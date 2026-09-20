<x-app-layout>
    <x-slot name="title">Laporan Nilai</x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="relative rounded-3xl overflow-hidden mb-8 p-8"
                 style="background: linear-gradient(135deg, #1a4731 0%, #14532d 60%, #064e3b 100%);">
                <div class="relative z-10">
                    <h1 class="text-3xl font-extrabold text-white mb-1">📊 Laporan Nilai Siswa</h1>
                    <p class="text-green-100">Pantau perkembangan belajar siswa per materi — pretest vs posttest.</p>
                    <div class="flex flex-wrap gap-3 mt-4">
                        <div class="bg-white/20 backdrop-blur text-white text-sm font-bold px-4 py-2 rounded-xl">
                            👥 {{ $totalStudents }} Siswa Terdaftar
                        </div>
                        <div class="bg-white/20 backdrop-blur text-white text-sm font-bold px-4 py-2 rounded-xl">
                            📝 {{ $totalResults }} Total Pengerjaan Quiz
                        </div>
                        <div class="bg-white/20 backdrop-blur text-white text-sm font-bold px-4 py-2 rounded-xl">
                            📚 {{ $materials->count() }} Materi Aktif
                        </div>
                    </div>
                    <div class="mt-5">
                        <a href="{{ route('teacher.reports.export') }}"
                           class="inline-flex items-center gap-2 bg-yellow-400 hover:bg-yellow-300 text-green-900 font-bold px-5 py-2.5 rounded-full shadow-lg transition-transform hover:scale-105 active:scale-95">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Download Laporan (CSV)
                        </a>
                    </div>
                </div>
                <div class="absolute right-6 top-6 text-8xl opacity-10">📊</div>
            </div>

            <!-- Chart.js: Pretest vs Posttest per Materi -->
            @if(count($chartLabels) > 0)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-6">
                    <h2 class="font-extrabold text-gray-900 dark:text-white mb-1">📈 Grafik Rata-rata Pretest vs Posttest</h2>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">Perbandingan nilai rata-rata siswa sebelum dan sesudah membaca materi.</p>
                    <div class="relative" style="height: 320px;">
                        <canvas id="reportChart"></canvas>
                    </div>
                </div>
            @endif

            <!-- Tabel per Materi -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
                    <h2 class="font-extrabold text-gray-900 dark:text-white">Ringkasan Per Materi</h2>
                    <p class="text-xs text-gray-500 mt-0.5">Klik "Detail" untuk melihat nilai per siswa.</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-700 text-left">
                                <th class="px-5 py-3 font-bold text-gray-600 dark:text-gray-300">Materi</th>
                                <th class="px-4 py-3 font-bold text-gray-600 dark:text-gray-300 text-center">Kategori</th>
                                <th class="px-4 py-3 font-bold text-gray-600 dark:text-gray-300 text-center">Selesai</th>
                                <th class="px-4 py-3 font-bold text-amber-600 text-center">Avg. Pretest</th>
                                <th class="px-4 py-3 font-bold text-green-600 text-center">Avg. Posttest</th>
                                <th class="px-4 py-3 font-bold text-blue-600 text-center">Peningkatan</th>
                                <th class="px-4 py-3 font-bold text-red-500 text-center">Retry Posttest</th>
                                <th class="px-4 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse($materials as $material)
                                @php
                                    $completed  = $material->progress_count ?? 0;
                                    $preAvg     = $pretestAvgByMaterial[$material->id] ?? null;
                                    $postAvg    = $posttestAvgByMaterial[$material->id] ?? null;
                                    $delta      = ($preAvg !== null && $postAvg !== null) ? ($postAvg - $preAvg) : null;
                                    $retryCount = $posttestRetryByMaterial[$material->id] ?? 0;
                                @endphp
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                    <td class="px-5 py-4">
                                        <p class="font-bold text-gray-900 dark:text-white">{{ $material->title }}</p>
                                        @if($material->pertemuan_ke)
                                            <p class="text-xs text-gray-400 mt-0.5">Pertemuan {{ $material->pertemuan_ke }}</p>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <span class="text-base">{{ $material->category_icon }}</span>
                                        <span class="text-xs text-gray-500">{{ $material->category_label }}</span>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <span class="font-bold {{ $completed > 0 ? 'text-green-600' : 'text-gray-400' }}">
                                            {{ $completed }} / {{ $totalStudents }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        @if($preAvg !== null)
                                            <span class="font-bold text-amber-600">{{ $preAvg }}%</span>
                                        @else
                                            <span class="text-gray-400">—</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        @if($postAvg !== null)
                                            <span class="font-bold text-green-600">{{ $postAvg }}%</span>
                                        @else
                                            <span class="text-gray-400">—</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        @if($delta !== null)
                                            <span class="font-bold {{ $delta >= 0 ? 'text-green-600' : 'text-red-500' }}">
                                                {{ $delta >= 0 ? '+' : '' }}{{ $delta }}%
                                            </span>
                                        @else
                                            <span class="text-gray-400">—</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        @if($retryCount > 0)
                                            <span class="inline-flex items-center gap-1 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 font-bold text-xs px-2 py-1 rounded-lg">
                                                🔄 {{ $retryCount }} siswa
                                            </span>
                                        @else
                                            <span class="text-gray-400 text-xs">—</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-right">
                                        <a href="{{ route('teacher.reports.material', $material) }}"
                                           class="text-sm text-blue-600 hover:text-blue-800 font-bold">
                                            Detail →
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-12 text-gray-400">
                                        Belum ada materi aktif.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    @if(count($chartLabels) > 0)
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const isDark = document.documentElement.classList.contains('dark');
                const gridColor  = isDark ? 'rgba(255,255,255,0.08)' : 'rgba(0,0,0,0.06)';
                const labelColor = isDark ? '#9ca3af' : '#6b7280';

                const labels   = @json($chartLabels);
                const preData  = @json($chartPretest);
                const postData = @json($chartPosttest);

                // Truncate long labels
                const shortLabels = labels.map(l => l.length > 22 ? l.substring(0, 20) + '…' : l);

                const ctx = document.getElementById('reportChart').getContext('2d');
                const gradientPre = ctx.createLinearGradient(0, 0, 0, 400);
                gradientPre.addColorStop(0, 'rgba(245, 158, 11, 0.8)'); // Amber
                gradientPre.addColorStop(1, 'rgba(245, 158, 11, 0.2)');

                const gradientPost = ctx.createLinearGradient(0, 0, 0, 400);
                gradientPost.addColorStop(0, 'rgba(21, 128, 61, 0.8)'); // Green
                gradientPost.addColorStop(1, 'rgba(21, 128, 61, 0.2)');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: shortLabels,
                        datasets: [
                            {
                                label: 'Rata-rata Pretest',
                                data: preData,
                                backgroundColor: gradientPre,
                                borderColor: '#d97706',
                                borderWidth: 2,
                                borderRadius: 8,
                                borderSkipped: false,
                            },
                            {
                                label: 'Rata-rata Posttest',
                                data: postData,
                                backgroundColor: gradientPost,
                                borderColor: '#166534',
                                borderWidth: 2,
                                borderRadius: 8,
                                borderSkipped: false,
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: { mode: 'index', intersect: false },
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: { color: labelColor, font: { weight: 'bold' } },
                            },
                            tooltip: {
                                callbacks: {
                                    afterBody(context) {
                                        const i = context[0].dataIndex;
                                        const delta = postData[i] - preData[i];
                                        return delta >= 0
                                            ? [`📈 Peningkatan: +${delta.toFixed(0)}%`]
                                            : [`📉 Penurunan: ${delta.toFixed(0)}%`];
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                min: 0, max: 100,
                                grid: { color: gridColor },
                                ticks: {
                                    color: labelColor,
                                    callback: v => v + '%',
                                },
                            },
                            x: {
                                grid: { display: false },
                                ticks: { color: labelColor },
                            },
                        },
                    },
                });
            });
        </script>
    @endif
</x-app-layout>
