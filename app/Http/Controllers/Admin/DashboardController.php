<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $pendingMaterials = Material::pending()->with('teacher')->latest()->get();
        $totalStudents    = User::where('role', 'student')->count();
        $totalTeachers    = User::where('role', 'teacher')->count();
        $totalApproved    = Material::approved()->count();
        $totalQuizzes     = Quiz::count();

        return view('admin.dashboard', compact(
            'pendingMaterials',
            'totalStudents',
            'totalTeachers',
            'totalApproved',
            'totalQuizzes'
        ));
    }
}
