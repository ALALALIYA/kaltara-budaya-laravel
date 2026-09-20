<x-app-layout>
    <x-slot name="title">Data Siswa</x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white">👥 Data Siswa</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1 text-sm">
                    Leaderboard siswa berdasarkan XP tertinggi. Total {{ $students->total() }} siswa terdaftar.
                </p>
            </div>

            @if($students->isEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-16 text-center">
                    <p class="text-6xl mb-4">👥</p>
                    <h2 class="font-bold text-gray-900 dark:text-white text-xl mb-2">Belum Ada Siswa</h2>
                    <p class="text-gray-500 dark:text-gray-400">Belum ada siswa yang mendaftar di platform ini.</p>
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                                <tr>
                                    <th class="text-center px-4 py-3.5 font-semibold text-gray-500 dark:text-gray-400 w-14">#</th>
                                    <th class="text-left px-4 py-3.5 font-semibold text-gray-500 dark:text-gray-400">Siswa</th>
                                    <th class="text-center px-4 py-3.5 font-semibold text-gray-500 dark:text-gray-400">XP</th>
                                    <th class="text-center px-4 py-3.5 font-semibold text-gray-500 dark:text-gray-400 hidden sm:table-cell">Streak</th>
                                    <th class="text-center px-4 py-3.5 font-semibold text-gray-500 dark:text-gray-400 hidden md:table-cell">
                                        Materi Selesai
                                    </th>
                                    <th class="text-center px-4 py-3.5 font-semibold text-gray-500 dark:text-gray-400 hidden md:table-cell">
                                        Quiz Dikerjakan
                                    </th>
                                    <th class="text-right px-4 py-3.5 font-semibold text-gray-500 dark:text-gray-400">Detail</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @foreach($students as $i => $student)
                                    @php $rank = ($students->currentPage() - 1) * $students->perPage() + $i + 1; @endphp
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                        <!-- Rank -->
                                        <td class="px-4 py-4 text-center">
                                            @if($rank === 1)
                                                <span class="text-2xl">🥇</span>
                                            @elseif($rank === 2)
                                                <span class="text-2xl">🥈</span>
                                            @elseif($rank === 3)
                                                <span class="text-2xl">🥉</span>
                                            @else
                                                <span class="text-gray-400 dark:text-gray-500 font-bold text-sm">{{ $rank }}</span>
                                            @endif
                                        </td>

                                        <!-- Nama -->
                                        <td class="px-4 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="shrink-0 w-9 h-9 rounded-full bg-gradient-to-br from-green-600 to-green-900 flex items-center justify-center text-white font-bold text-sm">
                                                    {{ strtoupper(substr($student->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $student->name }}</p>
                                                    <p class="text-gray-400 dark:text-gray-500 text-xs">{{ $student->email }}</p>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- XP -->
                                        <td class="px-4 py-4 text-center">
                                            <span class="font-extrabold text-yellow-500">⚡ {{ number_format($student->xp) }}</span>
                                        </td>

                                        <!-- Streak -->
                                        <td class="px-4 py-4 text-center hidden sm:table-cell">
                                            @if($student->streak > 0)
                                                <span class="text-orange-500 font-bold">🔥 {{ $student->streak }}</span>
                                            @else
                                                <span class="text-gray-300 dark:text-gray-600">—</span>
                                            @endif
                                        </td>

                                        <!-- Materi Selesai -->
                                        <td class="px-4 py-4 text-center hidden md:table-cell">
                                            <div class="flex items-center justify-center gap-1.5">
                                                <span class="font-bold text-gray-900 dark:text-white">{{ $student->completed_materials_count }}</span>
                                                <span class="text-gray-400 text-xs">/ {{ $totalMaterials }}</span>
                                            </div>
                                            <div class="mt-1 h-1.5 bg-gray-200 dark:bg-gray-600 rounded-full overflow-hidden w-16 mx-auto">
                                                <div class="h-full bg-green-500 rounded-full"
                                                     style="width: {{ $totalMaterials > 0 ? round(($student->completed_materials_count / $totalMaterials) * 100) : 0 }}%">
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Quiz Dikerjakan -->
                                        <td class="px-4 py-4 text-center hidden md:table-cell">
                                            <span class="font-bold text-gray-700 dark:text-gray-300">{{ $student->quiz_results_count }}</span>
                                        </td>

                                        <!-- Detail -->
                                        <td class="px-4 py-4 text-right">
                                            <a href="{{ route('teacher.students.show', $student->id) }}"
                                               class="text-green-600 hover:text-green-500 font-medium text-xs px-3 py-1.5 rounded-lg border border-green-200 dark:border-green-700 hover:bg-green-50 dark:hover:bg-green-900/20 transition">
                                                Lihat →
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($students->hasPages())
                        <div class="px-5 py-4 border-t border-gray-100 dark:border-gray-700">
                            {{ $students->links() }}
                        </div>
                    @endif
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
