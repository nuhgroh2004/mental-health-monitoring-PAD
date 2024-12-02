<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\OTP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OTPController extends Controller
{
    public function otpVerificationForm(Request $request)
    {
        $dosenId = $request->session()->get('dosen_id');
        return view('dosen.otp', compact('dosenId'));
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

        // Add some logging or debugging
        \Log::info('Dosen ID: ' . $dosenId);
        \Log::info('Submitted OTP: ' . $otpCode);

        $otpRecord = OTP::where('dosen_id', $dosenId)
                        ->where('otp_code', $otpCode)
                        ->where('verified', 'no')
                        ->where('is_expired', 'no')
                        ->first();

        \Log::info('OTP Record: ' . ($otpRecord ? 'Found' : 'Not Found'));

        if ($otpRecord) {
            $otpRecord->verified = 'yes';
            $otpRecord->is_expired = 'yes'; // Mark as expired after successful verification
            $otpRecord->save();

            $dosen = Dosen::find($dosenId);
            $dosen->verified = 'yes';
            $dosen->save();

            // Find the user associated with this dosen
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
}
