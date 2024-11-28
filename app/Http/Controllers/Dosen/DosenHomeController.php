<?php

namespace App\Http\Controllers\Dosen;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Mahasiswa;
use App\Models\Notification;
use App\Models\User;

class DosenHomeController extends Controller
{
    public function index(Request $request)
    {
        $batas = 5;
        $dataMahasiswa = Mahasiswa::join('users', 'mahasiswa.mahasiswa_id', '=', 'users.user_id')
            ->where('users.role', 'Mahasiswa')
            ->distinct()
            ->orderBy('mahasiswa.mahasiswa_id')
            ->select('mahasiswa.*', 'users.name', 'users.email')
            ->paginate($batas);
        $no = $batas * ($dataMahasiswa->currentPage() - 1);
        return view('dosen.landingPage', compact('batas', 'no', 'dataMahasiswa'));
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


    public function editRole(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $validatedData = $request->validate([
            'role' => 'required|string|in:role_1,role_2',
        ]);
        $mahasiswa->mahasiswa_role = $validatedData['role'];
        $mahasiswa->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Role berhasil diperbarui',
        ]);
    }


    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::where('mahasiswa_id', $id)->first();
        if ($mahasiswa) {
            $user = User::where('user_id', $mahasiswa->mahasiswa_id)->first();
            $mahasiswa->delete();
            if ($user) {
                $user->delete();
            }
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }


    public function sendPermissionRequest(Request $request, $mahasiswaId)
    {
        try {
            $dosenId = Auth::user()->user_id;

            // Cek apakah mahasiswa sudah memiliki permintaan izin yang masih pending, accepted, atau rejected
            $existingNotification = Notification::where('mahasiswa_id', $mahasiswaId)
                ->whereIn('request_status', ['pending']) // Cek status permintaan
                ->first();

            // Jika sudah ada permintaan izin yang belum diproses
            if ($existingNotification) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda sudah memiliki permintaan izin yang belum diproses.',
                ], 400); // Mengembalikan status 400 (Bad Request)
            }

            // Jika belum ada permintaan izin sebelumnya, buat permintaan baru
            $notification = Notification::create([
                'mahasiswa_id' => $mahasiswaId,
                'dosen_id' => $dosenId,
                'mood_id' => null,
                'progress_id' => null,
                'request_status' => 'pending',
                'read_status' => 'unread',
                'created_at' => now(), // Explicitly set created_at
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Permintaan izin berhasil dikirim!',
                'notification' => $notification,
            ]);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Permission Request Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim permintaan izin: ' . $e->getMessage(),
            ], 500);
        }
    }

}
?>
