<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Add status to materials, make category nullable
        Schema::table('materials', function (Blueprint $table) {
            $table->enum('status', ['draft', 'pending', 'approved'])->default('pending')->after('teacher_id');
            // Change category to nullable string (MySQL doesn't support modifying ENUMs cleanly cross-platform)
        });

        // Make category nullable via raw SQL (works on MySQL/MariaDB)
        DB::statement("ALTER TABLE materials MODIFY COLUMN `category` ENUM('dayak','banjar','kutai','tidung') NULL DEFAULT NULL");

        // 2. Add quiz_type, passing_score, time_limit, min_harian_required to quizzes
        Schema::table('quizzes', function (Blueprint $table) {
            $table->enum('quiz_type', ['pretest', 'posttest', 'ujian_harian', 'uts', 'uas', 'standalone'])
                  ->default('standalone')
                  ->after('teacher_id');
            $table->unsignedTinyInteger('passing_score')->default(70)->after('quiz_type');
            $table->unsignedSmallInteger('time_limit')->nullable()->after('passing_score');
            $table->unsignedTinyInteger('min_harian_required')->default(0)->after('time_limit');
        });

        // 3. Add admin to users role enum
        DB::statement("ALTER TABLE users MODIFY COLUMN `role` ENUM('student','teacher','admin') NOT NULL DEFAULT 'student'");
    }

    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        DB::statement("ALTER TABLE materials MODIFY COLUMN `category` ENUM('dayak','banjar','kutai','tidung') NOT NULL");

        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropColumn(['quiz_type', 'passing_score', 'time_limit', 'min_harian_required']);
        });

        DB::statement("ALTER TABLE users MODIFY COLUMN `role` ENUM('student','teacher') NOT NULL DEFAULT 'student'");
    }
};
