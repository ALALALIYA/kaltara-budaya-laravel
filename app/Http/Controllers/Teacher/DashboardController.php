<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Quiz;
use App\Models\QuizResult;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard statistik untuk guru yang sedang login.
     */
    public function index(): View
    {
        $teacher = auth()->user();

        // Statistik konten milik guru ini
        $totalMaterials = Material::where('teacher_id', $teacher->id)->count();
        $totalQuizzes   = Quiz::where('teacher_id', $teacher->id)->count();

        // Jumlah seluruh siswa terdaftar
        $totalStudents = User::where('role', 'student')->count();

        // ID semua quiz milik guru ini untuk query berikutnya
        $quizIds = Quiz::where('teacher_id', $teacher->id)->pluck('id');

        // Total pengerjaan quiz dari quiz milik guru ini (hanya siswa)
        $totalAttempts = QuizResult::whereIn('quiz_id', $quizIds)
            ->whereHas('user', function ($query) {
                $query->where('role', 'student');
            })->count();

        // Rata-rata skor (persentase) dari seluruh pengerjaan quiz milik guru ini (hanya siswa)
        $avgScoreData = QuizResult::whereIn('quiz_id', $quizIds)
            ->whereHas('user', function ($query) {
                $query->where('role', 'student');
            })
            ->selectRaw('AVG(score / total_questions * 100) as avg_pct')
            ->first();
        $avgScore = round($avgScoreData->avg_pct ?? 0, 1);

        // 10 pengerjaan quiz terbaru dari quiz milik guru ini (hanya siswa)
        $recentResults = QuizResult::whereIn('quiz_id', $quizIds)
            ->whereHas('user', function ($query) {
                $query->where('role', 'student');
            })
            ->with(['user', 'quiz'])
            ->latest('completed_at')
            ->take(10)
            ->get();

        // 5 materi terbaru milik guru ini
        $latestMaterials = Material::where('teacher_id', $teacher->id)
            ->latest()
            ->take(5)
            ->get();

        return view('teacher.dashboard', compact(
            'totalMaterials',
            'totalQuizzes',
            'totalStudents',
            'totalAttempts',
            'avgScore',
            'recentResults',
            'latestMaterials',
        ));
    }
}
