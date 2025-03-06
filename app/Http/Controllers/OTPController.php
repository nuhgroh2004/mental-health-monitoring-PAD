<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use App\Models\Dosen;
use App\Models\OTP;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OTPController extends Controller
{
    public function otpVerificationForm(Request $request) { 
        $dosenId = $request->session()->get('dosen_id'); 
        
        // Find the most recent OTP record for this user
        $otpRecord = OTP::where('dosen_id', $dosenId)
            ->where('verified', 'no')
            ->latest('created_at')
            ->first(); 
    
        // Calculate remaining time
        $now = now();
        $expiredAt = \Carbon\Carbon::parse($otpRecord->expired_at);
        
        // Check if OTP has expired
        if ($now->greaterThan($expiredAt)) {
            // Mark OTP as expired in the database
            $otpRecord->update([
                'is_expired' => 'yes'
            ]);
    
            // Redirect with expiration message
            return redirect()->route('dosen.register')->withErrors('Kode OTP telah kadaluarsa. Silakan minta kode baru.');
        }
    
        // Calculate remaining seconds
        $remainingTime = $now->diffInSeconds($expiredAt, false);
    
        // Store the exact expiration timestamp in the session
        $request->session()->put('otp_expiration', $expiredAt->timestamp);
    
        return view('dosen.otp', compact('dosenId', 'remainingTime', 'expiredAt'));
    }

    public function checkOtpStatus(Request $request) {
        $dosenId = $request->session()->get('dosen_id');
        
        $otpRecord = OTP::where('dosen_id', $dosenId)
            ->where('verified', 'no')
            ->latest('created_at')
            ->first();
        
        if (!$otpRecord || now()->greaterThan($otpRecord->expired_at)) {
            $otpRecord->update(['verified' => 'expired']);
            return response()->json(['status' => 'expired']);
        }
        
        return response()->json(['status' => 'active']);
    }

    public function verifyOTP(Request $request)
    {
        // Gabungkan array menjadi string
        $otpCode = implode('', $request->input('otp_code', []));
        
        // Validasi OTP
        $request->merge(['otp_code' => $otpCode]);
        $request->validate([
            'otp_code' => 'required|numeric|digits:4',
        ]);
    
        $dosenId = $request->session()->get('dosen_id');
    
        // Log untuk debugging 
        \Log::info('Dosen ID: ' . $dosenId);
        \Log::info('Submitted OTP: ' . $otpCode);
    
        // Cek apakah OTP ditemukan dan belum diverifikasi
        $otpRecord = OTP::where('dosen_id', $dosenId)
                        ->where('otp_code', $otpCode)
                        ->where('verified', 'no')
                        ->first();
    
        // Log untuk debugging
        \Log::info('OTP Record: ' . ($otpRecord ? 'Found' : 'Not Found'));
    
        if ($otpRecord) {
            // Cek apakah OTP sudah kadaluarsa
            if (now()->greaterThan($otpRecord->expired_at)) {
                // Tandai expired jika OTP sudah kadaluarsa
                $otpRecord->is_expired = 'yes';
                $otpRecord->save();
                return back()->withErrors(['otp' => 'Kode OTP telah kadaluarsa. Silakan kirim ulang OTP.']);
            }
    
            // Verifikasi OTP jika masih berlaku
            $otpRecord->verified = 'yes';
            $otpRecord->is_expired = 'yes'; // Tandai expired setelah verifikasi
            $otpRecord->save();
    
            $dosen = Dosen::find($dosenId);
            $dosen->verified = 'yes';
            $dosen->save();
    
            // Temukan user terkait dengan dosen
            $user = \App\Models\User::find($dosenId);
    
            if ($user) {
                Auth::login($user);
                return redirect()->route('dosen.home')->withSuccess('Registered & logged in!');
            } else {
                return back()->withErrors(['otp' => 'User not found.']);
            }
        } else {
            return back()->withErrors(['otp' => 'Kode OTP salah. Silakan coba lagi.']);
        }
    }
    
    // Controller (resendOtp function)
    public function resendOtp(Request $request)
    {
        // Mendapatkan dosen_id dari sesi
        $dosenId = $request->session()->get('dosen_id');

        // Ambil record OTP yang belum diverifikasi
        $otpRecord = OTP::where('dosen_id', $dosenId)
                        ->where('verified', 'no')
                        ->first();

        if (!$otpRecord) {
            return back()->withErrors(['otp' => 'OTP tidak ditemukan atau sudah diverifikasi.']);
        }

        // Generate OTP baru
        $newOtp = rand(1000, 9999);
        $otpRecord->otp_code = $newOtp;
        $otpRecord->expired_at = now()->addMinutes(1); // Setel expired_at baru
        $otpRecord->verified = 'no'; // Setel status menjadi belum diverifikasi
        $otpRecord->save();

        // Ambil email dosen dari database berdasarkan dosen_id
        $user = User::find($dosenId);
        if (!$user || !filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
            return back()->withErrors(['otp' => 'Alamat email tidak valid.']);
        }

        $email = $user->email; // Ambil email dari user yang terkait

        // Kirim OTP baru via email
        dispatch(new SendMailJob($newOtp, $email));

        return back()->withSuccess('OTP baru telah dikirim ke email Anda.');
    }

    
}
