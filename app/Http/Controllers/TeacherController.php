<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $title = "Data Guru";
        $search = $request->input("search");
        $teachers = User::role("teacher")->latest()->get();

        return view("pages.teachers.index", compact(
            "teachers",
            "title",
        ));
    }

    public function edit(string $id)
    {
        $title = "Edit Status Akun";
        $teacher = User::role("teacher")->findOrFail($id);
        $roles = Role::where('name', '!=', 'super_admin')->pluck("name");

        return view("pages.teachers.edit", compact(
            "title",
            "teacher",
            "roles",
        ));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            "roles" => "required|in:admin,operator,teacher",
        ]);
        $teacher = User::role("teacher")->findOrFail($id);

        // Hapus role yang sebelumnya
        $teacher->roles()->detach();

        // Tambahkan role yang baru
        $teacher->assignRole($request->input("roles"));

        return redirect()->route("admin.teacher.index")->with("success", "Status akun " . $teacher->name . " telah diupdate.");
    }
}
