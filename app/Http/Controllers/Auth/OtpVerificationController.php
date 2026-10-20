<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OtpVerificationController extends Controller
{
    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required'
        ]);

        $otp = DB::table('password_reset_otps')
            ->where('email', $request->email)
            ->where('code', $request->code)
            ->where('used', false)
            ->where('expires_at', '>', now())
            ->first();

        if (!$otp) {
            return back()->withErrors(['code' => 'Cod invalid sau expirat']);
        }

        DB::table('password_reset_otps')
            ->where('email', $request->email)
            ->update(['used' => true]);

        session(['otp_verified_email' => $request->email]);

        return redirect()->route('password.request');
    }
}