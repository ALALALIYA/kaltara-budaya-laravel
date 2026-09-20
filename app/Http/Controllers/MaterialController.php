<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MaterialProgress;
use App\Models\Quiz;
use App\Models\QuizResult;
use App\Services\AIFeedbackService;
use App\Services\BadgeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MaterialController extends Controller
{
    public function __construct(
        private readonly BadgeService $badgeService,
        private readonly AIFeedbackService $aiFeedback,
    ) {
    }

    public function index(Request $request): View
    {
        $user = auth()->user();
        $search = $request->query('search');

        $materials = Material::approved()
            ->with('teacher')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->orderByRaw('CASE WHEN pertemuan_ke IS NULL OR pertemuan_ke = "" THEN 1 ELSE 0 END')
            ->orderBy('pertemuan_ke')
            ->orderBy('category')
            ->orderBy('title')
            ->get();

        $progressMap = $user->materialProgress()
            ->pluck('completed_at', 'material_id');

        // Track which materials the student has completed pretest for
        $pretestDoneMap = QuizResult::whereIn(
            'quiz_id',
            Quiz::whereIn('material_id', $materials->pluck('id'))
                ->where('quiz_type', 'pretest')
                ->pluck('id')
        )
            ->where('user_id', $user->id)
            ->pluck('quiz_id');

        $byPertemuan = $materials->groupBy(function ($item) {
            $pk = (int) $item->pertemuan_ke;
            return ($pk >= 1 && $pk <= 7) ? $pk : 0;
        })->sortBy(function ($items, $key) {
            return $key == 0 ? 999 : $key;
        });

        return view('materials.index', compact('materials', 'progressMap', 'pretestDoneMap', 'search', 'byPertemuan'));
    }

    /**
     * Show material. Redirect to pretest if student hasn't done it yet.
     */
    public function show(string $slug): View|RedirectResponse
    {
        $user     = auth()->user();
        $material = Material::approved()->where('slug', $slug)
            ->with(['teacher', 'quizzes'])
            ->firstOrFail();

       // Check if there's a pretest for this material
        $pretest = $material->quizzes->firstWhere('quiz_type', 'pretest');
        
        // JALUR VIP: Pengecekan pretest HANYA BERLAKU JIKA BUKAN GURU/ADMIN
        if ($pretest && !$user->isTeacherOrAdmin()) {
            $hasDonePretest = QuizResult::where('user_id', $user->id)
                ->where('quiz_id', $pretest->id)
                ->exists();

            if (! $hasDonePretest) {
                return redirect()->route('materials.pretest', $slug)
                    ->with('info', 'Kamu harus mengerjakan Pretest terlebih dahulu sebelum membaca materi ini.');
            }
        }

        $progress = MaterialProgress::firstOrCreate([
            'user_id'     => $user->id,
            'material_id' => $material->id,
        ]);

        // Get pretest result for progress tracker
        $pretestResult = null;
        if ($pretest) {
            $pretestResult = QuizResult::where('user_id', $user->id)
                ->where('quiz_id', $pretest->id)
                ->latest()
                ->first();
        }

        // Get latest posttest result (if any)
        $posttest = $material->quizzes->firstWhere('quiz_type', 'posttest');
        $latestPosttestResult = null;
        if ($posttest) {
            $latestPosttestResult = QuizResult::where('user_id', $user->id)
                ->where('quiz_id', $posttest->id)
                ->latest()
                ->first();
        }

        return view('materials.show', compact('material', 'progress', 'pretest', 'posttest', 'pretestResult', 'latestPosttestResult'));
    }

    // ─── Pretest ──────────────────────────────────────────────────────────────

    public function pretest(string $slug): View|RedirectResponse
    {
        $user     = auth()->user();
        $material = Material::approved()->where('slug', $slug)
            ->with('quizzes')
            ->firstOrFail();

        $pretest = $material->quizzes->firstWhere('quiz_type', 'pretest');

        if (! $pretest) {
            return redirect()->route('materials.show', $slug);
        }

        // Already done → show result summary and redirect to material
        $existingResult = QuizResult::where('user_id', $user->id)
            ->where('quiz_id', $pretest->id)
            ->latest()
            ->first();

        if ($existingResult && !$user->isTeacherOrAdmin()) {
            return redirect()->route('materials.show', $slug)
                ->with('info', 'Kamu sudah mengerjakan pretest materi ini.');
        }

        $questions = $pretest->questions()->get();

        abort_if($questions->isEmpty(), 404, 'Pretest belum memiliki soal.');

        return view('materials.pretest', compact('material', 'pretest', 'questions'));
    }

    public function submitPretest(Request $request, string $slug): RedirectResponse
    {
        $user     = auth()->user();
        $material = Material::approved()->where('slug', $slug)
            ->with('quizzes')
            ->firstOrFail();

        $pretest = $material->quizzes->firstWhere('quiz_type', 'pretest');
        abort_if(! $pretest, 404);

        $questions = $pretest->questions()->get();
        $answers   = $request->input('answers', []);
        $correct   = 0;

        foreach ($questions as $question) {
            $userAnswer = $answers[$question->id] ?? null;
            if ($userAnswer !== null && $userAnswer === $question->correct_answer) {
                $correct++;
            }
        }

        $result = QuizResult::create([
            'user_id'         => $user->id,
            'quiz_id'         => $pretest->id,
            'score'           => $correct,
            'total_questions' => $questions->count(),
            'completed_at'    => now(),
        ]);

        return redirect()->route('materials.pretest.result', [$slug, $result->id]);
    }

    public function pretestResult(string $slug, int $resultId): View
    {
        $user     = auth()->user();
        $material = Material::approved()->where('slug', $slug)->firstOrFail();
        $result   = QuizResult::where('id', $resultId)->where('user_id', $user->id)->firstOrFail();
        $result->load('quiz.questions');

        return view('materials.pretest_result', compact('material', 'result'));
    }

    // ─── Complete + Posttest ──────────────────────────────────────────────────

    public function complete(string $slug): RedirectResponse
    {
        $user     = auth()->user();
        $material = Material::approved()->where('slug', $slug)->with('quizzes')->firstOrFail();

        // Check pretest gate
        $pretest = $material->quizzes->firstWhere('quiz_type', 'pretest');
        
        // JALUR VIP: Pengecekan pretest HANYA BERLAKU JIKA BUKAN GURU/ADMIN
        if ($pretest && !$user->isTeacherOrAdmin()) {
            $hasDonePretest = QuizResult::where('user_id', $user->id)
                ->where('quiz_id', $pretest->id)
                ->exists();
            if (! $hasDonePretest) {
                return redirect()->route('materials.pretest', $slug)
                    ->with('warning', 'Selesaikan pretest terlebih dahulu.');
            }
        }
        // If posttest exists, redirect to posttest instead of marking complete directly
        $posttest = $material->quizzes->firstWhere('quiz_type', 'posttest');
        if ($posttest) {
            return redirect()->route('materials.posttest', $slug);
        }

        // No posttest → mark complete directly
        $progress = MaterialProgress::firstOrCreate([
            'user_id'     => $user->id,
            'material_id' => $material->id,
        ]);

        if (! $progress->completed_at) {
            $progress->update(['completed_at' => now()]);
            $this->badgeService->awardXp($user, 30);
            $this->badgeService->updateStreak($user);
            $newBadges = $this->badgeService->checkAndAwardBadges($user);

            $message = 'Hebat! Kamu menyelesaikan materi ini dan mendapat +30 XP! 🎉';
            if (! empty($newBadges)) {
                $badgeNames = collect($newBadges)->map(fn ($b) => "{$b['icon']} {$b['name']}")->implode(', ');
                $message .= " Badge baru: {$badgeNames}";
            }

            return redirect()->route('materials.show', $slug)->with('success', $message);
        }

        return redirect()->route('materials.show', $slug)->with('info', 'Kamu sudah menyelesaikan materi ini.');
    }

    // ─── Posttest ─────────────────────────────────────────────────────────────

    public function posttest(string $slug): View|RedirectResponse
    {
        $user     = auth()->user();
        $material = Material::approved()->where('slug', $slug)
            ->with('quizzes')
            ->firstOrFail();

        $posttest = $material->quizzes->firstWhere('quiz_type', 'posttest');
        abort_if(! $posttest, 404, 'Tidak ada posttest untuk materi ini.');

        $questions = $posttest->questions()->get();
        abort_if($questions->isEmpty(), 404, 'Posttest belum memiliki soal.');

        // Check if already passed
        $alreadyPassed = QuizResult::where('user_id', $user->id)
            ->where('quiz_id', $posttest->id)
            ->get()
            ->contains(fn ($r) => $r->isPassed());

        if ($alreadyPassed && !$user->isTeacherOrAdmin()) {
            return redirect()->route('materials.show', $slug)
                ->with('success', 'Kamu sudah lulus posttest materi ini! ✅');
        }

        $attemptCount = QuizResult::where('user_id', $user->id)
            ->where('quiz_id', $posttest->id)
            ->count();

        return view('materials.posttest', compact('material', 'posttest', 'questions', 'attemptCount'));
    }

    public function submitPosttest(Request $request, string $slug): RedirectResponse
    {
        $user     = auth()->user();
        $material = Material::approved()->where('slug', $slug)
            ->with('quizzes')
            ->firstOrFail();

        $posttest  = $material->quizzes->firstWhere('quiz_type', 'posttest');
        abort_if(! $posttest, 404);

        $questions = $posttest->questions()->get();
        $answers   = $request->input('answers', []);
        $correct   = 0;

        foreach ($questions as $question) {
            $userAnswer = $answers[$question->id] ?? null;
            if ($userAnswer !== null && $userAnswer === $question->correct_answer) {
                $correct++;
            }
        }

        $result = QuizResult::create([
            'user_id'         => $user->id,
            'quiz_id'         => $posttest->id,
            'score'           => $correct,
            'total_questions' => $questions->count(),
            'completed_at'    => now(),
        ]);

        $this->aiFeedback->generate($result, $answers);

        // Award XP regardless
        $xpEarned = max(5, $correct * 5);
        $this->badgeService->awardXp($user, $xpEarned);
        $this->badgeService->updateStreak($user);
        $this->badgeService->checkAndAwardBadges($user);

        // If passed → mark material complete
        if ($result->isPassed()) {
            $progress = MaterialProgress::firstOrCreate([
                'user_id'     => $user->id,
                'material_id' => $material->id,
            ]);
            if (! $progress->completed_at) {
                $progress->update(['completed_at' => now()]);
                $this->badgeService->awardXp($user, 30);
                $this->badgeService->checkAndAwardBadges($user);
            }
        }

        return redirect()->route('materials.posttest.result', [$slug, $result->id]);
    }

    public function posttestResult(string $slug, int $resultId): View
    {
        $user     = auth()->user();
        $material = Material::approved()->where('slug', $slug)->with('quizzes')->firstOrFail();
        $result   = QuizResult::where('id', $resultId)->where('user_id', $user->id)->firstOrFail();
        $result->load('quiz.questions');

        $posttest = $material->quizzes->firstWhere('quiz_type', 'posttest');

        // Fetch pretest result for score comparison card
        $pretest = $material->quizzes->firstWhere('quiz_type', 'pretest');
        $pretestResult = null;
        if ($pretest) {
            $pretestResult = QuizResult::where('user_id', $user->id)
                ->where('quiz_id', $pretest->id)
                ->latest()
                ->first();
        }

        // Count total posttest attempts for this student
        $attemptCount = $posttest
            ? QuizResult::where('user_id', $user->id)->where('quiz_id', $posttest->id)->count()
            : 0;

        return view('materials.posttest_result', compact('material', 'result', 'posttest', 'pretestResult', 'attemptCount'));
    }
}
