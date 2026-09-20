<x-app-layout>
    <x-slot name="title">Admin Dashboard</x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white">🛡️ Admin Dashboard</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Kelola dan moderasi konten platform Kaltara Budaya</p>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
                <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700 rounded-2xl p-5 text-center">
                    <div class="text-3xl font-extrabold text-yellow-700 dark:text-yellow-400">{{ $pendingMaterials->count() }}</div>
                    <div class="text-xs text-yellow-600 dark:text-yellow-500 mt-1 font-medium">Menunggu Review</div>
                </div>
                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700 rounded-2xl p-5 text-center">
                    <div class="text-3xl font-extrabold text-green-700 dark:text-green-400">{{ $totalApproved }}</div>
                    <div class="text-xs text-green-600 dark:text-green-500 mt-1 font-medium">Materi Aktif</div>
                </div>
                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-2xl p-5 text-center">
                    <div class="text-3xl font-extrabold text-blue-700 dark:text-blue-400">{{ $totalStudents }}</div>
                    <div class="text-xs text-blue-600 dark:text-blue-500 mt-1 font-medium">Siswa</div>
                </div>
                <div class="bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-700 rounded-2xl p-5 text-center">
                    <div class="text-3xl font-extrabold text-purple-700 dark:text-purple-400">{{ $totalTeachers }}</div>
                    <div class="text-xs text-purple-600 dark:text-purple-500 mt-1 font-medium">Guru</div>
                </div>
                <div class="bg-orange-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-700 rounded-2xl p-5 text-center">
                    <div class="text-3xl font-extrabold text-orange-700 dark:text-orange-400">{{ $totalQuizzes }}</div>
                    <div class="text-xs text-orange-600 dark:text-orange-500 mt-1 font-medium">Total Quiz/Ujian</div>
                </div>
            </div>

            <!-- Pending Materials -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                    <h2 class="font-bold text-gray-900 dark:text-white">⏳ Materi Menunggu Persetujuan</h2>
                    <a href="{{ route('admin.materials.index') }}" class="text-sm text-orange-600 hover:text-orange-700 font-medium">Lihat Semua →</a>
                </div>

                @if($pendingMaterials->isEmpty())
                    <div class="p-12 text-center">
                        <div class="text-5xl mb-3">✅</div>
                        <p class="text-gray-500 dark:text-gray-400 font-medium">Tidak ada materi yang menunggu persetujuan</p>
                    </div>
                @else
                    <div class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach($pendingMaterials as $material)
                            <div class="p-5 flex items-start gap-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                <div class="shrink-0 w-12 h-12 rounded-xl overflow-hidden bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-2xl">
                                    {{ $material->category_icon }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-gray-900 dark:text-white truncate">{{ $material->title }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">
                                        oleh {{ $material->teacher->name }} ·
                                        {{ $material->created_at->diffForHumans() }}
                                        @if($material->category)
                                            · <span class="text-xs font-medium {{ $material->category_color }} px-2 py-0.5 rounded-full">{{ $material->category_label }}</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="flex items-center gap-2 shrink-0">
                                    <a href="{{ route('admin.materials.show', $material->id) }}"
                                       class="text-xs px-3 py-1.5 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 font-medium transition">
                                        Preview
                                    </a>
                                    <form method="POST" action="{{ route('admin.materials.approve', $material->id) }}">
                                        @csrf @method('PATCH')
                                        <button class="text-xs px-3 py-1.5 bg-green-600 text-white rounded-lg hover:bg-green-700 font-bold transition">
                                            ✓ Setujui
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.materials.reject', $material->id) }}">
                                        @csrf @method('PATCH')
                                        <button class="text-xs px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 font-bold transition">
                                            ✕ Tolak
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
