<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'xp', 'streak', 'last_activity_at', 'avatar'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'last_activity_at'  => 'datetime',
            'xp'                => 'integer',
            'streak'            => 'integer',
        ];
    }

    // ─── Helper Methods ───────────────────────────────────────────────

    public function isTeacher(): bool
    {
        return $this->role === 'teacher';
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isTeacherOrAdmin(): bool
    {
        return in_array($this->role, ['teacher', 'admin']);
    }

    // ─── Relationships ────────────────────────────────────────────────

    /** Materi-materi yang dibuat oleh guru ini */
    public function materials(): HasMany
    {
        return $this->hasMany(Material::class, 'teacher_id');
    }

    /** Quiz-quiz yang dibuat oleh guru ini */
    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class, 'teacher_id');
    }

    /** Riwayat hasil quiz siswa ini */
    public function quizResults(): HasMany
    {
        return $this->hasMany(QuizResult::class);
    }

    /** Record progress per materi siswa ini */
    public function materialProgress(): HasMany
    {
        return $this->hasMany(MaterialProgress::class);
    }

    /** Materi yang sudah diselesaikan siswa (via pivot material_progress) */
    public function completedMaterials(): BelongsToMany
    {
        return $this->belongsToMany(Material::class, 'material_progress')
            ->withPivot('completed_at')
            ->withTimestamps();
    }

    /** Badge-badge yang diraih siswa (via pivot user_badges) */
    public function badges(): BelongsToMany
    {
        return $this->belongsToMany(Badge::class, 'user_badges')
            ->withPivot('earned_at')
            ->withTimestamps();
    }

    /** Detail record user_badges */
    public function userBadges(): HasMany
    {
        return $this->hasMany(UserBadge::class);
    }
}
