<x-app-layout>
    <x-slot name="title">Materi Budaya</x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white">📖 Materi Budaya Kaltara</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Pilih materi berdasarkan suku, lalu baca dan dapatkan +30 XP!</p>
            </div>

            @php
                $tribes = [
                    'dayak'  => ['label' => 'Dayak',  'emoji' => '🦅', 'color' => 'bg-green-700',  'light' => 'bg-green-50 dark:bg-green-900/20', 'border' => 'border-green-200 dark:border-green-800', 'heading' => 'text-green-800 dark:text-green-300'],
                    'banjar' => ['label' => 'Banjar', 'emoji' => '🎋', 'color' => 'bg-amber-600',   'light' => 'bg-amber-50 dark:bg-amber-900/20',  'border' => 'border-amber-200 dark:border-amber-800',  'heading' => 'text-amber-800 dark:text-amber-300'],
                    'kutai'  => ['label' => 'Kutai',  'emoji' => '🐉', 'color' => 'bg-red-700',     'light' => 'bg-red-50 dark:bg-red-900/20',      'border' => 'border-red-200 dark:border-red-800',      'heading' => 'text-red-800 dark:text-red-300'],
                    'tidung' => ['label' => 'Tidung', 'emoji' => '🌊', 'color' => 'bg-blue-700',    'light' => 'bg-blue-50 dark:bg-blue-900/20',    'border' => 'border-blue-200 dark:border-blue-800',    'heading' => 'text-blue-800 dark:text-blue-300'],
                ];
                $byCategory = $materials->groupBy('category');
                $uncategorized = $byCategory->get('', collect())->merge($byCategory->get(null, collect()));
            @endphp

            <div x-data="{ viewMode: 'suku', active: 'semua' }" class="space-y-8">

                <!-- View Mode Toggle -->
                <div class="flex items-center gap-2 bg-white dark:bg-gray-800 p-1.5 rounded-2xl w-fit shadow-sm border border-gray-200 dark:border-gray-700">
                    <button @click="viewMode = 'suku'; active = 'semua'" 
                            :class="viewMode === 'suku' ? 'bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300 font-bold' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                            class="px-5 py-2 rounded-xl text-sm transition-colors focus:outline-none">
                        🎭 Berdasarkan Suku
                    </button>
                    <button @click="viewMode = 'pertemuan'; active = 'semua'" 
                            :class="viewMode === 'pertemuan' ? 'bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300 font-bold' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200'"
                            class="px-5 py-2 rounded-xl text-sm transition-colors focus:outline-none">
                        📅 Berdasarkan Pertemuan
                    </button>
                </div>

                <!-- Search Bar -->
                <form action="{{ route('materials.index') }}" method="GET" class="relative max-w-lg">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari judul materi atau topik..." 
                           class="block w-full pl-10 pr-3 py-3 border border-gray-200 dark:border-gray-700 rounded-2xl leading-5 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 sm:text-sm shadow-sm transition-all">
                    @if(!empty($search))
                        <a href="{{ route('materials.index') }}" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </a>
                    @endif
                </form>

                <!-- Filter Buttons -->
                <div class="flex flex-wrap gap-2">
                    @php
                        $filters = [
                            'semua'  => ['label' => 'Semua',  'emoji' => '🗺️',  'color' => 'bg-gray-900 text-white'],
                            'dayak'  => ['label' => 'Dayak',  'emoji' => '🦅', 'color' => 'bg-green-700 text-white'],
                            'banjar' => ['label' => 'Banjar', 'emoji' => '🎋', 'color' => 'bg-amber-600 text-white'],
                            'kutai'  => ['label' => 'Kutai',  'emoji' => '🐉', 'color' => 'bg-red-700 text-white'],
                            'tidung' => ['label' => 'Tidung', 'emoji' => '🌊', 'color' => 'bg-blue-700 text-white'],
                        ];
                    @endphp
                    @foreach($filters as $key => $f)
                        @php
                            $count = $key === 'semua'
                                ? $materials->count()
                                : $materials->where('category', $key)->count();
                        @endphp
                        <button @click="active = '{{ $key }}'"
                                :class="active === '{{ $key }}' ? '{{ $f['color'] }} shadow-md scale-105' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-600 hover:border-gray-400'"
                                class="flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-semibold transition-all">
                            <span>{{ $f['emoji'] }}</span>
                            <span>{{ $f['label'] }}</span>
                            <span class="text-xs opacity-70">({{ $count }})</span>
                        </button>
                    @endforeach
                </div>

                <!-- Empty State Search -->
                @if($materials->isEmpty())
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-12 text-center">
                        <div class="text-6xl mb-4">🔍</div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Tidak Ada Materi Ditemukan</h3>
                        <p class="text-gray-500 dark:text-gray-400 mt-2">Coba gunakan kata kunci lain atau hapus filter pencarian.</p>
                        @if(!empty($search))
                            <a href="{{ route('materials.index') }}" class="mt-4 inline-block bg-green-600 text-white font-semibold px-6 py-2 rounded-full hover:bg-green-700">Tampilkan Semua Materi</a>
                        @endif
                    </div>
                @endif

                {{-- Container Mode Suku --}}
                <div x-show="viewMode === 'suku'">
                    {{-- "Semua" view: grouped by tribe with section headers --}}
                <div x-show="active === 'semua'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                    @if($materials->isEmpty())
                        <div class="text-center py-16 text-gray-400">
                            <p class="text-5xl mb-4">📚</p>
                            <p class="text-lg font-medium">Belum ada materi tersedia.</p>
                        </div>
                    @else
                        @foreach($tribes as $tribeKey => $tribe)
                            @php $tribeItems = $byCategory->get($tribeKey, collect()); @endphp
                            @if($tribeItems->isNotEmpty())
                                <div class="mb-8">
                                    <!-- Section Header -->
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="{{ $tribe['color'] }} text-white text-2xl w-10 h-10 rounded-xl flex items-center justify-center shadow-sm">
                                            {{ $tribe['emoji'] }}
                                        </div>
                                        <div>
                                            <h2 class="text-lg font-extrabold {{ $tribe['heading'] }}">Suku {{ $tribe['label'] }}</h2>
                                            <p class="text-xs text-gray-400 dark:text-gray-500">{{ $tribeItems->count() }} materi tersedia</p>
                                        </div>
                                        <div class="flex-1 h-px {{ $tribe['border'] }} border-t ml-2"></div>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                                        @foreach($tribeItems as $material)
                                            @php $isCompleted = isset($progressMap[$material->id]) && $progressMap[$material->id]; @endphp
                                            <a href="{{ route('materials.show', $material->slug) }}"
                                               class="group block bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all h-full">
                                                <div class="relative h-36
                                                    {{ $material->category === 'dayak'  ? 'bg-gradient-to-br from-green-600 to-green-900' :
                                                       ($material->category === 'banjar' ? 'bg-gradient-to-br from-amber-500 to-amber-900' :
                                                       ($material->category === 'kutai'  ? 'bg-gradient-to-br from-red-600 to-red-900' :
                                                                                            'bg-gradient-to-br from-blue-600 to-blue-900')) }}
                                                    flex items-end justify-center pb-0">
                                                    @if($material->image && str_starts_with($material->image, 'http'))
                                                        <img src="{{ $material->image }}" alt="{{ $material->title }}" loading="lazy" class="w-full h-full object-cover absolute inset-0 mix-blend-overlay opacity-50">
                                                    @elseif($material->image)
                                                        <img src="{{ asset('storage/' . $material->image) }}" alt="{{ $material->title }}" loading="lazy" class="w-full h-full object-cover absolute inset-0">
                                                    @endif
                                                    <span class="relative text-5xl z-10 drop-shadow-lg self-end mb-2">{{ $tribe['emoji'] }}</span>
                                                    @if($isCompleted)
                                                        <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-0.5 rounded-full z-20">✓ Selesai</span>
                                                    @endif
                                                </div>
                                                <div class="p-4">
                                                    <h3 class="font-bold text-gray-900 dark:text-white leading-tight group-hover:text-green-600 transition-colors">
                                                        {{ $material->title }}
                                                    </h3>
                                                    <p class="text-gray-500 dark:text-gray-400 text-xs mt-2 line-clamp-2">{{ $material->description }}</p>
                                                    <div class="mt-3 flex items-center justify-between text-xs">
                                                        <span class="text-green-600 font-semibold">+30 XP</span>
                                                        @if($isCompleted)
                                                            <span class="text-green-600 font-medium">Sudah dibaca ✓</span>
                                                        @else
                                                            <span class="text-gray-400">Belum dibaca</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach

                        {{-- Uncategorized materials --}}
                        @if($uncategorized->isNotEmpty())
                            <div class="mb-8">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="bg-gray-700 text-white text-2xl w-10 h-10 rounded-xl flex items-center justify-center shadow-sm">🗂️</div>
                                    <div>
                                        <h2 class="text-lg font-extrabold text-gray-700 dark:text-gray-300">Materi Umum</h2>
                                        <p class="text-xs text-gray-400">{{ $uncategorized->count() }} materi tersedia</p>
                                    </div>
                                    <div class="flex-1 h-px border-t border-gray-200 dark:border-gray-600 ml-2"></div>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                                    @foreach($uncategorized as $material)
                                        @php $isCompleted = isset($progressMap[$material->id]) && $progressMap[$material->id]; @endphp
                                        <a href="{{ route('materials.show', $material->slug) }}"
                                           class="group block bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all h-full">
                                            <div class="relative h-36 bg-gradient-to-br from-purple-600 to-purple-900 flex items-end justify-center pb-0">
                                                @if($material->image && str_starts_with($material->image, 'http'))
                                                    <img src="{{ $material->image }}" alt="{{ $material->title }}" loading="lazy" class="w-full h-full object-cover absolute inset-0 mix-blend-overlay opacity-50">
                                                @elseif($material->image)
                                                    <img src="{{ asset('storage/' . $material->image) }}" alt="{{ $material->title }}" loading="lazy" class="w-full h-full object-cover absolute inset-0">
                                                @endif
                                                <span class="relative text-5xl z-10 drop-shadow-lg self-end mb-2">🗂️</span>
                                                @if($isCompleted)
                                                    <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-0.5 rounded-full z-20">✓ Selesai</span>
                                                @endif
                                            </div>
                                            <div class="p-4">
                                                <h3 class="font-bold text-gray-900 dark:text-white leading-tight group-hover:text-green-600 transition-colors">{{ $material->title }}</h3>
                                                <p class="text-gray-500 dark:text-gray-400 text-xs mt-2 line-clamp-2">{{ $material->description }}</p>
                                                <div class="mt-3 flex items-center justify-between text-xs">
                                                    <span class="text-green-600 font-semibold">+30 XP</span>
                                                    @if($isCompleted)
                                                        <span class="text-green-600 font-medium">Sudah dibaca ✓</span>
                                                    @else
                                                        <span class="text-gray-400">Belum dibaca</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endif
                </div>

                {{-- Per-tribe filtered views --}}
                @foreach($tribes as $tribeKey => $tribe)
                    <div x-show="active === '{{ $tribeKey }}'"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0">
                        @php $tribeItems = $byCategory->get($tribeKey, collect()); @endphp
                        @if($tribeItems->isNotEmpty())
                            <div class="{{ $tribe['light'] }} border {{ $tribe['border'] }} rounded-2xl p-6 mb-4">
                                <div class="flex items-center gap-3 mb-1">
                                    <span class="text-3xl">{{ $tribe['emoji'] }}</span>
                                    <div>
                                        <h2 class="text-xl font-extrabold {{ $tribe['heading'] }}">Suku {{ $tribe['label'] }}</h2>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $tribeItems->count() }} materi · klik kartu untuk mulai belajar</p>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                                @foreach($tribeItems as $material)
                                    @php $isCompleted = isset($progressMap[$material->id]) && $progressMap[$material->id]; @endphp
                                    <a href="{{ route('materials.show', $material->slug) }}"
                                       class="group block bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all h-full">
                                        <div class="relative h-36
                                            {{ $material->category === 'dayak'  ? 'bg-gradient-to-br from-green-600 to-green-900' :
                                               ($material->category === 'banjar' ? 'bg-gradient-to-br from-amber-500 to-amber-900' :
                                               ($material->category === 'kutai'  ? 'bg-gradient-to-br from-red-600 to-red-900' :
                                                                                    'bg-gradient-to-br from-blue-600 to-blue-900')) }}
                                            flex items-end justify-center pb-0">
                                            @if($material->image && str_starts_with($material->image, 'http'))
                                                <img src="{{ $material->image }}" alt="{{ $material->title }}" class="w-full h-full object-cover absolute inset-0 mix-blend-overlay opacity-50">
                                            @elseif($material->image)
                                                <img src="{{ asset('storage/' . $material->image) }}" alt="{{ $material->title }}" class="w-full h-full object-cover absolute inset-0">
                                            @endif
                                            <span class="relative text-5xl z-10 drop-shadow-lg self-end mb-2">{{ $tribe['emoji'] }}</span>
                                            @if($isCompleted)
                                                <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-0.5 rounded-full z-20">✓ Selesai</span>
                                            @endif
                                        </div>
                                        <div class="p-4">
                                            <span class="inline-block text-xs font-bold {{ $material->category_color }} uppercase mb-2">{{ $material->category_label }}</span>
                                            <h3 class="font-bold text-gray-900 dark:text-white leading-tight group-hover:text-green-600 transition-colors">
                                                {{ $material->title }}
                                            </h3>
                                            <p class="text-gray-500 dark:text-gray-400 text-xs mt-2 line-clamp-2">{{ $material->description }}</p>
                                            <div class="mt-3 flex items-center justify-between text-xs">
                                                <span class="text-green-600 font-semibold">+30 XP</span>
                                                @if($isCompleted)
                                                    <span class="text-green-600 font-medium">Sudah dibaca ✓</span>
                                                @else
                                                    <span class="text-gray-400">Belum dibaca</span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-16 text-gray-400">
                                <p class="text-5xl mb-4">{{ $tribe['emoji'] }}</p>
                                <p class="text-lg font-medium text-gray-500 dark:text-gray-400">Materi Suku {{ $tribe['label'] }} belum tersedia.</p>
                                <p class="text-sm mt-1 text-gray-400">Guru sedang menyiapkan materi ini untuk kamu!</p>
                            </div>
                        @endif
                    </div>
                @endforeach

            </div>

                {{-- Container Mode Pertemuan --}}
                <div x-show="viewMode === 'pertemuan'" style="display: none;">
                    @if($materials->isEmpty())
                        <div class="text-center py-16 text-gray-400">
                            <p class="text-5xl mb-4">📅</p>
                            <p class="text-lg font-medium">Belum ada materi tersedia.</p>
                        </div>
                    @else
                        @foreach($byPertemuan as $pertemuan_ke => $items)
                            <div class="mb-8">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="bg-indigo-600 text-white text-2xl w-10 h-10 rounded-xl flex items-center justify-center shadow-sm">
                                        📅
                                    </div>
                                    <div>
                                        <h2 class="text-lg font-extrabold text-indigo-800 dark:text-indigo-300">
                                            {{ empty($pertemuan_ke) ? 'Materi Umum' : 'Pertemuan ' . $pertemuan_ke }}
                                        </h2>
                                        <p class="text-xs text-gray-400 dark:text-gray-500">{{ $items->count() }} materi tersedia</p>
                                    </div>
                                    <div class="flex-1 h-px border-t border-indigo-200 dark:border-indigo-800 ml-2"></div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                                    @foreach($items as $material)
                                        @php 
                                            $isCompleted = isset($progressMap[$material->id]) && $progressMap[$material->id]; 
                                            $tribe = $tribes[$material->category] ?? ['emoji' => '🗂️', 'label' => 'Umum'];
                                        @endphp
                                        <a href="{{ route('materials.show', $material->slug) }}"
                                           class="group block bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all h-full">
                                            <div class="relative h-36
                                                {{ $material->category === 'dayak'  ? 'bg-gradient-to-br from-green-600 to-green-900' :
                                                   ($material->category === 'banjar' ? 'bg-gradient-to-br from-amber-500 to-amber-900' :
                                                   ($material->category === 'kutai'  ? 'bg-gradient-to-br from-red-600 to-red-900' :
                                                   ($material->category === 'tidung' ? 'bg-gradient-to-br from-blue-600 to-blue-900' : 'bg-gradient-to-br from-purple-600 to-purple-900'))) }}
                                                flex items-end justify-center pb-0">
                                                @if($material->image && str_starts_with($material->image, 'http'))
                                                    <img src="{{ $material->image }}" alt="{{ $material->title }}" loading="lazy" class="w-full h-full object-cover absolute inset-0 mix-blend-overlay opacity-50">
                                                @elseif($material->image)
                                                    <img src="{{ asset('storage/' . $material->image) }}" alt="{{ $material->title }}" loading="lazy" class="w-full h-full object-cover absolute inset-0">
                                                @endif
                                                <span class="relative text-5xl z-10 drop-shadow-lg self-end mb-2">{{ $tribe['emoji'] }}</span>
                                                @if($isCompleted)
                                                    <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-0.5 rounded-full z-20">✓ Selesai</span>
                                                @endif
                                            </div>
                                            <div class="p-4">
                                                <span class="inline-block text-xs font-bold {{ $material->category_color ?? 'text-gray-500' }} uppercase mb-2">{{ $material->category_label ?? 'Umum' }}</span>
                                                <h3 class="font-bold text-gray-900 dark:text-white leading-tight group-hover:text-green-600 transition-colors">{{ $material->title }}</h3>
                                                <p class="text-gray-500 dark:text-gray-400 text-xs mt-2 line-clamp-2">{{ $material->description }}</p>
                                                <div class="mt-3 flex items-center justify-between text-xs">
                                                    <span class="text-green-600 font-semibold">+30 XP</span>
                                                    @if($isCompleted)
                                                        <span class="text-green-600 font-medium">Sudah dibaca ✓</span>
                                                    @else
                                                        <span class="text-gray-400">Belum dibaca</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
