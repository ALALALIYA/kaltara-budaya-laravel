<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Urutan penting: User dulu, baru data yang butuh foreign key ke users
        $this->call([
            UserSeeder::class,
            BadgeSeeder::class,
            MaterialSeeder::class,
            QuizSeeder::class,
            ContentSeeder::class,
            DayakMaterialSeeder::class,
            BanjarMaterialSeeder::class,
            KutaiMaterialSeeder::class,
            TidungMaterialSeeder::class,
        ]);
    }
}
