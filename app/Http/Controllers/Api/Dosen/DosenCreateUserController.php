<?php

namespace App\Http\Controllers\Api\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\MahasiswaRole;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;

class DosenCreateUserController extends Controller
{
    public function storeUserManualAPI(Request $request)
    {
        $validRoles = MahasiswaRole::pluck('mahasiswa_role_id')->toArray();
        $errors = [];
        $createdUsers = [];

        foreach ($request->users as $index => $userData) {
            $validator = Validator::make($userData, [
                'name' => 'required|string|max:255',
                'email' => [
                    'required', 'email', 'max:255', 'unique:users,email',
                    'regex:/^[a-zA-Z0-9._%+-]+@mail\.ugm\.ac\.id$/',
                ],
                'prodi' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date_format:Y-m-d',
                'phone' => 'nullable|string|digits_between:10,12|regex:/^[0-9]+$/',
                'nim' => [
                    'required', 'string', 'max:20', 'unique:mahasiswa,NIM',
                    'regex:/^\d{2}\/\d{6}\/[A-Za-z]{2}\/\d{5}$/',
                ],
                'password' => [
                    'required', 'string', 'min:8',
                    'regex:/^(?=.*[A-Za-z])(?=.*\d).+$/',
                ],
                'role' => ['required', Rule::in($validRoles)],
            ]);

            if ($validator->fails()) {
                $errors["user_$index"] = $validator->errors();
                continue; // skip user invalid
            }

            // Jika valid, simpan ke DB:
            DB::beginTransaction();
            try {
                $user = User::create([
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'password' => Hash::make($userData['password']),
                    'role' => 'Mahasiswa',
                ]);

                Mahasiswa::create([
                    'mahasiswa_id' => $user->user_id,
                    'prodi' => $userData['prodi'],
                    'NIM' => $userData['nim'],
                    'tanggal_lahir' => $userData['tanggal_lahir'],
                    'nomor_hp' => $userData['phone'] ?? null,
                    'mahasiswa_role_id' => $userData['role'],
                ]);

                $createdUsers[] = $user;
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $errors["user_$index"] = $e->getMessage();
            }
        }
    }

    public function importUserExcelAPI(Request $request)
    {
        if (!$request->hasFile('file')) {
            return response()->json(['status' => 'error', 'message' => 'Tidak ada file yang diupload'], 400);
        }

        $file = $request->file('file');

        try {
            $spreadsheet = IOFactory::load($file->getPathname());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            $resultRows = [];

            for ($i = 1; $i < count($rows); $i++) {
                $row = $rows[$i];
                $errors = [];

                $email = trim($row[0] ?? '');
                $password = $row[1] ?? '';
                $name = trim($row[2] ?? '');
                $nim = trim($row[3] ?? '');
                $prodi = trim($row[4] ?? '');
                $tanggalLahirRaw = $row[5] ?? '';
                $phone = preg_replace('/[^0-9]/', '', $row[6] ?? '');

                // Validasi data
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
                    $tanggalLahir = null;
                    $errors[] = 'Format tanggal lahir tidak valid';
                }

                if (!preg_match('/^[0-9]{10,12}$/', $phone)) {
                    $errors[] = 'Nomor HP harus 10 sampai 12 digit angka';
                }

                $userData = [
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'nim' => $nim,
                    'prodi' => $prodi,
                    'tanggal_lahir' => $tanggalLahir,
                    'nomor_hp' => $phone,
                ];

                if (!empty($errors)) {
                    $userData['status'] = 'failed';
                    $userData['errors'] = $errors;
                } else {
                    try {
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

                        $userData['status'] = 'success';
                    } catch (\Exception $e) {
                        $userData['status'] = 'failed';
                        $userData['errors'] = ['Gagal menyimpan ke database: ' . $e->getMessage()];
                    }
                }

                $resultRows[] = $userData;
            }

            return response()->json([
                'status' => 'completed',
                'results' => $resultRows
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memproses file: ' . $e->getMessage()
            ], 500);
        }
    }


}
