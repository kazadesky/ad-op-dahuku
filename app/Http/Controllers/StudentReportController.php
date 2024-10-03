<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Lesson;
use App\Models\Student;
use App\Models\StudentReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Raport";
        $user = Auth::user();
        $reports = StudentReport::with("teacher", "student", "classRoom", "lesson")
            ->where("teacher_id", $user->id)
            ->latest()
            ->paginate(50);

        return view("pages.student-report.index", compact("title", "reports"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Raport";
        $students = Student::with('classRoom')->orderBy('name', 'asc')->get();
        $classRooms = ClassRoom::orderBy('name', 'asc')->get();
        $lessons = Lesson::orderBy('name', 'asc')->get();

        return view("pages.student-report.create", compact(
            'title',
            'students',
            'classRooms',
            'lessons',
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:class_rooms,id',
            'lesson_id' => 'required|exists:lessons,id',
        ]);

        $report = StudentReport::create([
            'teacher_id' => Auth::user()->id,
            'student_id' => $request->student_id,
            'class_id' => $request->class_id,
            'lesson_id' => $request->lesson_id,
        ]);

        return redirect()->route('teacher.student-report.index')->with('success', 'Nilai santri atas nama ' . $report->student->name . ' telah dibuat.');
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
        $title = "Raport";
        $report = StudentReport::with("teacher", "student", "classRoom", "lesson")->findOrFail($id);
        $students = Student::with('classRoom')->orderBy('name', 'asc')->get();
        $classRooms = ClassRoom::orderBy('name', 'asc')->get();
        $lessons = Lesson::orderBy('name', 'asc')->get();

        return view("pages.student-report.create", compact(
            'title',
            'report',
            'students',
            'classRooms',
            'lessons',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'teacher_id' => 'required|exists:users,id' . Auth::user()->id,
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:class_rooms,id',
            'lesson_id' => 'required|exists:lessons,id',
        ]);

        $report = StudentReport::with("teacher", "student", "classRoom", "lesson")->findOrFail($id);
        $report->update([
            'teacher_id' => Auth::user()->id,
            'student_id' => $request->student_id,
            'class_id' => $request->class_id,
            'lesson_id' => $request->lesson_id,
        ]);

        return redirect()->route('teacher.student-report.index')->with('success', 'Nilai santri atas nama ' . $report->student->name . ' telah diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $report = StudentReport::with("teacher", "student", "classRoom", "lesson")->findOrFail($id);
        $report->delete();

        return redirect()->route('teacher.student-report.index')->with('success', 'Nilai santri atas nama ' . $report->student->name . ' telah dihapus.');
    }
}
