<?php

namespace App\Http\Controllers\Api\Auth;

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
use App\Models\OTP;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function storeMahasiswa(Request $request)
    {
        $rules = [
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
        ];

        $validated = $request->validate($rules);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'Mahasiswa'
        ]);

        Mahasiswa::create([
            'mahasiswa_id' => $user->user_id,
            'prodi' => $validated['prodi'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'nomor_hp' => $validated['phone_number'],
            'NIM' => $validated['nim'],
            'mahasiswa_role_id' => '1',
        ]);

        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'message' => 'Mahasiswa registered successfully',
            'token' => $token
        ], 201);
    }

    public function storeDosen(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|regex:/@ugm\.ac\.id$/|unique:users,email',
            'password' => 'required|string|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d).+$/',
        ];

        $validated = $request->validate($rules);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'Dosen'
        ]);

        Dosen::create([
            'dosen_id' => $user->user_id,
            'verified' => 'no'
        ]);

        $otp = rand(1000, 9999);
        OTP::create([
            'dosen_id' => $user->user_id,
            'otp_code' => $otp,
            'verified' => 'no',
            'expired_at' => now()->addMinutes(1)
        ]);

        dispatch(new SendMailJob($otp, $validated['email']));

        return response()->json([
            'message' => 'Dosen registered successfully, OTP sent to email'
        ], 201);
    }



}
