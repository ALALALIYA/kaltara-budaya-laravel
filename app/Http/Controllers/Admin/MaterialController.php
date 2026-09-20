<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MaterialController extends Controller
{
    public function index(): View
    {
        $materials = Material::with('teacher')
            ->latest()
            ->paginate(15);

        return view('admin.materials.index', compact('materials'));
    }

    public function show(Material $material): View
    {
        $material->load('teacher', 'quizzes');
        return view('admin.materials.show', compact('material'));
    }

    public function approve(Material $material): RedirectResponse
    {
        $material->update(['status' => Material::STATUS_APPROVED]);

        return back()->with('success', "Materi \"{$material->title}\" telah disetujui dan sekarang dapat diakses siswa.");
    }

    public function reject(Material $material): RedirectResponse
    {
        $material->update(['status' => Material::STATUS_DRAFT]);

        return back()->with('warning', "Materi \"{$material->title}\" telah dikembalikan ke status Draft.");
    }
}
