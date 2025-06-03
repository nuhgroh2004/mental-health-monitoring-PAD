<?php

namespace app\Http\Controllers\Api\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Notification;

class DosenHomeController extends Controller
{
    public function index(Request $request)
    {
        $batas = 10;

        $dataMahasiswa = Mahasiswa::join('users', 'mahasiswa.mahasiswa_id', '=', 'users.user_id')
            ->where('users.role', 'Mahasiswa')
            ->distinct()
            ->orderBy('mahasiswa.mahasiswa_id')
            ->select('mahasiswa.*', 'users.name', 'users.email')
            ->paginate($batas);

        $no = $batas * ($dataMahasiswa->currentPage() - 1);

        return response()->json([
            'status' => 'completed',
            'results' => $dataMahasiswa
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $batas = 5;

        $dataMahasiswa = Mahasiswa::join('users', 'mahasiswa.mahasiswa_id', '=', 'users.user_id')
            ->where('users.role', 'Mahasiswa')
            ->where(function ($q) use ($query) {
                $q->where('users.name', 'like', "%$query%")
                ->orWhere('mahasiswa.NIM', 'like', "%$query%");
            })
            ->distinct()
            ->orderBy('mahasiswa.mahasiswa_id')
            ->select('mahasiswa.*', 'users.name', 'users.email')
            ->paginate($batas);

        $no = $batas * ($dataMahasiswa->currentPage() - 1);

        if ($dataMahasiswa->isEmpty()) {
            $error = "Mahasiswa tidak terdaftar.";
            return view('dosen.partials.mahasiswaTable', compact('dataMahasiswa', 'no', 'error'));
        }

        return view('dosen.partials.mahasiswaTable', compact('dataMahasiswa', 'no'));
    }

    public function sendPermissionRequest(Request $request, $mahasiswaId)
    {
        $dosenId = Auth::user()->user_id;

        // Cek apakah sudah ada request pending
        $existingNotification = Notification::where('mahasiswa_id', $mahasiswaId)
            ->where('request_status', 'pending')
            ->first();

        if ($existingNotification) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah memiliki permintaan izin yang belum diproses.',
            ], 400);
        }

        $notification = Notification::create([
            'mahasiswa_id' => $mahasiswaId,
            'dosen_id' => $dosenId,
            'mood_id' => null,
            'progress_id' => null,
            'request_status' => 'pending',
            'read_status' => 'unread',
            'created_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Permintaan izin berhasil dikirim!',
            'notification' => $notification,
        ]);
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::where('mahasiswa_id', $id)->first();

        if (!$mahasiswa) {
            return response()->json(['success' => false, 'message' => 'Mahasiswa tidak ditemukan']);
        }

        $user = User::where('user_id', $mahasiswa->mahasiswa_id)->first();

        $mahasiswa->delete();
        if ($user) {
            $user->delete();
        }

        return response()->json(['success' => true, 'message' => 'Mahasiswa berhasil dihapus']);
    }
}

