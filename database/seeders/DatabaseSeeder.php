<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Urutan penting: User dulu, baru data yang butuh foreign key ke users
        $this->call([
            UserSeeder::class,
            BadgeSeeder::class,
            DayakMaterialSeeder::class,
            BanjarMaterialSeeder::class,
            KutaiMaterialSeeder::class,
            TidungMaterialSeeder::class,
            ContentSeeder::class,
        ]);
    }
}
