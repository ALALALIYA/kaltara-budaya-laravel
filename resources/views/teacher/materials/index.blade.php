<x-app-layout>
    <x-slot name="title">Materi Saya</x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white">📖 Materi Saya</h1>
                    <p class="text-gray-500 dark:text-gray-400 mt-1 text-sm">Kelola semua materi yang kamu buat.</p>
                </div>
                <a href="{{ route('teacher.materials.create') }}"
                   class="inline-flex items-center gap-2 bg-green-700 hover:bg-green-600 text-white font-bold px-5 py-2.5 rounded-xl transition shadow-sm">
                    + Tambah Materi
                </a>
            </div>

            <!-- Filters -->
            <div class="mb-6 flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
                <!-- Search Bar -->
                <form action="{{ route('teacher.materials.index') }}" method="GET" class="relative max-w-md w-full sm:w-auto">
                    <!-- Preserve group filter in search -->
                    <input type="hidden" name="group" value="{{ $group ?? 'suku' }}">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari materi..." 
                           class="block w-full pl-10 pr-10 py-2.5 border border-gray-200 dark:border-gray-700 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    @if(!empty($search))
                        <a href="{{ route('teacher.materials.index', ['group' => $group ?? 'suku']) }}" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </a>
                    @endif
                </form>

                <!-- Group By Toggle -->
                <div class="flex items-center gap-2 bg-white dark:bg-gray-800 p-1.5 rounded-2xl w-fit shadow-sm border border-gray-200 dark:border-gray-700">
                    <a href="{{ route('teacher.materials.index', ['search' => $search, 'group' => 'suku']) }}" 
                       class="px-4 py-2 rounded-xl text-sm transition-colors focus:outline-none {{ ($group ?? 'suku') === 'suku' ? 'bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300 font-bold' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200' }}">
                        🎭 Suku
                    </a>
                    <a href="{{ route('teacher.materials.index', ['search' => $search, 'group' => 'pertemuan']) }}" 
                       class="px-4 py-2 rounded-xl text-sm transition-colors focus:outline-none {{ ($group ?? 'suku') === 'pertemuan' ? 'bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300 font-bold' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200' }}">
                        📅 Pertemuan
                    </a>
                </div>
            </div>

            @if($materials->isEmpty())
                @if(empty($search))
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-16 text-center">
                    <p class="text-6xl mb-4">📖</p>
                    <h2 class="font-bold text-gray-900 dark:text-white text-xl mb-2">Belum Ada Materi</h2>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">Buat materi pertamamu untuk mulai berbagi ilmu dengan siswa!</p>
                    <a href="{{ route('teacher.materials.create') }}"
                       class="bg-green-700 hover:bg-green-600 text-white font-bold px-6 py-3 rounded-xl transition">
                        + Buat Materi Pertama
                    </a>
                </div>
                @else
                    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-12 text-center">
                        <p class="text-5xl mb-4">🔍</p>
                        <h2 class="font-bold text-gray-900 dark:text-white text-xl mb-2">Pencarian Tidak Ditemukan</h2>
                        <p class="text-gray-500 dark:text-gray-400">Tidak ada materi yang cocok dengan kata kunci "{{ $search }}".</p>
                    </div>
                @endif
            @else
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                                <tr>
                                    <th class="text-left px-5 py-3.5 font-semibold text-gray-500 dark:text-gray-400">Judul</th>
                                    <th class="text-left px-3 py-3.5 font-semibold text-gray-500 dark:text-gray-400 hidden sm:table-cell">Kategori</th>
                                    <th class="text-left px-3 py-3.5 font-semibold text-gray-500 dark:text-gray-400">Kelengkapan</th>
                                    <th class="px-3 py-3.5 font-semibold text-gray-500 dark:text-gray-400 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @php $currentPertemuan = -1; @endphp
                                @foreach($materials as $material)
                                    @php
                                        $pk = (int) $material->pertemuan_ke;
                                        $displayPertemuan = ($pk >= 1 && $pk <= 7) ? $pk : 0;
                                    @endphp
                                    @if(($group ?? 'suku') === 'pertemuan' && $displayPertemuan !== $currentPertemuan)
                                        @php $currentPertemuan = $displayPertemuan; @endphp
                                        <tr class="bg-indigo-50 dark:bg-indigo-900/20 border-b border-indigo-100 dark:border-indigo-800">
                                            <td colspan="4" class="px-5 py-3">
                                                <div class="flex items-center gap-2">
                                                    <span class="text-indigo-600 dark:text-indigo-400 font-extrabold text-sm uppercase tracking-wider">
                                                        {{ $currentPertemuan > 0 ? 'Pertemuan ' . $currentPertemuan : 'Umum / Tanpa Pertemuan' }}
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif

                                    @php
                                        $pretest  = $material->quizzes->firstWhere('quiz_type', 'pretest');
                                        $posttest = $material->quizzes->firstWhere('quiz_type', 'posttest');
                                        $hasImage = !empty($material->image);
                                        $hasVideo = !empty($material->video_url);
                                        $hasText  = !empty(strip_tags($material->content));
                                        $missingMedia = !$hasImage && !$hasVideo;
                                    @endphp
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                        <td class="px-5 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="shrink-0 w-10 h-10 rounded-lg flex items-center justify-center text-xl
                                                    {{ $material->category === 'dayak'  ? 'bg-green-100 dark:bg-green-900/40' :
                                                       ($material->category === 'banjar' ? 'bg-amber-100 dark:bg-amber-900/40' :
                                                       ($material->category === 'kutai'  ? 'bg-red-100 dark:bg-red-900/40' : 'bg-blue-100 dark:bg-blue-900/40')) }}">
                                                    {{ $material->category === 'dayak' ? '🦅' : ($material->category === 'banjar' ? '🎋' : ($material->category === 'kutai' ? '🐉' : '🌊')) }}
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $material->title }}</p>
                                                    @if($missingMedia)
                                                        <span class="inline-flex items-center gap-1 text-xs font-semibold text-orange-600 dark:text-orange-400 bg-orange-50 dark:bg-orange-900/30 px-2 py-0.5 rounded-full mt-0.5">
                                                            ⚠️ Belum ada foto/video
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-3 py-4 hidden sm:table-cell">
                                            <span class="text-xs font-bold {{ $material->category_color }} uppercase">
                                                {{ $material->category_label }}
                                            </span>
                                        </td>

                                        <!-- Completeness Checklist -->
                                        <td class="px-3 py-4">
                                            <div class="flex flex-col gap-1 text-xs">
                                                <span class="{{ $hasText ? 'text-green-600 dark:text-green-400' : 'text-gray-400' }}">
                                                    {{ $hasText ? '✅' : '⚠️' }} Konten teks
                                                </span>
                                                <span class="{{ $hasImage ? 'text-green-600 dark:text-green-400' : 'text-orange-500 dark:text-orange-400' }}">
                                                    {{ $hasImage ? '✅' : '⚠️' }} Gambar/foto
                                                </span>
                                                <span class="{{ $hasVideo ? 'text-green-600 dark:text-green-400' : 'text-orange-500 dark:text-orange-400' }}">
                                                    {{ $hasVideo ? '✅' : '⚠️' }} Video
                                                </span>
                                                @if($pretest)
                                                    <span class="{{ $pretest->questions_count > 0 ? 'text-green-600 dark:text-green-400' : 'text-red-500' }}">
                                                        {{ $pretest->questions_count > 0 ? '✅' : '❌' }} Pretest ({{ $pretest->questions_count }} soal)
                                                    </span>
                                                @else
                                                    <span class="text-gray-400">⚠️ Pretest belum ada</span>
                                                @endif
                                                @if($posttest)
                                                    <span class="{{ $posttest->questions_count > 0 ? 'text-green-600 dark:text-green-400' : 'text-red-500' }}">
                                                        {{ $posttest->questions_count > 0 ? '✅' : '❌' }} Posttest ({{ $posttest->questions_count }} soal)
                                                    </span>
                                                @else
                                                    <span class="text-gray-400">⚠️ Posttest belum ada</span>
                                                @endif
                                            </div>
                                        </td>

                                        <td class="px-3 py-4">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="{{ route('teacher.materials.show', $material->id) }}"
                                                   class="text-blue-600 hover:text-blue-500 font-medium text-xs px-2 py-1 rounded hover:bg-blue-50 dark:hover:bg-blue-900/20 transition">
                                                    Lihat
                                                </a>
                                                <a href="{{ route('teacher.materials.edit', $material->id) }}"
                                                   class="text-green-600 hover:text-green-500 font-medium text-xs px-2 py-1 rounded hover:bg-green-50 dark:hover:bg-green-900/20 transition">
                                                    Edit
                                                </a>
                                                <form method="POST" action="{{ route('teacher.materials.destroy', $material->id) }}"
                                                      onsubmit="return confirm('Hapus materi \'{{ addslashes($material->title) }}\'? Tindakan ini tidak bisa dibatalkan.')">
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

                    @if($materials->hasPages())
                        <div class="px-5 py-4 border-t border-gray-100 dark:border-gray-700">
                            {{ $materials->links() }}
                        </div>
                    @endif
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
