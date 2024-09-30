<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Day;
use App\Models\Lesson;
use App\Models\LessonTimetable;
use App\Models\Time;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonTimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Roster";
        $timetables = LessonTimetable::with("lesson", "classRoom", "teacher", "day", "time")->latest()->get();
        return view("pages.lessons-timetable.index", compact([
            "title",
            "timetables",
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Roster";
        $teachers = User::role("teacher")->orderBy("name", "asc")->get();
        $days = Day::all();
        $lessons = Lesson::orderBy("name", "asc")->get();
        $classRooms = ClassRoom::orderBy("name", "asc")->get();
        $times = Time::all();

        return view("pages.lessons-timetable.create", compact([
            "title",
            "teachers",
            "days",
            "lessons",
            "classRooms",
            "times",
        ]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            "teacher_id" => "required",
            "lesson_id" => "required",
            "class_id" => "required",
            "day_id" => "required",
            "time_id" => "required",
        ]);

        $timetable = LessonTimetable::create($fields);

        $role = Auth::user()->roles->pluck("name")->first();

        if ($role == "admin") {
            return redirect()->route("admin.lesson-timetable.index")->with("success", "Jadwal pembelajaran guru " . $timetable->teacher->name . " berhasil dibuat.");
        } elseif ($role == "operator") {
            return redirect()->route("operator.lesson-timetable.index")->with("success", "Jadwal pembelajaran guru " . $timetable->teacher->name . " berhasil dibuat.");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = "Roster";
        $timetable = LessonTimetable::with("lesson", "classRoom", "teacher", "day", "time")->findOrFail($id);
        return view("", compact([
            "title",
            "timetable",
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Roster";
        $timetable = LessonTimetable::with("lesson", "classRoom", "teacher", "day", "time")->findOrFail($id);
        $teachers = User::role("teacher")->orderBy("name", "asc")->get();
        $days = Day::all();
        $lessons = Lesson::orderBy("name", "asc")->get();
        $classRooms = ClassRoom::orderBy("name", "asc")->get();
        $times = Time::all();

        return view("pages.lessons-timetable.edit", compact([
            "title",
            "timetable",
            "teachers",
            "days",
            "lessons",
            "classRooms",
            "times",
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fields = $request->validate([
            "teacher_id" => "required",
            "lesson_id" => "required",
            "class_id" => "required",
            "day_id" => "required",
            "time_id" => "required",
        ]);

        $timetable = LessonTimetable::with("lesson", "classRoom", "teacher", "day", "time")->findOrFail($id);
        $timetable->update($fields);

        $role = Auth::user()->roles->pluck("name")->first();

        if ($role == "admin") {
            return redirect()->route("admin.lesson-timetable.index")->with("success", "Jadwal pembelajaran guru " . $timetable->teacher->name . " telah diupdate.");
        } elseif ($role == "operator") {
            return redirect()->route("operator.lesson-timetable.index")->with("success", "Jadwal pembelajaran guru " . $timetable->teacher->name . " telah diupdate.");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $timetable = LessonTimetable::with("lesson", "classRoom", "teacher", "day", "time")->findOrFail($id);
        $timetable->delete();

        return redirect()->back()->with("success", "Jadwal pembelajaran guru " . $timetable->teacher->name . " telah dihapus.");
    }
}
