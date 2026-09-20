<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->longText('content'); // Konten materi lengkap (HTML)
            $table->string('image')->nullable(); // Path gambar cover materi
            $table->string('video_url')->nullable(); // URL video YouTube
            // Kategori suku di Kalimantan Utara
            $table->enum('category', ['dayak', 'banjar', 'kutai', 'tidung']);
            // Guru yang membuat materi ini
            $table->foreignId('teacher_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
