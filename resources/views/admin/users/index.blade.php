<x-app-layout>
    <x-slot name="title">Kelola Akun</x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white">⚙️ Kelola Akun</h1>
                    <p class="text-sm text-gray-500 mt-1">Buat akun guru baru atau lihat daftar siswa terdaftar.</p>
                </div>
                <a href="{{ route('admin.users.create') }}"
                   class="px-5 py-2.5 bg-amber-600 hover:bg-amber-500 text-white font-bold rounded-xl shadow text-sm transition">
                    ➕ Tambah Guru
                </a>
            </div>

            <!-- Daftar Guru -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-amber-50 to-yellow-50 dark:from-gray-800 dark:to-gray-800 rounded-t-2xl flex items-center gap-3">
                    <span class="text-xl">👩‍🏫</span>
                    <h2 class="font-extrabold text-gray-900 dark:text-white">Daftar Guru</h2>
                    <span class="ml-auto text-xs bg-amber-100 text-amber-800 font-bold px-2.5 py-1 rounded-full">{{ $teachers->count() }} guru</span>
                </div>
                <div class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($teachers as $teacher)
                        <div class="flex items-center justify-between px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center text-white font-extrabold text-sm">
                                    {{ strtoupper(substr($teacher->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 dark:text-white text-sm">{{ $teacher->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $teacher->email }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-xs bg-yellow-100 text-yellow-800 font-bold px-2 py-0.5 rounded-full">
                                    {{ $teacher->role === 'admin' ? '🛡️ Admin' : '👩‍🏫 Guru' }}
                                </span>
                                @if($teacher->id !== auth()->id())
                                    <form method="POST" action="{{ route('admin.users.destroy', $teacher) }}"
                                          onsubmit="return confirm('Hapus akun {{ $teacher->name }}?')">
                                        @csrf @method('DELETE')
                                        <button class="text-xs text-red-500 hover:text-red-700 font-semibold">Hapus</button>
                                    </form>
                                @else
                                    <span class="text-xs text-gray-400">(akun ini)</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-400 py-8">Belum ada guru terdaftar.</p>
                    @endforelse
                </div>
            </div>

            <!-- Daftar Siswa -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-800 dark:to-gray-800 rounded-t-2xl flex items-center gap-3">
                    <span class="text-xl">🎓</span>
                    <h2 class="font-extrabold text-gray-900 dark:text-white">Daftar Siswa</h2>
                    <span class="ml-auto text-xs bg-green-100 text-green-800 font-bold px-2.5 py-1 rounded-full">{{ $students->total() }} siswa</span>
                </div>
                <div class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($students as $student)
                        <div class="flex items-center justify-between px-6 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-green-400 to-emerald-500 flex items-center justify-center text-white font-bold text-xs">
                                    {{ strtoupper(substr($student->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-white text-sm">{{ $student->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $student->email }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 text-xs text-gray-500">
                                <span class="text-yellow-600 font-bold">⚡ {{ $student->xp }} XP</span>
                                <form method="POST" action="{{ route('admin.users.destroy', $student) }}"
                                      onsubmit="return confirm('Hapus akun siswa {{ $student->name }}?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-400 hover:text-red-600 font-semibold">Hapus</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-400 py-8">Belum ada siswa terdaftar.</p>
                    @endforelse
                </div>
                @if($students->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100">{{ $students->links() }}</div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
