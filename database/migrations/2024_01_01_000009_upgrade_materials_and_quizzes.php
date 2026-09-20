<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Add status to materials (idempotent — safe for fresh installs & retries)
        Schema::table('materials', function (Blueprint $table) {
            if (!Schema::hasColumn('materials', 'status')) {
                $table->enum('status', ['draft', 'pending', 'approved'])->default('pending')->after('teacher_id');
            }
        });

        // Make category nullable — MySQL/MariaDB only (SQLite doesn't support MODIFY COLUMN)
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE materials MODIFY COLUMN `category` ENUM('dayak','banjar','kutai','tidung') NULL DEFAULT NULL");
        }

        // 2. Add quiz columns (idempotent)
        Schema::table('quizzes', function (Blueprint $table) {
            if (!Schema::hasColumn('quizzes', 'quiz_type')) {
                $table->enum('quiz_type', ['pretest', 'posttest', 'ujian_harian', 'uts', 'uas', 'standalone'])
                      ->default('standalone')
                      ->after('teacher_id');
            }
            if (!Schema::hasColumn('quizzes', 'passing_score')) {
                $table->unsignedTinyInteger('passing_score')->default(70)->after('quiz_type');
            }
            if (!Schema::hasColumn('quizzes', 'time_limit')) {
                $table->unsignedSmallInteger('time_limit')->nullable()->after('passing_score');
            }
            if (!Schema::hasColumn('quizzes', 'min_harian_required')) {
                $table->unsignedTinyInteger('min_harian_required')->default(0)->after('time_limit');
            }
        });

        // 3. Add admin to users role enum — MySQL only
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE users MODIFY COLUMN `role` ENUM('student','teacher','admin') NOT NULL DEFAULT 'student'");
        }
    }

    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            if (Schema::hasColumn('materials', 'status')) {
                $table->dropColumn('status');
            }
        });

        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE materials MODIFY COLUMN `category` ENUM('dayak','banjar','kutai','tidung') NOT NULL");
        }

        Schema::table('quizzes', function (Blueprint $table) {
            $toDrop = array_filter(
                ['quiz_type', 'passing_score', 'time_limit', 'min_harian_required'],
                fn($c) => Schema::hasColumn('quizzes', $c)
            );
            if (!empty($toDrop)) {
                $table->dropColumn(array_values($toDrop));
            }
        });

        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE users MODIFY COLUMN `role` ENUM('student','teacher') NOT NULL DEFAULT 'student'");
        }
    }
};
