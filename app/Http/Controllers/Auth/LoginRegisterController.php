<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{
    /**
     * Instantiate a new LoginRegisterController instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
        // ->except([
        //     'logout', 'dashboard'
        // ]);
    }

    /**
     * Display a registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_mahasiswa(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:50|unique:mahasiswas',
            'nim' => 'required|string|max:15|unique:mahasiswas',
            // 'phone_number' => 'required|min:11|',
            'password' => 'required|min:8',
        ]);

        Mahasiswa::create([
            'name' => $request->name,
            'email' => $request->email,
            'NIM' => $request->nim,
            'password' => Hash::make($request->password)
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('mahasiswa.landingPage')
        ->withSuccess('You have successfully registered & logged in!');
    }

    public function store_dosen(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:50|unique:mahasiswas',
            'password' => 'required|min:8',
        ]);

        Dosen::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('dosen.landingPage')
        ->withSuccess('You have successfully registered & logged in!');
    }

    /**
     * Display a login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('login');
    }

    /**
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $email = $credentials['email'];
    // Check for students
    if (str_ends_with($email, '@mail.ugm.ac.id')) {
        $student = Mahasiswa::where('email', $email)->first();
        if ($student) {
            // Ngecek manual password hash siswa dengan database
            if (Hash::check($credentials['password'], $student->password)) {
                Auth::login($student);
                $request->session()->regenerate();
                return redirect()->route('mahasiswa.landingPage')
                    ->withSuccess('You have successfully logged in as a student!');
            }
        }
    }
    // Check for lecturers
    elseif (str_ends_with($email, '@ugm.ac.id')) {
        $lecturer = Dosen::where('email', $email)->first();
        if ($lecturer) {
            // Ngecek manual password hash password dengan database
            if (Hash::check($credentials['password'], $lecturer->password)) {
                Auth::login($lecturer);
                $request->session()->regenerate();
                return redirect()->route('dosen.landingPage')
                    ->withSuccess('You have successfully logged in as a lecturer!');
            }
        }
    }

    return back()->withErrors([
        'email' => 'Your provided credentials do not match in our records.',
    ])->onlyInput('email');
}

    /**
     * Display a dashboard to authenticated users.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if(Auth::check())
        {
            return view('auth.dashboard');
        }

        return redirect()->route('login')
            ->withErrors([
            'email' => 'Please login to access the dashboard.',
        ])->onlyInput('email');
    }

    /**
     * Log out the user from application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');;
    }

}
