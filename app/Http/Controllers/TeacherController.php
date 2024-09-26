<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $title = "";
        $search = $request->input("search");
        $teachers = User::all();
        return view("pages.teachers.index", compact("teachers"));
    }
}
