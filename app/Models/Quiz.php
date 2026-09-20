<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
    const TYPE_PRETEST       = 'pretest';
    const TYPE_POSTTEST      = 'posttest';
    const TYPE_UJIAN_HARIAN  = 'ujian_harian';
    const TYPE_UTS           = 'uts';
    const TYPE_UAS           = 'uas';
    const TYPE_STANDALONE    = 'standalone';

    protected $fillable = [
        'title',
        'description',
        'material_id',
        'teacher_id',
        'quiz_type',
        'passing_score',
        'time_limit',
        'min_harian_required',
    ];

    protected $casts = [
        'passing_score'       => 'integer',
        'time_limit'          => 'integer',
        'min_harian_required' => 'integer',
    ];

    // ─── Scopes ───────────────────────────────────────────────────────

    public function scopeOfType($query, string $type)
    {
        return $query->where('quiz_type', $type);
    }

    public function scopeExamTypes($query)
    {
        return $query->whereIn('quiz_type', [self::TYPE_UJIAN_HARIAN, self::TYPE_UTS, self::TYPE_UAS]);
    }

    // ─── Relationships ────────────────────────────────────────────────

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class)->orderBy('order');
    }

    public function results(): HasMany
    {
        return $this->hasMany(QuizResult::class);
    }

    // ─── Accessors ────────────────────────────────────────────────────

    public function getTypeLabelAttribute(): string
    {
        return match ($this->quiz_type) {
            'pretest'      => 'Pretest',
            'posttest'     => 'Posttest',
            'ujian_harian' => 'Ujian Harian',
            'uts'          => 'Ujian Tengah Semester',
            'uas'          => 'Ujian Akhir Semester',
            'standalone'   => 'Latihan Soal',
            default        => ucfirst($this->quiz_type),
        };
    }

    public function getTypeBadgeColorAttribute(): string
    {
        return match ($this->quiz_type) {
            'pretest'      => 'bg-blue-100 text-blue-800',
            'posttest'     => 'bg-purple-100 text-purple-800',
            'ujian_harian' => 'bg-green-100 text-green-800',
            'uts'          => 'bg-orange-100 text-orange-800',
            'uas'          => 'bg-red-100 text-red-800',
            'standalone'   => 'bg-gray-100 text-gray-700',
            default        => 'bg-gray-100 text-gray-700',
        };
    }

    public function isTimeLimited(): bool
    {
        return $this->time_limit !== null && $this->time_limit > 0;
    }

    public function isExam(): bool
    {
        return in_array($this->quiz_type, [self::TYPE_UJIAN_HARIAN, self::TYPE_UTS, self::TYPE_UAS]);
    }
}
