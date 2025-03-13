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
use App\Models\OTP;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function storeMahasiswa(Request $request)
    {
        // Aturan validasi
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
            'g-recaptcha-response' => 'required|captcha',
        ];

        // Pesan error khusus
        $messages = [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'email.unique' => 'Email sudah terdaftar.',
            'email.regex' => 'Email harus menggunakan domain @mail.ugm.ac.id.',

            'prodi.required' => 'Program studi wajib diisi.',
            'prodi.string' => 'Program studi harus berupa teks.',
            'prodi.max' => 'Program studi maksimal 255 karakter.',

            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date_format' => 'Format tanggal lahir harus YYYY-MM-DD.',

            'phone_number.size' => 'Nomor telepon harus 11 digit.',
            'phone_number.regex' => 'Nomor telepon hanya boleh mengandung angka.',

            'nim.required' => 'NIM wajib diisi.',
            'nim.string' => 'NIM harus berupa teks.',
            'nim.max' => 'NIM maksimal 20 karakter.',
            'nim.unique' => 'NIM sudah terdaftar.',
            'nim.regex' => 'Format NIM tidak valid. Contoh yang benar: XX/XXXXXX/AA/XXXXX.',

            'password.required' => 'Password wajib diisi.',
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.regex' => 'Password harus mengandung setidaknya satu huruf dan satu angka.',

            'g-recaptcha-response.required' => 'Verifikasi CAPTCHA wajib dilakukan.',
            'g-recaptcha-response.captcha' => 'Verifikasi CAPTCHA gagal.',
        ];

        // Validasi request
        $request->validate($rules, $messages);

        // Membuat User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Mahasiswa',
        ]);

        // Membuat Mahasiswa
        Mahasiswa::create([
            'mahasiswa_id' => $user->user_id,
            'prodi' => $request->prodi,
            'NIM' => $request->nim,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nomor_hp' => $request->phone_number,
            'mahasiswa_role_id' => '1',
        ]);

        // Login otomatis
        Auth::attempt($request->only('email', 'password'));
        $request->session()->regenerate();

        // Redirect ke halaman mahasiswa
        return redirect()->route('mahasiswa.home')->withSuccess('Registered & logged in!');
    }


    public function storeDosen(Request $request)
    {
        // Aturan validasi
        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                'regex:/^[a-zA-Z0-9._%+-]+@ugm\.ac\.id$|^kalkulator\.exe72@gmail\.com$/',
                function ($attribute, $value, $fail) {
                    $userExists = User::where('email', $value)->first();
                    if ($userExists) {
                        $dosenExists = Dosen::where('dosen_id', $userExists->user_id)->first();
                        if ($dosenExists && $dosenExists->verified === 'yes') {
                            $fail('Email sudah terdaftar dan telah diverifikasi. Silakan login.');
                        }
                    }
                },
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Za-z])(?=.*\d).+$/',
            ],
            'g-recaptcha-response' => 'required|captcha',
        ];

        // Pesan error khusus
        $messages = [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'email.unique' => 'Email sudah terdaftar.',
            'email.regex' => 'Email harus menggunakan domain @ugm.ac.id',

            'password.required' => 'Password wajib diisi.',
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.regex' => 'Password harus mengandung setidaknya satu huruf dan satu angka.',

            'g-recaptcha-response.required' => 'Verifikasi CAPTCHA wajib dilakukan.',
            'g-recaptcha-response.captcha' => 'Verifikasi CAPTCHA gagal.',
        ];

        // Validasi request
        $request->validate($rules, $messages);

        $userExists = User::where('email', $request->email)->first();
        if ($userExists) {
            $dosenExists = Dosen::where('dosen_id', $userExists->user_id)->first();
            if ($dosenExists && $dosenExists->verified === 'no') {
                // Hapus data OTP yang terkait
                OTP::where('dosen_id', $userExists->user_id)->delete();

                // Hapus data dosen
                $dosenExists->delete();

                // Hapus data user
                $userExists->delete();
            }
        }


        // Membuat User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Dosen',
        ]);

        // Membuat Dosen
        $dosen = Dosen::create([
            'dosen_id' => $user->user_id,
            'verified' => 'no',
        ]);

        // Membuat OTP
        $otp = rand(1000, 9999);
        Log::info('OTP for Dosen registration: ' . $otp);

        OTP::create([
            'dosen_id' => $user->user_id,
            'otp_code' => $otp,
            'created_at' => now(),
            'verified' => "no",
            'expired_at' => now()->addMinutes(1)
        ]);

        // Kirim OTP via email
        dispatch(new SendMailJob($otp, $request->email));

        // Redirect ke halaman OTP-verifikasi
        $request->session()->put('dosen_id', $user->user_id); // Simpan `dosen_id` ke dalam sesi
        return redirect()->route('otp-verification');
    }

}

