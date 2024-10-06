<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request)
{
    $request->validate([
        'username' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6',
        'nim' => 'required|numeric',
        'captcha' => 'required|captcha',
    ]);

    // Lanjutkan proses pendaftaran jika CAPTCHA dan data lain valid
}

}
