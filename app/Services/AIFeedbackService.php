<?php

namespace App\Services;

use App\Models\QuizResult;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIFeedbackService
{
    private string $apiKey;
    private string $model = 'gemini-1.5-flash';

    public function __construct()
    {
        // Menggunakan GEMINI_API_KEY dari .env
        $this->apiKey  = env('GEMINI_API_KEY', '');
        $this->enabled = env('AI_FEEDBACK_ENABLED', true) && !empty($this->apiKey);
    }

    /**
     * Generate AI feedback for a quiz result.
     * Skips pretest (diagnostic only). Caches result in ai_feedback column.
     *
     * @param array<int, string> $userAnswers  ['question_id' => 'jawaban_siswa']
     */
    public function generate(QuizResult $result, array $userAnswers): string
    {
        // Return cached feedback if already generated
        if (!empty($result->ai_feedback)) {
            return $result->ai_feedback;
        }

        // Skip pretest — it's diagnostic, not evaluative
        if ($result->quiz?->quiz_type === 'pretest') {
            return '';
        }

        $feedback = $this->enabled
            ? $this->callApi($result, $userAnswers)
            : $this->fallback($result);

        $result->update(['ai_feedback' => $feedback]);

        return $feedback;
    }

    private function callApi(QuizResult $result, array $userAnswers): string
    {
        try {
            $result->load('quiz.questions', 'quiz.material');
            $quiz = $result->quiz;

            $wrongQuestions = [];
            foreach ($quiz->questions as $question) {
                $userAnswer = $userAnswers[$question->id] ?? null;
                if ($userAnswer !== $question->correct_answer) {
                    // Send full question and explanation if available to give context of the topic
                    $qText = mb_substr($question->question, 0, 150);
                    $explanation = $question->explanation ? " (Topik/Konteks: {$question->explanation})" : "";
                    $wrongQuestions[] = "- {$qText}{$explanation}";
                }
            }

            $quizLabel    = $quiz->type_label ?? ucfirst($quiz->quiz_type);
            $materialName = $quiz->material?->title ?? 'Seni Budaya Kaltara';

            $wrongList = !empty($wrongQuestions)
                ? implode("\n", array_slice($wrongQuestions, 0, 10))
                : '(semua soal dijawab benar)';

            $prompt = <<<EOT
Siswa baru saja mengerjakan evaluasi {$quizLabel} untuk materi "{$materialName}" (Seni Budaya Kalimantan Utara).
Daftar ringkasan soal yang dijawab salah beserta topik/konteksnya:
{$wrongList}

Berdasarkan data di atas, berikan evaluasi konseptual yang spesifik (maksimal 2-3 kalimat ringkas) dalam Bahasa Indonesia.
Aturan ketat:
1. JANGAN mengulang penyebutan angka skor, persentase kelulusan, atau jumlah benar/salah.
2. Jelaskan secara langsung konsep, budaya, atau topik spesifik mana yang masih perlu dipelajari ulang oleh siswa berdasarkan kesalahan tersebut.
3. Sertakan rekomendasi subbab, bagian materi, atau nama tarian/suku spesifik yang harus dibaca kembali.
4. Gunakan gaya bahasa guru yang suportif dan langsung pada inti materi tanpa basa-basi pembuka/penutup.
EOT;

            $response = Http::timeout(10)
                ->withoutVerifying()
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])
                ->post("https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent?key={$this->apiKey}", [
                    'system_instruction' => [
                        'parts' => [
                            ['text' => 'Kamu adalah guru Seni Budaya yang suportif untuk siswa SMA. Berikan evaluasi konseptual ringkas yang langsung menunjuk pada kelemahan materi.']
                        ]
                    ],
                    'contents' => [
                        [
                            'role' => 'user',
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'maxOutputTokens' => 300,
                        'temperature' => 0.7,
                    ]
                ]);

            if ($response->successful()) {
                $text = $response->json('candidates.0.content.parts.0.text', '');
                if (!empty(trim($text))) {
                    return trim($text);
                }
            }

            Log::warning('AIFeedback: unusable API response', [
                'status' => $response->status(),
                'quiz'   => $result->quiz_id,
            ]);
        } catch (\Throwable $e) {
            Log::warning('AIFeedback: API error, using fallback', ['error' => $e->getMessage()]);
        }

        return $this->fallback($result);
    }

    private function fallback(QuizResult $result): string
    {
        if ($result->isPassed()) {
            return "Keren! Pemahamanmu tentang materi ini sudah sangat baik. Pertahankan terus semangat belajarmu untuk mengeksplorasi budaya Kalimantan Utara lainnya.";
        }

        return "Masih ada beberapa konsep yang keliru. Coba baca kembali materi secara perlahan, terutama pada bagian yang belum kamu kuasai. Jangan ragu untuk mengulang kuis ini setelah kamu merasa lebih yakin!";
    }
}
