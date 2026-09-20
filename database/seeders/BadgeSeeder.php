<?php

namespace Database\Seeders;

use App\Models\Badge;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
    public function run(): void
    {
        $badges = [
            [
                'name'        => 'Penjelajah Budaya',
                'description' => 'Selesaikan materi pertamamu dan mulai petualangan budaya Kaltara!',
                'icon'        => '🗺️',
                'criteria'    => ['type' => 'material_completed', 'count' => 1],
            ],
            [
                'name'        => 'Sang Pejuang',
                'description' => 'Raih nilai sempurna 100 dalam sebuah quiz. Kamu memang juara!',
                'icon'        => '⚔️',
                'criteria'    => ['type' => 'quiz_perfect_score', 'score' => 100],
            ],
            [
                'name'        => 'Bintang Kaltara',
                'description' => 'Selesaikan semua 4 materi budaya Kalimantan Utara. Luar biasa!',
                'icon'        => '⭐',
                'criteria'    => ['type' => 'material_completed', 'count' => 4],
            ],
            [
                'name'        => 'Streak Master',
                'description' => 'Belajar 7 hari berturut-turut tanpa berhenti. Konsistensi adalah kunci!',
                'icon'        => '🔥',
                'criteria'    => ['type' => 'streak', 'days' => 7],
            ],
            [
                'name'        => 'Maestro Quiz',
                'description' => 'Kerjakan 5 quiz berbeda. Kamu adalah master pengetahuan budaya!',
                'icon'        => '🏆',
                'criteria'    => ['type' => 'quiz_completed', 'count' => 5],
            ],
        ];

        foreach ($badges as $badge) {
            Badge::create($badge);
        }
    }
}
