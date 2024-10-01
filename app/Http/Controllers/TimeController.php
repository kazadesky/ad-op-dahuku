<?php

namespace App\Http\Controllers;

use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimeController extends Controller
{
    public function index()
    {
        $title = "Jam Masuk";
        $times = Time::latest()->get();
        return view("pages.times.index", compact("title", "times"));
    }

    public function create()
    {
        $title = "Jam Masuk";
        return view("pages.times.create", compact("title"));
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            "start" => "required",
            "finish" => "required",
        ]);

        $time = Time::create($fields);

        $role = Auth::user()->roles->pluck("name")->first();
        if ($role == 'super_admin') {
            return redirect()->route("sa.time.index")->with("success", "Jam masuk telah dibuat.");
        } elseif ($role == "admin") {
            return redirect()->route("admin.time.index")->with("success", "Jam masuk telah dibuat.");
        } elseif ($role == "operator") {
            return redirect()->route("operator.time.index")->with("success", "Jam masuk telah dibuat.");
        }
    }

    public function edit(string $id)
    {
        $title = "Jam Masuk";
        $time = Time::findOrFail($id);
        return view("pages.times.edit", compact("title", "time"));
    }

    public function update(Request $request, string $id)
    {
        $fields = $request->validate([
            "start" => "required",
            "finish" => "required",
        ]);

        $time = Time::findOrFail($id);
        $time->update($fields);

        $role = Auth::user()->roles->pluck("name")->first();
        if ($role == 'super_admin') {
            return redirect()->route("sa.time.index")->with("success", "Jam masuk telah diupdate.");
        } elseif ($role == "admin") {
            return redirect()->route("admin.time.index")->with("success", "Jam masuk telah diupdate.");
        } elseif ($role == "operator") {
            return redirect()->route("operator.time.index")->with("success", "Jam masuk telah diupdate.");
        }
    }

    public function destroy(string $id)
    {
        $time = Time::findOrFail($id);
        $time->delete();
        return redirect()->back()->with("success", "Jam masuk telah dihapus.");
    }
}
