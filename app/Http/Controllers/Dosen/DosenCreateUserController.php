<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\MahasiswaRole;
use App\Models\User;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class DosenCreateUserController extends Controller
{
    public function create()
    {
        $roles = MahasiswaRole::select([
            'mahasiswa_role_id as id',
            'name'
         ])->get();

    return view('dosen.create-user', compact('roles'));
    }

    public function storeUserManual(Request $request)
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

    public function importUserExcel(Request $request)
    {
        if (!$request->hasFile('file')) {
            return response()->json(['status' => 'error', 'message' => 'Tidak ada file yang diupload'], 400);
        }

        $file = $request->file('file');

        try {
            $spreadsheet = IOFactory::load($file->getPathname());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            $importedUsers = [];
            $failedRows = [];

            for ($i = 1; $i < count($rows); $i++) {
                $row = $rows[$i];
                $errors = [];

                // Ambil kolom
                $email = trim($row[0] ?? '');
                $password = $row[1] ?? '';
                $name = trim($row[2] ?? '');
                $nim = trim($row[3] ?? '');
                $prodi = trim($row[4] ?? '');
                $tanggalLahirRaw = $row[5] ?? '';
                $phone = preg_replace('/[^0-9]/', '', $row[6] ?? '');

                // Validasi kolom satu per satu
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = 'Email tidak valid';
                } elseif (User::where('email', $email)->exists()) {
                    $errors[] = 'Email sudah digunakan';
                }

                if (strlen($password) < 6) {
                    $errors[] = 'Password minimal 6 karakter';
                }

                if (strlen($name) === 0) {
                    $errors[] = 'Nama tidak boleh kosong';
                }

                if (strlen($nim) > 20) {
                    $errors[] = 'NIM maksimal 20 karakter';
                }

                if (strlen($prodi) === 0) {
                    $errors[] = 'Prodi wajib diisi';
                }

                try {
                    if (is_numeric($tanggalLahirRaw)) {
                        $tanggalLahir = Date::excelToDateTimeObject($tanggalLahirRaw)->format('Y-m-d');
                    } else {
                        $tanggalLahir = Carbon::parse($tanggalLahirRaw)->format('Y-m-d');
                    }
                } catch (\Exception $e) {
                    $errors[] = 'Format tanggal lahir tidak valid';
                }

                if (!preg_match('/^[0-9]{10,12}$/', $phone)) {
                    $errors[] = 'Nomor HP harus 10-12 digit angka';
                }

                // Kalau ada error, log dan skip
                if (!empty($errors)) {
                    $failedRows[] = [
                        'row' => $i + 1,
                        'errors' => $errors
                    ];
                    continue;
                }

                try {
                    // Buat user
                    $user = User::create([
                        'name' => $name,
                        'email' => $email,
                        'password' => Hash::make($password),
                        'role' => 'Mahasiswa',
                    ]);

                    Mahasiswa::create([
                        'mahasiswa_id' => $user->user_id,
                        'NIM' => $nim,
                        'prodi' => $prodi,
                        'tanggal_lahir' => $tanggalLahir,
                        'nomor_hp' => $phone,
                        'mahasiswa_role_id' => 1,
                    ]);

                    $importedUsers[] = $user;
                } catch (\Exception $e) {
                    $failedRows[] = [
                        'row' => $i + 1,
                        'errors' => ['Gagal menyimpan ke database: ' . $e->getMessage()]
                    ];
                    continue;
                }
            }

            return response()->json([
                'status' => 'success',
                'imported_users' => $importedUsers,
                'failed_rows' => $failedRows,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memproses file: ' . $e->getMessage()
            ], 500);
        }
    }

}
