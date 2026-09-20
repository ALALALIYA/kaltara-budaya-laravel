<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Quiz;
use App\Models\QuizResult;
use App\Models\User;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(): View
    {
        $materials = Material::approved()
            ->withCount(['quizzes', 'progress' => function ($query) {
                $query->whereNotNull('completed_at');
            }])
            ->orderBy('title')
            ->get();

        $totalStudents = User::where('role', 'student')->count();
        $totalResults  = QuizResult::whereHas('user', function ($q) {
            $q->where('role', 'student');
        })->count();

        // Pretest/posttest averages per material
        $pretestQuizIds  = Quiz::where('quiz_type', 'pretest')->pluck('material_id', 'id');
        $posttestQuizIds = Quiz::where('quiz_type', 'posttest')->pluck('material_id', 'id');

        $pretestAvg  = QuizResult::whereIn('quiz_id', $pretestQuizIds->keys())
            ->whereHas('user', function ($q) {
                $q->where('role', 'student');
            })
            ->selectRaw('quiz_id, round(avg((score/total_questions)*100)) as avg_pct')
            ->groupBy('quiz_id')
            ->pluck('avg_pct', 'quiz_id');

        $posttestAvg = QuizResult::whereIn('quiz_id', $posttestQuizIds->keys())
            ->whereHas('user', function ($q) {
                $q->where('role', 'student');
            })
            ->selectRaw('quiz_id, round(avg((score/total_questions)*100)) as avg_pct')
            ->groupBy('quiz_id')
            ->pluck('avg_pct', 'quiz_id');

        // Count students who retried posttest (attempted more than once per quiz)
        $posttestRetries = QuizResult::whereIn('quiz_id', $posttestQuizIds->keys())
            ->whereHas('user', function ($q) {
                $q->where('role', 'student');
            })
            ->selectRaw('quiz_id, count(distinct user_id) as retry_students')
            ->groupBy('quiz_id', 'user_id')
            ->havingRaw('count(*) > 1')
            ->get()
            ->groupBy('quiz_id')
            ->map(fn ($rows) => $rows->count());

        // Map material_id → average / retry count
        $pretestAvgByMaterial  = [];
        $posttestAvgByMaterial = [];
        $posttestRetryByMaterial = [];
        foreach ($pretestQuizIds as $quizId => $materialId) {
            $pretestAvgByMaterial[$materialId] = $pretestAvg[$quizId] ?? null;
        }
        foreach ($posttestQuizIds as $quizId => $materialId) {
            $posttestAvgByMaterial[$materialId]  = $posttestAvg[$quizId] ?? null;
            $posttestRetryByMaterial[$materialId] = $posttestRetries[$quizId] ?? 0;
        }

        // Build chart data (only materials with both pretest + posttest data)
        $chartLabels    = [];
        $chartPretest   = [];
        $chartPosttest  = [];
        foreach ($materials as $m) {
            if (isset($pretestAvgByMaterial[$m->id]) && isset($posttestAvgByMaterial[$m->id])) {
                $chartLabels[]   = $m->title;
                $chartPretest[]  = $pretestAvgByMaterial[$m->id];
                $chartPosttest[] = $posttestAvgByMaterial[$m->id];
            }
        }

        return view('teacher.reports.index', compact(
            'materials',
            'totalStudents',
            'totalResults',
            'pretestAvgByMaterial',
            'posttestAvgByMaterial',
            'posttestRetryByMaterial',
            'chartLabels',
            'chartPretest',
            'chartPosttest'
        ));
    }

    public function material(Material $material): View
    {
        $pretestQuiz  = $material->quizzes()->where('quiz_type', 'pretest')->first();
        $posttestQuiz = $material->quizzes()->where('quiz_type', 'posttest')->first();

        $students = User::where('role', 'student')->orderBy('name')->get();

        // Pretest results: best per student
        $pretestResults = collect();
        if ($pretestQuiz) {
            $pretestResults = QuizResult::where('quiz_id', $pretestQuiz->id)
                ->whereHas('user', function ($q) {
                    $q->where('role', 'student');
                })
                ->selectRaw('user_id, max(score) as best_score, min(score) as min_score, count(*) as attempts, max(total_questions) as total_q, max(completed_at) as last_at')
                ->groupBy('user_id')
                ->get()
                ->keyBy('user_id');
        }

        // Posttest results: best per student
        $posttestResults = collect();
        if ($posttestQuiz) {
            $posttestResults = QuizResult::where('quiz_id', $posttestQuiz->id)
                ->whereHas('user', function ($q) {
                    $q->where('role', 'student');
                })
                ->selectRaw('user_id, max(score) as best_score, min(score) as min_score, count(*) as attempts, max(total_questions) as total_q, max(completed_at) as last_at')
                ->groupBy('user_id')
                ->get()
                ->keyBy('user_id');
        }

        // Completion status per student
        $completedUserIds = $material->progress()
            ->whereNotNull('completed_at')
            ->pluck('user_id')
            ->toArray();

        return view('teacher.reports.material', compact(
            'material',
            'pretestQuiz',
            'posttestQuiz',
            'students',
            'pretestResults',
            'posttestResults',
            'completedUserIds'
        ));
    }

    public function exportCsv()
    {
        $materials = Material::approved()->orderBy('title')->get();

        $pretestQuizIds  = Quiz::where('quiz_type', 'pretest')->pluck('material_id', 'id');
        $posttestQuizIds = Quiz::where('quiz_type', 'posttest')->pluck('material_id', 'id');

        $pretestAvg  = QuizResult::whereIn('quiz_id', $pretestQuizIds->keys())
            ->whereHas('user', function ($q) {
                $q->where('role', 'student');
            })
            ->selectRaw('quiz_id, round(avg((score/total_questions)*100)) as avg_pct')
            ->groupBy('quiz_id')
            ->pluck('avg_pct', 'quiz_id');

        $posttestAvg = QuizResult::whereIn('quiz_id', $posttestQuizIds->keys())
            ->whereHas('user', function ($q) {
                $q->where('role', 'student');
            })
            ->selectRaw('quiz_id, round(avg((score/total_questions)*100)) as avg_pct')
            ->groupBy('quiz_id')
            ->pluck('avg_pct', 'quiz_id');

        $completionCounts = \App\Models\MaterialProgress::whereNotNull('completed_at')
            ->whereHas('user', function ($q) {
                $q->where('role', 'student');
            })
            ->selectRaw('material_id, count(distinct user_id) as cnt')
            ->groupBy('material_id')
            ->pluck('cnt', 'material_id');

        $fileName = "Laporan_Nilai_Kaltara_Budaya.csv";
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['ID', 'Judul Materi', 'Kategori', 'Siswa Selesai', 'Rata-rata Pretest (%)', 'Rata-rata Posttest (%)'];

        $callback = function() use($materials, $columns, $pretestQuizIds, $posttestQuizIds, $pretestAvg, $posttestAvg, $completionCounts) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            $pretestAvgByMaterial  = [];
            $posttestAvgByMaterial = [];
            foreach ($pretestQuizIds as $quizId => $materialId) {
                $pretestAvgByMaterial[$materialId] = $pretestAvg[$quizId] ?? 0;
            }
            foreach ($posttestQuizIds as $quizId => $materialId) {
                $posttestAvgByMaterial[$materialId] = $posttestAvg[$quizId] ?? 0;
            }

            foreach ($materials as $material) {
                $row['ID']  = $material->id;
                $row['Judul Materi']    = $material->title;
                $row['Kategori']    = ucfirst($material->category ?: '-');
                $row['Siswa Selesai']  = $completionCounts[$material->id] ?? 0;
                $row['Rata-rata Pretest (%)']  = $pretestAvgByMaterial[$material->id] ?? 0;
                $row['Rata-rata Posttest (%)']  = $posttestAvgByMaterial[$material->id] ?? 0;

                fputcsv($file, array($row['ID'], $row['Judul Materi'], $row['Kategori'], $row['Siswa Selesai'], $row['Rata-rata Pretest (%)'], $row['Rata-rata Posttest (%)']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
