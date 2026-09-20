<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Badge extends Model
{
    protected $fillable = [
        'name',
        'description',
        'icon',
        'criteria',
    ];

    protected function casts(): array
    {
        return [
            // Kolom JSON otomatis di-decode jadi array PHP
            'criteria' => 'array',
        ];
    }

    // ─── Relationships ────────────────────────────────────────────────

    /** User-user yang telah meraih badge ini */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_badges')
            ->withPivot('earned_at')
            ->withTimestamps();
    }

    public function userBadges(): HasMany
    {
        return $this->hasMany(UserBadge::class);
    }
}
