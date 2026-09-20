<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class GameController extends Controller
{
    /**
     * Mini Game 1: Cocokkan Motif
     *
     * Siswa mencocokkan nama motif khas Kaltara dengan suku asal-nya.
     * Logika game (drag-drop / klik pasang) ditangani Alpine.js di view.
     */
    public function matching(): View
    {
        // Data motif: nama motif di satu sisi, nama suku di sisi lain
        $motifs = [
            [
                'id'          => 1,
                'name'        => 'Motif Burung Enggang',
                'description' => 'Motif kebanggaan Suku Dayak yang menggambarkan burung suci Enggang (Rangkong).',
                'image'       => 'https://placehold.co/200x200/166534/ffffff?text=🦅+Enggang',
                'suku'        => 'Dayak',
                'color'       => 'green',
            ],
            [
                'id'          => 2,
                'name'        => 'Motif Pucuk Rebung',
                'description' => 'Melambangkan pertumbuhan dan harapan, populer dalam kerajinan Suku Banjar.',
                'image'       => 'https://placehold.co/200x200/92400e/ffffff?text=🎋+Pucuk+Rebung',
                'suku'        => 'Banjar',
                'color'       => 'yellow',
            ],
            [
                'id'          => 3,
                'name'        => 'Motif Naga Mahkota',
                'description' => 'Motif naga kerajaan yang mencerminkan kebesaran dan kejayaan Suku Kutai.',
                'image'       => 'https://placehold.co/200x200/991b1b/ffffff?text=🐉+Naga+Kutai',
                'suku'        => 'Kutai',
                'color'       => 'red',
            ],
            [
                'id'          => 4,
                'name'        => 'Motif Ombak Bahari',
                'description' => 'Simbol keberanian melaut dan semangat bahari masyarakat pesisir Suku Tidung.',
                'image'       => 'https://placehold.co/200x200/1e3a8a/ffffff?text=🌊+Ombak+Bahari',
                'suku'        => 'Tidung',
                'color'       => 'blue',
            ],
        ];

        // Acak urutan motif dan opsi suku setiap halaman dibuka
        $motifs      = collect($motifs)->shuffle()->values()->toArray();
        $sukuOptions = collect($motifs)->pluck('suku')->shuffle()->values()->toArray();

        return view('games.matching', compact('motifs', 'sukuOptions'));
    }

    /**
     * Mini Game 2: Tebak Tarian
     *
     * Siswa diberi foto tarian dan harus memilih nama suku yang benar.
     * Semua data soal ada di sini; tidak perlu tabel DB.
     */
    public function guessDance(): View
    {
        $dances = [
            [
                'id'          => 1,
                'name'        => 'Tari Hudoq',
                'image'       => 'https://placehold.co/480x320/166534/ffffff?text=🎭+Tari+Hudoq',
                'hint'        => 'Tarian ritual yang dibawakan dengan topeng kayu besar saat musim tanam.',
                'options'     => ['Dayak', 'Banjar', 'Kutai', 'Tidung'],
                'answer'      => 'Dayak',
                'explanation' => 'Tari Hudoq adalah tarian sakral Suku Dayak Bahau yang dilakukan untuk memohon kesuburan ladang.',
            ],
            [
                'id'          => 2,
                'name'        => 'Tari Jepen',
                'image'       => 'https://placehold.co/480x320/991b1b/ffffff?text=💃+Tari+Jepen',
                'hint'        => 'Tarian anggun dengan gerakan lembut yang terinspirasi budaya Melayu.',
                'options'     => ['Banjar', 'Kutai', 'Tidung', 'Dayak'],
                'answer'      => 'Kutai',
                'explanation' => 'Tari Jepen berkembang di komunitas Suku Kutai dan merupakan perpaduan budaya Melayu-Arab yang harmonis.',
            ],
            [
                'id'          => 3,
                'name'        => 'Tari Garay',
                'image'       => 'https://placehold.co/480x320/1e3a8a/ffffff?text=⛵+Tari+Garay',
                'hint'        => 'Tarian sakral pembuka festival di atas perahu di kota Tarakan.',
                'options'     => ['Tidung', 'Dayak', 'Banjar', 'Kutai'],
                'answer'      => 'Tidung',
                'explanation' => 'Tari Garay adalah tarian pembuka Festival Iraw Tengkayu yang menjadi kebanggaan Suku Tidung di Tarakan.',
            ],
            [
                'id'          => 4,
                'name'        => 'Tari Baksa Kembang',
                'image'       => 'https://placehold.co/480x320/92400e/ffffff?text=🌺+Baksa+Kembang',
                'hint'        => 'Tarian penyambutan tamu dengan untaian bunga melati yang harum.',
                'options'     => ['Banjar', 'Dayak', 'Tidung', 'Kutai'],
                'answer'      => 'Banjar',
                'explanation' => 'Tari Baksa Kembang adalah tarian penyambutan tamu khas Suku Banjar yang dibawakan oleh penari putri dengan hiasan bunga.',
            ],
            [
                'id'          => 5,
                'name'        => 'Tari Kinyah',
                'image'       => 'https://placehold.co/480x320/166534/ffffff?text=⚔️+Tari+Kinyah',
                'hint'        => 'Tarian heroik yang menggambarkan keberanian para pejuang di hutan Kalimantan.',
                'options'     => ['Dayak', 'Kutai', 'Tidung', 'Banjar'],
                'answer'      => 'Dayak',
                'explanation' => 'Tari Kinyah adalah tarian perang Suku Dayak yang menggambarkan semangat juang dan keberanian para kesatria.',
            ],
        ];

        // Acak urutan soal setiap halaman dibuka
        $dances = collect($dances)->shuffle()->values()->toArray();

        return view('games.guess-dance', compact('dances'));
    }
}
