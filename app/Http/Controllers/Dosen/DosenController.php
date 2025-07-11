<?php

namespace App\Http\Controllers\Dosen;
use App\Http\Controllers\Controller;

use App\Models\Dosen;
use App\Models\Notification;
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


    public function bukaEdit(){
        $user = Auth::user();
        $dosen = Dosen::where('dosen_id', $user->user_id)->first();
        return view('dosen.edit-profil', compact('user', 'dosen'));
    }

    public function updateProfil(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                'regex:/^[a-zA-Z0-9._%+-]+@ugm\.ac\.id$/',
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Za-z])(?=.*\d).+$/',
            ],
        ]);

        $user = Auth::user();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        // Response as JSON
        return response()->json([
            'status' => 'success',
            'message' => 'Profil berhasil diperbarui.',
        ]);
    }

}
