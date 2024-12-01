<?php

namespace App\Http\Middleware;

use App\Models\Dosen;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DosenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
    // Pertama, periksa apakah pengguna sudah login
    if (!Auth::check()) {
        return redirect('/home')->with('alert', 'Silakan login terlebih dahulu');
    }

    // Dapatkan user yang sedang login
    $user = Auth::user();

    // Periksa apakah user memiliki role dosen
    if ($user->role !== 'Dosen') {
        return redirect('/home')->with('alert', 'Anda tidak memiliki akses');
    }

    // Cari data dosen berdasarkan user_id
    $dosen = Dosen::where('dosen_id', $user->user_id)->first();

    // Periksa apakah dosen ditemukan dan sudah diverifikasi
    if (!$dosen || $dosen->verified !== 'yes') {
        return redirect('/home')->with('alert', 'Akun Anda belum diverifikasi');
    }

    return $next($request);
    }
}
