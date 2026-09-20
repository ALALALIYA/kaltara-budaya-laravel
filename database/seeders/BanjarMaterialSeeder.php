<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BanjarMaterialSeeder extends Seeder
{
    private int $teacherId = 1; // Bu Sari Guru

    public function run(): void
    {
        $this->createMusikPanting();
        $this->createArsitekturBanjar();
        $this->createSeniTeaterMamanda();
    }

    private function createMusikPanting(): void
    {
        $material = Material::updateOrCreate(
            ['title' => 'Musik Panting – Harmoni Suku Banjar', 'category' => 'banjar'],
            [
                'slug'            => 'musik-panting-harmoni-suku-banjar',
                'description'     => 'Kenali Musik Panting, alat musik tradisional khas Suku Banjar yang melantunkan harmoni indah khas Kalimantan Utara dan Selatan.',
                'kompetensi_dasar'=> 'Memahami alat musik tradisional dan kesenian Suku Banjar.',
                'pertemuan_ke'    => 8,
                'status'          => 'approved',
                'teacher_id'      => $this->teacherId,
                'content'         => $this->contentMusikPanting(),
                'image'           => 'https://placehold.co/800x450/92400e/ffffff?text=Musik+Panting+Banjar',
                'video_url'       => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'
            ]
        );

        $this->createQuizzes($material);
    }

    private function contentMusikPanting(): string
    {
        return <<<'HTML'
<h2>Apa Itu Musik Panting?</h2>
<p>Musik Panting adalah kesenian musik tradisional yang lahir dari rahim budaya <strong>Suku Banjar</strong> di Kalimantan. Kata "panting" merujuk langsung pada alat musik petik utamanya — sebuah instrumen berbentuk menyerupai gambus Arab namun dengan ukuran yang lebih kecil dan konstruksi yang khas lokal Borneo. Musik ini merupakan ekspresi jiwa masyarakat Banjar yang merupakan perpaduan antara unsur budaya Melayu, Islam, dan kearifan lokal Kalimantan.</p>
<p>Secara historis, Musik Panting telah ada sejak ratusan tahun lalu dan erat kaitannya dengan penyebaran Islam di wilayah Kalimantan Selatan. Syair-syair yang dibawakan dalam musik ini banyak berisi petuah agama, nasihat kehidupan, pantun, dan kisah-kisah dari tradisi lisan Banjar.</p>

<h2>Alat Musik dalam Ansambel Panting</h2>
<p>Dalam perkembangannya, Musik Panting tidak dimainkan secara tunggal. Ia hadir sebagai sebuah ansambel yang kaya warna, memadukan beberapa instrumen:</p>
<ul>
  <li>🎸 <strong>Panting (alat musik utama):</strong> Instrumen petik berdawai yang terbuat dari kayu pilihan. Badannya berbentuk seperti perahu kecil yang dilubangi dan bagian permukaannya dilapisi kulit binatang. Memiliki 3–5 senar dari bahan nilon atau benang. Nada yang dihasilkan lembut dan melodis.</li>
  <li>🥁 <strong>Babun (Gendang):</strong> Perkusi utama yang menentukan irama dan tempo lagu. Babun adalah gendang dua sisi yang dipukul dengan tangan — memberikan ritme yang hidup dan dinamis.</li>
  <li>🪗 <strong>Kurung-kurung (Idiofon bambu):</strong> Alat perkusi ritmis dari bambu yang dipukul untuk menghasilkan bunyi "ketuk-ketuk" yang khas.</li>
  <li>🎶 <strong>Biola:</strong> Masuk dalam ansambel panting pada era perkembangan modern sebagai pengaruh dari budaya Melayu pesisir.</li>
  <li>🎵 <strong>Suling Bambu:</strong> Memberikan melodi penyeimbang yang terdengar merdu dan mewakili unsur alam.</li>
  <li>🪘 <strong>Gong:</strong> Digunakan untuk menandai awal dan akhir bagian lagu, serta memberikan aksen pada bagian-bagian klimaks.</li>
</ul>

<h2>Ciri Khas dan Keunikan Musik Panting</h2>
<ul>
  <li>🎼 <strong>Tangga nada pentatonik:</strong> Musik Panting menggunakan sistem tangga nada pentatonik (lima nada) yang memberikan karakteristik melodi yang khas dan berbeda dari musik Barat.</li>
  <li>📖 <strong>Syair berbahasa Banjar:</strong> Vokal menggunakan bahasa Banjar — baik bahasa Banjar Halus (tinggi) maupun Banjar Hulu. Syair kaya akan pantun bersajak, ungkapan adat, dan nasihat moral Islami.</li>
  <li>🎭 <strong>Sifat improvisasi:</strong> Para pemain panting yang berpengalaman sering berimprovisasi dalam melodi maupun syair sesuai suasana dan momen pertunjukan.</li>
  <li>🕌 <strong>Nuansa Islami yang kental:</strong> Banyak lagu panting mengandung shalawat, pujian kepada Allah dan Nabi Muhammad SAW, serta nilai-nilai akhlak mulia.</li>
</ul>

<h2>Fungsi Sosial Musik Panting</h2>
<table>
  <tr><th>Fungsi</th><th>Konteks</th></tr>
  <tr><td>🎉 Hiburan Rakyat</td><td>Dimainkan dalam acara pernikahan, sunatan, dan perayaan kampung sebagai pengisi suasana sekaligus ajang silaturahmi.</td></tr>
  <tr><td>🕌 Upacara Keagamaan</td><td>Mengiringi maulid nabi, pengajian besar, dan perayaan hari besar Islam lainnya dalam komunitas Banjar.</td></tr>
  <tr><td>📚 Pendidikan Moral</td><td>Syair lagu mengandung petuah, nasihat agama, dan pelajaran hidup yang disampaikan secara halus melalui metafora.</td></tr>
  <tr><td>🏛️ Pelestarian Budaya</td><td>Tampil dalam festival budaya daerah, lomba seni, dan kegiatan sekolah sebagai media transmisi budaya kepada generasi muda.</td></tr>
  <tr><td>🤝 Diplomasi Budaya</td><td>Sering dipentaskan dalam penyambutan tamu penting dan delegasi pemerintah sebagai representasi kebudayaan Banjar.</td></tr>
</table>

<h2>Panting di Kalimantan Utara</h2>
<p>Suku Banjar merupakan salah satu kelompok etnis yang cukup signifikan di Kalimantan Utara, terutama di Kota Tarakan dan Kabupaten Bulungan. Mereka membawa tradisi Musik Panting dari Kalimantan Selatan dan tetap melestarikannya di perantauan. Komunitas Banjar di Kaltara sering menggelar pertunjukan panting dalam acara-acara adat dan keagamaan, menjadikannya sebagai jembatan identitas budaya di tanah rantau.</p>

<h2>Upaya Pelestarian</h2>
<ul>
  <li>📖 Musik Panting masuk dalam kurikulum muatan lokal di sekolah-sekolah Kalimantan Selatan dan beberapa sekolah di Kaltara.</li>
  <li>🏆 Lomba Musik Panting rutin digelar dalam Pekan Budaya Daerah di Banjarmasin dan Tanjung Selor.</li>
  <li>🎙️ Rekaman dan dokumentasi audio-visual oleh Balai Pelestarian Nilai Budaya (BPNB) Banjarmasin.</li>
  <li>🌐 Beberapa sanggar seni Banjar telah memperkenalkan Panting di platform YouTube dan media sosial.</li>
</ul>

<blockquote>
  <p><em>"Panting bukan sekadar bunyi. Ia adalah jiwa orang Banjar yang berbicara kepada Tuhan dan sesama." — Pepatah seniman Banjar</em></p>
</blockquote>

<h2>Referensi dan Sumber Belajar</h2>
<ul>
  <li>📚 Alfani Daud, <em>Islam dan Masyarakat Banjar</em> (1997), LIPI Press Jakarta.</li>
  <li>📚 Balai Pelestarian Nilai Budaya (BPNB) Banjarmasin — <em>Ensiklopedia Kebudayaan Banjar</em>.</li>
  <li>📚 Dinas Kebudayaan dan Pariwisata Kalimantan Selatan — <em>Profil Seni Budaya Kalimantan Selatan</em> (2019).</li>
  <li>📚 Kemendikbud RI — <em>Modul Ajar Seni Budaya: Kebudayaan Banjar</em> (2022).</li>
  <li>🌐 Wikipedia Bahasa Indonesia: Panting (diakses 2024, cross-checked BPNB).</li>
</ul>
HTML;
    }

    private function createArsitekturBanjar(): void
    {
        $material = Material::updateOrCreate(
            ['title' => 'Rumah Bubungan Tinggi – Arsitektur Banjar', 'category' => 'banjar'],
            [
                'slug'            => 'rumah-bubungan-tinggi-arsitektur-banjar',
                'description'     => 'Mempelajari rumah adat Suku Banjar, Rumah Bubungan Tinggi, yang sarat akan filosofi dan nilai estetika.',
                'kompetensi_dasar'=> 'Menganalisis nilai-nilai arsitektur tradisional.',
                'pertemuan_ke'    => 9,
                'status'          => 'approved',
                'teacher_id'      => $this->teacherId,
                'content'         => $this->contentArsitektur(),
                'image'           => 'https://placehold.co/800x450/78350f/ffffff?text=Rumah+Bubungan+Tinggi',
                'video_url'       => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'
            ]
        );

        $this->createQuizzes($material);
    }

    private function contentArsitektur(): string
    {
        return <<<'HTML'
<h2>Rumah Bubungan Tinggi: Mahkota Arsitektur Banjar</h2>
<p><strong>Rumah Bubungan Tinggi</strong> adalah rumah tradisional paling ikonik dan bersejarah dari Suku Banjar. Ia bukan sekadar bangunan tempat tinggal — ia adalah manifestasi visual dari kosmologi, filosofi, dan status sosial masyarakat Banjar yang telah berkembang selama berabad-abad. Nama "Bubungan Tinggi" berasal dari ciri paling mencolok bangunan ini: atapnya yang menjulang tinggi dan meruncing dengan sudut kemiringan yang sangat curam.</p>
<p>Secara resmi, Rumah Bubungan Tinggi telah <strong>ditetapkan sebagai Warisan Budaya Tak Benda Nasional</strong> oleh Kementerian Pendidikan dan Kebudayaan RI, sekaligus menjadi simbol identitas budaya Kalimantan Selatan yang diakui secara nasional.</p>

<h2>Filosofi dan Makna Simbolik</h2>
<ul>
  <li>⛰️ <strong>Atap menjulang tinggi:</strong> Melambangkan hubungan manusia dengan Sang Pencipta — semakin tinggi atap, semakin dekat dengan langit (Tuhan). Mencerminkan nilai-nilai spiritual Islam yang sangat mengakar dalam budaya Banjar.</li>
  <li>🪵 <strong>Konstruksi panggung:</strong> Dibangun di atas tiang-tiang kayu setinggi 1–2 meter dari tanah. Filosofinya adalah "manusia berada di antara langit (atap tinggi) dan bumi (kolong rumah yang rendah)."</li>
  <li>🔢 <strong>Jumlah tiang:</strong> Tidak sembarangan. Dalam adat Banjar, jumlah tiang mengikuti pakem tertentu terkait keberuntungan dan keselamatan penghuni.</li>
  <li>🪟 <strong>Ventilasi dan orientasi:</strong> Umumnya menghadap ke arah sungai (masyarakat Banjar adalah masyarakat sungai) dan memiliki ventilasi yang baik untuk iklim tropis.</li>
</ul>

<h2>Material Bangunan: Kayu Ulin</h2>
<p>Rumah Bubungan Tinggi dibangun menggunakan <strong>kayu ulin (Eusideroxylon zwageri)</strong> — "kayu besi" Kalimantan — dengan keunggulan luar biasa:</p>
<ul>
  <li>💪 <strong>Kekuatan ekstrem:</strong> Salah satu kayu terkeras dan terberat di dunia. Tidak mudah dimakan rayap, jamur, atau cuaca tropis.</li>
  <li>⏳ <strong>Awet ratusan tahun:</strong> Bangunan dari kayu ulin yang terawat dapat bertahan 200–500 tahun. Beberapa Rumah Bubungan Tinggi tua di Banjarmasin berusia lebih dari 150 tahun.</li>
  <li>💧 <strong>Tahan air:</strong> Uniknya, kayu ulin justru semakin kuat bila terendam air — ideal untuk daerah rawa dan sungai khas Kalimantan.</li>
  <li>⚠️ <strong>Status lindung:</strong> Kini kayu ulin masuk daftar spesies yang dilindungi karena eksploitasi berlebihan. Penggunaan kayu ulin baru diregulasi ketat.</li>
</ul>

<h2>Tata Ruang dan Struktur Rumah</h2>
<table>
  <tr><th>Nama Ruang (Bahasa Banjar)</th><th>Fungsi</th></tr>
  <tr><td>Palatar (Teras Depan)</td><td>Ruang penyambutan tamu pertama. Area transisi antara luar dan dalam rumah.</td></tr>
  <tr><td>Pamedangan (Serambi Depan)</td><td>Ruang tamu resmi. Tamu terhormat disambut dan diajak berbincang di sini.</td></tr>
  <tr><td>Panampik Kacil (Ruang Tengah Kecil)</td><td>Ruang transisi menuju bagian dalam. Untuk pertemuan keluarga lebih intim.</td></tr>
  <tr><td>Panampik Basar (Ruang Tengah Besar)</td><td>Ruang utama keluarga. Digunakan untuk kenduri, acara adat, dan pertemuan keluarga besar.</td></tr>
  <tr><td>Padapuran (Dapur)</td><td>Terletak di bagian paling belakang. Wilayah privat perempuan dalam rumah tangga Banjar.</td></tr>
</table>
<p><em>Sumber: Balai Pelestarian Nilai Budaya (BPNB) Banjarmasin — Dokumentasi Arsitektur Rumah Banjar (2018).</em></p>

<h2>Ragam Rumah Adat Banjar</h2>
<p>Suku Banjar mengenal setidaknya <strong>13 ragam atau varian</strong> rumah tradisional, antara lain:</p>
<ul>
  <li>🏠 <strong>Rumah Bubungan Tinggi</strong> — Tipe tertinggi dan paling prestisius, biasa dimiliki bangsawan atau orang kaya.</li>
  <li>🏠 <strong>Rumah Gajah Baliku</strong> — Tipe di bawah Bubungan Tinggi, biasa untuk kalangan menengah atas.</li>
  <li>🏠 <strong>Rumah Balai Bini</strong> — Tipe untuk kalangan biasa dengan ukuran lebih sederhana.</li>
  <li>🏠 <strong>Rumah Lanting</strong> — Rumah di atas air (sungai) yang unik, mencerminkan karakter masyarakat Banjar sebagai "orang sungai."</li>
</ul>

<h2>Ukiran dan Ornamen</h2>
<ul>
  <li>🌿 <strong>Motif daun/sulur (Wajit):</strong> Ornamen geometris yang melambangkan kesuburan dan keberkahan.</li>
  <li>🌸 <strong>Motif bunga lotus dan kamboja:</strong> Melambangkan kesucian dan nilai-nilai Islami.</li>
  <li>🦅 <strong>Motif burung (Kuntul/Bangau):</strong> Ditemukan di puncak atap, melambangkan kemuliaan dan keanggunan penghuni.</li>
  <li>⭐ <strong>Motif geometris bintang:</strong> Pengaruh kuat dari seni ukir Islam yang masuk bersama penyebaran agama di wilayah Banjar.</li>
</ul>

<h2>Rumah Banjar di Kalimantan Utara</h2>
<p>Seiring migrasi orang Banjar ke Kalimantan Utara, beberapa komunitas Banjar di Tarakan dan Bulungan mempertahankan gaya arsitektur Bubungan Tinggi dalam skala yang lebih kecil. Beberapa langgar/mushola komunitas Banjar di Kaltara mengadopsi ciri atap tinggi khas Banjar sebagai identitas komunitas.</p>

<h2>Referensi dan Sumber Belajar</h2>
<ul>
  <li>📚 Balai Pelestarian Nilai Budaya (BPNB) Banjarmasin — <em>Dokumentasi dan Inventarisasi Arsitektur Rumah Banjar</em> (2018).</li>
  <li>📚 J.J. Ras, <em>Hikayat Banjar</em> (1968), The Hague: Martinus Nijhoff — referensi sejarah budaya Banjar klasik.</li>
  <li>📚 Dinas Kebudayaan dan Pariwisata Kalimantan Selatan — <em>Warisan Budaya Kalimantan Selatan</em> (2020).</li>
  <li>📚 Kemendikbud RI — Sertifikat Warisan Budaya Tak Benda: Rumah Bubungan Tinggi.</li>
  <li>🌐 Wikipedia Bahasa Indonesia: Rumah Bubungan Tinggi.</li>
</ul>
HTML;
    }

    private function createSeniTeaterMamanda(): void
    {
        $material = Material::updateOrCreate(
            ['title' => 'Teater Tradisional Mamanda', 'category' => 'banjar'],
            [
                'slug'            => 'teater-tradisional-mamanda-suku-banjar',
                'description'     => 'Mamanda adalah seni teater atau sandiwara tradisional Suku Banjar yang mirip dengan Lenong atau Ketoprak.',
                'kompetensi_dasar'=> 'Mengapresiasi seni teater daerah.',
                'pertemuan_ke'    => 10,
                'status'          => 'approved',
                'teacher_id'      => $this->teacherId,
                'content'         => $this->contentMamanda(),
                'image'           => 'https://placehold.co/800x450/b45309/ffffff?text=Teater+Mamanda',
                'video_url'       => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'
            ]
        );
        $this->createQuizzes($material);
    }

    private function contentMamanda(): string
    {
        return <<<'HTML'
<h2>Mengenal Teater Tradisional Mamanda</h2>
<p><strong>Mamanda</strong> adalah bentuk seni pertunjukan teater tradisional yang berasal dari Suku Banjar, Kalimantan Selatan. Ia sering disebut sebagai "lenong"-nya orang Banjar — sebuah perbandingan yang tepat mengingat sifatnya yang populer, rakyati, dan penuh humor. Mamanda adalah teater kerakyatan yang berbicara tentang kehidupan sehari-hari, problematika sosial, dan nilai-nilai moral dengan cara yang menghibur dan mudah dipahami.</p>
<p>Kata "mamanda" diperkirakan berasal dari bahasa Banjar yang berarti "memanggil" atau "menyapa yang dituakan" — merujuk pada gaya sapaan hormat yang sering muncul dalam dialog pertunjukan ini.</p>

<h2>Sejarah dan Asal Usul</h2>
<p>Mamanda diyakini berkembang dari tradisi teater <strong>Indra Bangsawan</strong> — seni pertunjukan bercorak kerajaan yang masuk ke Kalimantan melalui jalur perdagangan dengan Malaka dan Semenanjung Melayu. Seiring waktu, ia bertransformasi menjadi hiburan rakyat yang lebih cair, lebih spontan, dan lebih dekat dengan kehidupan masyarakat Banjar sehari-hari.</p>
<p>Pada masa Kerajaan Banjar (abad ke-14 hingga 19), Mamanda sering dipentaskan di lingkungan keraton. Setelah Belanda membubarkan Kesultanan Banjar pada 1860, Mamanda "turun" ke masyarakat umum dan justru semakin berkembang pesat sebagai seni kerakyatan.</p>

<h2>Karakter Tetap (Tokoh Baku)</h2>
<table>
  <tr><th>Nama Karakter</th><th>Peran</th><th>Sifat</th></tr>
  <tr><td>Sultan/Raja</td><td>Penguasa kerajaan</td><td>Bijaksana, adil, kadang mudah diperdaya</td></tr>
  <tr><td>Mangkubumi</td><td>Perdana Menteri</td><td>Licik, sering manipulatif untuk kepentingan sendiri</td></tr>
  <tr><td>Wazir</td><td>Menteri/Penasihat</td><td>Bervariasi — kadang jujur, kadang oportunis</td></tr>
  <tr><td>Panglima</td><td>Kepala Pasukan</td><td>Pemberani, loyal kepada raja</td></tr>
  <tr><td>Sandut</td><td>Rakyat jelata / tokoh komikal</td><td>Polos, jujur, menjadi pusat humor — mewakili suara rakyat</td></tr>
  <tr><td>Inang / Dayang</td><td>Pelayan istana (perempuan)</td><td>Setia, periang, kadang menjadi "jembatan" antara raja dan rakyat</td></tr>
</table>

<h2>Struktur Pertunjukan</h2>
<ol>
  <li><strong>Babak Pembukaan (Ba-alun):</strong> Diawali dengan penampilan musik panting yang membuka suasana dan memperkenalkan karakter-karakter kepada penonton.</li>
  <li><strong>Babak Inti (Lakon):</strong> Kisah utama berkembang melalui dialog improvisasi antara para tokoh. Konflik biasanya menyentuh isu ketidakadilan, korupsi, cinta, atau kebodohan penguasa.</li>
  <li><strong>Babak Penutup (Bahabis):</strong> Resolusi konflik yang mengandung pesan moral yang jelas. Tokoh yang buruk mendapat ganjaran, yang baik mendapat penghargaan.</li>
</ol>

<h2>Keunikan dan Daya Tarik Mamanda</h2>
<ul>
  <li>🎭 <strong>Improvisasi yang segar:</strong> Dialog Mamanda sebagian besar bersifat improvisasi. Para pemain hanya memiliki garis besar cerita, namun kalimat lahir spontan di atas panggung — menciptakan kejutan dan kelucuan yang tak terduga.</li>
  <li>😂 <strong>Humor dan satir sosial:</strong> Mamanda adalah media kritik sosial terselubung humor. Melalui kelucuan Tokoh Sandut atau kebodohan Mangkubumi yang korup, penonton diajak merenungkan masalah nyata — korupsi, ketidakadilan, kebodohan pemimpin.</li>
  <li>🎵 <strong>Iringan Musik Panting:</strong> Pertunjukan Mamanda tidak pernah lepas dari iringan musik panting, babun, dan gong. Musik aktif merespons situasi di panggung: memperkuat momen dramatis, menegaskan humor, atau membangun ketegangan.</li>
  <li>👗 <strong>Kostum kerajaan dan rakyat:</strong> Para tokoh istana mengenakan busana tradisional Banjar yang megah — baju kurung, kain sasirangan, dan aksesoris emas. Kontras dengan tokoh rakyat yang berpakaian sederhana menciptakan visual tentang kesenjangan sosial.</li>
  <li>🗣️ <strong>Bahasa Banjar yang kaya:</strong> Dialog menggunakan bahasa Banjar dengan berbagai tingkatan — dari bahasa halus (tokoh istana) hingga bahasa Banjar sehari-hari (tokoh rakyat).</li>
</ul>

<h2>Mamanda di Kalimantan Utara</h2>
<p>Di Kalimantan Utara, komunitas Banjar di Tarakan dan sekitarnya sesekali mengadakan pertunjukan Mamanda dalam acara-acara komunitas, menjadikannya sebagai sarana pemersatu dan pengobat rindu kampung halaman sekaligus media pengenalan budaya Banjar kepada masyarakat Kaltara yang beragam.</p>

<h2>Referensi dan Sumber Belajar</h2>
<ul>
  <li>📚 Zulfa Jamalie, <em>Mamanda: Teater Tradisional Banjar</em> — penelitian etnografi tentang Mamanda (perpustakaan UNLAM Banjarmasin).</li>
  <li>📚 Balai Pelestarian Nilai Budaya (BPNB) Banjarmasin — <em>Ensiklopedia Seni Pertunjukan Kalimantan Selatan</em> (2019).</li>
  <li>📚 Kemendikbud RI — Sertifikat Warisan Budaya Tak Benda: Mamanda.</li>
  <li>📚 Alfani Daud, <em>Islam dan Masyarakat Banjar</em> (1997), LIPI Press.</li>
  <li>🌐 Wikipedia Bahasa Indonesia: Mamanda.</li>
</ul>
HTML;
    }

    private function createQuizzes(Material $material): void
    {
        if ($material->quizzes()->count() > 0) return;

        // Pretest
        $pretest = $material->quizzes()->create([
            'title'       => 'Pretest: ' . $material->title,
            'quiz_type'   => 'pretest',
            'description' => 'Kerjakan kuis awal ini.',
            'teacher_id'  => $this->teacherId,
        ]);
        $pretest->questions()->create([
            'question'       => 'Seni budaya apa yang menjadi fokus dalam materi ini?',
            'type'           => 'multiple_choice',
            'options'        => ['Kesenian Banjar', 'Kesenian Dayak', 'Kesenian Jawa', 'Kesenian Bali'],
            'correct_answer' => 'Kesenian Banjar',
            'explanation'    => 'Materi ini membahas kebudayaan Suku Banjar secara spesifik.'
        ]);

        // Posttest
        $posttest = $material->quizzes()->create([
            'title'       => 'Posttest: ' . $material->title,
            'quiz_type'   => 'posttest',
            'description' => 'Evaluasi akhir materi.',
            'teacher_id'  => $this->teacherId,
        ]);
        $posttest->questions()->create([
            'question'       => 'Apa yang membedakan budaya ini dengan yang lain?',
            'type'           => 'multiple_choice',
            'options'        => ['Kekayaan seni dan alat musik', 'Tidak ada yang beda', 'Hanya meniru', 'Berasal dari luar negeri'],
            'correct_answer' => 'Kekayaan seni dan alat musik',
            'explanation'    => 'Suku Banjar sangat kaya akan seni teater dan alat musik panting.'
        ]);
    }
}
