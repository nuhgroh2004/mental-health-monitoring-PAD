<?php

namespace App\Http\Controllers\Mahasiswa;
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
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan');
        }

        return view('mahasiswa.profil', compact('user', 'mahasiswa'));
    }

    public function bukaEdit(){
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('mahasiswa_id', $user->user_id)->first();
        return view('mahasiswa.edit-profil', compact('user', 'mahasiswa'));
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
            'NIM' => [
                'required',
                'string',
                'max:20',
                'regex:/^\d{2}\/\d{6}\/[A-Za-z]{2}\/\d{5}$/', // Format XX/XXXXXX/AA/XXXXX
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
