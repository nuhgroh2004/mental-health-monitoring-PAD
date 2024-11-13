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
}
