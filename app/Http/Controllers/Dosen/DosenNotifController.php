<?php

namespace App\Http\Controllers\Dosen;
use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;

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

    public function downloadPDF($notificationId)
    {
        // Ambil notifikasi berdasarkan ID
        $notification = Notification::findOrFail($notificationId);

        // Ambil mahasiswa yang terkait
        $mahasiswa = Mahasiswa::findOrFail($notification->mahasiswa_id);

        // Hitung tanggal 90 hari lalu
        $startDate = Carbon::now()->subDays(90);

        // Ambil mood dan progress mahasiswa selama 90 hari
        $moodProgressData = $mahasiswa->moodProgressData($startDate);

        // Ambil nama mahasiswa dari relasi user dan NIM dari mahasiswa
        $name = $mahasiswa->user ? $mahasiswa->user->name : 'N/A';  // Nama dari tabel users
        $nim = $mahasiswa->NIM; // NIM dari tabel mahasiswa

        // Buat view untuk PDF
        $pdf = FacadePdf::loadView('dosen.pdf_report', compact('moodProgressData', 'name', 'nim'));

        // Download PDF
        return $pdf->download('mood_progress_report.pdf');
    }
}
