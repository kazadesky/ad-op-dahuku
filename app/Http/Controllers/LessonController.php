<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Daftar Pelajaran";
        $lessons = Lesson::latest()->get();
        return view("pages.lessons.index", compact(
            "title",
            "lessons",
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Pembelajaran";
        return view("pages.lessons.create", compact([
            "title",
        ]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:255",
        ]);

        $lesson = Lesson::create(["name" => ucwords($request->name)]);
        return redirect()->route("admin.lesson.index")->with("success", "Pembelajaran " . $lesson->name . " berhasil ditambah.");
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
        $title = "Edit Pembelajaran";
        $lesson = Lesson::findOrFail($id);
        return view("pages.lessons.edit", compact([
            "title",
            "lesson",
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required|string|max:255",
        ]);

        $lesson = Lesson::findOrFail($id);
        $lesson->update(["name" => ucwords($request->name)]);
        return redirect()->route("admin.lesson.index")->with("success", "Pembelajaran " . $lesson->name . " telah diupdate.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();

        return redirect()->route("admin.lesson.index")->with("success", "Pembelajaran " . $lesson->name . " telah dihapus.");
    }
}
