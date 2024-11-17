<?php

namespace App\Http\Controllers;
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
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan');
        }

        return view('mahasiswa.profil', compact('user', 'mahasiswa'));
    }

    public function bukaEdit(){
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('mahasiswa_id', $user->user_id)->first();
        return view('mahasiswa.editProfil', compact('user', 'mahasiswa'));
    }

    public function updateProfil(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8',
            'NIM' => 'required|string|max:20',
            'prodi' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'nomor_hp' => 'required|string|max:15',
        ]);

        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('mahasiswa_id', $user->user_id)->first();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $mahasiswa->NIM = $request->input('NIM');
        $mahasiswa->prodi = $request->input('prodi');
        $mahasiswa->tanggal_lahir = $request->input('tanggal_lahir');
        $mahasiswa->nomor_hp = $request->input('nomor_hp');

        $user->save();
        $mahasiswa->save();

        // Response as JSON
        return response()->json([
            'status' => 'success',
            'message' => 'Profil berhasil diperbarui.',
        ]);
    }


}
