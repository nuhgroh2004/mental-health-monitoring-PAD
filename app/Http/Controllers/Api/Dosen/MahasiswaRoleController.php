<?php

namespace App\Http\Controllers\Api\dosen;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\MahasiswaRole;
use App\Models\Mahasiswa;

class MahasiswaRoleController extends Controller
{
    // Menampilkan semua role yang tersedia
    public function index()
    {
        $roles = MahasiswaRole::whereNotIn('mahasiswa_role_id', [1, 2])->get([
        'mahasiswa_role_id',
        'name',
        'min_intensity',
        'max_intensity'
    ]);
        return response()->json($roles);
    }

    // Membuat role baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:mahasiswa_role,name',
            'min_intensity' => 'required|integer|min:1|max:100',
            'max_intensity' => 'required|integer|min:1|max:100|gt:min_intensity',
        ]);

        $role = MahasiswaRole::create([
            'name' => $request->name,
            'min_intensity' => $request->min_intensity,
            'max_intensity' => $request->max_intensity
        ]);

        return response()->json([
        'success' => true,
        'role' => [
        'mahasiswa_role_id' => $role->mahasiswa_role_id,
        'name' => $role->name,
        'min_intensity' => $role->min_intensity,
        'max_intensity' => $role->max_intensity
        ]
    ], 200, ['Content-Type' => 'application/json']);
    }    // Mengubah role mahasiswa
    public function updateMahasiswaRole(Request $request, $mahasiswa_id)
    {

        $validated = $request->validate([
            'mahasiswa_role_id' => 'required|exists:mahasiswa_role,mahasiswa_role_id'
        ]);

        $mahasiswa = Mahasiswa::findOrFail($mahasiswa_id);
        $mahasiswa->mahasiswa_role_id = $validated['mahasiswa_role_id']; // Harusnya mahasiswa_role_id
        $mahasiswa->save();

        return response()->json(['success' => true, 'message' => 'Role mahasiswa berhasil diperbarui']);
    }


    // Menghapus role dan atur mahasiswa ke role default (1)
    public function deleteRole($role_id)
    {
        $role = MahasiswaRole::findOrFail($role_id);

        // Set semua mahasiswa dengan role ini ke role default (1)
        Mahasiswa::where('mahasiswa_role_id', $role_id)->update(['mahasiswa_role_id' => 1]);

        $role->delete();

        return response()->json(['success' => true, 'message' => 'Role berhasil dihapus dan mahasiswa diperbarui ke default.']);
    }


}
