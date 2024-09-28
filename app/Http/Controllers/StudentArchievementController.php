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
        $archievements = StudentAchievement::with("teacher", "student")->latest()->get();

        return view("pages.student-achievement.index", compact([
            "title",
            "archievements",
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
            "teacher_id" => "required",
            "student_id" => "required",
            "achievement" => "required|string",
        ]);

        $achievement = StudentAchievement::create([
            "teacher_id" => Auth::user()->id,
            "student_id" => $request->student_id,
            "achievement" => ucfirst($request->achievement),
        ]);

        return redirect()->route("")->with("success", "Pencapaian atas nama " . $achievement->student->name . " telah ditambahkan.");
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
        $title = "Edit Pencapaian";
        $achievement = StudentAchievement::with("teacher", "student")->findOrFail($id);
        $students = Student::with("classRoom")->orderBy("name", "asc")->get();

        return view("pages.student-achievement.edit", compact([
            "title",
            "achievement",
            "students",
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "teacher_id" => "required" . Auth::user()->id,
            "student_id" => "required",
            "achievement" => "required|string",
        ]);

        $achievement = StudentAchievement::with("student", "teacher")->findOrFail($id);
        $achievement->update([
            "teacher_id" => Auth::user()->id,
            "student_id" => $request->student_id,
            "achievement" => ucfirst($request->achievement),
        ]);

        return redirect()->route("")->with("success", "Pencapaian atas nama " . $achievement->student->name . " telah diupdate.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $achievement = StudentAchievement::with("student", "teacher")->findOrFail($id);
        $achievement->delete();

        return redirect()->route("")->with("success", "Pencapaian atas nama " . $achievement->student->name . " telah dihapus.");
    }
}
