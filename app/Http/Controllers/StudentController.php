<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\MonthlyPayment;
use App\Models\Student;
use App\Models\StudentAchievement;
use App\Models\StudentMisconduct;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Data Santri";
        $search = $request->input('search');

        if ($search) {
            $students = Student::with('classRoom')
                ->where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('nis', 'LIKE', '%' . $search . '%');
                })
                ->paginate(15);
        } else {
            $students = Student::with('classRoom')->paginate(25);
        }

        return view("pages.students.index", compact("students", "title"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Data Santri";
        $genders = ["Laki-Laki", "Perempuan"];
        $classRoom = ClassRoom::orderBy('id', 'DESC')->get();
        return view("pages.students.create", compact("classRoom", "title", "genders"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|numeric|unique:students,nis',
            'nisn' => 'required|numeric|unique:students,nisn',
            'class_id' => 'required',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required',
            'address' => 'required',
        ]);

        $student = Student::create([
            'name' => ucwords($request->name),
            'nis' => $request->nis,
            'nisn' => $request->nisn,
            'class_id' => $request->class_id,
            'place_of_birth' => ucwords($request->place_of_birth),
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'address' => ucwords($request->address),
        ]);

        return redirect()->route("admin.student.index")->with("success", "Data santri dengan nama " . $student->name . " telah di tambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::findOrFail($id);
        $achievements = StudentAchievement::orderBy("id", "DESC")->with("teacher", "student")->where('student_id', $id)->get();
        $misconducts = StudentMisconduct::orderBy("id", "DESC")->with("teacher", "student")->where('student_id', $id)->get();
        $payments = MonthlyPayment::with("moon", "student")->where('student_id', $id)->get();
        $title = "Detail Data Santri";
        return view("pages.students.show", compact(
            "student",
            "title",
            "achievements",
            "misconducts",
            "payments",
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::with('classRoom')->findOrFail($id);
        $title = "Edit Data Santri";
        $genders = ["Laki-Laki", "Perempuan"];
        $classRoom = ClassRoom::all();
        return view("pages.students.edit", compact(
            "student",
            "title",
            "genders",
            "classRoom",
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|numeric|unique:students,nis' . $student->nis,
            'nisn' => 'required|numeric|unique:students,nisn' . $student->nisn,
            'class_id' => 'required',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required',
            'address' => 'required',
        ]);

        $student->update([
            'name' => ucwords($request->name),
            'nis' => $request->nis,
            'nisn' => $request->nisn,
            'class_id' => $request->class_id,
            'place_of_birth' => ucwords($request->place_of_birth),
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'address' => ucwords($request->address),
        ]);

        return redirect()->route("admin.student.index")->with("success", "Data santri atas nama " . $student->name . " telah diubah.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->back()->with("success", "Data santri atas nama " . $student->name . " telah dihapus.");
    }
}
