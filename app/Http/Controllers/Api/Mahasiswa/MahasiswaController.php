<?php

namespace App\Http\Controllers\Api\Mahasiswa;
use App\Http\Controllers\Controller;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function showProfil()
    {
        $user = Auth::user();

        $mahasiswa = Mahasiswa::where('mahasiswa_id', $user->user_id)->first();

        if (!$mahasiswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data mahasiswa tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'mahasiswa' => $mahasiswa
        ]);
    }

    public function updateProfil(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                'regex:/^[a-zA-Z0-9._%+-]+@mail\.ugm\.ac\.id$/',
            ],
            'prodi' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date_format:Y-m-d',
            'phone_number' => 'nullable|string|size:11|regex:/^[0-9]+$/',
            'nim' => [
                'required',
                'string',
                'max:20',
                'regex:/^\d{2}\/\d{6}\/[A-Za-z]{2}\/\d{5}$/',
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Za-z])(?=.*\d).+$/',
            ],
        ]);

        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('mahasiswa_id', $user->user_id)->first();

        // ✅ Update data di tabel users
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password
        ]);

        // ✅ Update data di tabel mahasiswa
        $mahasiswa->update([
            'NIM' => $request->nim,
            'prodi' => $request->prodi,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nomor_hp' => $request->phone_number
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Profil mahasiswa berhasil diperbarui.'
        ], 200);
    }
}
