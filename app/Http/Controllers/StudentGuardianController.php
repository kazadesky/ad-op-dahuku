<?php

namespace App\Http\Controllers;

use App\Models\StudentGuardian;
use Illuminate\Http\Request;

class StudentGuardianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Akun Wali Santri";
        $studentGuardians = StudentGuardian::latest()->paginate(25);
        return view("pages.student-guardian.index", compact(
            "title",
            "studentGuardians",
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
