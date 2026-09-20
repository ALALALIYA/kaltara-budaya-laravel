<x-app-layout>
    <x-slot name="title">Edit: {{ $material->title }}</x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <nav class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-6">
                <a href="{{ route('teacher.materials.index') }}" class="hover:text-orange-500">Materi Saya</a>
                <span>/</span>
                <a href="{{ route('teacher.materials.show', $material->id) }}" class="hover:text-orange-500 truncate max-w-[200px]">{{ $material->title }}</a>
                <span>/</span>
                <span class="text-gray-700 dark:text-gray-300 font-medium">Edit</span>
            </nav>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="px-8 py-6 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-orange-50 to-amber-50 dark:from-gray-800 dark:to-gray-800 rounded-t-2xl">
                    <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white">✏️ Edit Materi</h1>
                    <p class="text-sm text-gray-500 mt-1">
                        Status saat ini:
                        <span class="font-bold px-2 py-0.5 rounded-full text-xs {{ $material->status_color }}">{{ $material->status_label }}</span>
                        — Perubahan akan mereset ke Pending untuk review ulang.
                    </p>
                </div>

                <form method="POST" action="{{ route('teacher.materials.update', $material->id) }}"
                    enctype="multipart/form-data"
                    x-data="{
                        imagePreview: null,
                        coverCropper: null,
                        handleImage(e) {
                            const file = e.target.files[0];
                            if (!file) return;
                            const reader = new FileReader();
                            reader.onload = ev => {
                                this.openCoverCropModal(ev.target.result);
                            };
                            reader.readAsDataURL(file);
                        },
                        openCoverCropModal(src) {
                            document.getElementById('coverCropModal').classList.remove('hidden');
                            let img = document.getElementById('cover-cropper-image');
                            img.src = src;
                            if (this.coverCropper) {
                                this.coverCropper.destroy();
                            }
                            this.coverCropper = new Cropper(img, {
                                aspectRatio: 896 / 176, // Sesuaikan dengan ukuran header h-44 di max-w-4xl
                                viewMode: 2,
                                autoCropArea: 1,
                            });
                        },
                        saveCoverCrop() {
                            if (!this.coverCropper) return;
                            let canvas = this.coverCropper.getCroppedCanvas();
                            if (!canvas) return;
                            this.imagePreview = canvas.toDataURL('image/jpeg');
                            
                            canvas.toBlob((blob) => {
                                let file = new File([blob], 'cover.jpg', { type: 'image/jpeg' });
                                let dt = new DataTransfer();
                                dt.items.add(file);
                                document.getElementById('image').files = dt.files;
                            }, 'image/jpeg');
                            
                            this.closeCoverCrop(false);
                        },
                        closeCoverCrop(clearInput = true) {
                            document.getElementById('coverCropModal').classList.add('hidden');
                            if (this.coverCropper) {
                                this.coverCropper.destroy();
                                this.coverCropper = null;
                            }
                            if (clearInput && !this.imagePreview) {
                                document.getElementById('image').value = '';
                            }
                        }
                    }">
                    @csrf
                    @method('PUT')

                    <div class="p-8 space-y-8">

                        <!-- Judul -->
                        <div>
                            <label for="title" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Judul Materi <span class="text-red-500">*</span></label>
                            <input id="title" name="title" type="text" required value="{{ old('title', $material->title) }}"
                                   class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-orange-500 focus:ring-orange-500 py-3 px-4 text-base">
                            <x-input-error :messages="$errors->get('title')" class="mt-1" />
                        </div>

                        <!-- Row: Kategori + Pertemuan + Deskripsi -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="category" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                    Kategori Suku <span class="text-gray-400 text-xs font-normal">(opsional)</span>
                                </label>
                                <select id="category" name="category"
                                        class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-orange-500 focus:ring-orange-500 py-3">
                                    <option value="">— Umum / Bebas —</option>
                                    <option value="dayak"  {{ old('category', $material->category) === 'dayak'  ? 'selected' : '' }}>🦅 Dayak</option>
                                    <option value="banjar" {{ old('category', $material->category) === 'banjar' ? 'selected' : '' }}>🎋 Banjar</option>
                                    <option value="kutai"  {{ old('category', $material->category) === 'kutai'  ? 'selected' : '' }}>🐉 Kutai</option>
                                    <option value="tidung" {{ old('category', $material->category) === 'tidung' ? 'selected' : '' }}>🌊 Tidung</option>
                                </select>
                                <x-input-error :messages="$errors->get('category')" class="mt-1" />
                            </div>
                            <div>
                                <label for="pertemuan_ke" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                    Pertemuan ke- <span class="text-gray-400 text-xs font-normal">(opsional)</span>
                                </label>
                                <input id="pertemuan_ke" name="pertemuan_ke" type="number" min="0" max="50"
                                       value="{{ old('pertemuan_ke', $material->pertemuan_ke) }}"
                                       placeholder="Contoh: 3 (0 untuk Umum)"
                                       class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-orange-500 focus:ring-orange-500 py-3 px-4">
                                <p class="text-xs text-gray-400 mt-1">Nomor pertemuan sesuai RPP. Isi 0 untuk umum.</p>
                                <x-input-error :messages="$errors->get('pertemuan_ke')" class="mt-1" />
                            </div>
                            <div>
                                <label for="description" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Deskripsi Singkat <span class="text-red-500">*</span></label>
                                <textarea id="description" name="description" rows="3" required
                                          class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-orange-500 focus:ring-orange-500">{{ old('description', $material->description) }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-1" />
                            </div>
                        </div>

                        <!-- Kompetensi Dasar -->
                        <div>
                            <label for="kompetensi_dasar" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Kompetensi Dasar (KD) <span class="text-gray-400 text-xs font-normal">(opsional)</span>
                            </label>
                            <textarea id="kompetensi_dasar" name="kompetensi_dasar" rows="2"
                                      placeholder="Contoh: 3.1 Memahami keunikan gerak tari tradisional berdasarkan pola lantai dengan menggunakan unsur pendukung tari"
                                      class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-orange-500 focus:ring-orange-500">{{ old('kompetensi_dasar', $material->kompetensi_dasar) }}</textarea>
                            <p class="text-xs text-gray-400 mt-1">Ditampilkan di halaman materi sebagai tujuan pembelajaran untuk siswa.</p>
                            <x-input-error :messages="$errors->get('kompetensi_dasar')" class="mt-1" />
                        </div>

                        <!-- Konten Materi -->
                        <div>
                            <label for="content" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Konten Materi <span class="text-red-500">*</span></label>
                            <p class="text-xs text-gray-400 mb-3">Kamu bisa drag & drop gambar langsung ke editor. Perubahan konten akan mengembalikan status materi ke Pending.</p>
                            <textarea id="content" name="content" required
                                      class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">{{ old('content', $material->content) }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-1" />
                        </div>

                        <!-- Row: Gambar + Audio + Video -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="image" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                    Gambar Sampul <span class="text-gray-400 text-xs font-normal">(opsional — kosongkan jika tidak ingin mengganti)</span>
                                </label>
                                @if($material->image)
                                    <div class="mb-2 w-full h-32 rounded-xl overflow-hidden border border-gray-200 dark:border-gray-600">
                                        <img src="{{ str_starts_with($material->image, 'http') ? $material->image : asset('storage/'.$material->image) }}"
                                             alt="{{ $material->title }}" class="w-full h-full object-cover">
                                    </div>
                                @endif
                                <div x-show="imagePreview" class="mb-2 w-full h-32 rounded-xl overflow-hidden border-2 border-orange-300">
                                    <img :src="imagePreview" alt="Preview baru" class="w-full h-full object-cover">
                                </div>
                                <input type="file" id="image" name="image" accept="image/*" @change="handleImage"
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 cursor-pointer">
                                <x-input-error :messages="$errors->get('image')" class="mt-1" />
                            </div>

                            <!-- Audio -->
                            <div x-data="{ hasAudio: false }">
                                <label for="audio" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                    Audio Pendukung <span class="text-gray-400 text-xs font-normal">(opsional)</span>
                                </label>
                                <p class="text-xs text-gray-400 mb-3">MP3/WAV/M4A, maks. 10MB</p>

                                @if($material->audio_url)
                                    <div class="mb-2 p-2 bg-orange-50/50 dark:bg-gray-700 rounded-xl border border-orange-200 dark:border-gray-600 flex items-center gap-2">
                                        <span class="text-xl">🎵</span>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs font-bold text-orange-850 dark:text-orange-300 truncate">Audio Saat Ini</p>
                                            <audio src="{{ str_starts_with($material->audio_url, 'http') ? $material->audio_url : asset('storage/'.$material->audio_url) }}" controls class="w-full h-8 mt-1"></audio>
                                        </div>
                                    </div>
                                @endif

                                <div class="mb-3 w-full h-28 rounded-xl border-2 border-dashed border-gray-300 dark:border-gray-600 flex flex-col items-center justify-center text-gray-300 dark:text-gray-600 transition-colors"
                                     :class="hasAudio ? 'border-green-400 bg-green-50/50 dark:bg-green-950/20' : ''">
                                    <span class="text-3xl" :class="hasAudio ? 'animate-bounce text-green-600 dark:text-green-400' : ''">🎵</span>
                                    <span class="text-xs font-semibold mt-1" :class="hasAudio ? 'text-green-600 dark:text-green-400' : 'text-gray-400'">
                                        <span x-show="!hasAudio">Ganti Audio (opsional)</span>
                                        <span x-show="hasAudio">Audio Baru Terpilih!</span>
                                    </span>
                                </div>

                                <input type="file" id="audio" name="audio" accept="audio/*"
                                       @change="hasAudio = $event.target.files.length > 0"
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 cursor-pointer">
                                <x-input-error :messages="$errors->get('audio')" class="mt-1" />
                            </div>

                            <div>
                                <label for="video_url" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">URL Video YouTube <span class="text-gray-400 text-xs font-normal">(opsional)</span></label>
                                <input id="video_url" name="video_url" type="url"
                                       value="{{ old('video_url', $material->video_url) }}"
                                       placeholder="https://www.youtube.com/embed/..."
                                       class="block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-orange-500 focus:ring-orange-500 py-3 px-4">
                                <x-input-error :messages="$errors->get('video_url')" class="mt-1" />
                            </div>
                        </div>
                    </div>

                    <!-- Cover Crop Modal -->
                    <div id="coverCropModal" class="fixed inset-0 z-[9999] hidden bg-black/75 flex items-center justify-center p-4">
                        <div class="bg-white dark:bg-gray-800 rounded-xl max-w-3xl w-full flex flex-col max-h-[90vh]" @click.stop>
                            <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">✂️ Sesuaikan Gambar Sampul</h3>
                                <button type="button" @click="closeCoverCrop()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 text-2xl">&times;</button>
                            </div>
                            <div class="p-4 flex-1 min-h-0 overflow-hidden bg-gray-100 dark:bg-gray-900 flex justify-center items-center">
                                <div class="w-full h-[50vh] max-h-[50vh]">
                                    <img id="cover-cropper-image" src="" alt="To Crop" class="max-w-full max-h-full">
                                </div>
                            </div>
                            <div class="p-4 border-t border-gray-200 dark:border-gray-700 flex justify-end gap-3">
                                <button type="button" @click="closeCoverCrop()" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-medium transition">Batal</button>
                                <button type="button" @click="saveCoverCrop()" class="px-5 py-2 bg-orange-600 hover:bg-orange-500 text-white rounded-lg font-medium transition">💾 Terapkan</button>
                            </div>
                        </div>
                    </div>

                    <div class="px-8 py-5 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 rounded-b-2xl flex gap-3">
                        <button type="submit"
                                class="px-6 py-3 bg-orange-600 hover:bg-orange-500 text-white font-bold rounded-xl shadow-md transition text-sm">
                            💾 Simpan Perubahan
                        </button>
                        <a href="{{ route('teacher.materials.show', $material->id) }}"
                           class="px-5 py-3 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-semibold rounded-xl text-sm hover:bg-gray-50 dark:hover:bg-gray-600 transition">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Crop Modal -->
    <div id="cropModal" class="fixed inset-0 z-[9999] hidden bg-black/75 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl max-w-3xl w-full flex flex-col max-h-[90vh]">
            <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">✂️ Potong Gambar (Crop)</h3>
                <button type="button" id="closeCropBtn" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 text-2xl">&times;</button>
            </div>
            <div class="p-4 flex-1 min-h-0 overflow-hidden bg-gray-100 dark:bg-gray-900 flex justify-center items-center">
                <div class="w-full h-[60vh] max-h-[60vh]">
                    <img id="cropper-image" src="" alt="To Crop" class="max-w-full max-h-full">
                </div>
            </div>
            <div class="p-4 border-t border-gray-200 dark:border-gray-700 flex justify-end gap-3">
                <button type="button" onclick="$('#closeCropBtn').click()" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-medium transition">Batal</button>
                <button type="button" id="saveCropBtn" class="px-5 py-2 bg-orange-600 hover:bg-orange-500 text-white rounded-lg font-medium transition">💾 Simpan Potongan</button>
            </div>
        </div>
    </div>

    <!-- Summernote Rich Editor & Cropper -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <style>
        .note-editor { border-radius: 0.75rem !important; border: 1px solid #d1d5db !important; overflow: hidden; }
        .dark .note-editor { background-color: #374151 !important; border-color: #4b5563 !important; }
        .note-toolbar { background-color: #fff7ed !important; border-bottom: 2px solid #fed7aa !important; padding: 8px 12px !important; }
        .dark .note-toolbar { background-color: #1f2937 !important; border-bottom-color: #374151 !important; }
        .note-btn { background-color: white !important; border: 1px solid #d1d5db !important; color: #374151 !important; border-radius: 0.375rem !important; font-size: 13px !important; padding: 4px 8px !important; }
        .note-btn:hover { background-color: #fff7ed !important; border-color: #f97316 !important; color: #ea580c !important; }
        .note-editable { min-height: 500px !important; font-family: inherit !important; font-size: 16px !important; line-height: 1.75 !important; padding: 24px !important; background-color: white !important; color: #1f2937 !important; }
        .dark .note-editable { background-color: #1f2937 !important; color: #f3f4f6 !important; }
        .note-statusbar { display: none; }
        .note-modal-content { border-radius: 0.75rem !important; border: none !important; box-shadow: 0 20px 60px rgba(0,0,0,0.15) !important; }
    </style>

    <script>
        $(document).ready(function () {
            var CenterImageButton = function(context) {
                var ui = $.summernote.ui;
                var button = ui.button({
                    contents: '<i class="note-icon-align-center"></i> Center',
                    tooltip: 'Center Image',
                    click: function() {
                        var $img = $(context.invoke('editor.restoreTarget'));
                        if ($img.length) {
                            $img.css({
                                'display': 'block',
                                'margin-left': 'auto',
                                'margin-right': 'auto',
                                'float': 'none'
                            });
                            context.invoke('editor.afterCommand');
                        }
                    }
                });
                return button.render();
            };

            var CaptionImageButton = function(context) {
                var ui = $.summernote.ui;
                var button = ui.button({
                    contents: '<i class="note-icon-text"></i> Caption',
                    tooltip: 'Add Caption',
                    click: function() {
                        var $img = $(context.invoke('editor.restoreTarget'));
                        if ($img.length && !$img.parent().is('figure')) {
                            $img.wrap('<figure class="image-caption-container" style="text-align: center; margin: 1rem auto; display: block;"></figure>');
                            $img.after('<figcaption style="font-size: 0.875rem; color: #6b7280; margin-top: 0.5rem; text-align: center;">Tulis caption di sini...</figcaption>');
                            context.invoke('editor.afterCommand');
                        }
                    }
                });
                return button.render();
            };

            var currentCropImg = null;
            var cropper = null;

            var CropImageButton = function(context) {
                var ui = $.summernote.ui;
                var button = ui.button({
                    contents: '<i class="note-icon-arrows-alt"></i> Crop',
                    tooltip: 'Crop Image',
                    click: function() {
                        var $img = $(context.invoke('editor.restoreTarget'));
                        if ($img.length) {
                            currentCropImg = $img[0];
                            $('#cropModal').removeClass('hidden');
                            var cropImgElement = document.getElementById('cropper-image');
                            cropImgElement.src = currentCropImg.src;
                            if (cropper) cropper.destroy();
                            cropper = new Cropper(cropImgElement, { viewMode: 2, autoCropArea: 1 });
                        }
                    }
                });
                return button.render();
            };

            // Modal save event for crop
            $('#saveCropBtn').on('click', function() {
                if (!cropper) return;
                var canvas = cropper.getCroppedCanvas();
                if (!canvas) return;

                var dataUrl = canvas.toDataURL('image/jpeg');
                var arr = dataUrl.split(','), mime = arr[0].match(/:(.*?);/)[1],
                    bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
                while(n--){ u8arr[n] = bstr.charCodeAt(n); }
                var file = new File([u8arr], 'cropped.jpg', {type:mime});
                
                var formData = new FormData();
                formData.append('image', file);
                
                var btn = $(this);
                var originalText = btn.text();
                btn.text('Menyimpan...').prop('disabled', true);

                $.ajax({
                    url: "{{ route('teacher.materials.upload_image') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function (res) {
                        currentCropImg.src = res.url;
                        $('#cropModal').addClass('hidden');
                        cropper.destroy(); cropper = null;
                        btn.text(originalText).prop('disabled', false);
                    },
                    error: function (xhr) {
                        alert('Gagal crop: ' + (xhr.responseJSON?.message || 'Error server.'));
                        btn.text(originalText).prop('disabled', false);
                    }
                });
            });

            $('#closeCropBtn').on('click', function() {
                $('#cropModal').addClass('hidden');
                if (cropper) { cropper.destroy(); cropper = null; }
            });

            $('#content').summernote({
                placeholder: 'Edit konten materi di sini...',
                tabsize: 2,
                height: 550,
                toolbar: [
                    ['style',  ['style']],
                    ['font',   ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color',  ['color']],
                    ['para',   ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table',  ['table']],
                    ['insert', ['link', 'picture', 'video', 'hr']],
                    ['view',   ['fullscreen', 'codeview']],
                ],
                buttons: {
                    centerImage: CenterImageButton,
                    captionImage: CaptionImageButton,
                    cropImage: CropImageButton
                },
                popover: {
                    image: [
                        ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                        ['float', ['floatLeft', 'centerImage', 'floatRight', 'floatNone']],
                        ['custom', ['captionImage', 'cropImage']],
                        ['remove', ['removeMedia']]
                    ]
                },
                styleTags: ['p', 'h1', 'h2', 'h3', 'h4', 'blockquote'],
                fontSizes: ['12', '13', '14', '15', '16', '18', '20', '24', '28', '32'],
                dialogsInBody: true,
                dialogsFade: true,
                callbacks: {
                    onImageUpload: function (files) { uploadImage(files[0]); }
                }
            });

            function uploadImage(file) {
                const formData = new FormData();
                formData.append('image', file);
                $.ajax({
                    url: "{{ route('teacher.materials.upload_image') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    cache: false,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: res => { $('#content').summernote('insertImage', res.url); },
                    error: xhr => { alert('Gagal upload: ' + (xhr.responseJSON?.message || 'Cek ukuran/format file.')); }
                });
            }
        });
    </script>
</x-app-layout>
