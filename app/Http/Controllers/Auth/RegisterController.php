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
use App\Models\User;
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
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
                'regex:/^[a-zA-Z0-9._%+-]+@mail\.ugm\.ac\.id$/',
            ],
            'prodi' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date_format:Y-m-d',
            'phone_number' => 'nullable|string|size:11|regex:/^[0-9]+$/',
            'nim' => [
                'required',
                'string',
                'max:20',
                'unique:mahasiswa,NIM',
                'regex:/^\d{2}\/\d{6}\/[A-Za-z]{2}\/\d{5}$/', // Format XX/XXXXXX/AA/XXXXX
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Za-z])(?=.*\d).+$/',
            ],
            'g-recaptcha-response' => 'required|captcha',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Mahasiswa',
        ]);

        Mahasiswa::create([
            'mahasiswa_id' => $user->user_id,
            'prodi' => $request->prodi,
            'NIM' => $request->nim,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nomor_hp' => $request->phone_number,
            'mahasiswa_role' => 'role_1',
        ]);

        Auth::attempt($request->only('email', 'password'));
        $request->session()->regenerate();

        return redirect()->route('mahasiswa.home')->withSuccess('Registered & logged in!');
    }

    public function storeDosen(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
                'regex:/^[a-zA-Z0-9._%+-]+@ugm\.ac\.id$/',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Za-z])(?=.*\d).+$/',
            ],
            'g-recaptcha-response' => 'required|captcha',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Dosen',
        ]);

        Dosen::create([
            'dosen_id' => $user->user_id,
            'verified' => 'no',
        ]);

        // $otp = rand(1000, 9999);
        // Log::info('OTP for Dosen registration: ' . $otp);

        // dispatch(new SendMailJob($otp, $request->email));

        // Auth::attempt($request->only('email', 'password'));
        // $request->session()->regenerate();

        Auth::attempt($request->only('email', 'password'));
        $request->session()->regenerate();

        return redirect()->route('dosen.home')->withSuccess('Registered & logged in!');
    }
}

