<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained('quizzes')->cascadeOnDelete();
            $table->text('question');
            // Tipe soal: pilihan ganda atau benar/salah
            $table->enum('type', ['multiple_choice', 'true_false']);
            // Pilihan jawaban disimpan sebagai JSON array
            $table->json('options');
            // Kunci jawaban (value yang cocok dengan salah satu option)
            $table->string('correct_answer');
            // Urutan tampil soal dalam quiz
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
