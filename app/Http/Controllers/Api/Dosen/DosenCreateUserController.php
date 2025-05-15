<?php

namespace App\Http\Controllers\Api\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\MahasiswaRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class DosenCreateUserController extends Controller
{
    public function store(Request $request)
    {
        // Ambil semua role yang valid dari database
        $validRoles = MahasiswaRole::pluck('mahasiswa_role_id')->toArray();

        // Aturan validasi
        $rules = [
            'users.*.name' => 'required|string|max:255',
            'users.*.email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
                'regex:/^[a-zA-Z0-9._%+-]+@mail\.ugm\.ac\.id$/',
            ],
            'users.*.prodi' => 'required|string|max:255',
            'users.*.tanggal_lahir' => 'required|date_format:Y-m-d',
            'users.*.phone' => 'nullable|string|digits_between:10,12|regex:/^[0-9]+$/',
            'users.*.nim' => [
                'required',
                'string',
                'max:20',
                'unique:mahasiswa,NIM',
                'regex:/^\d{2}\/\d{6}\/[A-Za-z]{2}\/\d{5}$/', // Format XX/XXXXXX/AA/XXXXX
            ],
            'users.*.password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Za-z])(?=.*\d).+$/',
            ],
            'users.*.role' => [
                'required',
                Rule::in($validRoles)
            ],
        ];

        // Pesan error khusus
        $messages = [
            'users.*.name.required' => 'Nama wajib diisi untuk semua user.',
            'users.*.name.string' => 'Nama harus berupa teks.',
            'users.*.name.max' => 'Nama maksimal 255 karakter.',

            'users.*.email.required' => 'Email wajib diisi untuk semua user.',
            'users.*.email.email' => 'Format email tidak valid.',
            'users.*.email.max' => 'Email maksimal 255 karakter.',
            'users.*.email.unique' => 'Email sudah terdaftar.',
            'users.*.email.regex' => 'Email harus menggunakan domain @mail.ugm.ac.id.',

            'users.*.prodi.required' => 'Program studi wajib diisi untuk semua user.',
            'users.*.prodi.string' => 'Program studi harus berupa teks.',
            'users.*.prodi.max' => 'Program studi maksimal 255 karakter.',

            'users.*.tanggal_lahir.required' => 'Tanggal lahir wajib diisi untuk semua user.',
            'users.*.tanggal_lahir.date_format' => 'Format tanggal lahir harus YYYY-MM-DD.',

            'users.*.phone.digits_between' => 'Nomor telepon harus antara 10 dan 12 digit.',
            'users.*.phone.regex' => 'Nomor telepon hanya boleh mengandung angka.',

            'users.*.nim.required' => 'NIM wajib diisi untuk semua user.',
            'users.*.nim.string' => 'NIM harus berupa teks.',
            'users.*.nim.max' => 'NIM maksimal 20 karakter.',
            'users.*.nim.unique' => 'NIM sudah terdaftar.',
            'users.*.nim.regex' => 'Format NIM tidak valid. Contoh yang benar: XX/XXXXXX/AA/XXXXX.',

            'users.*.password.required' => 'Password wajib diisi untuk semua user.',
            'users.*.password.string' => 'Password harus berupa teks.',
            'users.*.password.min' => 'Password minimal 8 karakter.',
            'users.*.password.regex' => 'Password harus mengandung setidaknya satu huruf dan satu angka.',

            'users.*.role.required' => 'Role wajib dipilih untuk semua user.',
            'users.*.role.in' => 'Role yang dipilih tidak valid.',
        ];

        // Validasi request
        $validatedData = $request->validate($rules, $messages);

        DB::beginTransaction();
        try {
            $createdUsers = [];

            foreach ($request->users as $userData) {
                // Buat user
                $user = User::create([
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'password' => Hash::make($userData['password']),
                    'role' => 'Mahasiswa',
                ]);

                // Buat mahasiswa
                Mahasiswa::create([
                    'mahasiswa_id' => $user->user_id,
                    'prodi' => $userData['prodi'],
                    'NIM' => $userData['nim'],
                    'tanggal_lahir' => $userData['tanggal_lahir'],
                    'nomor_hp' => $userData['phone'] ?? null,
                    'mahasiswa_role_id' => $userData['role'],
                ]);

                $roleName = MahasiswaRole::where('mahasiswa_role_id', $userData['role'])->value('name');

                $createdUsers[] = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'role_id' => $userData['role'],
                    'nama_role' => $roleName
                ];
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'User berhasil ditambahkan',
                'created_users' => $createdUsers
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
