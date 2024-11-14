<?php

namespace App\Http\Controllers;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function showProfil()
    {
        $user = Auth::user();

        $dosen = Dosen::where('dosen_id', $user->user_id)->first();

        if (!$dosen) {
            return redirect()->back()->with('error', 'Data dosen tidak ditemukan');
        }

        return view('dosen.profil', compact('user', 'dosen'));
    }
}
