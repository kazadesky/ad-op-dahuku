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

    public function registerPage()
    {
        $status = ["Guru Dayah", "Guru Umum"];
        return view('auth.register', compact('status'));
    }

    public function registerProses(Request $request)
    {
        $request->validate([
            'profile' => 'required|image|mimes:png,jpg,jpeg|max:2080',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nomor_telepon' => 'required|numeric',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'teacher_status' => 'required|in:Guru Umum,Guru Dayah',
        ]);

        $profileFile = $request->file('profile');
        $profileName = strtolower(str_replace(' ', '_', $request->name)) . '_' . time() . '.' . $profileFile->getClientOriginalExtension();
        $profileFile->storeAs('profile', $profileName, 'public');

        $userData = [
            'name' => ucwords($request->name),
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon,
            'password' => Hash::make($request->password),
            'profile' => $profileName,
            'teacher_status' => $request->teacher_status,
        ];

        $user = User::create($userData);
        $user->assignRole("teacher");

        Auth::login($user);

        return redirect()->route("teacher.dashboard");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Successfully logged out.');
    }
}
