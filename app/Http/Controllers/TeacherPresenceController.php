<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Day;
use App\Models\Lesson;
use App\Models\Lessontime;
use App\Models\Moon;
use App\Models\TeacherPicket;
use App\Models\TeacherPresence;
use App\Models\Time;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherPresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Absensi Guru";
        $user = Auth::user();
        $role = $user->roles->pluck('name')->first();

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $month = $request->input('month');
        $year = $request->input('year');
        $search = $request->input("search");

        $moons = Moon::all();
        $years = range(2020, 2032);

        if ($role == 'admin') {
            $query = TeacherPresence::with("teacherPicket", "teacher", "lesson", "day", "time", "classRoom", "updatedBy", "substituteTeacher");

            if ($month && $year) {
                $query->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year);
            } else {
                $query->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear);
            }

            if ($search) {
                $query->whereHas("teacher", function ($query) use ($search) {
                    $query->where("name", "like", "%" . $search . "%");
                });
            }

            $presences = $query->latest()->paginate(50);

            return view("pages.teacher-presence.index", compact(
                "title",
                "presences",
                "moons",
                "years",
            ));
        } elseif ($role == 'teacher') {
            $query = TeacherPresence::with("teacherPicket", "teacher", "lesson", "day", "time", "classRoom", "updatedBy", "substituteTeacher")
                ->where("teacher_picket_id", $user->id);

            if ($search) {
                $query->whereHas("teacher", function ($query) use ($search) {
                    $query->where("name", "like", "%" . $search . "%");
                });
            }

            $presences = $query->latest()->paginate(50);

            $action = TeacherPicket::with("teacher", "substitute", "day")
                ->where("teacher_id", $user->id)
                ->orWhere('substitute_picket_teacher_id', $user->id)
                ->first();

            return view("pages.teacher-presence.index", compact(
                "title",
                "presences",
                "action",
            ));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Absensi Guru";
        $teachers = User::role("teacher")->orderBy("name", "asc")->get();
        $lessons = Lesson::orderBy("name", "asc")->get();
        $classRooms = ClassRoom::orderBy("name", "asc")->get();
        $days = Day::all();
        $times = Time::latest()->get();
        $status = ["Hadir", "Tidak Hadir", "Izin"];

        return view("pages.teacher-presence.create", compact([
            "title",
            "teachers",
            "lessons",
            "classRooms",
            "days",
            "times",
            "status",
        ]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $fields = $request->validate([
            "teacher_id" => "required",
            "lesson_id" => "required",
            "class_id" => "required",
            "day_id" => "required",
            "time_id" => "required",
            "status" => "required|in:Hadir,Tidak Hadir,Izin",
            "substitute_teacher_id" => "nullable|different:teacher_id",
        ]);

        $presence = TeacherPresence::create([
            "teacher_picket_id" => $user->id,
            "teacher_id" => $request->teacher_id,
            "lesson_id" => $request->lesson_id,
            "class_id" => $request->class_id,
            "day_id" => $request->day_id,
            "time_id" => $request->time_id,
            "status" => $request->status,
            "substitute_teacher_id" => $request->substitute_teacher_id,
        ]);

        $role = $user->roles->pluck('name')->first();
        if ($role == 'admin') {
            return redirect()->route("admin.teacher-presence.index")->with("success", "Absensi atas nama guru " . $presence->teacher->name . " telah ditambah.");
        } elseif ($role == 'teacher') {
            return redirect()->route("teacher.teacher-presence.index")->with("success", "Absensi atas nama guru " . $presence->teacher->name . " telah ditambah.");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = "Absensi Guru";
        $presence = TeacherPresence::with("teacherPicket", "teacher", "lesson", "classRoom", "day", "time", "substituteTeacher", "updatedBy")->findOrFail($id);
        return view("pages.teacher-presence.show", compact("title", "presence"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Absensi Guru";
        $presence = TeacherPresence::with("teacherPicket", "teacher", "lesson", "classRoom", "day", "time", "substituteTeacher", "updatedBy")->findOrFail($id);
        $teachers = User::role("teacher")->orderBy("name", "asc")->get();
        $lessons = Lesson::orderBy("name", "asc")->get();
        $classRooms = ClassRoom::orderBy("name", "asc")->get();
        $days = Day::all();
        $times = Time::latest()->get();
        $status = ["Hadir", "Tidak Hadir", "Izin"];

        return view("pages.teacher-presence.edit", compact([
            "title",
            "presence",
            "teachers",
            "lessons",
            "classRooms",
            "days",
            "times",
            "status",
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();

        $request->validate([
            "teacher_id" => "required",
            "lesson_id" => "required",
            "class_id" => "required",
            "day_id" => "required",
            "time_id" => "required",
            "status" => "required|in:Hadir,Tidak Hadir,Izin",
            "substitute_teacher_id" => "nullable|different:teacher_id", // "different" digunakan agar inputan tidak boleh sama atau kebalikan dari "same"
            "updated_by" => "nullable",
        ]);

        $presence = TeacherPresence::with("teacherPicket", "teacher", "lesson", "classRoom", "day", "time", "substituteTeacher")->findOrFail($id);

        $role = $user->roles->pluck('name')->first();
        if ($role == 'admin') {
            $presence->update([
                "teacher_id" => $request->teacher_id,
                "lesson_id" => $request->lesson_id,
                "class_id" => $request->class_id,
                "day_id" => $request->day_id,
                "time_id" => $request->time_id,
                "status" => $request->status,
                "substitute_teacher_id" => $request->substitute_teacher_id,
                "updated_by" => $user->id,
            ]);

            return redirect()->route("admin.teacher-presence.index")->with("success", "Absensi atas nama " . $presence->teacher->name . " telah diupdate.");
        } elseif ($role == 'teacher') {
            $presence->update([
                "teacher_picket_id" => $user->id,
                "teacher_id" => $request->teacher_id,
                "lesson_id" => $request->lesson_id,
                "class_id" => $request->class_id,
                "day_id" => $request->day_id,
                "time_id" => $request->time_id,
                "status" => $request->status,
                "substitute_teacher_id" => $request->substitute_teacher_id,
            ]);
            return redirect()->route("teacher.teacher-presence.index")->with("success", "Absensi atas nama " . $presence->teacher->name . " telah diupdate.");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $presence = TeacherPresence::with("teacherPicket", "teacher", "lesson", "classRoom", "day", "time", "substituteTeacher", "updatedBy")->findOrFail($id);
        $presence->delete();

        return redirect()->back()->with("success", "Absensi atas nama " . $presence->teacher->name . " telah dihapus.");
    }
}
