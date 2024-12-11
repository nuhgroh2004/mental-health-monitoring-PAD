<?php

namespace App\Http\Controllers\Dosen;
use App\Http\Controllers\Controller;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DosenCreateUserController extends Controller
{
    public function create()
    {
        return view('dosen.create-user');
    }

    public function store(Request $request)
    {
        $usersData = $request->validate([
            'users' => 'required|array',
            'users.*.name' => 'required|string|max:255',
            'users.*.email' => 'required|string|email|max:255|distinct|unique:users,email',
            'users.*.password' => 'required|string|min:8',
            'users.*.nim' => 'required|string|distinct|unique:mahasiswa,NIM',
            'users.*.prodi' => 'nullable|string|max:255',
            'users.*.tanggal_lahir' => 'nullable|date',
            'users.*.phone' => 'nullable|string|max:15',
            'users.*.role' => 'required|string|in:role_1,role_2',
        ]);

        try {
            DB::beginTransaction();

            $createdUsers = [];
            foreach ($usersData['users'] as $userData) {
                // Simpan ke tabel users
                $user = User::create([
                    'email' => $userData['email'],
                    'password' => Hash::make($userData['password']),
                    'name' => $userData['name'],
                ]);

                // Simpan ke tabel mahasiswa
                Mahasiswa::create([
                    'mahasiswa_id' => $user->user_id,
                    'NIM' => $userData['nim'],
                    'prodi' => $userData['prodi'] ?? null,
                    'tanggal_lahir' => $userData['tanggal_lahir'] ?? null,
                    'nomor_hp' => $userData['phone'] ?? null,
                    'mahasiswa_role' => $userData['role'],
                ]);

                $createdUsers[] = $user;
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => count($createdUsers) . ' user(s) berhasil ditambahkan',
                'users' => $createdUsers
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
