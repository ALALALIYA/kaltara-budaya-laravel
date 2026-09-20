<x-app-layout>
    <x-slot name="title">Hasil Posttest — {{ $material->title }}</x-slot>

    <div class="min-h-screen py-12" style="background: linear-gradient(135deg, #4c1d95 0%, #1e3a8a 50%, #064e3b 100%);">
        <div class="max-w-xl mx-auto px-4">

            @php $passed = $result->isPassed(); @endphp

            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl overflow-hidden">

                <!-- Score Header -->
                <div class="p-8 text-center {{ $passed ? 'bg-gradient-to-r from-green-500 to-emerald-600' : 'bg-gradient-to-r from-red-500 to-orange-500' }}">
                    @if($passed)
                        <div class="text-6xl mb-3 animate-bounce">🎉</div>
                    @else
                        <div class="text-6xl mb-3">😤</div>
                    @endif
                    <div class="text-7xl font-extrabold text-white mb-2">{{ $result->percentage }}%</div>
                    <div class="text-white/80 text-lg">{{ $result->score }} / {{ $result->total_questions }} benar</div>
                    <div class="mt-3 flex items-center justify-center gap-3 flex-wrap">
                        <span class="bg-white/20 text-white font-bold px-4 py-1.5 rounded-full text-sm">
                            {{ $passed ? '✅ LULUS' : '❌ BELUM LULUS' }} · Min. {{ $posttest->passing_score }}%
                        </span>
                        <span class="bg-white/20 text-white text-sm px-3 py-1.5 rounded-full">
                            Percobaan ke-{{ $attemptCount }}
                        </span>
                    </div>
                </div>

                <div class="p-8 space-y-6">

                    {{-- Pretest vs Posttest Comparison Card --}}
                    @if($pretestResult)
                        @php
                            $diff = $result->percentage - $pretestResult->percentage;
                        @endphp
                        <div class="rounded-2xl border-2 {{ $diff >= 0 ? 'border-green-300 dark:border-green-700 bg-green-50 dark:bg-green-900/20' : 'border-orange-300 dark:border-orange-700 bg-orange-50 dark:bg-orange-900/20' }} p-5">
                            <p class="font-bold text-gray-700 dark:text-gray-300 text-sm mb-3 flex items-center gap-2">
                                📊 Perbandingan Skor Kamu
                            </p>
                            <div class="flex items-center gap-3">
                                <div class="flex-1 text-center bg-white dark:bg-gray-700/60 rounded-xl p-3 shadow-sm">
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mb-1">Pretest</p>
                                    <p class="text-2xl font-extrabold text-blue-600 dark:text-blue-400">{{ $pretestResult->percentage }}%</p>
                                </div>
                                <div class="text-2xl font-extrabold {{ $diff >= 0 ? 'text-green-500' : 'text-red-500' }}">
                                    {{ $diff >= 0 ? '→' : '→' }}
                                </div>
                                <div class="flex-1 text-center bg-white dark:bg-gray-700/60 rounded-xl p-3 shadow-sm">
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mb-1">Posttest</p>
                                    <p class="text-2xl font-extrabold {{ $result->percentage >= $posttest->passing_score ? 'text-green-600 dark:text-green-400' : 'text-orange-500' }}">{{ $result->percentage }}%</p>
                                </div>
                            </div>
                            <p class="text-center mt-3 font-bold text-sm
                                {{ $diff > 0 ? 'text-green-600 dark:text-green-400' : ($diff === 0 ? 'text-gray-500' : 'text-orange-600 dark:text-orange-400') }}">
                                @if($diff > 0)
                                    🚀 Kamu meningkat {{ $diff }}% dari Pretest ke Posttest!
                                @elseif($diff === 0)
                                    Skor sama dengan Pretest — yuk tingkatkan lagi!
                                @else
                                    Posttest lebih rendah {{ abs($diff) }}% dari Pretest — baca ulang materinya!
                                @endif
                            </p>
                        </div>
                    @endif

                    {{-- AI Feedback Personal --}}
                    @if(!empty($result->ai_feedback) && env('AI_FEEDBACK_ENABLED', true))
                        <div class="rounded-2xl border border-indigo-200 dark:border-indigo-700 overflow-hidden">
                            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-4 py-2.5 flex items-center gap-2">
                                <span class="text-base">🤖</span>
                                <span class="text-white font-bold text-sm">Feedback Personal untuk Kamu</span>
                                <span class="ml-auto text-indigo-200 text-xs">Dibuat oleh AI</span>
                            </div>
                            <div class="bg-white dark:bg-gray-800 px-5 py-4">
                                <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-sm">{{ $result->ai_feedback }}</p>
                            </div>
                        </div>
                    @endif

                    @if($passed)
                        <div class="text-center">
                            <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-3">Selamat, Kamu Lulus! 🏆</h2>
                            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                                Kamu berhasil menyelesaikan materi <strong class="text-green-600">{{ $material->title }}</strong>
                                dan mendapatkan <strong class="text-yellow-600">+30 XP</strong>! Terus semangat belajar budaya Kaltara!
                            </p>
                        </div>

                        <div class="space-y-3">
                            <a href="{{ route('materials.show', $material->slug) }}"
                               class="block w-full text-center py-3.5 bg-green-600 hover:bg-green-500 text-white font-bold rounded-xl transition">
                                ← Kembali ke Materi
                            </a>
                            <a href="{{ route('materials.index') }}"
                               class="block w-full text-center py-3.5 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-semibold rounded-xl transition">
                                📚 Materi Lainnya
                            </a>
                        </div>

                    @else
                        <div class="text-center">
                            <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-3">Belum Lulus, Ayo Coba Lagi! 💪</h2>
                            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                                Kamu perlu <strong class="text-red-600">{{ $posttest->passing_score }}%</strong> untuk lulus,
                                tapi kamu baru dapat <strong class="text-orange-600">{{ $result->percentage }}%</strong>.
                                Baca ulang materinya dan coba lagi — kamu pasti bisa!
                            </p>
                        </div>

                        <div class="bg-orange-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-700 rounded-xl p-4">
                            <p class="text-orange-700 dark:text-orange-400 font-semibold text-sm">💡 Tips:</p>
                            <ul class="text-orange-600 dark:text-orange-500 text-sm mt-1 space-y-1">
                                <li>• Baca kembali bagian materi yang kamu rasa kurang paham</li>
                                <li>• Perhatikan video penjelasan jika ada</li>
                                <li>• Tidak ada batas percobaan — terus coba sampai lulus!</li>
                            </ul>
                        </div>

                        <div class="space-y-3">
                            <a href="{{ route('materials.show', $material->slug) }}"
                               class="block w-full text-center py-3.5 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl transition">
                                📖 Baca Ulang Materi
                            </a>
                            <a href="{{ route('materials.posttest', $material->slug) }}"
                               class="block w-full text-center py-3.5 bg-orange-500 hover:bg-orange-400 text-white font-bold rounded-xl transition shadow-lg shadow-orange-500/30">
                                🔄 Coba Posttest Lagi
                            </a>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
