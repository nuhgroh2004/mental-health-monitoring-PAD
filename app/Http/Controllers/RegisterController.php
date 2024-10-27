<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
//     public function register(Request $request)
// {
//     $request->validate([
//         'username' => 'required',
//         'email' => 'required|email',
//         'password' => 'required|min:6',
//         'nim' => 'required|numeric',
//         'captcha' => 'required|captcha',
//     ]);

//     // Lanjutkan proses pendaftaran jika CAPTCHA dan data lain valid
// }

public function register(Request $request)
{
    $request->validate([
        'username' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6',
        'nim' => 'required|numeric',
        'captcha' => 'required|captcha',
    ]);

    // Cek apakah email memiliki domain @ugm.ac.id
    if (!str_ends_with($request->email, '@ugm.ac.id')) {
        return back()->withErrors(['email' => 'Email harus menggunakan domain @ugm.ac.id']);
    }

    // Cek apakah email sudah terdaftar di database
    if (User::where('email', $request->email)->exists()) {
        return back()->withErrors(['email' => 'Email sudah terdaftar']);
    }

    // Lanjutkan dengan mengirim OTP
    // Simpan data sementara di sesi atau cache
    session(['register_data' => $request->only('username', 'email', 'password', 'nim')]);

    // Kirim OTP ke email (gunakan job/queue untuk pengiriman email)
    $otp = rand(100000, 999999); // Kode OTP
    session(['otp' => $otp, 'otp_expires_at' => now()->addMinutes(1)]); // Simpan OTP dengan waktu kadaluarsa 60 detik
    Mail::to($request->email)->send(new SendOtpMail($otp));

    // Arahkan ke halaman OTP
    return redirect()->route('dosen.otp');
}

// verifikasi OTP
public function verifyOtp(Request $request)
{
    $request->validate([
        'otp' => 'required|numeric',
    ]);

    // Cek apakah OTP sudah kadaluarsa
    if (now()->greaterThan(session('otp_expires_at'))) {
        return back()->withErrors(['otp' => 'Kode OTP sudah kadaluarsa. Silakan coba lagi.']);
    }

    // Cek apakah OTP valid
    if ($request->otp != session('otp')) {
        return back()->withErrors(['otp' => 'Kode OTP salah.']);
    }

    // Buat user dengan role dosen
    $registerData = session('register_data');
    $user = User::create([
        'username' => $registerData['username'],
        'email' => $registerData['email'],
        'password' => bcrypt($registerData['password']),
        'nim' => $registerData['nim'],
        'role' => 'dosen', // Atur role dosen
    ]);

    // Bersihkan sesi
    session()->forget(['otp', 'otp_expires_at', 'register_data']);

    // Arahkan ke halaman dosen
    return redirect()->route('dosen.landingPage');
}

// Kirim ulang OTP
public function resendOtp()
{
    // Cek apakah waktu sudah habis
    if (now()->lessThan(session('otp_expires_at'))) {
        return back()->withErrors(['otp' => 'Anda harus menunggu waktu habis sebelum meminta kode OTP baru.']);
    }

    // Buat OTP baru
    $otp = rand(100000, 999999);
    session(['otp' => $otp, 'otp_expires_at' => now()->addMinutes(1)]); // Reset timer

    // Kirim ulang OTP ke email
    Mail::to(session('register_data')['email'])->send(new SendOtpMail($otp));

    return back()->with('status', 'Kode OTP baru telah dikirim.');
}

}
