<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
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
}
?>
