<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailVerifyController extends Controller
{
    public function verify()
    {
        return view("auth.verify-email");
    }

    public function resendVerify(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('success', 'Verification link sent!');
    }
}
