<x-app-layout>
    <x-slot name="title">Game: Tebak Tarian</x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8" x-data="guessDanceGame()">

            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-2 bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-400 text-sm font-semibold px-4 py-2 rounded-full mb-4">
                    🎮 Mini Game 2
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white">Tebak Tarian Kaltara!</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Lihat gambar dan petunjuknya, lalu tebak dari suku mana tarian ini berasal.</p>
            </div>

            <!-- Progress bar soal -->
            <div class="mb-6" x-show="!isFinished">
                <div class="flex justify-between text-sm text-gray-500 dark:text-gray-400 mb-2">
                    <span x-text="`Soal ${current + 1} dari ${dances.length}`"></span>
                    <span x-text="`Skor: ${score}/${current + (answered ? 1 : 0)}`"></span>
                </div>
                <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                    <div class="h-full bg-blue-600 rounded-full transition-all duration-500"
                         :style="`width: ${((current + (answered ? 1 : 0)) / dances.length) * 100}%`"></div>
                </div>
            </div>

            <!-- LAYAR HASIL AKHIR -->
            <div x-show="isFinished"
                 x-transition:enter="transition ease-out duration-400"
                 x-transition:enter-start="opacity-0 scale-90"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-8 text-center">

                <p class="text-7xl mb-4" x-text="score === 5 ? '🏆' : (score >= 4 ? '🎉' : (score >= 3 ? '👍' : '💪'))"></p>
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-2">
                    <span x-text="`${score} / ${dances.length}`"></span>
                </h2>
                <p class="text-gray-500 dark:text-gray-400 text-lg mb-2"
                   x-text="score === 5 ? 'Luar biasa! Kamu maestro tarian Kaltara!' : (score >= 4 ? 'Hampir sempurna, kerja bagus!' : (score >= 3 ? 'Lumayan! Ayo belajar lebih banyak!' : 'Yuk baca materi dulu, lalu coba lagi!'))"
                ></p>
                <p class="text-sm font-semibold mb-8"
                   :class="score >= 4 ? 'text-green-600' : (score >= 3 ? 'text-yellow-600' : 'text-red-500')"
                   x-text="`${Math.round(score / dances.length * 100)}% benar`">
                </p>

                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <button @click="restart()"
                            class="bg-blue-600 hover:bg-blue-500 text-white font-bold px-6 py-3 rounded-xl transition">
                        🔄 Main Lagi
                    </button>
                    <a href="{{ route('games.matching') }}"
                       class="bg-green-700 hover:bg-green-600 text-white font-bold px-6 py-3 rounded-xl transition">
                        ← Game Cocokkan Motif
                    </a>
                    <a href="{{ route('dashboard') }}"
                       class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-semibold px-6 py-3 rounded-xl transition">
                        🏠 Dashboard
                    </a>
                </div>
            </div>

            <!-- KARTU SOAL -->
            <div x-show="!isFinished" class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">

                <!-- Gambar Tarian -->
                <div class="relative">
                    <img :src="currentDance.image"
                         :alt="currentDance.name"
                         class="w-full h-52 sm:h-64 object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex flex-col justify-end p-5">
                        <h2 class="text-white font-extrabold text-xl sm:text-2xl" x-text="currentDance.name"></h2>
                    </div>
                </div>

                <!-- Petunjuk -->
                <div class="px-5 py-4 bg-yellow-50 dark:bg-yellow-900/20 border-b border-yellow-200 dark:border-yellow-700">
                    <p class="text-yellow-800 dark:text-yellow-300 text-sm">
                        <strong>💡 Petunjuk:</strong>
                        <span x-text="currentDance.hint"></span>
                    </p>
                </div>

                <!-- Pilihan Jawaban -->
                <div class="p-5">
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-medium mb-4">Tarian ini berasal dari suku:</p>
                    <div class="grid grid-cols-2 gap-3">
                        <template x-for="option in currentDance.options" :key="option">
                            <button @click="!answered && choose(option)"
                                    :disabled="answered"
                                    :class="{
                                        'bg-green-600 border-green-600 text-white': answered && option === currentDance.answer,
                                        'bg-red-500 border-red-500 text-white': answered && option === selectedAnswer && option !== currentDance.answer,
                                        'opacity-50': answered && option !== currentDance.answer && option !== selectedAnswer,
                                        'hover:border-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 cursor-pointer': !answered,
                                        'cursor-default': answered,
                                    }"
                                    class="border-2 border-gray-200 dark:border-gray-600 rounded-xl py-3 px-4 font-bold text-gray-900 dark:text-white transition-all text-sm">
                                <span x-text="option"></span>
                            </button>
                        </template>
                    </div>

                    <!-- Penjelasan setelah jawab -->
                    <div x-show="answered"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="mt-4 p-4 rounded-xl"
                         :class="selectedAnswer === currentDance.answer
                                 ? 'bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700'
                                 : 'bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700'">
                        <p class="font-bold text-sm mb-1"
                           :class="selectedAnswer === currentDance.answer ? 'text-green-700 dark:text-green-400' : 'text-red-700 dark:text-red-400'"
                           x-text="selectedAnswer === currentDance.answer ? '✓ Jawaban Kamu Benar!' : '✗ Jawaban Kamu Salah'">
                        </p>
                        <p class="text-gray-600 dark:text-gray-300 text-sm" x-text="currentDance.explanation"></p>
                    </div>

                    <!-- Tombol Lanjut -->
                    <div x-show="answered" class="mt-4">
                        <button @click="next()"
                                class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 rounded-xl transition text-sm"
                                x-text="current < dances.length - 1 ? 'Soal Berikutnya →' : '🏁 Lihat Hasil Akhir'">
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function guessDanceGame() {
            const allDances = @json($dances);
            return {
                dances:         allDances,
                current:        0,
                answered:       false,
                selectedAnswer: null,
                score:          0,
                isFinished:     false,

                get currentDance() { return this.dances[this.current]; },

                choose(answer) {
                    if (this.answered) return;
                    this.answered       = true;
                    this.selectedAnswer = answer;
                    if (answer === this.currentDance.answer) this.score++;
                },

                next() {
                    if (this.current < this.dances.length - 1) {
                        this.current++;
                        this.answered       = false;
                        this.selectedAnswer = null;
                    } else {
                        this.isFinished = true;
                    }
                },

                restart() {
                    this.current        = 0;
                    this.answered       = false;
                    this.selectedAnswer = null;
                    this.score          = 0;
                    this.isFinished     = false;
                }
            };
        }
    </script>
</x-app-layout>
