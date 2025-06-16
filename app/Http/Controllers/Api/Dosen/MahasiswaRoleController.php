<?php

namespace App\Http\Controllers\Api\dosen;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\MahasiswaRole;
use App\Models\Mahasiswa;

class MahasiswaRoleController extends Controller
{
    // Menampilkan semua role yang tersedia
    public function index(Request $request)
    {
        $mahasiswaId = $request->query('mahasiswa_id');

        // Jika ada parameter mahasiswa_id, kembalikan role milik mahasiswa tersebut
        if ($mahasiswaId) {
            $mahasiswa = Mahasiswa::with('role')->find($mahasiswaId);

            if (!$mahasiswa || !$mahasiswa->role) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mahasiswa atau role tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'role' => [
                    'mahasiswa_role_id' => $mahasiswa->role->mahasiswa_role_id,
                    'name' => $mahasiswa->role->name,
                    'min_intensity' => $mahasiswa->role->min_intensity,
                    'max_intensity' => $mahasiswa->role->max_intensity
                ]
            ]);
        }

        // Jika tidak ada mahasiswa_id, kembalikan semua role kecuali ID 1 dan 2
        $roles = MahasiswaRole::get([
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
    }

    // Mengubah role mahasiswa
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
        // Hitung jumlah total role
        $totalRoles = MahasiswaRole::count();

        // Cek jika role hanya 1, tolak penghapusan
        if ($totalRoles <= 1) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat menghapus role karena hanya ada satu role yang tersedia.'
            ], 400);
        }

        $role = MahasiswaRole::findOrFail($role_id);

        // Cari role_id terendah selain yang akan dihapus
        $defaultRole = MahasiswaRole::where('mahasiswa_role_id', '!=', $role_id)
            ->orderBy('mahasiswa_role_id', 'asc')
            ->first();

        // Jika tidak ada role lain, kembalikan error
        if (!$defaultRole) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada role lain untuk dijadikan default.'
            ], 400);
        }

        // Set semua mahasiswa dengan role ini ke role dengan ID terendah
        Mahasiswa::where('mahasiswa_role_id', $role_id)
            ->update(['mahasiswa_role_id' => $defaultRole->mahasiswa_role_id]);

        // Hapus role
        $role->delete();

        return response()->json([
            'success' => true,
            'message' => 'Role berhasil dihapus. Mahasiswa dipindahkan ke role "' . $defaultRole->name . '".'
        ]);
    }


}
