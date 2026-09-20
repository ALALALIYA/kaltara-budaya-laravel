<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMaterialRequest;
use App\Http\Requests\UpdateMaterialRequest;
use App\Models\Material;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MaterialController extends Controller
{
    /**
     * Daftar semua materi milik guru yang sedang login.
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $group = $request->query('group', 'suku'); // 'suku' or 'pertemuan'

        $query = Material::where('teacher_id', auth()->id())
            ->with(['quizzes' => fn ($q) => $q->withCount('questions')])
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('category', 'like', "%{$search}%");
                });
            });

        if ($group === 'pertemuan') {
            $query->orderByRaw('CASE WHEN CAST(pertemuan_ke AS UNSIGNED) BETWEEN 1 AND 7 THEN 0 ELSE 1 END')
                  ->orderByRaw('CAST(pertemuan_ke AS UNSIGNED)')
                  ->orderBy('category')
                  ->orderBy('title');
        } else {
            $query->orderBy('category')->orderBy('pertemuan_ke')->orderBy('title');
        }

        $materials = $query->paginate(10)->appends(['search' => $search, 'group' => $group]);

        return view('teacher.materials.index', compact('materials', 'search', 'group'));
    }

    /**
     * Tampilkan form tambah materi baru.
     */
    public function create(): View
    {
        return view('teacher.materials.create');
    }

    /**
     * Simpan materi baru ke database.
     * Gambar di-upload ke public disk (storage/app/public/materials/).
     */
    public function store(StoreMaterialRequest $request): RedirectResponse
    {
        $data                = $request->validated();
        $data['teacher_id'] = auth()->id();
        $data['status']     = 'approved';

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('materials', 'public');
        }

        if ($request->hasFile('audio')) {
            $data['audio_url'] = $request->file('audio')->store('audio', 'public');
        }

        Material::create($data);

        return redirect()
            ->route('teacher.materials.index')
            ->with('success', 'Materi berhasil disimpan dan langsung aktif! ✅');
    }

    /**
     * Tampilkan detail satu materi beserta quiz terkait.
     */
    public function show(Material $material): View
    {
        abort_if($material->teacher_id !== auth()->id(), 403, 'Kamu tidak berhak mengakses materi ini.');

        $material->load(['quizzes' => function($query) {
            $query->withCount('questions');
        }]);

        return view('teacher.materials.show', compact('material'));
    }

    /**
     * Tampilkan form edit materi.
     */
    public function edit(Material $material): View
    {
        abort_if($material->teacher_id !== auth()->id(), 403, 'Kamu tidak berhak mengedit materi ini.');

        return view('teacher.materials.edit', compact('material'));
    }

    /**
     * Perbarui data materi.
     * Jika ada gambar baru, hapus gambar lama (jika tersimpan di storage) lalu upload yang baru.
     */
    public function update(UpdateMaterialRequest $request, Material $material): RedirectResponse
    {
        abort_if($material->teacher_id !== auth()->id(), 403, 'Kamu tidak berhak mengubah materi ini.');

        $data = $request->validated();
        $data['status'] = 'approved';

        if ($request->hasFile('image')) {
            if ($material->image && ! str_starts_with($material->image, 'http')) {
                Storage::disk('public')->delete($material->image);
            }
            $data['image'] = $request->file('image')->store('materials', 'public');
        }

        if ($request->hasFile('audio')) {
            if ($material->audio_url && ! str_starts_with($material->audio_url, 'http')) {
                Storage::disk('public')->delete($material->audio_url);
            }
            $data['audio_url'] = $request->file('audio')->store('audio', 'public');
        }

        $material->update($data);

        return redirect()
            ->route('teacher.materials.show', $material->id)
            ->with('success', 'Materi berhasil diperbarui! ✅');
    }

    /**
     * Hapus materi dan gambarnya dari storage.
     */
    public function destroy(Material $material): RedirectResponse
    {
        abort_if($material->teacher_id !== auth()->id(), 403, 'Kamu tidak berhak menghapus materi ini.');

        if ($material->image && ! str_starts_with($material->image, 'http')) {
            Storage::disk('public')->delete($material->image);
        }

        if ($material->audio_url && ! str_starts_with($material->audio_url, 'http')) {
            Storage::disk('public')->delete($material->audio_url);
        }

        $material->delete();

        return redirect()
            ->route('teacher.materials.index')
            ->with('success', 'Materi berhasil dihapus.');
    }

    /**
     * Upload gambar dari editor (Summernote).
     */
    public function uploadImage(Request $request): JsonResponse
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('materials/editor', 'public');
            return response()->json([
                'url' => asset('storage/' . $path)
            ]);
        }

        return response()->json(['error' => 'Gagal mengupload gambar.'], 400);
    }
}
