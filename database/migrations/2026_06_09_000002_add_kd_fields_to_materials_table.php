<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->text('kompetensi_dasar')->nullable()->after('description');
            $table->unsignedTinyInteger('pertemuan_ke')->nullable()->after('kompetensi_dasar');
        });
    }

    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropColumn(['kompetensi_dasar', 'pertemuan_ke']);
        });
    }
};
