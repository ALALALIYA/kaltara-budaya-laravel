<?php

namespace App\Services;

use App\Models\Badge;
use App\Models\User;

/**
 * Menangani logika gamifikasi: XP, streak harian, dan pemberian badge.
 * Di-inject via constructor ke controller yang membutuhkan (MaterialController, QuizController).
 */
class BadgeService
{
    /**
     * Tambah XP ke akun user.
     */
    public function awardXp(User $user, int $amount): void
    {
        $user->increment('xp', $amount);
        // Refresh agar atribut in-memory sinkron dengan DB setelah increment
        $user->refresh();
    }

    /**
     * Update streak harian user.
     *
     * Aturan:
     * - Aktif hari ini → hanya update timestamp
     * - Aktif kemarin  → streak +1
     * - Lebih dari 1 hari → streak reset ke 1
     */
    public function updateStreak(User $user): void
    {
        $now          = now();
        $lastActivity = $user->last_activity_at;

        if ($lastActivity === null) {
            $user->update(['streak' => 1, 'last_activity_at' => $now]);
            return;
        }

        $daysDiff = (int) $lastActivity->startOfDay()->diffInDays($now->copy()->startOfDay());

        if ($daysDiff === 0) {
            // Sudah belajar hari ini, cukup update timestamp
            $user->update(['last_activity_at' => $now]);
        } elseif ($daysDiff === 1) {
            // Hari berturut-turut — tambah streak
            $user->update([
                'streak'           => $user->streak + 1,
                'last_activity_at' => $now,
            ]);
        } else {
            // Putus streak — reset ke 1
            $user->update(['streak' => 1, 'last_activity_at' => $now]);
        }

        $user->refresh();
    }

    /**
     * Cek semua badge yang belum diraih user dan berikan jika kriteria terpenuhi.
     *
     * @return Badge[]  Daftar badge baru yang baru saja diraih (untuk ditampilkan ke user)
     */
    public function checkAndAwardBadges(User $user): array
    {
        $newBadges     = [];
        $allBadges     = Badge::all();
        $earnedIds     = $user->badges()->pluck('badge_id')->toArray();

        foreach ($allBadges as $badge) {
            // Skip badge yang sudah diraih
            if (in_array($badge->id, $earnedIds)) {
                continue;
            }

            if ($this->meetsCriterion($user, $badge->criteria)) {
                $user->badges()->attach($badge->id, ['earned_at' => now()]);
                $newBadges[] = $badge;
            }
        }

        return $newBadges;
    }

    /**
     * Evaluasi apakah user memenuhi kriteria badge tertentu.
     */
    private function meetsCriterion(User $user, array $criteria): bool
    {
        return match ($criteria['type']) {
            // Jumlah materi yang sudah diselesaikan
            'material_completed' => $user->materialProgress()
                ->whereNotNull('completed_at')
                ->count() >= ($criteria['count'] ?? 1),

            // Pernah mendapat nilai sempurna (semua jawaban benar)
            'quiz_perfect_score' => $user->quizResults()
                ->whereColumn('score', 'total_questions')
                ->exists(),

            // Jumlah hari streak saat ini
            'streak' => $user->streak >= ($criteria['days'] ?? 1),

            // Jumlah quiz yang sudah dikerjakan (berapa kali pun)
            'quiz_completed' => $user->quizResults()->count() >= ($criteria['count'] ?? 1),

            default => false,
        };
    }
}
