<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $title = "Data Guru";
        $search = $request->input("search");

        if ($search) {
            $sa_teachers = User::role(["admin", "operator", "teacher"])->where("name", "like", "%" . $search . "%")->latest()->get();
            $ad_teachers = User::role(["teacher", "operator"])->where("name", "like", "%" . $search . "%")->latest()->get();
            $teachers = User::role("teacher")->where("name", "like", "%" . $search . "%")->latest()->get();
        } else {
            $sa_teachers = User::role(["admin", "operator", "teacher"])->latest()->get();
            $ad_teachers = User::role(["teacher", "operator"])->latest()->get();
            $teachers = User::role("teacher")->latest()->get();
        }

        return view("pages.teachers.index", compact(
            "sa_teachers",
            "ad_teachers",
            "teachers",
            "title",
        ));
    }

    public function edit(string $id)
    {
        $title = "Edit Status Akun";
        $teacher = User::role(['admin', 'operator', 'teacher'])->findOrFail($id);
        $roles = Role::where('name', '!=', 'super_admin')->pluck("name");
        $status = ["Guru Dayah", "Guru Umum"];

        return view("pages.teachers.edit", compact(
            "title",
            "teacher",
            "roles",
            "status"
        ));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            "teacher_status" => "required|in:Guru Dayah,Guru Umum",
            "roles" => "required|in:admin,operator,teacher",
        ]);

        $teacher = User::role(['admin', 'operator', 'teacher'])->findOrFail($id);
        $teacher->update([
            "teacher_status" => $request->input("teacher_status"),
        ]);

        // Sync roles: detach old roles and assign new one
        $teacher->syncRoles([$request->input("roles")]);

        $role = Auth::user()->roles->pluck('name')->first();
        if ($role == 'super_admin') {
            return redirect()->route("sa.teacher.index")->with("success", "Status akun " . $teacher->name . " telah diupdate.");
        } elseif ($role == 'admin') {
            return redirect()->route("admin.teacher.index")->with("success", "Status akun " . $teacher->name . " telah diupdate.");
        }

    }
}
