<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
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
            // 'remember' => 'boolean', // Validasi untuk checkbox remember
        ]);

        $checkAuth = User::where('email', $request->email)->first();

        if (!$checkAuth || !Hash::check($request->password, $checkAuth->password)) {
            return redirect()->back()->with('error', 'Invalid credentials, please try again');
        }

        $request->session()->regenerate();

        // Auth::login($checkAuth, $request->remember);
        Auth::login($checkAuth, true);

        if ($checkAuth->hasRole('super_admin')) {
            return redirect()->route('sa.dashboard');
        } elseif ($checkAuth->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($checkAuth->hasRole('operator')) {
            return redirect()->route('operator.dashboard');
        } elseif ($checkAuth->hasRole('teacher')) {
            return redirect()->route('teacher.dashboard');
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
            'nomor_telepon' => 'required|numeric|min:10',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'teacher_status' => 'required|in:Guru Umum,Guru Dayah',
        ]);

        $profileFile = $request->file('profile');
        $profileName = strtolower(str_replace(' ', '_', $request->name)) . '_' . time() . '.' . $profileFile->getClientOriginalExtension();
        $profileFile->storeAs('profile', $profileName, 'public');

        $user = User::create([
            'name' => ucwords($request->name),
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon,
            'password' => Hash::make($request->password),
            'profile' => $profileName,
            'teacher_status' => $request->teacher_status,
        ]);
        $user->assignRole("teacher");

        event(new Registered($user));
        $user->sendEmailVerificationNotification();
        Auth::login($user, true);

        return redirect()->route("verification.notice");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('logout', 'Successfully logged out.');
    }
}
