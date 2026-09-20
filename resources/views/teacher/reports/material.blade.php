<x-app-layout>
    <x-slot name="title">Laporan: {{ $material->title }}</x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
                <a href="{{ route('teacher.reports.index') }}" class="hover:text-green-600">Laporan Nilai</a>
                <span>/</span>
                <span class="text-gray-700 font-semibold truncate max-w-xs">{{ $material->title }}</span>
            </nav>

            <!-- Header -->
            <div class="rounded-2xl p-6 mb-6 text-white"
                 style="background: linear-gradient(135deg, #1a4731, #14532d);">
                <div class="flex items-start gap-4">
                    <span class="text-4xl">{{ $material->category_icon }}</span>
                    <div>
                        <h1 class="text-2xl font-extrabold">{{ $material->title }}</h1>
                        <p class="text-green-200 text-sm mt-1">{{ $material->description }}</p>
                        <div class="flex gap-3 mt-3 flex-wrap">
                            @if($pretestQuiz)
                                <span class="bg-amber-400/30 text-amber-200 text-xs font-bold px-3 py-1 rounded-full">📋 Pretest: {{ $pretestQuiz->title }}</span>
                            @else
                                <span class="bg-white/10 text-white/50 text-xs px-3 py-1 rounded-full">Tidak ada pretest</span>
                            @endif
                            @if($posttestQuiz)
                                <span class="bg-green-400/30 text-green-200 text-xs font-bold px-3 py-1 rounded-full">✅ Posttest: {{ $posttestQuiz->title }} (min {{ $posttestQuiz->passing_score }}%)</span>
                            @else
                                <span class="bg-white/10 text-white/50 text-xs px-3 py-1 rounded-full">Tidak ada posttest</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel nilai siswa -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 flex items-center justify-between">
                    <h2 class="font-extrabold text-gray-900 dark:text-white">Nilai Per Siswa</h2>
                    <span class="text-xs text-gray-500">{{ $students->count() }} siswa terdaftar</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-700 text-left">
                                <th class="px-5 py-3 font-bold text-gray-600 dark:text-gray-300">Nama Siswa</th>
                                <th class="px-4 py-3 font-bold text-amber-600 text-center">Pretest</th>
                                <th class="px-4 py-3 font-bold text-green-600 text-center">Posttest (terbaik)</th>
                                <th class="px-4 py-3 font-bold text-blue-600 text-center">Peningkatan</th>
                                <th class="px-4 py-3 font-bold text-gray-600 dark:text-gray-300 text-center">Status Materi</th>
                                <th class="px-4 py-3 font-bold text-purple-600 text-center">Percobaan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach($students as $student)
                                @php
                                    $preResult  = $pretestResults[$student->id] ?? null;
                                    $postResult = $posttestResults[$student->id] ?? null;

                                    $prePct  = $preResult && $preResult->total_q > 0
                                                ? (int) round(($preResult->best_score / $preResult->total_q) * 100) : null;
                                    $postPct = $postResult && $postResult->total_q > 0
                                                ? (int) round(($postResult->best_score / $postResult->total_q) * 100) : null;

                                    $delta    = ($prePct !== null && $postPct !== null) ? ($postPct - $prePct) : null;
                                    $passed   = $postPct !== null && $posttestQuiz && $postPct >= $posttestQuiz->passing_score;
                                    $completed = in_array($student->id, $completedUserIds);
                                @endphp
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition {{ $completed ? 'bg-green-50/30' : '' }}">
                                    <td class="px-5 py-3">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center text-white font-bold text-xs shrink-0">
                                                {{ strtoupper(substr($student->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-900 dark:text-white">{{ $student->name }}</p>
                                                <p class="text-xs text-gray-400">{{ $student->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if($prePct !== null)
                                            <span class="font-bold text-amber-600">{{ $prePct }}%</span>
                                        @else
                                            <span class="text-gray-300 text-xs">Belum</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if($postPct !== null)
                                            <span class="font-bold {{ $passed ? 'text-green-600' : 'text-red-500' }}">
                                                {{ $postPct }}% {{ $passed ? '✅' : '❌' }}
                                            </span>
                                        @else
                                            <span class="text-gray-300 text-xs">Belum</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if($delta !== null)
                                            <span class="font-bold {{ $delta >= 0 ? 'text-green-600' : 'text-red-500' }}">
                                                {{ $delta >= 0 ? '+' : '' }}{{ $delta }}%
                                            </span>
                                        @else
                                            <span class="text-gray-300 text-xs">—</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if($completed)
                                            <span class="text-xs bg-green-100 text-green-700 font-bold px-2 py-0.5 rounded-full">✅ Selesai</span>
                                        @else
                                            <span class="text-xs bg-gray-100 text-gray-500 px-2 py-0.5 rounded-full">Belum</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center text-gray-500 text-xs">
                                        @if($postResult)
                                            {{ $postResult->attempts }}x percobaan
                                        @else
                                            —
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Legenda -->
            <div class="mt-4 flex flex-wrap gap-4 text-xs text-gray-500">
                <span>✅ = Lulus posttest</span>
                <span>❌ = Belum mencapai nilai minimum</span>
                <span>Kolom <strong>Peningkatan</strong> = selisih pretest → posttest</span>
            </div>

        </div>
    </div>
</x-app-layout>
