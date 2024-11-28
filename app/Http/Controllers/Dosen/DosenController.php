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
        return view('dosen.editProfil', compact('user', 'dosen'));
    }

    public function updateProfil(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8',
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

    public function showNotifications()
    {
        $dosenId = Auth::user()->user_id;

        $pendingNotifications = Notification::where('dosen_id', $dosenId)
        ->where('request_status', 'pending')
        ->join('mahasiswa', 'notifications.mahasiswa_id', '=', 'mahasiswa.mahasiswa_id')
        ->join('users', 'mahasiswa.mahasiswa_id', '=', 'users.user_id')
        ->select('notifications.*', 'mahasiswa.nim', 'users.name')
        ->get();

    $approvedNotifications = Notification::where('dosen_id', $dosenId)
        ->where('request_status', 'accepted')
        ->join('mahasiswa', 'notifications.mahasiswa_id', '=', 'mahasiswa.mahasiswa_id')
        ->join('users', 'mahasiswa.mahasiswa_id', '=', 'users.user_id')
        ->select('notifications.*', 'mahasiswa.nim', 'users.name')
        ->get();

    $rejectedNotifications = Notification::where('dosen_id', $dosenId)
        ->where('request_status', 'rejected')
        ->join('mahasiswa', 'notifications.mahasiswa_id', '=', 'mahasiswa.mahasiswa_id')
        ->join('users', 'mahasiswa.mahasiswa_id', '=', 'users.user_id')
        ->select('notifications.*', 'mahasiswa.nim', 'users.name')
        ->get();

        return view('dosen.notifikasi', compact(
            'pendingNotifications',
            'approvedNotifications',
            'rejectedNotifications'
        ));
    }
}
