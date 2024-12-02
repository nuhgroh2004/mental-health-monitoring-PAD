<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\OTP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OTPController extends Controller
{
    public function otpVerificationForm(Request $request)
    {
        $dosenId = $request->session()->get('dosen_id');
        return view('dosen.otp', compact('dosenId'));
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp_code' => 'required|numeric|digits:4',
        ]);

        $dosenId = $request->session()->get('dosen_id');
        $otpRecord = OTP::where('dosen_id', $dosenId)
                            ->where('otp_code', $request->otp_code)
                            ->where('verified', 'no')
                            ->first();

        if ($otpRecord) {
            $otpRecord->verified = true;
            $otpRecord->save();

            $dosen = Dosen::find($dosenId);
            $dosen->otp_verified = true;
            $dosen->save();

            Auth::attempt(['email' => $dosen->email, 'password' => $request->password]);
            $request->session()->regenerate();

            return redirect()->route('dosen.home')->withSuccess('Registered & logged in!');
        } else {
            return back()->withErrors(['otp_code' => 'Invalid OTP code.']);
        }
    }
}
