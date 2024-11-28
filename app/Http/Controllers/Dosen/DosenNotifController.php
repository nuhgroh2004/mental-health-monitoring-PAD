<?php

namespace App\Http\Controllers\Dosen;
use App\Http\Controllers\Controller;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;


class DosenNotifController extends Controller
{
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
