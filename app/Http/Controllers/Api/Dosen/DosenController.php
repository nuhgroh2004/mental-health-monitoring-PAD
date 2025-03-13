<?php

namespace app\Http\Controllers\Api\Dosen;
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
            return response()->json([
                'status' => 'error',
                'message' => 'Data dosen tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'dosen' => $dosen
        ]);
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

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Profil dosen berhasil diperbarui.'
        ], 200);
    }
}
