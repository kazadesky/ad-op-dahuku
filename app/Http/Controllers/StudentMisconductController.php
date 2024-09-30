<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentMisconduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentMisconductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Pelanggaran";
        $user = Auth::user();
        $misconducts = StudentMisconduct::with("teacher", "student", "updatedBy")->where("teacher_id", $user->id)->get();

        return view("pages.student-misconduct.index", compact(
            "title",
            "misconducts"
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Pelanggaran";
        $students = Student::with("classRoom")->orderBy("name", "asc")->get();

        return view("pages.student-misconduct.create", compact([
            "title",
            "students",
        ]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "teacher_id" => "required",
            "student_id" => "required",
            "misconduct" => "required"
        ]);

        $misconduct = StudentMisconduct::create([
            "teacher_id" => Auth::user()->id,
            "student_id" => $request->student_id,
            "misconduct" => ucfirst($request->misconduct),
        ]);

        return redirect()->route("teacher.student-misconduct.index")->with("success", "Pelanggaran atas nama " . $misconduct->student->name . " telah ditambahkan.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Pelanggaran";
        $misconduct = StudentMisconduct::with("teacher", "student", "updatedBy")->findOrFail($id);
        $students = Student::with("classRoom")->orderBy("name", "asc")->get();

        return view("pages.student-misconduct.create", compact([
            "title",
            "misconduct",
            "students",
        ]));
    }

    public function editFromAdmin(string $id, $studentId)
    {
        $title = "Pelanggaran";
        $misconduct = StudentMisconduct::with("teacher", "student", "updatedBy")->findOrFail($id);
        $student = Student::with("classRoom")->findOrFail($studentId);
        $students = Student::with("classRoom")->orderBy("name", "asc")->get();

        return view("pages.student-misconduct.create", compact([
            "title",
            "misconduct",
            "student",
            "students",
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();

        $request->validate([
            "misconduct" => "required|string"
        ]);

        $misconduct = StudentMisconduct::with("teacher", "student", "updatedBy")->findOrFail($id);

        $misconduct->update([
            "teacher_id" => $user->id,
            "student_id" => $request->student_id,
            "misconduct" => ucfirst($request->misconduct),
        ]);

        return redirect()->route("teacher.student-misconduct.index")->with("success", "Pelanggaran atas nama " . $misconduct->student->name . " telah diupdate.");
    }

    public function updateFromAdmin(Request $request, string $id, $studentId)
    {
        $user = Auth::user();

        $request->validate([
            "misconduct" => "required|string"
        ]);

        $misconduct = StudentMisconduct::with("teacher", "student", "updatedBy")->findOrFail($id);
        $student = Student::with("classRoom")->findOrFail($studentId);

        $misconduct->update([
            "teacher_id" => $request->teacher_id,
            "student_id" => $request->student_id,
            "misconduct" => ucfirst($request->misconduct),
            "updated_by" => $user->id,
        ]);

        return redirect()->route("admin.student.show", $student->id)->with("success", "Pelanggaran atas nama " . $misconduct->student->name . " telah diupdate.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $misconduct = StudentMisconduct::with("teacher", "student", "updatedBy")->findOrFail($id);
        $misconduct->delete();

        return redirect()->route("teacher.student-misconduct.index")->with("success", "Pelanggaran atas nama " . $misconduct->student->name . " telah dihapus.");
    }
}
