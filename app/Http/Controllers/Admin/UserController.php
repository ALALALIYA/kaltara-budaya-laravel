<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $teachers = User::whereIn('role', ['teacher', 'admin'])->orderBy('name')->get();
        $students = User::where('role', 'student')->orderBy('name')->paginate(20);

        return view('admin.users.index', compact('teachers', 'students'));
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'teacher',
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Akun guru berhasil dibuat! ✅');
    }

    public function destroy(User $user): RedirectResponse
    {
        abort_if($user->id === auth()->id(), 403, 'Tidak bisa menghapus akun sendiri.');
        abort_if($user->role === 'admin' && User::where('role', 'admin')->count() <= 1, 403, 'Harus ada minimal satu guru/admin.');

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Akun berhasil dihapus.');
    }
}
