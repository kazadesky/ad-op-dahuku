<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
