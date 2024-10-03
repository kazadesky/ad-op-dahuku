<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerifyController extends Controller
{
    public function verify(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route("teacher.dashboard");
        } else {
            return view("auth.verify-email");
        }
    }

    public function resendVerify(Request $request)
    {
        if (!$request->user()->hasVerifiedEmail()) {
            $request->user()->sendEmailVerificationNotification();

            return back()->with('success', 'Email verifikasi telah dikirim ulang.');
        } else {
            return back()->with('error', 'Anda telah memverifikasi email Anda.');
        }
    }
}
