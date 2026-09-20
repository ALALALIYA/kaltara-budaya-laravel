<x-app-layout>
    <x-slot name="title">Game: Cocokkan Motif</x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8" x-data="matchingGame()">

            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-2 bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-400 text-sm font-semibold px-4 py-2 rounded-full mb-4">
                    🎮 Mini Game 1
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white">Cocokkan Motif Kaltara!</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Klik sebuah motif, lalu klik suku yang tepat untuk mencocokkannya.</p>
            </div>

            <!-- Selesai / Skor -->
            <div x-show="isCompleted"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-8 text-center mb-8">
                <p class="text-7xl mb-4" x-text="score === 4 ? '🏆' : (score >= 3 ? '🎉' : (score >= 2 ? '👍' : '💪'))"></p>
                <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-2">
                    <span x-text="`Kamu benar ${score} dari 4!`"></span>
                </h2>
                <p class="text-gray-500 dark:text-gray-400 mb-2"
                   x-text="score === 4 ? 'Sempurna! Kamu menguasai motif Kaltara!' : (score >= 3 ? 'Hampir sempurna, bagus sekali!' : 'Latihan lagi yuk, kamu pasti bisa!')">
                </p>
                <div class="flex gap-4 justify-center mt-6">
                    <button @click="reset()"
                            class="bg-green-700 hover:bg-green-600 text-white font-bold px-6 py-3 rounded-xl transition">
                        🔄 Main Lagi
                    </button>
                    <a href="{{ route('games.guess-dance') }}"
                       class="bg-blue-600 hover:bg-blue-500 text-white font-bold px-6 py-3 rounded-xl transition">
                        🎭 Game Berikutnya →
                    </a>
                </div>
            </div>

            <!-- Instruksi -->
            <div x-show="!isCompleted" class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700 rounded-xl p-4 mb-6 text-sm text-yellow-800 dark:text-yellow-300">
                <strong>Cara Main:</strong> Klik motif di kiri → klik nama suku di kanan untuk memasangkan. Semua motif harus dipasangkan!
            </div>

            <!-- Area Game -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Kolom Motif -->
                <div>
                    <h2 class="font-bold text-gray-500 dark:text-gray-400 text-xs uppercase tracking-widest mb-4">Pilih Motif</h2>
                    <div class="space-y-3">
                        <template x-for="motif in motifs" :key="motif.id">
                            <div @click="!matches[motif.id] && selectMotif(motif.id)"
                                 :class="{
                                     'ring-2 ring-yellow-400 shadow-lg -translate-y-0.5 bg-yellow-50 dark:bg-yellow-900/20': selectedMotif === motif.id,
                                     'border-green-400 bg-green-50 dark:bg-green-900/20': matches[motif.id] && matches[motif.id].correct,
                                     'border-red-400 bg-red-50 dark:bg-red-900/20': matches[motif.id] && !matches[motif.id].correct,
                                     'cursor-pointer hover:shadow-md hover:-translate-y-0.5 hover:border-gray-400': !matches[motif.id],
                                     'cursor-default opacity-80': matches[motif.id],
                                 }"
                                 class="flex items-center gap-4 bg-white dark:bg-gray-800 rounded-xl border-2 border-gray-200 dark:border-gray-700 p-4 transition-all duration-150">
                                <img :src="motif.image" :alt="motif.name"
                                     class="w-16 h-16 rounded-lg object-cover shrink-0 bg-gray-200">
                                <div class="flex-1 min-w-0">
                                    <p class="font-bold text-gray-900 dark:text-white text-sm" x-text="motif.name"></p>
                                    <p class="text-gray-400 dark:text-gray-500 text-xs mt-0.5 line-clamp-2" x-text="motif.description"></p>
                                </div>
                                <!-- Hasil match -->
                                <template x-if="matches[motif.id]">
                                    <div class="shrink-0 flex flex-col items-center gap-1">
                                        <span :class="matches[motif.id].correct ? 'text-green-600 text-xl' : 'text-red-500 text-xl'"
                                              x-text="matches[motif.id].correct ? '✓' : '✗'"></span>
                                        <span class="text-xs font-bold text-gray-500" x-text="matches[motif.id].suku"></span>
                                    </div>
                                </template>
                                <template x-if="!matches[motif.id]">
                                    <span :class="selectedMotif === motif.id ? 'text-yellow-500' : 'text-gray-300 dark:text-gray-600'"
                                          class="shrink-0 text-lg transition-colors">→</span>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Kolom Suku -->
                <div>
                    <h2 class="font-bold text-gray-500 dark:text-gray-400 text-xs uppercase tracking-widest mb-4">Pilih Suku</h2>
                    <div class="space-y-3">
                        <template x-for="suku in sukuOptions" :key="suku">
                            <button @click="selectSuku(suku)"
                                    :disabled="isSukuUsed(suku) || !selectedMotif"
                                    :class="{
                                        'opacity-40 cursor-not-allowed': isSukuUsed(suku),
                                        'ring-2 ring-yellow-400 scale-105': selectedMotif && !isSukuUsed(suku),
                                        'hover:shadow-md hover:-translate-y-0.5 cursor-pointer': selectedMotif && !isSukuUsed(suku),
                                        'cursor-default': !selectedMotif && !isSukuUsed(suku),
                                    }"
                                    class="w-full bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 rounded-xl px-6 py-5 font-bold text-gray-900 dark:text-white text-lg text-center transition-all duration-150">
                                <span x-text="suku"></span>
                            </button>
                        </template>
                    </div>

                    <!-- Instruksi kontekstual -->
                    <div class="mt-4 p-4 rounded-xl bg-gray-50 dark:bg-gray-700/50 text-center">
                        <p class="text-sm text-gray-500 dark:text-gray-400"
                           x-text="selectedMotif ? '✨ Sekarang pilih suku yang tepat!' : '👆 Pilih dulu motif di sebelah kiri'">
                        </p>
                    </div>
                </div>
            </div>

            <!-- Feedback Toast -->
            <div x-show="feedback"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-4"
                 :class="feedback && feedback.correct ? 'bg-green-600' : 'bg-red-600'"
                 class="fixed bottom-6 left-1/2 -translate-x-1/2 text-white font-bold px-6 py-4 rounded-xl shadow-2xl text-sm max-w-sm w-full text-center z-50">
                <p x-text="feedback && feedback.message"></p>
            </div>

        </div>
    </div>

    <script>
        function matchingGame() {
            return {
                motifs:      @json($motifs),
                sukuOptions: @json($sukuOptions),
                selectedMotif: null,
                matches: {},
                feedback: null,
                _feedbackTimer: null,

                get isCompleted() {
                    return Object.keys(this.matches).length === this.motifs.length;
                },
                get score() {
                    return Object.values(this.matches).filter(m => m.correct).length;
                },

                selectMotif(id) {
                    if (this.matches[id]) return;
                    this.selectedMotif = (this.selectedMotif === id) ? null : id;
                },

                selectSuku(suku) {
                    if (!this.selectedMotif || this.isSukuUsed(suku)) return;
                    const motif   = this.motifs.find(m => m.id === this.selectedMotif);
                    const correct = motif.suku === suku;
                    this.matches  = { ...this.matches, [this.selectedMotif]: { suku, correct } };
                    this.showFeedback({
                        correct,
                        message: correct
                            ? `✓ Tepat! ${motif.name} memang dari Suku ${suku}.`
                            : `✗ Salah! ${motif.name} berasal dari Suku ${motif.suku}.`
                    });
                    this.selectedMotif = null;
                },

                isSukuUsed(suku) {
                    return Object.values(this.matches).some(m => m.suku === suku);
                },

                showFeedback(fb) {
                    this.feedback = fb;
                    clearTimeout(this._feedbackTimer);
                    this._feedbackTimer = setTimeout(() => { this.feedback = null; }, 2800);
                },

                reset() {
                    this.matches      = {};
                    this.selectedMotif = null;
                    this.feedback     = null;
                    this.sukuOptions  = [...this.sukuOptions].sort(() => Math.random() - 0.5);
                }
            };
        }
    </script>
</x-app-layout>
