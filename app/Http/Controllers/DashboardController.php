<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\ClassRoom;
use App\Models\Lesson;
use App\Models\LessonTimetable;
use App\Models\Student;
use App\Models\StudentGuardian;
use App\Models\TeacherPicket;
use App\Models\Time;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Dashboard";
        $students = Student::all()->count();
        $teachers = User::role("teacher")->count();
        $teacherPickets = TeacherPicket::all()->count();
        $lessons = Lesson::all()->count();
        $times = Time::all()->count();
        $timetables = LessonTimetable::all()->count();
        $classRoom = ClassRoom::all()->count();
        $studentGuardian = StudentGuardian::all()->count();
        $sa_archive = Archive::all()->count();
        $archive = Archive::where('user_id', Auth::user()->id)->count();

        $user = Auth::user();
        $schedules = LessonTimetable::with("teacher", "lesson", "classRoom", "day", "time")
            ->where("teacher_id", $user->id)
            ->orderBy("day_id", "asc")
            ->get();
        $groupedSchedules = $schedules->groupBy(function ($schedule) {
            return $schedule->day->name;
        });

        $pickets = TeacherPicket::with("teacher", "substitute", "day")->where("teacher_id", $user->id)->orderBy("day_id", "asc")->get();

        $groupedPickets = $pickets->groupBy(function ($picket) {
            return $picket->day->name;
        });

        Carbon::setLocale("id");
        $action = Carbon::now()->setTimezone("Asia/Jakarta")->isoFormat("dddd");

        return view("pages.dashboard", [
            "title" => $title,
            "student" => $students,
            "teacher" => $teachers,
            "picket" => $teacherPickets,
            "lesson" => $lessons,
            "time" => $times,
            "timetable" => $timetables,
            "room" => $classRoom,
            "guardian" => $studentGuardian,
            "archive" => $archive,
            "sa_archive" => $sa_archive,
            "schedules" => $groupedSchedules,
            "action" => $action,
            "pickets" => $groupedPickets,
        ]);
    }
}
