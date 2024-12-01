<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // Jika pengguna sudah login
        if (Auth::check()) {
            // Redirect berdasarkan role user
            if (Auth::user()->role === 'Mahasiswa') {
                return redirect()->route('mahasiswa.home'); // Ganti dengan route yang sesuai
            } elseif (Auth::user()->role === 'Dosen') {
                return redirect()->route('dosen.home'); // Ganti dengan route yang sesuai
            }
        }

        return $next($request);
    }
}
