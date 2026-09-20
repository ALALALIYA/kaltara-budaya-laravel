<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\User;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Daftar semua siswa terdaftar, diurutkan berdasarkan XP tertinggi (leaderboard).
     */
    public function index(): View
    {
        $students = User::where('role', 'student')
            ->withCount([
                'quizResults',
                // Alias untuk menghitung materi yang sudah diselesaikan
                'materialProgress as completed_materials_count' => fn ($q) => $q->whereNotNull('completed_at'),
            ])
            ->orderByDesc('xp')
            ->paginate(15);

        $totalMaterials = Material::count();

        return view('teacher.students.index', compact('students', 'totalMaterials'));
    }

    /**
     * Profil detail satu siswa: semua hasil quiz, progress materi, dan badge yang diraih.
     */
    public function show(User $user): View
    {
        // Pastikan yang ditampilkan adalah siswa, bukan guru
        abort_if($user->isTeacher(), 404, 'User ini bukan siswa.');

        $quizResults = $user->quizResults()
            ->with('quiz')
            ->latest('completed_at')
            ->get();

        $materialProgress = $user->materialProgress()
            ->with('material')
            ->latest('completed_at')
            ->get();

        $earnedBadges = $user->badges()->get();

        $totalMaterials     = Material::count();
        $completedMaterials = $materialProgress->whereNotNull('completed_at')->count();

        return view('teacher.students.show', compact(
            'user',
            'quizResults',
            'materialProgress',
            'earnedBadges',
            'totalMaterials',
            'completedMaterials',
        ));
    }

    /**
     * Reset seluruh progress belajar siswa (XP, Badges, Quiz Results, Material Progress).
     */
    public function resetAllProgress(User $user)
    {
        abort_if($user->isTeacher(), 404, 'User ini bukan siswa.');

        // Delete all progress data
        $user->quizResults()->delete();
        $user->materialProgress()->delete();
        $user->badges()->detach();
        
        // Reset user stats
        $user->update([
            'xp' => 0,
            'streak' => 0,
            'last_activity_at' => null,
        ]);

        return back()->with('success', "Seluruh progres belajar {$user->name} berhasil di-reset.");
    }

    /**
     * Reset progress untuk satu materi spesifik bagi siswa ini.
     */
    public function resetMaterialProgress(User $user, Material $material)
    {
        abort_if($user->isTeacher(), 404, 'User ini bukan siswa.');

        // 1. Hapus progress materi
        $user->materialProgress()->where('material_id', $material->id)->delete();

        // 2. Hapus hasil kuis yang terkait dengan materi ini (pretest & posttest)
        $quizIds = $material->quizzes()->pluck('id');
        $user->quizResults()->whereIn('quiz_id', $quizIds)->delete();

        return back()->with('success', "Progres materi '{$material->title}' milik {$user->name} berhasil di-reset.");
    }
}
