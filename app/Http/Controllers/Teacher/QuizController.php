<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\StoreQuizRequest;
use App\Http\Requests\UpdateQuizRequest;
use App\Models\Material;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class QuizController extends Controller
{
    /**
     * Daftar semua quiz milik guru yang sedang login.
     */
    public function index(): View
    {
        $quizzes = Quiz::where('teacher_id', auth()->id())
            ->withCount('questions')
            ->with('material')
            ->latest()
            ->paginate(10);

        return view('teacher.quizzes.index', compact('quizzes'));
    }

    /**
     * Form tambah quiz baru.
     * Sertakan daftar materi agar guru bisa mengaitkan quiz ke materi tertentu.
     */
    public function create(): View
    {
        $materials = Material::where('teacher_id', auth()->id())
            ->orderBy('title')
            ->get();

        return view('teacher.quizzes.create', compact('materials'));
    }

    /**
     * Simpan quiz baru ke database.
     * Setelah disimpan, arahkan ke halaman detail agar guru langsung bisa tambah soal.
     */
    public function store(StoreQuizRequest $request): RedirectResponse
    {
        $data                = $request->validated();
        $data['teacher_id'] = auth()->id();

        $quiz = Quiz::create($data);

        return redirect()
            ->route('teacher.quizzes.show', $quiz->id)
            ->with('success', 'Quiz berhasil dibuat! Tambahkan soal-soalnya sekarang.');
    }

    /**
     * Tampilkan detail quiz beserta soal-soalnya.
     * Halaman ini juga menjadi tempat guru menambah/menghapus soal.
     */
    public function show(Quiz $quiz): View
    {
        abort_if($quiz->teacher_id !== auth()->id(), 403, 'Kamu tidak berhak mengakses quiz ini.');

        $quiz->load(['questions' => fn ($q) => $q->orderBy('order'), 'material']);

        // Daftar materi untuk dropdown "ganti materi" di halaman ini
        $materials = Material::where('teacher_id', auth()->id())
            ->orderBy('title')
            ->get();

        return view('teacher.quizzes.show', compact('quiz', 'materials'));
    }

    /**
     * Form edit quiz.
     */
    public function edit(Quiz $quiz): View
    {
        abort_if($quiz->teacher_id !== auth()->id(), 403, 'Kamu tidak berhak mengedit quiz ini.');

        $materials = Material::where('teacher_id', auth()->id())
            ->orderBy('title')
            ->get();

        return view('teacher.quizzes.edit', compact('quiz', 'materials'));
    }

    /**
     * Perbarui data quiz (judul, deskripsi, materi terkait).
     */
    public function update(UpdateQuizRequest $request, Quiz $quiz): RedirectResponse
    {
        abort_if($quiz->teacher_id !== auth()->id(), 403, 'Kamu tidak berhak mengubah quiz ini.');

        $quiz->update($request->validated());

        return redirect()
            ->route('teacher.quizzes.show', $quiz->id)
            ->with('success', 'Quiz berhasil diperbarui!');
    }

    /**
     * Hapus quiz beserta semua soalnya (cascade via DB).
     */
    public function destroy(Quiz $quiz): RedirectResponse
    {
        abort_if($quiz->teacher_id !== auth()->id(), 403, 'Kamu tidak berhak menghapus quiz ini.');

        $quiz->delete();

        return redirect()
            ->route('teacher.quizzes.index')
            ->with('success', 'Quiz berhasil dihapus.');
    }

    /**
     * Tambah satu soal ke dalam quiz.
     * Kolom 'order' diisi otomatis (max existing + 1) jika tidak disertakan.
     */
    public function storeQuestion(StoreQuestionRequest $request, Quiz $quiz): RedirectResponse
    {
        abort_if($quiz->teacher_id !== auth()->id(), 403, 'Kamu tidak berhak menambah soal ke quiz ini.');

        $data = $request->validated();

        if (empty($data['order'])) {
            $data['order'] = ($quiz->questions()->max('order') ?? 0) + 1;
        }

        $quiz->questions()->create($data);

        return redirect()
            ->route('teacher.quizzes.show', $quiz->id)
            ->with('success', 'Soal berhasil ditambahkan!');
    }

    /**
     * Hapus satu soal dari quiz.
     * Validasi ganda: soal harus benar-benar milik quiz ini.
     */
    public function destroyQuestion(Quiz $quiz, Question $question): RedirectResponse
    {
        abort_if($quiz->teacher_id !== auth()->id(), 403, 'Kamu tidak berhak menghapus soal ini.');
        abort_if($question->quiz_id !== $quiz->id, 404, 'Soal tidak ditemukan dalam quiz ini.');

        $question->delete();

        return redirect()
            ->route('teacher.quizzes.show', $quiz->id)
            ->with('success', 'Soal berhasil dihapus.');
    }
}
