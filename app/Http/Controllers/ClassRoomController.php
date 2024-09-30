<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Kelas";
        $classRoom = ClassRoom::latest()->get();
        return view("pages.class-rooms.index", compact(
            "title",
            "classRoom",
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Kelas";
        return view("pages.class-rooms.create", compact(
            "title",
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:255",
        ]);

        $classRoom = ClassRoom::create([
            "name" => ucwords($request->name),
        ]);
        return redirect()->route("admin.class-room.index")->with("success", "Kelas " . $classRoom->name . " telah ditambahkan.");
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
        $title = "Kelas";
        $classRoom = ClassRoom::findOrFail($id);
        return view("pages.class-rooms.edit", compact(
            "title",
            "classRoom",
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required|string|max:255",
        ]);

        $classRoom = ClassRoom::findOrFail($id);
        $classRoom->update(["name" => ucwords($request->name)]);

        return redirect()->route("admin.class-room.index")->with("success", "Kelas " . $classRoom->name . " telah diupdate.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $classRoom = ClassRoom::findOrFail($id);
        $classRoom->delete();
        return redirect()->route("admin.class-room.index")->with("success", "Kelas " . $classRoom->name . " telah dihapus.");
    }
}
