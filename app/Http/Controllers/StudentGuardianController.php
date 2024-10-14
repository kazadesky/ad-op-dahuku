<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentGuardian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentGuardianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Akun Wali";
        $search = $request->input("search");

        if ($search) {
            $studentGuardians = StudentGuardian::where("name", "LIKE", "%" . $search . "%")->orWhere("nis", "LIKE", "%" . $search . "%")->latest()->paginate(15);
        } else {
            $studentGuardians = StudentGuardian::with("student")->latest()->paginate(25);
        }

        return view("pages.student-guardian.index", compact(
            "title",
            "studentGuardians",
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Akun";
        $studentGuardian = StudentGuardian::pluck('student_id')->all();
        $students = Student::with("classRoom")->whereNotIn('id', $studentGuardian)->get();
        $students = $students->sortBy('name');

        return view("pages.student-guardian.create", compact([
            "title",
            "students",
        ]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            "name" => "required|string|max:255",
            "nis" => "required|numeric",
            "no_tel" => "nullable|numeric|min:10",
            "student_id" => "required|exists:students,id",
        ]);

        $student = Student::find($request->student_id);
        $fields["name"] = ucwords($request->name);
        $fields["password"] = Hash::make(str_replace(" ", "", strtolower($student->name)));
        // $fields["password"] = str_replace(" ", "", strtolower($student->name));
        $studentGuardiant = StudentGuardian::create($fields);

        $role = Auth::user()->roles->pluck('name')->first();
        if ($role == 'super_admin') {
            return redirect()->route("sa.student-guardian.index")->with("success", "Akun atas nama " . $studentGuardiant->name . " berhasil ditambahkan.");
        } elseif ($role == 'admin') {
            return redirect()->route("admin.student-guardian.index")->with("success", "Akun atas nama " . $studentGuardiant->name . " berhasil ditambahkan.");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = "Detail Akun";
        $studentGuardian = StudentGuardian::with("student")->findOrFail($id);
        return view("pages.student-guardian.show", compact([
            "title",
            "studentGuardian",
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Edit Akun";
        $studentGuardian = StudentGuardian::with("student")->findOrFail($id);
        $students = Student::with("classRoom")->orderBy("name", "ASC")->get();
        return view("pages.student-guardian.edit", compact([
            "title",
            "students",
            "studentGuardian",
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fields = $request->validate([
            "name" => "required|string|max:255",
            "nis" => "required|numeric",
            "no_tel" => "nullable|numeric|min:10",
            "student_id" => "required",
            // "password" => "required|confirmed",
            // "password_confirmation" => "required",
        ]);

        $student = Student::find($request->student_id);
        $fields["name"] = ucwords($request->name);
        $fields["password"] = Hash::make(str_replace(" ", "", strtolower($student->name)));
        $studentGuardian = StudentGuardian::with("student")->findOrFail($id);
        $studentGuardian->update($fields);

        $role = Auth::user()->roles->pluck('name')->first();
        if ($role == 'super_admin') {
            return redirect()->route("sa.student-guardiant.index")->with("success", "Akun atas nama " . $studentGuardian->name . " telah diupdate.");
        } elseif ($role == 'admin') {
            return redirect()->route("admin.student-guardian.index")->with("success", "Akun atas nama " . $studentGuardian->name . " telah diupdate.");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $studentGuardian = StudentGuardian::findOrFail($id);
        $studentGuardian->delete();

        return redirect()->back()->with("success", "Akun atas nama " . $studentGuardian->name . " telah dihapus.");
    }
}
