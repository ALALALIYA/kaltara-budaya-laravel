<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    protected $fillable = [
        'quiz_id',
        'question',
        'type',
        'options',
        'correct_answer',
        'explanation',
        'order',
    ];

    protected function casts(): array
    {
        return [
            // Kolom JSON otomatis di-decode jadi array PHP
            'options' => 'array',
            'order'   => 'integer',
        ];
    }

    // ─── Relationships ────────────────────────────────────────────────

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }
}
