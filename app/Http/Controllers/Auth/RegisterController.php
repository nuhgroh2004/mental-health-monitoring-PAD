<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Log;

use App\Jobs\SendMailJob;
use App\Mail\SendEmail;
use App\http\conroller\sendEmailController;
use Illuminate\Support\Facades\Storage;


class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function storeMahasiswa(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:50|unique:mahasiswas',
            'prodi' => 'required|string|max:100|',
            'tanggal_lahir' => 'required|date_format:Y-m-d',
            'phone_number' => 'nullable|string|size:11|regex:/^[0-9]+$/',
            'nim' => 'required|string|max:15|unique:mahasiswas',
            'password' => 'required|min:8',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        Mahasiswa::create([
            'name' => $request->name,
            'email' => $request->email,
            'prodi' => $request->prodi,
            'tanggal_lahir' => $request->tanggal_lahir,
            'phone_number' => $request->phone_number,
            'NIM' => $request->nim,
            'password' => Hash::make($request->password),
        ]);

        Auth::attempt($request->only('email', 'password'));
        $request->session()->regenerate();
        return redirect()->route('mahasiswa.home')->withSuccess('Registered & logged in!');
    }

    public function storeDosen(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:50|unique:dosens',
            'password' => 'required|min:8',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        Dosen::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);



        $otp = rand(1000, 9999);
        Log::info('OTP for Dosen registration: ' . $otp);

        dispatch(new SendMailJob($otp));


        Auth::attempt($request->only('email', 'password'));
        $request->session()->regenerate();
        return redirect()->route('dosen.otp')->withSuccess('Registered & logged in!');
    }
}
