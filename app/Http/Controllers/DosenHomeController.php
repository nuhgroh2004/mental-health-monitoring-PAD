<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\User;

class DosenHomeController extends Controller
{
    /**
     * Show the home page for the dosen.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $batas = 5;

        // Gunakan distinct untuk mencegah pengulangan data
        $dataMahasiswa = Mahasiswa::join('users', 'mahasiswa.mahasiswa_id', '=', 'users.user_id')
            ->where('users.role', 'Mahasiswa')
            ->distinct() // Menghindari duplikasi data
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

        // Pencarian berdasarkan name atau NIM dengan distinct untuk menghindari duplikasi
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

        // Jika hasil pencarian kosong, tambahkan pesan error
        if ($dataMahasiswa->isEmpty()) {
            $error = "Mahasiswa tidak terdaftar.";
            return view('dosen.partials.mahasiswaTable', compact('dataMahasiswa', 'no', 'error'));
        }

        // Jika ada hasil, kembali ke tampilan tanpa pesan error
        return view('dosen.partials.mahasiswaTable', compact('dataMahasiswa', 'no'));
    }

    public function destroy($id)
{
    // Cari data mahasiswa yang terkait dengan ID
    $mahasiswa = Mahasiswa::where('mahasiswa_id', $id)->first();
    if ($mahasiswa) {
        // Hapus data mahasiswa dan user terkait
        $user = User::where('user_id', $mahasiswa->mahasiswa_id)->first();

        // Hapus mahasiswa
        $mahasiswa->delete();

        // Hapus user terkait
        if ($user) {
            $user->delete();
        }

        // Kembalikan respons JSON sukses
        return response()->json(['success' => true]);
    }

    // Jika mahasiswa tidak ditemukan, kembalikan error
    return response()->json(['success' => false]);
}


}
