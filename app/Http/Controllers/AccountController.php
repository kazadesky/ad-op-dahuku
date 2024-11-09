<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{
    public function profile(string $id)
    {
        $title = "Profil";
        $user = User::findOrFail($id);
        $role = $user->roles->pluck("name")->first();
        $status = ["Guru Dayah", "Guru umum"];
        return view("pages.account.profile", compact("user", "title", "role", "status"));
    }

    public function updateProfile(Request $request, string $id)
    {
        $request->validate(['profile' => 'required|image|mimes:png,jpg,jpeg|max:2048']);

        $user = User::findOrFail($id);

        if ($request->hasFile('profile')) {
            if ($user->profile) {
                $oldFilePath = storage_path('app/public/profile/' . $user->profile);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
            }

            $profileFile = $request->file('profile');
            $profileName = strtolower(str_replace(' ', '_', $user->name)) . '_' . time() . '.' . $profileFile->getClientOriginalExtension();
            $profileFile->storeAs('profile', $profileName, 'public');

            $user->update(['profile' => $profileName]);
        }

        return redirect()->back()->with('success', 'Photo profil berhasil diperbarui.');
    }

    public function updateAccount(Request $request, string $id)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|email|unique:users,email," . Auth::user()->id,
            "nomor_telepon" => "required|numeric|min:10",
            "teacher_status" => "nullable|in:Guru Dayah,Guru Umum",
        ]);

        $user = User::findOrFail($id);
        $user->update([
            "name" => $request->name,
            "email" => $request->email,
            "nomor_telepon" => $request->nomor_telepon,
            "teacher_status" => $request->teacher_status,
        ]);

        return redirect()->back()->with("success", "Profil akun berhasil diperbarui.");
    }

    public function deleteAccount(string $id)
    {
        $user = User::findOrFail($id);
        if ($user->profile) {
            $oldFilePath = storage_path('app/public/profile/' . $user->profile);
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }
        }
        $user->delete();
        Auth::logout();
        return redirect()->route("login")->with("delete", "Akun anda atas nama " . $user->name . " berhasil dihapus.");
    }

    public function password(string $id)
    {
        $title = "Ganti Password";
        $user = User::findOrFail($id);

        return view("pages.account.reset-password", compact("title", "user"));
    }

    public function updatePassword(Request $request, string $id)
    {
        $request->validate([
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required',
            'current_password' => 'required',
        ]);

        $user = User::findOrFail($id);

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Password lama yang Anda masukkan tidak valid.');
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        Log::info('User password updated', ['user_id' => $user->id]);


        Auth::logoutOtherDevices($request->current_password);

        return redirect()->back()->with('success', 'Password akun Anda berhasil diperbarui.');
    }
}
