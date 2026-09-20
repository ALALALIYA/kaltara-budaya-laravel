<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\QuizResult;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard sesuai role user:
     * - Guru  → redirect ke /teacher/dashboard
     * - Siswa → tampilkan dashboard siswa dengan data gamifikasi
     */
    public function index(): View|RedirectResponse
    {
        $user = auth()->user();

        if ($user->isTeacherOrAdmin()) {
            return redirect()->route('teacher.dashboard');
        }

        // ── Data untuk Dashboard Siswa ────────────────────────────────

        // 5 hasil quiz terakhir beserta info quiz-nya
        $recentResults = $user->quizResults()
            ->with('quiz')
            ->latest('completed_at')
            ->take(5)
            ->get();

        // Jumlah materi yang sudah selesai dibaca
        $completedMaterialCount = $user->materialProgress()
            ->whereNotNull('completed_at')
            ->count();

        $totalMaterials = Material::approved()->count();

        // Badge yang sudah diraih
        $earnedBadges = $user->badges()->get();

        // 4 materi terbaru untuk ditampilkan sebagai rekomendasi
        $latestMaterials = Material::approved()->latest()->take(4)->get();

        // Cek materi mana saja yang sudah selesai (untuk tampilkan indikator)
        $completedMaterialIds = $user->materialProgress()
            ->whereNotNull('completed_at')
            ->pluck('material_id')
            ->toArray();

        // Hitung total XP dari semua quiz (untuk progress bar)
        $totalQuizzesTaken = $user->quizResults()->count();

        // Per-suku progress: total dan selesai
        $sukuKeys = ['dayak', 'banjar', 'kutai', 'tidung'];
        $sukuProgress = [];
        foreach ($sukuKeys as $suku) {
            $totalForSuku = Material::approved()->where('category', $suku)->count();
            if ($totalForSuku === 0) continue;
            $completedForSuku = $user->materialProgress()
                ->whereNotNull('completed_at')
                ->whereHas('material', fn ($q) => $q->where('category', $suku))
                ->count();
            $sukuProgress[$suku] = [
                'total'     => $totalForSuku,
                'completed' => $completedForSuku,
                'pct'       => $totalForSuku > 0 ? round($completedForSuku / $totalForSuku * 100) : 0,
            ];
        }

        // Rata-rata nilai quiz student (dari semua QuizResult)
        $avgScore = QuizResult::where('user_id', $user->id)
            ->selectRaw('round(avg((score/total_questions)*100)) as avg_pct')
            ->value('avg_pct');

        return view('dashboard', compact(
            'user',
            'recentResults',
            'completedMaterialCount',
            'totalMaterials',
            'earnedBadges',
            'latestMaterials',
            'completedMaterialIds',
            'totalQuizzesTaken',
            'sukuProgress',
            'avgScore'
        ));
    }
}
