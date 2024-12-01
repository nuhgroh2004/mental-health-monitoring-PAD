<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'Mahasiswa') {
                return redirect()->route('mahasiswa.home')->withSuccess('You are already logged in as a student!');
            } elseif (Auth::user()->role === 'Dosen') {
                return redirect()->route('dosen.home')->withSuccess('You are already logged in as a lecturer!');
            }
        }
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $email = $credentials['email'];
        if (str_ends_with($email, '@mail.ugm.ac.id')) {
            $student = User::where('email', $email)->first();
            if ($student && Hash::check($credentials['password'], $student->password)) {
                Auth::login($student);
                $request->session()->regenerate();
                return redirect()->route('mahasiswa.home')->withSuccess('Logged in as a student!');
            }
        } elseif (str_ends_with($email, '@ugm.ac.id')) {
            $lecturer = User::where('email', $email)->first();
            if ($lecturer && Hash::check($credentials['password'], $lecturer->password)) {
                Auth::login($lecturer);
                $request->session()->regenerate();
                return redirect()->route('dosen.home')->withSuccess('Logged in as a lecturer!');
            }
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->withSuccess('Logged out successfully!');
    }
}
