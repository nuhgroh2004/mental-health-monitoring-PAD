<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMailController;

class DosenRegisterController extends Controller
{
    public function process(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // // Cek domain UGM
        // if (!str_ends_with($request->email, '@ugm.ac.id')) {
        //     return back()->withErrors(['email' => 'Gunakan email UGM anda.']);
        // }

        // Cek apakah email sudah terdaftar
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return back()->withErrors(['email' => 'Email sudah terdaftar.']);
        }

        // Generate OTP
        $otp = rand(1000, 9999);

        // Kirim OTP via email
        Mail::to($request->email)->send(new OtpMail($otp));

        // Simpan OTP dan waktu kedaluwarsa di session
        session(['otp' => $otp, 'otp_expiration' => now()->addMinutes(1)]);

        return view('auth.verify_otp', ['email' => $request->email]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:4',
        ]);

        // Cek apakah OTP sesuai
        if ($request->otp != session('otp')) {
            return back()->withErrors(['otp' => 'OTP salah.']);
        }

        // Cek apakah OTP sudah kedaluwarsa
        if (now()->greaterThan(session('otp_expiration'))) {
            return back()->withErrors(['otp' => 'OTP sudah kadaluwarsa.']);
        }

        // Proses registrasi user jika OTP valid
        User::create([
            'email' => session('email'),
            'password' => bcrypt($request->password),
            // tambahkan data lain yang diperlukan
        ]);

        return redirect()->route('dosen.landingPage')->with('success', 'Registrasi berhasil!');
    }
}
