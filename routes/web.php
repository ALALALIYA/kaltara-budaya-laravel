<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MaterialController as AdminMaterialController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Http\Controllers\Teacher\MaterialController as TeacherMaterialController;
use App\Http\Controllers\Teacher\QuizController as TeacherQuizController;

use App\Http\Controllers\Teacher\ReportController as TeacherReportController;
use App\Http\Controllers\Teacher\StudentController;
use Illuminate\Support\Facades\Route;

// ── Landing Page (bisa diakses siapa saja) ───────────────────────────────────
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

// ── Dashboard (closure diganti controller agar bisa cek role) ────────────────
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ── Profile Breeze (tidak diubah) ────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ── Halaman Siswa (butuh login) ───────────────────────────────────────────────
Route::middleware(['auth', 'verified'])->group(function () {

    // Materi Budaya
    Route::get('/materials', [MaterialController::class, 'index'])
        ->name('materials.index');
    Route::get('/materials/{slug}/pretest', [MaterialController::class, 'pretest'])
        ->name('materials.pretest');
    Route::post('/materials/{slug}/pretest', [MaterialController::class, 'submitPretest'])
        ->name('materials.pretest.submit');
    Route::get('/materials/{slug}/pretest/{result}', [MaterialController::class, 'pretestResult'])
        ->name('materials.pretest.result');
    Route::get('/materials/{slug}', [MaterialController::class, 'show'])
        ->name('materials.show');
    Route::post('/materials/{slug}/complete', [MaterialController::class, 'complete'])
        ->name('materials.complete');
    Route::get('/materials/{slug}/posttest', [MaterialController::class, 'posttest'])
        ->name('materials.posttest');
    Route::post('/materials/{slug}/posttest', [MaterialController::class, 'submitPosttest'])
        ->name('materials.posttest.submit');
    Route::get('/materials/{slug}/posttest/{result}', [MaterialController::class, 'posttestResult'])
        ->name('materials.posttest.result');

    // Quiz (standalone & latihan)
    Route::get('/quizzes', [QuizController::class, 'index'])
        ->name('quizzes.index');
    Route::get('/quizzes/{quiz}/take', [QuizController::class, 'take'])
        ->name('quizzes.take');
    Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit'])
        ->name('quizzes.submit');
    Route::get('/quizzes/{quiz}/result/{result}', [QuizController::class, 'result'])
        ->name('quizzes.result');

    // Ujian Kompetensi
    Route::get('/ujian', [ExamController::class, 'index'])
        ->name('exams.index');
    Route::get('/ujian/{quiz}/mulai', [ExamController::class, 'start'])
        ->name('exams.start');
    Route::post('/ujian/{quiz}/kumpulkan', [ExamController::class, 'submit'])
        ->name('exams.submit');
    Route::get('/ujian/{quiz}/hasil/{result}', [ExamController::class, 'result'])
        ->name('exams.result');

    // Mini Games
    Route::get('/games/matching', [GameController::class, 'matching'])
        ->name('games.matching');
    Route::get('/games/guess-dance', [GameController::class, 'guessDance'])
        ->name('games.guess-dance');

    // Proyek Akhir
    Route::get('/proyek-akhir', [App\Http\Controllers\ProjectController::class, 'index'])
        ->name('projects.index');
    Route::post('/proyek-akhir', [App\Http\Controllers\ProjectController::class, 'store'])
        ->name('projects.store');
    Route::get('/galeri-karya', [App\Http\Controllers\ProjectController::class, 'gallery'])
        ->name('projects.gallery');

});

// ── Halaman Guru (butuh login + role 'teacher') ───────────────────────────────
// Semua route di bawah ini diproteksi middleware 'teacher'
// URL prefix: /teacher/...
// Route name prefix: teacher....
Route::middleware(['auth', 'verified', 'teacher'])
    ->prefix('teacher')
    ->name('teacher.')
    ->group(function () {

        // Dashboard statistik guru
        Route::get('/dashboard', [TeacherDashboardController::class, 'index'])
            ->name('dashboard');

        // CRUD Materi — menghasilkan route:
        //   GET    /teacher/materials           → index
        //   GET    /teacher/materials/create    → create
        //   POST   /teacher/materials           → store
        //   GET    /teacher/materials/{id}      → show
        //   GET    /teacher/materials/{id}/edit → edit
        //   PATCH  /teacher/materials/{id}      → update
        //   DELETE /teacher/materials/{id}      → destroy
        Route::post('/materials/upload-image', [TeacherMaterialController::class, 'uploadImage'])
            ->name('materials.upload_image');
        Route::resource('materials', TeacherMaterialController::class);

        // CRUD Quiz
        Route::resource('quizzes', TeacherQuizController::class);

        // Endpoint tambah & hapus soal di dalam sebuah quiz
        Route::post('/quizzes/{quiz}/questions', [TeacherQuizController::class, 'storeQuestion'])
            ->name('quizzes.questions.store');
        Route::delete('/quizzes/{quiz}/questions/{question}', [TeacherQuizController::class, 'destroyQuestion'])
            ->name('quizzes.questions.destroy');

        // Daftar siswa & detail skor per siswa
        Route::get('/students', [StudentController::class, 'index'])
            ->name('students.index');
        Route::get('/students/{user}', [StudentController::class, 'show'])
            ->name('students.show');
        Route::delete('/students/{user}/reset-all', [StudentController::class, 'resetAllProgress'])
            ->name('students.reset_all');
        Route::delete('/students/{user}/reset-material/{material}', [StudentController::class, 'resetMaterialProgress'])
            ->name('students.reset_material');

        // Laporan Nilai
        Route::get('/reports/export', [TeacherReportController::class, 'exportCsv'])
            ->name('reports.export');
        Route::get('/reports', [TeacherReportController::class, 'index'])
            ->name('reports.index');
        Route::get('/reports/material/{material}', [TeacherReportController::class, 'material'])
            ->name('reports.material');

        // Proyek Akhir Santri
        Route::get('/projects', [App\Http\Controllers\Teacher\ProjectController::class, 'index'])
            ->name('projects.index');
        Route::post('/projects/{project}/upload-photo', [App\Http\Controllers\Teacher\ProjectController::class, 'uploadPhoto'])
            ->name('projects.upload-photo');
    });

// ── Panel Guru (Admin) ────────────────────────────────────────────────────────
Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');
        Route::get('/materials', [AdminMaterialController::class, 'index'])
            ->name('materials.index');
        Route::get('/materials/{material}', [AdminMaterialController::class, 'show'])
            ->name('materials.show');
        Route::patch('/materials/{material}/approve', [AdminMaterialController::class, 'approve'])
            ->name('materials.approve');
        Route::patch('/materials/{material}/reject', [AdminMaterialController::class, 'reject'])
            ->name('materials.reject');

        // Kelola Akun Guru & Siswa
        Route::get('/users', [AdminUserController::class, 'index'])
            ->name('users.index');
        Route::get('/users/create', [AdminUserController::class, 'create'])
            ->name('users.create');
        Route::post('/users', [AdminUserController::class, 'store'])
            ->name('users.store');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])
            ->name('users.destroy');
    });

require __DIR__.'/auth.php';
