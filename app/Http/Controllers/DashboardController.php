<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboardSA()
    {
        $title = "Dashboard";
        return view("pages.dashboard", ["title" => $title]);
    }

    public function dashboardAdmin()
    {
        $title = "Dashboard";
        return view("pages.dashboard", ["title" => $title]);
    }

    public function dashboardOperator()
    {
        $title = "Dashboard";
        return view("pages.dashboard", ["title" => $title]);
    }
}
