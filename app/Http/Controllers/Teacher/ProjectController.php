<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\FinalProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = FinalProject::with('user')->latest()->get();
        return view('teacher.projects.index', compact('projects'));
    }

    public function uploadPhoto(Request $request, FinalProject $project)
    {
        $request->validate([
            'image' => 'required|image|max:2048', // max 2MB
        ]);

        if ($project->image_path) {
            Storage::disk('public')->delete($project->image_path);
        }

        $path = $request->file('image')->store('projects', 'public');
        
        $project->update([
            'image_path' => $path
        ]);

        return back()->with('success', 'Foto proyek berhasil diunggah!');
    }
}
