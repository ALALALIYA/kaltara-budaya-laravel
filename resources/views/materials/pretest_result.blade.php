<x-app-layout>
    <x-slot name="title">Hasil Pretest — {{ $material->title }}</x-slot>

    <div class="min-h-screen py-12" style="background: linear-gradient(135deg, #1e3a5f 0%, #0f4c3a 50%, #2d1b4e 100%);">
        <div class="max-w-xl mx-auto px-4">

            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl overflow-hidden">

                <!-- Score Header -->
                <div class="bg-gradient-to-r from-amber-500 to-orange-600 p-8 text-center">
                    <div class="text-7xl font-extrabold text-white mb-2">{{ $result->percentage }}%</div>
                    <div class="text-white/80 text-lg">{{ $result->score }} / {{ $result->total_questions }} jawaban benar</div>
                    <div class="mt-3 inline-block bg-white/20 text-white font-bold px-4 py-1.5 rounded-full text-sm">
                        Grade: {{ $result->grade }}
                    </div>
                </div>

                <div class="p-8">
                    <div class="text-center mb-6">
                        <div class="text-5xl mb-3">📋</div>
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white mb-2">Pretest Selesai!</h2>
                        <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                            Ini adalah nilai awal kamu sebelum belajar. Jangan khawatir dengan hasilnya —
                            yang penting adalah kamu terus belajar dan berkembang! 💪
                        </p>
                    </div>

                    @if($result->percentage >= 70)
                        <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700 rounded-xl p-4 mb-6 text-center">
                            <p class="text-green-700 dark:text-green-400 font-bold">🌟 Wah, pengetahuan awalmu sudah bagus!</p>
                            <p class="text-green-600 dark:text-green-500 text-sm mt-1">Setelah baca materi, pasti makin jago!</p>
                        </div>
                    @else
                        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-xl p-4 mb-6 text-center">
                            <p class="text-blue-700 dark:text-blue-400 font-bold">📚 Siap belajar tentang budaya Kaltara?</p>
                            <p class="text-blue-600 dark:text-blue-500 text-sm mt-1">Materi ini akan membuat pengetahuanmu makin kaya!</p>
                        </div>
                    @endif

                    <a href="{{ route('materials.show', $material->slug) }}"
                       class="block w-full text-center py-4 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-500 hover:to-emerald-500 text-white font-extrabold rounded-xl shadow-lg shadow-green-700/30 transition text-lg">
                        📖 Mulai Baca Materi →
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
