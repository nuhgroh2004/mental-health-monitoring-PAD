<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MahasiswaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect('/login')->with('alert', 'Silakan login terlebih dahulu');
        }

        // Periksa role Mahasiswa
        if (Auth::user()->role !== 'Mahasiswa') {
            return redirect('/login')->with('alert', 'Anda harus login sebagai Mahasiswa terlebih dahulu');
        }

        return $next($request);
    }
}
