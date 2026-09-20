<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin
        User::firstOrCreate(['email' => 'admin@kaltara.test'], [
            'name'     => 'Admin Kaltara',
            'password' => Hash::make('password'),
            'role'     => 'admin',
            'xp'       => 0,
            'streak'   => 0,
        ]);

        // Akun Guru
        User::firstOrCreate(['email' => 'guru@kaltara.test'], [
            'name'     => 'Bu Sari Guru',
            'password' => Hash::make('password'),
            'role'     => 'teacher',
            'xp'       => 500,
            'streak'   => 10,
        ]);

        // Akun Siswa
        User::firstOrCreate(['email' => 'siswa@kaltara.test'], [
            'name'     => 'Budi Siswa',
            'password' => Hash::make('password'),
            'role'     => 'student',
            'xp'       => 120,
            'streak'   => 3,
        ]);
    }
}
