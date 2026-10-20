<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\PasswordOtp;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use App\Mail\PasswordOtpMail;

use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    // PAGINA EMAIL
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    // TRIMITE OTP
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Acest email nu există.'
            ]);
        }

        // ȘTERGE OTP VECHI
        PasswordOtp::where('email', $request->email)->delete();

        // GENEREAZĂ OTP
        $otp = rand(100000, 999999);

        PasswordOtp::create([
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(2),
        ]);

        Mail::to($request->email)
            ->send(new PasswordOtpMail($otp));

        return redirect()->route('password.verify')
            ->with('email', $request->email);
    }

    // PAGINA OTP
    public function verifyPage()
    {
        return view('auth.verify-otp');
    }

    // VERIFICARE OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required'
        ]);

        $otpData = PasswordOtp::where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        if (!$otpData) {
            return back()->withErrors([
                'otp' => 'Cod invalid.'
            ]);
        }

        if (Carbon::now()->gt($otpData->expires_at)) {

            $otpData->delete();

            return back()->withErrors([
                'otp' => 'Codul a expirat.'
            ]);
        }

        return redirect()->route('password.reset.form', [
            'email' => $request->email
        ]);
    }

    // PAGINA RESETARE
    public function resetForm(Request $request)
    {
        return view('auth.reset-password', [
            'email' => $request->email
        ]);
    }

    // RESETARE PAROLĂ
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Utilizator inexistent.'
            ]);
        }

        $user->password = Hash::make($request->password);

        $user->save();

        // ȘTERGE OTP
        PasswordOtp::where('email', $request->email)->delete();

        return redirect()->route('login')
            ->with('success', 'Parola a fost schimbată!');
    }
}