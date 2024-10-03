<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Arsip Data";
        $user = Auth::user();
        $archives = Archive::with("user")
            ->where("user_id", $user->id)
            ->latest()
            ->paginate(20);
        $sa_archives = Archive::with("user")->latest()->paginate(50);

        return view("pages.archive.index", compact(
            "title",
            "user",
            "archives",
            "sa_archives",
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
        $request->validate([
            "name" => "required|string|max:255",
            "file" => "required|file|mimes:pdf|max:2048",
        ]);

        $archiveFile = $request->file("file");
        $archiveName = strtolower(str_replace(' ', '-', $request->name)) . '_' . time() . '.' . $archiveFile->getClientOriginalExtension();
        $archiveFile->storeAs('archives', $archiveName, 'public');

        $archive = Archive::create([
            "user_id" => Auth::user()->id,
            "name" => ucwords($request->name),
            "file" => $archiveName,
        ]);

        return redirect()->back()->with("success", "Arsip data dengan nama file " . $archive->name . " telah ditambahkan.");
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
        $archive = Archive::with("user")->findOrFail($id);
        if ($archive->file) {
            $oldFile = storage_path('app/public/archives/' . $archive->file);
            if (File::exists($oldFile)) {
                File::delete($oldFile);
            }
        }
        $archive->delete();

        return redirect()->back()->with('success', 'Arsip data dengan nama file ' . $archive->name . ' telah dihapus.');
    }
}
