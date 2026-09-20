<x-app-layout>
    <x-slot name="title">Dashboard Guru</x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <p class="text-green-600 dark:text-green-400 text-sm font-medium">Selamat datang,</p>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white">{{ auth()->user()->name }} 👋</h1>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Kelola materi dan quiz untuk siswa kamu.</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('teacher.materials.create') }}"
                       class="bg-green-700 hover:bg-green-600 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition shadow-sm">
                        + Materi Baru
                    </a>
                    <a href="{{ route('teacher.quizzes.create') }}"
                       class="bg-yellow-500 hover:bg-yellow-400 text-green-900 font-bold text-sm px-4 py-2.5 rounded-xl transition shadow-sm">
                        + Quiz Baru
                    </a>
                </div>
            </div>

            <!-- Stat Cards -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                    <p class="text-3xl mb-1">👥</p>
                    <p class="text-2xl font-extrabold text-gray-900 dark:text-white">{{ $totalStudents }}</p>
                    <p class="text-gray-400 text-xs mt-0.5">Total Siswa</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                    <p class="text-3xl mb-1">📖</p>
                    <p class="text-2xl font-extrabold text-gray-900 dark:text-white">{{ $totalMaterials }}</p>
                    <p class="text-gray-400 text-xs mt-0.5">Materi Saya</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                    <p class="text-3xl mb-1">🧠</p>
                    <p class="text-2xl font-extrabold text-gray-900 dark:text-white">{{ $totalQuizzes }}</p>
                    <p class="text-gray-400 text-xs mt-0.5">Quiz Saya</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                    <p class="text-3xl mb-1">📝</p>
                    <p class="text-2xl font-extrabold text-gray-900 dark:text-white">{{ $totalAttempts }}</p>
                    <p class="text-gray-400 text-xs mt-0.5">Total Pengerjaan</p>
                </div>
                <div class="col-span-2 sm:col-span-1 bg-green-700 rounded-xl p-5 shadow-sm text-center text-white">
                    <p class="text-3xl mb-1">📊</p>
                    <p class="text-2xl font-extrabold">{{ $avgScore }}%</p>
                    <p class="text-green-200 text-xs mt-0.5">Rata-rata Skor</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Pengerjaan Quiz Terbaru -->
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-5">
                    <div class="flex items-center justify-between mb-5">
                        <h2 class="font-bold text-gray-900 dark:text-white text-lg">📝 Pengerjaan Quiz Terbaru</h2>
                        <a href="{{ route('teacher.students.index') }}" class="text-green-600 hover:text-green-500 text-sm font-medium">Lihat Siswa →</a>
                    </div>

                    @if($recentResults->isEmpty())
                        <div class="text-center py-10 text-gray-400">
                            <p class="text-4xl mb-3">📝</p>
                            <p class="text-sm">Belum ada siswa yang mengerjakan quiz kamu.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="text-left text-gray-400 dark:text-gray-500 border-b border-gray-100 dark:border-gray-700">
                                        <th class="pb-3 font-semibold">Siswa</th>
                                        <th class="pb-3 font-semibold">Quiz</th>
                                        <th class="pb-3 font-semibold text-center">Skor</th>
                                        <th class="pb-3 font-semibold text-right">Waktu</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                                    @foreach($recentResults as $result)
                                        @php $pct = $result->percentage; @endphp
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                            <td class="py-3 pr-3">
                                                <p class="font-medium text-gray-900 dark:text-white">{{ $result->user->name }}</p>
                                            </td>
                                            <td class="py-3 pr-3 text-gray-500 dark:text-gray-400 max-w-[150px] truncate">
                                                {{ $result->quiz->title }}
                                            </td>
                                            <td class="py-3 pr-3 text-center">
                                                <span class="font-bold text-sm
                                                    {{ $pct >= 80 ? 'text-green-600' : ($pct >= 60 ? 'text-yellow-600' : 'text-red-500') }}">
                                                    {{ $result->score }}/{{ $result->total_questions }}
                                                    <span class="text-xs">({{ round($pct) }}%)</span>
                                                </span>
                                            </td>
                                            <td class="py-3 text-right text-gray-400 dark:text-gray-500 text-xs whitespace-nowrap">
                                                {{ $result->completed_at?->diffForHumans() }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <!-- Materi Terbaru -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-5">
                    <div class="flex items-center justify-between mb-5">
                        <h2 class="font-bold text-gray-900 dark:text-white text-lg">📚 Materi Terbaru</h2>
                        <a href="{{ route('teacher.materials.index') }}" class="text-green-600 hover:text-green-500 text-sm font-medium">Kelola →</a>
                    </div>

                    @if($latestMaterials->isEmpty())
                        <div class="text-center py-8 text-gray-400">
                            <p class="text-3xl mb-2">📖</p>
                            <p class="text-sm">Belum ada materi. <a href="{{ route('teacher.materials.create') }}" class="text-green-600 font-medium">Tambah sekarang!</a></p>
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach($latestMaterials as $material)
                                <a href="{{ route('teacher.materials.show', $material->id) }}"
                                   class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors group">
                                    <div class="shrink-0 w-10 h-10 rounded-lg flex items-center justify-center text-xl
                                        {{ $material->category === 'dayak'  ? 'bg-green-100' :
                                           ($material->category === 'banjar' ? 'bg-amber-100' :
                                           ($material->category === 'kutai'  ? 'bg-red-100' : 'bg-blue-100')) }}">
                                        {{ $material->category === 'dayak' ? '🦅' : ($material->category === 'banjar' ? '🎋' : ($material->category === 'kutai' ? '🐉' : '🌊')) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-gray-900 dark:text-white text-sm truncate group-hover:text-green-600 transition-colors">
                                            {{ $material->title }}
                                        </p>
                                        <p class="text-gray-400 text-xs uppercase">{{ $material->category_label }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Aksi Cepat -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('teacher.materials.index') }}"
                   class="flex items-center gap-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700 rounded-xl p-4 hover:shadow-md transition group">
                    <span class="text-2xl">📖</span>
                    <div>
                        <p class="font-semibold text-green-800 dark:text-green-300 text-sm">Kelola Materi</p>
                        <p class="text-green-600 dark:text-green-500 text-xs">{{ $totalMaterials }} materi</p>
                    </div>
                    <span class="ml-auto text-green-400 group-hover:text-green-600 transition">→</span>
                </a>
                <a href="{{ route('teacher.quizzes.index') }}"
                   class="flex items-center gap-3 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700 rounded-xl p-4 hover:shadow-md transition group">
                    <span class="text-2xl">🧠</span>
                    <div>
                        <p class="font-semibold text-yellow-800 dark:text-yellow-300 text-sm">Kelola Quiz</p>
                        <p class="text-yellow-600 dark:text-yellow-500 text-xs">{{ $totalQuizzes }} quiz</p>
                    </div>
                    <span class="ml-auto text-yellow-400 group-hover:text-yellow-600 transition">→</span>
                </a>
                <a href="{{ route('teacher.students.index') }}"
                   class="flex items-center gap-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-xl p-4 hover:shadow-md transition group">
                    <span class="text-2xl">👥</span>
                    <div>
                        <p class="font-semibold text-blue-800 dark:text-blue-300 text-sm">Data Siswa</p>
                        <p class="text-blue-600 dark:text-blue-500 text-xs">{{ $totalStudents }} siswa</p>
                    </div>
                    <span class="ml-auto text-blue-400 group-hover:text-blue-600 transition">→</span>
                </a>
                <a href="{{ route('teacher.materials.create') }}"
                   class="flex items-center gap-3 bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-xl p-4 hover:shadow-md transition group">
                    <span class="text-2xl">✏️</span>
                    <div>
                        <p class="font-semibold text-gray-700 dark:text-gray-300 text-sm">Buat Materi Baru</p>
                        <p class="text-gray-400 text-xs">Tambah konten belajar</p>
                    </div>
                    <span class="ml-auto text-gray-400 group-hover:text-gray-600 transition">→</span>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
