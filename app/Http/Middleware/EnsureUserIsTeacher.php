<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsTeacher
{
    /**
     * Blokir akses jika user bukan guru.
     * Redirect siswa ke dashboard mereka dengan pesan error.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()?->isTeacherOrAdmin()) {
            return redirect()
                ->route('dashboard')
                ->with('error', 'Halaman ini hanya dapat diakses oleh Guru.');
        }

        return $next($request);
    }
}
