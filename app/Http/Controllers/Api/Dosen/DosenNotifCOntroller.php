<?php

namespace App\Http\Controllers\Api\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class DosenNotifCOntroller extends Controller
{
    public function showNotifications()
        {
            $dosenId = Auth::user()->user_id;

            $notifications = Notification::where('dosen_id', $dosenId)
                ->join('mahasiswa', 'notifications.mahasiswa_id', '=', 'mahasiswa.mahasiswa_id')
                ->join('users', 'mahasiswa.mahasiswa_id', '=', 'users.user_id')
                ->select('notifications.*', 'mahasiswa.nim', 'users.name')
                ->get();

            return response()->json([
                'status' => 'success',
                'notifications' => $notifications
            ], 200);
        }

    public function downloadPDF($notificationId)
        {
            $notification = Notification::findOrFail($notificationId);
            $mahasiswa = Mahasiswa::findOrFail($notification->mahasiswa_id);
            $startDate = Carbon::now()->subDays(90);

            // Ambil mood progress mahasiswa
            $moodProgressData = $mahasiswa->moodProgressData($startDate);

            // Ambil nama dan NIM
            $name = $mahasiswa->user->name ?? 'N/A';
            $nim = $mahasiswa->NIM;

            // Generate PDF
            $pdf = FacadePdf::loadView('dosen.pdf_report', compact('moodProgressData', 'name', 'nim'));

            return $pdf->download('mood_progress_report.pdf');
        }

}
