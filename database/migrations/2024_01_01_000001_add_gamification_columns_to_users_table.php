<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Kolom role untuk membedakan guru dan siswa
            $table->enum('role', ['student', 'teacher', 'admin'])->default('student')->after('password');
            // Kolom gamifikasi: poin pengalaman, streak harian, waktu aktivitas terakhir, foto profil
            $table->integer('xp')->default(0)->after('role');
            $table->integer('streak')->default(0)->after('xp');
            $table->timestamp('last_activity_at')->nullable()->after('streak');
            $table->string('avatar')->nullable()->after('last_activity_at');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'xp', 'streak', 'last_activity_at', 'avatar']);
        });
    }
};
