<?php

namespace App\Http\Controllers\Mahasiswa;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class MahasiswaNotifController extends Controller
{
    public function index()
    {
        $mahasiswaId = Auth::user()->user_id;

        // Mendapatkan notifikasi berdasarkan status
        $unreadNotifications = Notification::where('read_status', 'unread')
        ->where('mahasiswa_id', $mahasiswaId)
        ->join('dosen', 'notifications.dosen_id', '=', 'dosen.dosen_id')
        ->join('users', 'dosen.dosen_id', '=', 'users.user_id')
        ->select('notifications.*', 'users.email', 'users.name')
        ->get();

        $historyNotifications = Notification::where('read_status', 'read')
        ->where('mahasiswa_id', $mahasiswaId)
        ->join('dosen', 'notifications.dosen_id', '=', 'dosen.dosen_id')
        ->join('users', 'dosen.dosen_id', '=', 'users.user_id')
        ->select('notifications.*', 'users.email', 'users.name')
        ->get();

        return view('mahasiswa.notifikasi', compact('unreadNotifications', 'historyNotifications'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|in:approve,reject',
        ]);

        $notification = Notification::findOrFail($id);

        // Memperbarui status berdasarkan aksi
        if ($request->action === 'approve') {
            $notification->request_status = 'accepted';
        } elseif ($request->action === 'reject') {
            $notification->request_status = 'rejected';
        }

        $notification->read_status = 'read';
        $notification->save();

        return response()->json(['success' => true, 'message' => 'Notification updated successfully']);
    }
}
