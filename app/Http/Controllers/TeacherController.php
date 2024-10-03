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
        $sa_teacher = User::role(["teacher", "admin", "operator"])->findOrFail($id);
        $teacher = User::role(["teacher", "operator"])->findOrFail($id);
        $roles = Role::where('name', '!=', 'super_admin')->pluck("name");
        $status = ["Guru Dayah", "Guru Umum"];

        return view("pages.teachers.edit", compact(
            "title",
            "sa_teacher",
            "teacher",
            "roles",
            "status",
        ));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            "teacher_status" => "required|in:Guru Dayah,Guru Umum",
            "roles" => "required|in:admin,operator,teacher",
        ]);

        $teacher = User::role("teacher")->findOrFail($id);
        $teacher->update([
            "teacher_status" => $request->input("teacher_status"),
        ]);

        $teacher->roles()->detach();
        $teacher->assignRole($request->input("roles"));

        return redirect()->route("admin.teacher.index")->with("success", "Status akun " . $teacher->name . " telah diupdate.");
    }
}
