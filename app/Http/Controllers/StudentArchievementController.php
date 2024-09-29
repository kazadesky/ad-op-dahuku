<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentAchievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentArchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Pencapaian Santri";
        $achievements = StudentAchievement::with("teacher", "student", "updatedBy")->latest()->get();

        return view("pages.student-achievement.index", compact([
            "title",
            "achievements",
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Pencapaian";
        $students = Student::with("classRoom")->orderBy("name", "asc")->get();

        return view("pages.student-achievement.create", compact([
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
            "student_id" => "required",
            "achievement" => "required|string",
        ]);

        $achievement = StudentAchievement::create([
            "teacher_id" => Auth::user()->id,
            "student_id" => $request->student_id,
            "achievement" => ucfirst($request->achievement),
        ]);

        return redirect()->route("teacher.student-achievement.index")->with("success", "Pencapaian atas nama " . $achievement->student->name . " telah ditambahkan.");
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
    public function edit(string $id, $studentId)
    {
        $title = "Edit Pencapaian";
        $achievement = StudentAchievement::with("teacher", "student", "updatedBy")->findOrFail($id);
        $student = Student::with("classRoom")->findOrFail($studentId);
        $students = Student::with("classRoom")->orderBy("name", "asc")->get();

        return view("pages.student-achievement.edit", compact([
            "title",
            "achievement",
            "student",
            "students",
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, $studentId)
    {
        $user = Auth::user();

        $request->validate([
            "achievement" => "required|string",
        ]);

        $achievement = StudentAchievement::with("student", "teacher", "updatedBy")->findOrFail($id);
        $student = Student::with("classRoom")->findOrFail($studentId);

        $role = $user->roles->pluck('name')->first();

        if ($role == 'admin') {
            $achievement->update([
                "teacher_id" => $achievement->teacher_id,
                "student_id" => $achievement->student_id,
                "achievement" => ucfirst($request->achievement),
                "updated_by" => $user->id,
            ]);

            return redirect()->route("admin.student.show", $student->id)
                ->with("success", "Pencapaian atas nama " . $achievement->student->name . " telah diupdate.");
        } elseif ($role == 'teacher') {
            $achievement->update([
                "teacher_id" => $user->id,
                "student_id" => $achievement->student_id,
                "achievement" => ucfirst($request->achievement),
            ]);

            return redirect()->route("teacher.student-achievement.index")
                ->with("success", "Pencapaian atas nama " . $achievement->student->name . " telah diupdate.");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $achievement = StudentAchievement::with("student", "teacher")->findOrFail($id);
        $achievement->delete();

        return redirect()->route("teacher.student-achievement.index")->with("success", "Pencapaian atas nama " . $achievement->student->name . " telah dihapus.");
    }
}
