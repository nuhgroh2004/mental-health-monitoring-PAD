<?php

namespace App\Http\Controllers\Api\Mahasiswa;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class MahasiswaNotifController extends Controller
{
    public function index()
    {
        $mahasiswaId = Auth::user()->user_id;

        // Get Unread Notifications
        $unreadNotifications = $this->getNotifications($mahasiswaId, 'unread');

        // Get History Notifications (Accepted & Rejected)
        $historyNotifications = $this->getNotifications($mahasiswaId, 'read');

        return response()->json([
            'status' => 'success',
            'unread_notifications' => $unreadNotifications,
            'history_notifications' => $historyNotifications,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|in:approve,reject',
        ]);

        $notification = Notification::findOrFail($id);

        // Cek apakah notifikasi untuk mahasiswa yang login
        if ($notification->mahasiswa_id !== Auth::user()->user_id) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 403);
        }

        // Update Status (Approve/Reject)
        $notification->update([
            'request_status' => $request->action === 'approve' ? 'accepted' : 'rejected',
            'read_status' => 'read',
        ]);

        return response()->json(['status' => 'success', 'message' => 'Notification updated successfully']);
    }

    private function getNotifications($mahasiswaId, $status)
    {
        return Notification::where('mahasiswa_id', $mahasiswaId)
            ->where('read_status', $status)
            ->join('dosen', 'notifications.dosen_id', '=', 'dosen.dosen_id')
            ->join('users', 'dosen.dosen_id', '=', 'users.user_id')
            ->select('notifications.*', 'users.email', 'users.name')
            ->get();
    }
}
