<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KutaiMaterialSeeder extends Seeder
{
    private int $teacherId = 1; // Bu Sari Guru

    public function run(): void
    {
        $this->createTariJepen();
        $this->createPestaAdatErau();
        $this->createSapeKutai();
    }

    private function createTariJepen(): void
    {
        $material = Material::firstOrCreate(
            ['title' => 'Tari Jepen – Keanggunan Suku Kutai', 'category' => 'kutai'],
            [
                'slug'            => 'tari-jepen-keanggunan-suku-kutai',
                'description'     => 'Temukan keindahan Tari Jepen, tarian tradisional Suku Kutai yang memadukan gerakan anggun dengan irama Melayu yang merdu.',
                'kompetensi_dasar'=> 'Memahami seni tari Jepen Kutai.',
                'pertemuan_ke'    => 11,
                'status'          => 'approved',
                'teacher_id'      => $this->teacherId,
                'content'         => $this->contentTariJepen(),
                'image'           => 'https://placehold.co/800x450/991b1b/ffffff?text=Tari+Jepen+Kutai',
                'video_url'       => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'
            ]
        );

        $this->createQuizzes($material);
    }

    private function contentTariJepen(): string
    {
        return <<<'HTML'
<h2>Tari Jepen: Identitas Budaya Masyarakat Kutai</h2>
<p><strong>Tari Jepen</strong> adalah salah satu tarian tradisional paling populer dan ikonik dari Suku Kutai di Kalimantan Timur dan sebagian Kalimantan Utara. Tarian ini bukan sekadar hiburan — ia adalah ekspresi jiwa masyarakat Kutai yang kaya akan perpaduan budaya Melayu, pengaruh Islam, dan kearifan lokal Borneo. Jepen sering hadir dalam berbagai momen penting kehidupan masyarakat Kutai, dari penyambutan tamu hingga upacara adat besar.</p>
<p>Nama "Jepen" diyakini berasal dari kata "jepen" atau "japeng" dalam dialek Melayu Kutai yang berarti "bergembira bersama" — sebuah nama yang sangat mencerminkan semangat tarian ini: inklusif, riang, dan mempererat tali persaudaraan.</p>

<h2>Sejarah dan Asal Usul</h2>
<p>Tari Jepen memiliki akar historis yang erat dengan <strong>Kesultanan Kutai Kartanegara ing Martapura</strong> — kerajaan Islam tertua di Kalimantan yang telah berdiri sejak abad ke-16. Tarian ini lahir dari perpaduan budaya setempat dengan pengaruh budaya Melayu pesisir yang dibawa oleh pedagang dan ulama dari Semenanjung Melayu serta Sumatera.</p>
<p>Pada masa kejayaan Kesultanan Kutai, Tari Jepen dipentaskan di lingkungan keraton sebagai tarian penyambutan tamu kerajaan dan perayaan hari besar Islam. Setelah masa kolonial, tarian ini menyebar ke masyarakat umum dan berkembang menjadi tari rakyat yang dicintai berbagai kalangan.</p>

<h2>Ragam Tari Jepen</h2>
<table>
  <tr><th>Nama Ragam</th><th>Deskripsi</th><th>Konteks Pertunjukan</th></tr>
  <tr><td>Jepen Klasik (Keraton)</td><td>Ragam asli dari tradisi istana. Gerakan lebih formal, tertib, dan mengikuti pakem yang ketat.</td><td>Upacara adat resmi, penyambutan tamu negara.</td></tr>
  <tr><td>Jepen Tali</td><td>Variasi yang menggunakan properti tali atau selendang sebagai elemen koreografi. Lebih dinamis dan atraktif secara visual.</td><td>Festival budaya, pentas seni sekolah.</td></tr>
  <tr><td>Jepen Kembang</td><td>Tarian yang menampilkan gerakan lembut menyerupai bunga yang mekar dan mengayun. Dominan dibawakan oleh penari perempuan.</td><td>Penyambutan tamu, perayaan pernikahan adat.</td></tr>
  <tr><td>Jepen Modern Kreasi</td><td>Pengembangan kontemporer yang memadukan gerakan Jepen dengan elemen tari modern.</td><td>Lomba tari, festival nasional dan internasional.</td></tr>
</table>
<p><em>Sumber: Dinas Kebudayaan dan Pariwisata Kalimantan Timur — Katalog Seni Tari Kutai (2020).</em></p>

<h2>Gerakan Tari Jepen</h2>
<ul>
  <li>👣 <strong>Langkah kaki cepat dan ritmis:</strong> Gerakan kaki yang dinamis dan berirama — maju, mundur, ke samping, dan berputar — dilakukan dengan presisi tinggi. Kecepatan kaki mengikuti irama gambus menciptakan efek visual yang sangat memukau.</li>
  <li>🙌 <strong>Gerakan tangan melambai:</strong> Tangan bergerak lembut mengalun seperti ombak laut — melambangkan keanggunan dan kelemah-lembutan masyarakat pesisir Kutai.</li>
  <li>💫 <strong>Putaran dan perputaran:</strong> Penari sering melakukan putaran badan yang anggun, baik sendiri maupun berpasangan, yang menciptakan visual indah terutama saat kostum berputar.</li>
  <li>🌊 <strong>Sinkronisasi rombongan:</strong> Dalam Jepen kelompok, sinkronisasi antar-penari adalah kunci — gerakan yang serempak dan harmonis menciptakan keindahan visual yang memukau.</li>
</ul>

<h2>Musik Pengiring</h2>
<table>
  <tr><th>Instrumen</th><th>Peran</th></tr>
  <tr><td>Gambus</td><td>Alat musik petik utama yang memberikan melodi dasar bertema Melayu-Islami.</td></tr>
  <tr><td>Ketipak dan Gendang</td><td>Perkusi yang menentukan tempo dan ritme tarian.</td></tr>
  <tr><td>Biola Melayu</td><td>Memberikan melodi yang melengkapi gambus dengan nuansa yang lebih halus.</td></tr>
  <tr><td>Suara vokal (kadang)</td><td>Syair berbahasa Melayu-Kutai berisi pujian kepada Tuhan, nasihat kehidupan, atau ungkapan kegembiraan.</td></tr>
</table>

<h2>Tari Jepen dan Nilai-Nilai Islami</h2>
<ul>
  <li>🕌 Kostum yang menutup aurat mencerminkan norma Islam yang dipegang teguh masyarakat Kutai.</li>
  <li>🎵 Syair pengiring sering berisi shalawat dan pujian kepada Allah.</li>
  <li>🤝 Gerakan tangan yang terbuka dan bersalaman mencerminkan nilai silaturahmi dalam Islam.</li>
  <li>🌟 Tidak ada kontak fisik langsung antara penari pria dan wanita dalam ragam Jepen yang umum dipentaskan.</li>
</ul>

<h2>Pelestarian dan Pengembangan</h2>
<ul>
  <li>🏣 Diajarkan di sekolah-sekolah Kalimantan Timur sebagai bagian dari muatan lokal Seni Budaya.</li>
  <li>🏆 Lomba Tari Jepen digelar dalam Festival Erano Adat Kutai tahunan.</li>
  <li>🌐 Sanggar-sanggar tari aktif mengajarkan Jepen kepada generasi muda di Tenggarong, Samarinda, dan kota-kota Kaltara.</li>
</ul>

<h2>Referensi dan Sumber Belajar</h2>
<ul>
  <li>📚 Balai Pelestarian Nilai Budaya (BPNB) Samarinda — <em>Dokumentasi Tari Tradisional Kutai</em> (2019).</li>
  <li>📚 Dinas Kebudayaan dan Pariwisata Kalimantan Timur — <em>Katalog Seni Tari Kutai</em> (2020).</li>
  <li>📚 Kemendikbud RI — <em>Modul Ajar Seni Budaya: Kebudayaan Kutai</em> (2022).</li>
  <li>🌐 Wikipedia Bahasa Indonesia: Tari Jepen.</li>
</ul>
HTML;
    }

    private function createPestaAdatErau(): void
    {
        $material = Material::firstOrCreate(
            ['title' => 'Pesta Adat Erau', 'category' => 'kutai'],
            [
                'slug'            => 'pesta-adat-erau-suku-kutai',
                'description'     => 'Erau adalah perayaan adat budaya Kutai yang penuh dengan ritual, seni, dan hiburan rakyat.',
                'kompetensi_dasar'=> 'Menganalisis upacara adat dan tradisi Kutai.',
                'pertemuan_ke'    => 12,
                'status'          => 'approved',
                'teacher_id'      => $this->teacherId,
                'content'         => $this->contentErau(),
                'image'           => 'https://placehold.co/800x450/dc2626/ffffff?text=Pesta+Erau',
                'video_url'       => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'
            ]
        );

        $this->createQuizzes($material);
    }

    private function contentErau(): string
    {
        return <<<'HTML'
<h2>Erano: Festival Budaya Terbesar di Kalimantan</h2>
<p><strong>Pesta Adat Erano</strong> adalah festival budaya terbesar dan paling bersejarah bagi Kesultanan Kutai Kartanegara ing Martapura dan masyarakat Kalimantan Timur. Setiap tahun, ribuan pengunjung dari seluruh Indonesia dan mancanegara datang ke Kota Tenggarong untuk menyaksikan kemeriahan dan keagungan festival ini.</p>
<p>Kata <strong>"Erano"</strong> berasal dari bahasa Kutai kuno <em>"Eroh"</em> yang berarti ramai, riuh, atau penuh kegembiraan — sangat tepat menggambarkan suasana festival ini yang benar-benar semarak.</p>

<h2>Sejarah Panjang Erano</h2>
<p>Erano bukan festival yang lahir kemarin. Ia memiliki sejarah yang sangat panjang — diperkirakan telah ada sejak <strong>abad ke-13 atau ke-14</strong>, jauh sebelum Kesultanan Kutai Kartanegara memeluk Islam. Pada mulanya, Erano adalah ritual sakral yang hanya digelar dalam momen-momen paling penting keluarga kerajaan.</p>

<h2>Tiga Jenis Erano Asli</h2>
<table>
  <tr><th>Jenis Erano</th><th>Konteks</th><th>Keterangan</th></tr>
  <tr><td>Erano Penobatan Raja</td><td>Pengangkatan Sultan baru</td><td>Ritual paling sakral dan agung. Digelar untuk meresmikan Sultan baru naik tahta. Prosesinya sangat panjang dan kompleks.</td></tr>
  <tr><td>Erano Tepung Tawar</td><td>Peristiwa penting keluarga kerajaan</td><td>Digelar untuk menyucikan dan memberkati anggota keluarga kerajaan dalam peristiwa penting.</td></tr>
  <tr><td>Erano Pelas Benua</td><td>Bersih desa / tolak bala</td><td>Ritual membersihkan wilayah dari pengaruh buruk dan memohon keselamatan bagi seluruh rakyat.</td></tr>
</table>
<p><em>Sumber: Balai Pelestarian Nilai Budaya (BPNB) Samarinda — Dokumentasi Upacara Adat Kutai (2018).</em></p>

<h2>Prosesi Ritual Utama</h2>

<h3>Ritual Beluluh Sultan (Mandi Kembang)</h3>
<p>Ritual pembersihan Sultan yang mengawali rangkaian Erano. Sultan dimandikan dengan air kembang tujuh rupa yang telah disakralkan melalui doa-doa adat. Ritual ini melambangkan pembaharuan dan pembersihan jiwa raja sebelum memimpin upacara.</p>

<h3>Mengulur Naga</h3>
<p>Salah satu prosesi paling spektakuler dan ikonik — <strong>replika naga raksasa</strong> sepanjang puluhan meter diarak dan diturunkan ke Sungai Mahakam sebagai persembahan dan harapan agar sungai memberi kehidupan yang baik bagi masyarakat. Naga dalam tradisi Kutai melambangkan kekuatan, keberuntungan, dan hubungan antara manusia dengan alam.</p>

<h3>Belimbur (Saling Siram)</h3>
<p>Bagian yang paling dinantikan! Belimbur adalah tradisi saling menyiram air yang dilakukan oleh seluruh peserta festival — tidak peduli sultan, pejabat, atau rakyat biasa, semua basah kuyup bersama. Belimbur melambangkan penyucian diri, kebersamaan, dan kesetaraan sosial di hadapan alam.</p>

<h2>Seni dan Budaya dalam Festival Erano</h2>
<ul>
  <li>💃 Penampilan Tari Jepen dan Kancet dari berbagai sub-suku Kutai, Dayak, Banjar, dan suku-suku lain di Kalimantan.</li>
  <li>🎭 Teater Tradisional — pertunjukan sendratari yang menceritakan kisah-kisah legenda Kerajaan Kutai.</li>
  <li>🎨 Pameran kriya dan kerajinan tangan pengrajin lokal — ukiran kayu, anyaman, kain tenun, dan perhiasan tradisional.</li>
  <li>🏹 Lomba adat tradisional seperti lomba dayung, lomba memanah, dan lomba memancing.</li>
  <li>🍽️ Pameran kuliner tradisional — Sate Payau (rusa), Nasi Bekepor, Amplang Kutai.</li>
  <li>🎑 Delegasi budaya dari negara-negara lain turut berpartisipasi, menjadikan Erano sebagai festival budaya berkelas internasional.</li>
</ul>

<h2>Waren Budaya Tak Benda</h2>
<p>Festival Erano telah diakui sebagai <strong>Warisan Budaya Tak Benda Nasional</strong> oleh Kementerian Pendidikan dan Kebudayaan RI. Pengakuan ini menegaskan pentingnya Erano sebagai aset budaya bangsa yang perlu dijaga dan dilestarikan.</p>

<h2>Referensi dan Sumber Belajar</h2>
<ul>
  <li>📚 Balai Pelestarian Nilai Budaya (BPNB) Samarinda — <em>Dokumentasi Upacara Adat Kutai: Erano</em> (2018).</li>
  <li>📚 Dinas Kebudayaan dan Pariwisata Kabupaten Kutai Kartanegara — <em>Panduan Festival Erano</em>.</li>
  <li>📚 Kemendikbud RI — Sertifikat Warisan Budaya Tak Benda: Erano Adat Kutai.</li>
  <li>🌐 Wikipedia Bahasa Indonesia: Erano (diakses 2024).</li>
</ul>
HTML;
    }

    private function createSapeKutai(): void
    {
        $material = Material::updateOrCreate(
            ['title' => 'Seni Ukir dan Kriya Kutai', 'category' => 'kutai'],
            [
                'slug'            => 'seni-ukir-dan-kriya-kutai',
                'description'     => 'Mengenal kerajinan tangan, kriya, dan ukiran khas Suku Kutai.',
                'kompetensi_dasar'=> 'Mengenal kriya lokal Kutai.',
                'pertemuan_ke'    => 13,
                'status'          => 'approved',
                'teacher_id'      => $this->teacherId,
                'content'         => $this->contentKriya(),
                'image'           => 'https://placehold.co/800x450/7f1d1d/ffffff?text=Kriya+Kutai',
                'video_url'       => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'
            ]
        );
        $this->createQuizzes($material);
    }

    private function contentKriya(): string
    {
        return <<<'HTML'
<h2>Kekayaan Seni Kriya Kutai</h2>
<p>Seni kriya Suku Kutai adalah cerminan dari kebudayaan yang telah matang dan kaya — perpaduan antara keahlian tangan yang diwariskan selama berabad-abad, pengaruh budaya Melayu yang halus, dan nilai-nilai Islam yang menjadi landasan moral. Kriya Kutai bukan sekadar produk kerajinan — setiap karya adalah seni yang berbicara tentang hubungan manusia dengan alam, leluhur, dan Tuhan.</p>

<h2>Ukiran Kayu Kutai</h2>
<p>Seni ukir kayu adalah salah satu warisan kriya paling prestisius dari Suku Kutai. Ukiran Kutai memiliki kekhasan tersendiri yang tidak mudah ditiru.</p>

<h3>Motif-Motif Ukiran Kutai</h3>
<table>
  <tr><th>Nama Motif</th><th>Bentuk</th><th>Makna Filosofis</th></tr>
  <tr><td>Motif Naga</td><td>Makhluk mitologis berbentuk ular naga bersisik</td><td>Kekuatan, keberuntungan, dan perlindungan. Naga adalah simbol kesultanan dan bangsawan Kutai.</td></tr>
  <tr><td>Motif Bunga Lotus/Teratai</td><td>Bunga teratai mekar dengan kelopak simetris</td><td>Kesucian, kebersihan jiwa, dan pencerahan spiritual.</td></tr>
  <tr><td>Motif Sulur Daun</td><td>Tanaman merambat dengan sulur yang melingkar-liuk</td><td>Kehidupan yang terus tumbuh, kesinambungan generasi, dan hubungan dengan alam.</td></tr>
  <tr><td>Motif Burung Enggang</td><td>Burung berciri paruh besar dan mahkota</td><td>Kemuliaan, kejayaan, dan hubungan dengan dunia atas (langit).</td></tr>
  <tr><td>Motif Geometris Islam</td><td>Bintang, arabesque, pola octagon</td><td>Nilai-nilai Islami — kesempurnaan, ketakwaan, dan keindahan ciptaan Tuhan.</td></tr>
</table>

<h2>Anyaman Kutai</h2>
<p>Seni anyaman adalah keahlian yang diwariskan dari ibu ke anak selama generasi demi generasi dalam keluarga-keluarga Kutai. Bahan baku utamanya adalah rotan, bambu, dan pandan yang tumbuh melimpah di hutan-hutan Kalimantan.</p>
<ul>
  <li>🧴 <strong>Tudung Saji (Penutup Makanan):</strong> Anyaman paling umum dan fungsional. Kini juga menjadi produk souvenir yang diminati wisatawan.</li>
  <li>👜 <strong>Tas Rotan:</strong> Tas rotan anyaman Kutai dikenal kualitasnya yang kuat dan desainnya yang unik. Telah masuk pasar nasional dan ekspor ke mancanegara.</li>
  <li>🛦 <strong>Tikar Pandan:</strong> Alas duduk/lantai dari daun pandan yang dianyam — kebutuhan rumah tangga yang juga bernilai seni tinggi bila bermotif.</li>
</ul>

<h2>Kain Tenun Kutai</h2>
<p>Tradisi tenun kain adalah warisan budaya yang sangat berharga dari masyarakat Kutai. Kain tenun Kutai dibuat secara manual menggunakan alat tenun tradisional yang menghasilkan kain dengan tekstur dan keindahan yang tidak bisa ditiru oleh mesin.</p>
<ul>
  <li>🧵 <strong>Teknik Songket:</strong> Kain tenun dengan benang emas atau perak yang diselipkan di antara benang dasar, menciptakan motif yang mengkilat dan mewah. Digunakan untuk busana adat bangsawan dan pengantin.</li>
  <li>🌈 <strong>Warna Tradisional:</strong> Warna-warna yang dominan digunakan adalah merah, emas, hijau, dan hitam — warna-warna yang memiliki makna simbolis dalam tradisi Melayu-Kutai.</li>
</ul>

<h2>Produk Kriya Ikonik Kutai</h2>
<ul>
  <li>🐟 <strong>Amplang Kutai:</strong> Kerupuk ikan khas Kutai dari ikan pipih atau ikan belida yang terkenal renyah dan gurih. Kini menjadi oleh-oleh populer dari Kaltim dan Kaltara.</li>
  <li>🔪 <strong>Mandau:</strong> Senjata tradisional Dayak-Kutai — pedang dengan bilah baja berkualitas tinggi dan gagang ukiran yang indah. Kini lebih banyak dibuat sebagai suvenir dan benda koleksi.</li>
  <li>💍 <strong>Perhiasan Emas Tradisional:</strong> Kerajinan emas dalam bentuk gelang, kalung, dan subang dengan motif khas Kutai — karya para pandai emas tradisional yang keahliannya semakin langka.</li>
</ul>

<h2>Pusat Kriya dan Galeri</h2>
<ul>
  <li>🏛️ <strong>Museum Mulawarman (Tenggarong):</strong> Museum utama Kutai yang menyimpan koleksi kriya dan benda-benda pusaka Kutai terlengkap. Wajib dikunjungi untuk memahami kedalaman budaya Kutai.</li>
  <li>🛍️ <strong>Pasar Seni Tenggarong:</strong> Tempat pengrajin lokal menjual langsung hasil karya tangan mereka.</li>
</ul>

<h2>Referensi dan Sumber Belajar</h2>
<ul>
  <li>📚 Balai Pelestarian Nilai Budaya (BPNB) Samarinda — <em>Kerajinan Tradisional Kutai</em> (2017).</li>
  <li>📚 Museum Mulawarman Tenggarong — <em>Katalog Koleksi Benda Budaya Kutai</em>.</li>
  <li>📚 Kemendikbud RI — <em>Modul Ajar Seni Budaya: Seni Kriya Nusantara</em> (2022).</li>
  <li>🌐 Wikipedia Bahasa Indonesia: Kutai Kartanegara, Erano.</li>
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
            'options'        => ['Kesenian Kutai', 'Kesenian Banjar', 'Kesenian Jawa', 'Kesenian Dayak'],
            'correct_answer' => 'Kesenian Kutai',
            'explanation'    => 'Materi ini membahas kebudayaan Suku Kutai secara spesifik.'
        ]);

        // Posttest
        $posttest = $material->quizzes()->create([
            'title'       => 'Posttest: ' . $material->title,
            'quiz_type'   => 'posttest',
            'description' => 'Evaluasi akhir materi.',
            'teacher_id'  => $this->teacherId,
        ]);
        $posttest->questions()->create([
            'question'       => 'Apa nilai penting yang dapat dipelajari dari kebudayaan Kutai?',
            'type'           => 'multiple_choice',
            'options'        => ['Pelestarian tradisi leluhur', 'Nilai materialisme', 'Sikap acuh terhadap sejarah', 'Budaya luar'],
            'correct_answer' => 'Pelestarian tradisi leluhur',
            'explanation'    => 'Tradisi seperti Pesta Erau sangat kental dengan pelestarian leluhur.'
        ]);
    }
}
