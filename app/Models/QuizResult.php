<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizResult extends Model
{
    protected $fillable = [
        'user_id',
        'quiz_id',
        'score',
        'total_questions',
        'completed_at',
        'ai_feedback',
    ];

    protected function casts(): array
    {
        return [
            'score'           => 'integer',
            'total_questions' => 'integer',
            'completed_at'    => 'datetime',
        ];
    }

    // ─── Relationships ────────────────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    // ─── Helpers ──────────────────────────────────────────────────────

    /** Hitung persentase nilai */
    public function getPercentageAttribute(): int
    {
        if ($this->total_questions === 0) {
            return 0;
        }

        return (int) round(($this->score / $this->total_questions) * 100);
    }

    /** Label grade berdasarkan persentase */
    public function getGradeAttribute(): string
    {
        return match (true) {
            $this->percentage >= 90 => 'A',
            $this->percentage >= 80 => 'B',
            $this->percentage >= 70 => 'C',
            $this->percentage >= 60 => 'D',
            default                 => 'E',
        };
    }

    /** Apakah lulus berdasarkan passing_score quiz */
    public function isPassed(): bool
    {
        $passingScore = $this->quiz?->passing_score ?? 70;
        return $this->percentage >= $passingScore;
    }
}
