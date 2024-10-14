<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\TeacherPicket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherPicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Guru Piket";
        $days = Day::all();
        $picket = TeacherPicket::with("teacher", "substitute", "day")->orderBy("day_id", "asc")->get();
        $pickets = $picket->groupBy(function ($day) {
            return $day->day->name;
        });

        Carbon::setLocale("id");
        $action = Carbon::now()->setTimezone("Asia/Jakarta")->isoFormat("dddd");

        return view("pages.teacher-picket.index", compact(
            "title",
            "pickets",
            "action",
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Guru Piket";
        $teachers = User::role("teacher")->where("teacher_status", "Guru Dayah")->orderBy("name", "asc")->get();
        $days = Day::all();
        return view("pages.teacher-picket.create", compact(
            "title",
            "teachers",
            "days",
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            "teacher_id" => "required",
            "day_id" => "required",
            "substitute_picket_teacher_id" => "nullable|different:teacher_id",
        ]);

        $teacher = TeacherPicket::create($fields);

        $role = Auth::user()->roles->pluck('name')->first();
        if ($role == 'super_admin') {
            return redirect()->route('sa.teacher-picket.index')->with('success', 'Guru piket atas nama ' . $teacher->teacher->name . ' berhasil ditambah.');
        } elseif ($role == 'admin') {
            return redirect()->route('admin.teacher-picket.index')->with('success', 'Guru piket atas nama ' . $teacher->teacher->name . ' berhasil ditambah.');
        } elseif ($role == 'operator') {
            return redirect()->route('operator.teacher-picket.index')->with('success', 'Guru piket atas nama ' . $teacher->teacher->name . ' berhasil ditambah.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = "Guru Piket";
        $picket = TeacherPicket::with("teacher", "substitute", "day")->findOrFail($id);
        return view("pages.teacher-picket.show", compact([
            "title",
            "picket",
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Guru Piket";
        $picket = TeacherPicket::with("teacher", "substitute", "day")->findOrFail($id);
        $teachers = User::role("teacher")->where("teacher_status", "Guru Dayah")->orderBy("name", "asc")->get();
        $days = Day::all();

        return view("pages.teacher-picket.edit", compact([
            "title",
            "picket",
            "teachers",
            "days",
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "teacher_id" => "required",
            "day_id" => "required",
            "substitute_picket_teacher_id" => "nullable|different:teacher_id",
        ]);

        $teacher = TeacherPicket::with("teacher", "substitute", "day")->findOrFail($id);
        $teacher->update([
            "teacher_id" => $request->teacher_id,
            "day_id" => $request->day_id,
            "substitute_picket_teacher_id" => $request->substitute_picket_teacher_id,
        ]);

        $role = Auth::user()->roles->pluck('name')->first();
        if ($role == 'super_admin') {
            return redirect()->route('sa.teacher-picket.index')->with('success', 'Guru piket atas nama ' . $teacher->teacher->name . ' berhasil diupdate.');
        } elseif ($role == 'admin') {
            return redirect()->route('admin.teacher-picket.index')->with('success', 'Guru piket atas nama ' . $teacher->teacher->name . ' berhasil diupdate.');
        } elseif ($role == 'operator') {
            return redirect()->route('operator.teacher-picket.index')->with('success', 'Guru piket atas nama ' . $teacher->teacher->name . ' berhasil diupdate.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $picket = TeacherPicket::with("teacher", "substitute", "day")->findOrFail($id);
        $picket->delete();
        return redirect()->route('admin.teacher-picket.index')->with('success', 'Guru piket atas nama ' . $picket->teacher->name . ' telah dihapus.');
    }

    public function action(Request $request, string $id)
    {
        $request->validate([
            "action" => "required|boolean",
        ]);

        $picket = TeacherPicket::with("teacher", "substitute", "day")->findOrFail($id);

        $picket->action = !$picket->action;
        $picket->save();

        $status = $picket->action ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with("success", "Piket hari " . $picket->day->name . " atas nama " . $picket->teacher->name . " $status.");
    }
}
