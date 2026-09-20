<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitQuizRequest;
use App\Models\Quiz;
use App\Models\QuizResult;
use App\Services\AIFeedbackService;
use App\Services\BadgeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class QuizController extends Controller
{
    public function __construct(
        private readonly BadgeService $badgeService,
        private readonly AIFeedbackService $aiFeedback,
    ) {
    }

    /**
     * Tampilkan semua quiz yang tersedia beserta status "sudah dikerjakan" per siswa.
     */
    public function index(): View
    {
        $user = auth()->user();

        $quizzes = Quiz::with('material', 'teacher')
            ->withCount('questions')
            ->get();

        // Ambil skor terbaik siswa per quiz (untuk ditampilkan di kartu quiz)
        $bestScores = $user->quizResults()
            ->selectRaw('quiz_id, MAX(score) as best_score, MAX(total_questions) as total_q, COUNT(*) as attempts')
            ->groupBy('quiz_id')
            ->get()
            ->keyBy('quiz_id');

        return view('quizzes.index', compact('quizzes', 'bestScores'));
    }

    /**
     * Tampilkan halaman pengerjaan quiz dengan semua soal.
     * Exam types (ujian_harian, uts, uas) harus diakses via ExamController
     * agar prereq check (lulus ≥n UH sebelum UTS, dll.) tidak ter-bypass.
     */
    public function take(Quiz $quiz): View|\Illuminate\Http\RedirectResponse
    {
        if ($quiz->isExam()) {
            return redirect()->route('exams.start', $quiz->id);
        }

        $questions = $quiz->questions()->get();

        abort_if($questions->isEmpty(), 404, 'Quiz ini belum memiliki soal.');

        return view('quizzes.take', compact('quiz', 'questions'));
    }

    /**
     * Proses jawaban quiz, hitung skor, simpan hasil, beri XP.
     *
     * Score = jumlah jawaban benar (bukan persentase).
     * Persentase dihitung via accessor QuizResult::getPercentageAttribute().
     */
    public function submit(SubmitQuizRequest $request, Quiz $quiz): RedirectResponse
    {
        // Exam types must go through ExamController (prereq enforcement)
        if ($quiz->isExam()) {
            return redirect()->route('exams.start', $quiz->id);
        }

        $user      = auth()->user();
        $questions = $quiz->questions()->get();

        if ($questions->isEmpty()) {
            return redirect()->route('quizzes.index')
                ->with('error', 'Quiz ini tidak memiliki soal.');
        }

        $answers = $request->validated()['answers']; // ['question_id' => 'jawaban_siswa']
        $correct = 0;

        foreach ($questions as $question) {
            $userAnswer = $answers[$question->id] ?? null;
            if ($userAnswer !== null && $userAnswer === $question->correct_answer) {
                $correct++;
            }
        }

        // Simpan hasil quiz (score = jumlah benar, bukan persentase)
        $result = QuizResult::create([
            'user_id'         => $user->id,
            'quiz_id'         => $quiz->id,
            'score'           => $correct,
            'total_questions' => $questions->count(),
            'completed_at'    => now(),
        ]);

        // Generate AI feedback (skip pretest — handled inside the service)
        if ($quiz->quiz_type !== 'pretest') {
            $this->aiFeedback->generate($result, $answers);
        }

        // XP: setiap jawaban benar = 5 XP, minimal 5 XP untuk usaha mengerjakan
        $xpEarned = max(5, $correct * 5);
        $this->badgeService->awardXp($user, $xpEarned);
        $this->badgeService->updateStreak($user);
        $this->badgeService->checkAndAwardBadges($user);

        return redirect()->route('quizzes.result', [$quiz->id, $result->id]);
    }

    /**
     * Tampilkan halaman hasil quiz.
     * Hanya pemilik result yang boleh melihat (403 untuk user lain).
     */
    public function result(Quiz $quiz, QuizResult $result): View
    {
        // Pastikan result ini milik user yang sedang login
        abort_if($result->user_id !== auth()->id(), 403, 'Kamu tidak berhak melihat hasil quiz ini.');

        $quiz->load('questions');

        return view('quizzes.result', compact('quiz', 'result'));
    }
}
