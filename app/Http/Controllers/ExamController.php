<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizResult;
use App\Services\AIFeedbackService;
use App\Services\BadgeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExamController extends Controller
{
    public function __construct(
        private readonly BadgeService $badgeService,
        private readonly AIFeedbackService $aiFeedback,
    ) {
    }

    public function index(): View
    {
        $user = auth()->user();

        // Get all exam-type quizzes
        $harianList = Quiz::ofType('ujian_harian')->withCount('questions')->with('material')->get();
        $utsList    = Quiz::ofType('uts')->withCount('questions')->get();
        $uasList    = Quiz::ofType('uas')->withCount('questions')->get();

        // Student's best result per quiz
        $bestResults = QuizResult::where('user_id', $user->id)
            ->whereIn('quiz_id', Quiz::examTypes()->pluck('id'))
            ->selectRaw('quiz_id, MAX(score) as best_score, MAX(total_questions) as total_q, COUNT(*) as attempts')
            ->groupBy('quiz_id')
            ->get()
            ->keyBy('quiz_id');

        // Count how many ujian_harian the student has PASSED
        $harianPassedCount = 0;
        foreach ($harianList as $quiz) {
            $br = $bestResults[$quiz->id] ?? null;
            if ($br && $br->total_q > 0) {
                $pct = (int) round(($br->best_score / $br->total_q) * 100);
                if ($pct >= $quiz->passing_score) {
                    $harianPassedCount++;
                }
            }
        }

        // Has student passed any UTS?
        $utsPassedCount = 0;
        foreach ($utsList as $quiz) {
            $br = $bestResults[$quiz->id] ?? null;
            if ($br && $br->total_q > 0) {
                $pct = (int) round(($br->best_score / $br->total_q) * 100);
                if ($pct >= $quiz->passing_score) {
                    $utsPassedCount++;
                }
            }
        }

        return view('exams.index', compact(
            'harianList', 'utsList', 'uasList',
            'bestResults', 'harianPassedCount', 'utsPassedCount'
        ));
    }

    public function start(Quiz $quiz): View|RedirectResponse
    {
        $user = auth()->user();

        abort_unless($quiz->isExam(), 404, 'Quiz ini bukan ujian.');

        $questions = $quiz->questions()->get();
        abort_if($questions->isEmpty(), 404, 'Ujian ini belum memiliki soal.');

        // Prerequisite check
        if (! $this->checkPrerequisite($user, $quiz)) {
            return redirect()->route('exams.index')
                ->with('warning', $this->prerequisiteMessage($quiz));
        }

        return view('exams.start', compact('quiz', 'questions'));
    }

    public function submit(Request $request, Quiz $quiz): RedirectResponse
    {
        $user      = auth()->user();
        $questions = $quiz->questions()->get();

        abort_if($questions->isEmpty(), 404);

        $answers = $request->input('answers', []);
        $correct = 0;

        foreach ($questions as $question) {
            $userAnswer = $answers[$question->id] ?? null;
            if ($userAnswer !== null && $userAnswer === $question->correct_answer) {
                $correct++;
            }
        }

        $result = QuizResult::create([
            'user_id'         => $user->id,
            'quiz_id'         => $quiz->id,
            'score'           => $correct,
            'total_questions' => $questions->count(),
            'completed_at'    => now(),
        ]);

        $this->aiFeedback->generate($result, $answers);

        $xpEarned = max(5, $correct * 5);
        $this->badgeService->awardXp($user, $xpEarned);
        $this->badgeService->updateStreak($user);
        $this->badgeService->checkAndAwardBadges($user);

        return redirect()->route('exams.result', [$quiz->id, $result->id]);
    }

    public function result(Quiz $quiz, QuizResult $result): View
    {
        abort_if($result->user_id !== auth()->id(), 403);
        $quiz->load('questions');

        return view('exams.result', compact('quiz', 'result'));
    }

    // ─── Private ──────────────────────────────────────────────────────────────

    private function checkPrerequisite($user, Quiz $quiz): bool
    {
        if ($quiz->quiz_type === 'uts' && $quiz->min_harian_required > 0) {
            $harianPassed = $this->countHarianPassed($user);
            return $harianPassed >= $quiz->min_harian_required;
        }

        if ($quiz->quiz_type === 'uas' && $quiz->min_harian_required > 0) {
            $utsPassed = $this->countUtsPassed($user);
            return $utsPassed >= $quiz->min_harian_required;
        }

        return true;
    }

    private function prerequisiteMessage(Quiz $quiz): string
    {
        if ($quiz->quiz_type === 'uts') {
            $harianPassed = $this->countHarianPassed(auth()->user());
            return "Kamu harus lulus minimal {$quiz->min_harian_required} Ujian Harian sebelum bisa mengerjakan UTS ini. Saat ini kamu sudah lulus {$harianPassed} Ujian Harian.";
        }
        if ($quiz->quiz_type === 'uas') {
            $utsPassed = $this->countUtsPassed(auth()->user());
            return "Kamu harus lulus minimal {$quiz->min_harian_required} UTS sebelum bisa mengerjakan UAS ini. Saat ini kamu sudah lulus {$utsPassed} UTS.";
        }
        return 'Kamu belum memenuhi syarat untuk mengerjakan ujian ini.';
    }

    private function countHarianPassed($user): int
    {
        return QuizResult::where('user_id', $user->id)
            ->whereIn('quiz_id', Quiz::ofType('ujian_harian')->pluck('id'))
            ->get()
            ->groupBy('quiz_id')
            ->filter(function ($results) {
                return $results->contains(function ($r) {
                    return $r->isPassed();
                });
            })
            ->count();
    }

    private function countUtsPassed($user): int
    {
        return QuizResult::where('user_id', $user->id)
            ->whereIn('quiz_id', Quiz::ofType('uts')->pluck('id'))
            ->get()
            ->groupBy('quiz_id')
            ->filter(function ($results) {
                return $results->contains(function ($r) {
                    return $r->isPassed();
                });
            })
            ->count();
    }
}
