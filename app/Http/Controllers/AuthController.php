<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view("auth.login");
    }

    public function loginProses(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->back()->with('error', 'Invalid credentials, please try again');
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->hasRole('super_admin')) {
            return redirect()->route('sa.dashboard')->with('success', 'Welcome Super Admin!');
        } elseif ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
        } elseif ($user->hasRole('operator')) {
            return redirect()->route('operator.dashboard')->with('success', 'Welcome Operator!');
        }

        Auth::logout();
        return redirect()->route('login')->with('error', 'Role not recognized. Contact your administrator.');
    }

    public function register(Request $request)
    {
        //
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Successfully logged out.');
    }
}
