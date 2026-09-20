<?php

namespace App\Http\Controllers;

use App\Models\FinalProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $project = FinalProject::where('user_id', Auth::id())->first();
        return view('projects.index', compact('project'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'materials_used' => 'required|string',
            'cultural_meaning' => 'required|string',
        ]);

        FinalProject::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'title' => $request->title,
                'materials_used' => $request->materials_used,
                'cultural_meaning' => $request->cultural_meaning,
            ]
        );

        return redirect()->route('projects.index')->with('success', 'Karya berhasil dikumpulkan! Tunggu guru mengunggah fotonya.');
    }

    public function gallery()
    {
        $projects = FinalProject::whereNotNull('image_path')
            ->with('user')
            ->latest()
            ->get();
            
        return view('projects.gallery', compact('projects'));
    }
}
