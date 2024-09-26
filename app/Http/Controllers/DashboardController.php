<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\StudentGuardian;
use App\Models\TeacherPicket;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Dashboard";
        $students = Student::all()->count();
        $teachers = User::role("teacher")->count();
        $teacherPickets = TeacherPicket::all()->count();
        $classRoom = ClassRoom::all()->count();
        $studentGuardian = StudentGuardian::all()->count();
        $archives = Archive::all()->count();

        return view("pages.dashboard", [
            "title" => $title,
            "student" => $students,
            "teacher" => $teachers,
            "picket" => $teacherPickets,
            "room" => $classRoom,
            "guardian" => $studentGuardian,
            "archive" => $archives,
        ]);
    }
}
