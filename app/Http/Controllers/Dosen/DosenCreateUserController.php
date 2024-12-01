<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DosenCreateUserController extends Controller
{
    public function create()
    {
        return view('dosen.users.create');
    }

    public function store(Request $request)
    {
        dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'nim' => 'required|string|unique:mahasiswa,NIM',
            'prodi' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'phone' => 'nullable|string|max:15',
            'role' => 'required|string|in:role_1,role_2',
        ]);

        try {
            // Simpan ke tabel users
            $user = User::create([
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'name' => $validatedData['name'],
                'role' => $validatedData['role'],
            ]);

            // Simpan ke tabel mahasiswa
            Mahasiswa::create([
                'mahasiswa_id' => $user->id,
                'NIM' => $validatedData['nim'],
                'prodi' => $validatedData['prodi'] ?? null,
                'tanggal_lahir' => $validatedData['tanggal_lahir'] ?? null,
                'nomor_hp' => $validatedData['phone'] ?? null,
                'mahasiswa_role' => $validatedData['role'],
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'User berhasil ditambahkan',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
