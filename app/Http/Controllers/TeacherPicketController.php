<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\TeacherPicket;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherPicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Guru Piket";
        $days = Day::all();
        $pickets = TeacherPicket::with("teacher", "substitute", "day")->latest()->get();
        $senin = TeacherPicket::with("teacher", "substitute", "day")->where("day_id", $days->find(1)->id)->get();
        $selasa = TeacherPicket::with("teacher", "substitute", "day")->where("day_id", $days->find(2)->id)->get();
        $rabu = TeacherPicket::with("teacher", "substitute", "day")->where("day_id", $days->find(3)->id)->get();
        $kamis = TeacherPicket::with("teacher", "substitute", "day")->where("day_id", $days->find(4)->id)->get();
        $jumat = TeacherPicket::with("teacher", "substitute", "day")->where("day_id", $days->find(5)->id)->get();
        $sabtu = TeacherPicket::with("teacher", "substitute", "day")->where("day_id", $days->find(6)->id)->get();
        return view("pages.teacher-picket.index", compact(
            "title",
            "pickets",
            "senin",
            "selasa",
            "rabu",
            "kamis",
            "jumat",
            "sabtu",
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Guru Piket";
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
            "substitute_picket_teacher_id" => "nullable",
        ]);

        $teacher = TeacherPicket::create($fields);

        return redirect()->route('admin.teacher-picket.index')->with('success', 'Guru piket atas nama ' . $teacher->teacher->name . ' berhasil ditambah.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = "Detail Guru Piket";
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
        $title = "Edit Guru Piket";
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

        return redirect()->route('admin.teacher-picket.index')->with('success', 'Guru piket atas nama ' . $teacher->teacher->name . ' berhasil diupdate.');
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
            "action" => "boolean",
        ]);

        $action = $request->action;

        if ($action == 0) {
            $picket = TeacherPicket::with("teacher", "substitute", "day")->findOrFail($id);
            $picket->action = !$picket->action;
            $picket->save();
            return redirect()->back()->with("success", "Piket hari " . $picket->day->name . " atas nama " . $picket->teacher->name . " dinonaktifkan.");
        } elseif ($action == 1) {
            $picket = TeacherPicket::with("teacher", "substitute", "day")->findOrFail($id);
            $picket->action = !$picket->action;
            $picket->save();
            return redirect()->back()->with("success", "Piket hari " . $picket->day->name . " atas nama " . $picket->teacher->name . " diaktifkan.");
        }
    }
}
