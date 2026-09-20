<x-app-layout>
    <x-slot name="title">Quiz Saya</x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white">🧠 Quiz Saya</h1>
                    <p class="text-gray-500 dark:text-gray-400 mt-1 text-sm">Kelola semua quiz dan soal-soalnya.</p>
                </div>
                <a href="{{ route('teacher.quizzes.create') }}"
                   class="inline-flex items-center gap-2 bg-green-700 hover:bg-green-600 text-white font-bold px-5 py-2.5 rounded-xl transition shadow-sm">
                    + Buat Quiz Baru
                </a>
            </div>

            @if($quizzes->isEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-16 text-center">
                    <p class="text-6xl mb-4">🧠</p>
                    <h2 class="font-bold text-gray-900 dark:text-white text-xl mb-2">Belum Ada Quiz</h2>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">Buat quiz pertamamu untuk menguji pemahaman siswa!</p>
                    <a href="{{ route('teacher.quizzes.create') }}"
                       class="bg-green-700 hover:bg-green-600 text-white font-bold px-6 py-3 rounded-xl transition">
                        + Buat Quiz Pertama
                    </a>
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                                <tr>
                                    <th class="text-left px-5 py-3.5 font-semibold text-gray-500 dark:text-gray-400">Judul Quiz</th>
                                    <th class="text-left px-3 py-3.5 font-semibold text-gray-500 dark:text-gray-400">Tipe</th>
                                    <th class="text-left px-3 py-3.5 font-semibold text-gray-500 dark:text-gray-400 hidden sm:table-cell">Materi Terkait</th>
                                    <th class="text-center px-3 py-3.5 font-semibold text-gray-500 dark:text-gray-400">Soal</th>
                                    <th class="text-right px-5 py-3.5 font-semibold text-gray-500 dark:text-gray-400">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @foreach($quizzes as $quiz)
                                    @php
                                        $typeBadge = match($quiz->quiz_type) {
                                            'pretest'      => ['label' => 'Pretest',      'class' => 'bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300'],
                                            'posttest'     => ['label' => 'Posttest',     'class' => 'bg-purple-100 dark:bg-purple-900/40 text-purple-700 dark:text-purple-300'],
                                            'standalone'   => ['label' => 'Latihan',      'class' => 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400'],
                                            'ujian_harian' => ['label' => 'Ujian Harian', 'class' => 'bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300'],
                                            'uts'          => ['label' => 'UTS',          'class' => 'bg-orange-100 dark:bg-orange-900/40 text-orange-700 dark:text-orange-300'],
                                            'uas'          => ['label' => 'UAS',          'class' => 'bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300'],
                                            default        => ['label' => $quiz->quiz_type, 'class' => 'bg-gray-100 text-gray-600'],
                                        };
                                        $needsMaterial = in_array($quiz->quiz_type, ['pretest', 'posttest']);
                                    @endphp
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                        <td class="px-5 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="shrink-0 w-10 h-10 rounded-lg bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center text-xl">
                                                    🧠
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $quiz->title }}</p>
                                                    @if($quiz->description)
                                                        <p class="text-gray-400 dark:text-gray-500 text-xs truncate max-w-xs">{{ $quiz->description }}</p>
                                                    @endif
                                                    {{-- Warning: pretest/posttest with no material linked --}}
                                                    @if($needsMaterial && !$quiz->material)
                                                        <span class="inline-flex items-center gap-1 text-xs text-orange-600 dark:text-orange-400 bg-orange-50 dark:bg-orange-900/30 px-2 py-0.5 rounded-full mt-0.5">
                                                            ⚠️ Belum dikaitkan ke materi
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-3 py-4">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold {{ $typeBadge['class'] }}">
                                                {{ $typeBadge['label'] }}
                                            </span>
                                        </td>
                                        <td class="px-3 py-4 hidden sm:table-cell">
                                            @if($quiz->material)
                                                <a href="{{ route('teacher.materials.show', $quiz->material->id) }}"
                                                   class="text-green-600 hover:underline text-xs font-medium">
                                                    {{ $quiz->material->title }}
                                                </a>
                                            @elseif($needsMaterial)
                                                <span class="text-orange-500 dark:text-orange-400 text-xs font-medium">⚠️ Wajib diisi</span>
                                            @else
                                                <span class="text-gray-400 dark:text-gray-500 text-xs">—</span>
                                            @endif
                                        </td>
                                        <td class="px-3 py-4 text-center">
                                            @if($quiz->questions_count > 0)
                                                <span class="inline-flex items-center justify-center bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 font-bold text-sm w-10 h-7 rounded-full">
                                                    {{ $quiz->questions_count }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center justify-center bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 font-bold text-xs px-2 py-1 rounded-full">
                                                    Kosong
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-4">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="{{ route('teacher.quizzes.show', $quiz->id) }}"
                                                   class="text-blue-600 hover:text-blue-500 font-medium text-xs px-2 py-1 rounded hover:bg-blue-50 dark:hover:bg-blue-900/20 transition">
                                                    Kelola Soal
                                                </a>
                                                <a href="{{ route('teacher.quizzes.edit', $quiz->id) }}"
                                                   class="text-green-600 hover:text-green-500 font-medium text-xs px-2 py-1 rounded hover:bg-green-50 dark:hover:bg-green-900/20 transition">
                                                    Edit
                                                </a>
                                                <form method="POST" action="{{ route('teacher.quizzes.destroy', $quiz->id) }}"
                                                      onsubmit="return confirm('Hapus quiz \'{{ addslashes($quiz->title) }}\'? Semua soal juga akan terhapus.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="text-red-500 hover:text-red-600 font-medium text-xs px-2 py-1 rounded hover:bg-red-50 dark:hover:bg-red-900/20 transition">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($quizzes->hasPages())
                        <div class="px-5 py-4 border-t border-gray-100 dark:border-gray-700">
                            {{ $quizzes->links() }}
                        </div>
                    @endif
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
