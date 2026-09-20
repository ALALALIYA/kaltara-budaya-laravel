<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TidungMaterialSeeder extends Seeder
{
    private int $teacherId = 1; // Bu Sari Guru

    public function run(): void
    {
        $this->createIrawTengkayu();
        $this->createTariJepenTidung();
        $this->createBahasaTidung();
    }

    private function createIrawTengkayu(): void
    {
        $material = Material::firstOrCreate(
            ['title' => 'Festival Iraw Tengkayu – Pesta Laut Suku Tidung', 'category' => 'tidung'],
            [
                'slug'            => 'festival-iraw-tengkayu-pesta-laut-suku-tidung',
                'description'     => 'Saksikan kemeriahan Festival Iraw Tengkayu, perayaan syukur laut Suku Tidung yang digelar meriah di Kota Tarakan.',
                'kompetensi_dasar'=> 'Menganalisis upacara adat dan perayaan Suku Tidung.',
                'pertemuan_ke'    => 14,
                'status'          => 'approved',
                'teacher_id'      => $this->teacherId,
                'content'         => $this->contentIrawTengkayu(),
                'image'           => 'https://placehold.co/800x450/1e3a8a/ffffff?text=Iraw+Tengkayu+Tidung',
                'video_url'       => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'
            ]
        );

        $this->createQuizzes($material);
    }

    private function contentIrawTengkayu(): string
    {
        return <<<'HTML'
<h2>Iraw Tengkayu: Pesta Syukur Laut Suku Tidung</h2>
<p><strong>Festival Iraw Tengkayu</strong> adalah perayaan adat terbesar dan paling ikonik dari Suku Tidung — masyarakat asli yang telah lama mendiami wilayah pesisir Kalimantan Utara, terutama di Kota Tarakan, Nunukan, dan Kabupaten Tana Tidung. Festival ini merupakan ungkapan rasa syukur kepada Tuhan atas hasil laut yang melimpah serta permohonan keselamatan bagi para nelayan dan seluruh masyarakat yang hidupnya bergantung pada lautan.</p>
<p>Kata <strong>"Iraw"</strong> dalam bahasa Tidung berarti "pesta" atau "perayaan", sementara <strong>"Tengkayu"</strong> merujuk pada ritual inti festival ini — penurunan perahu sakral ke laut. Bersama-sama, Iraw Tengkayu berarti "Pesta Menurunkan Perahu" — sebuah nama yang sangat tepat menggambarkan prosesi paling spektakuler dalam festival ini.</p>

<h2>Sejarah dan Latar Belakang</h2>
<p>Suku Tidung adalah masyarakat pesisir yang sejak lama menjalin hubungan yang sangat erat dengan laut. Dalam kepercayaan dan kosmologi tradisional Tidung, laut adalah sumber kehidupan sekaligus entitas yang memiliki kekuatan spiritual — sehingga perlu dihormati, dijaga, dan diberi persembahan secara rutin.</p>
<p>Festival Iraw Tengkayu diyakini telah ada sejak ratusan tahun lalu sebagai ritual syukur nelayan-nelayan Tidung setelah musim tangkap yang berlimpah. Sejak Kota Tarakan resmi berdiri dan berkembang, Festival Iraw Tengkayu menjadi agenda budaya tahunan yang dikelola secara resmi oleh Pemerintah Kota Tarakan, digelar setiap <strong>dua tahun sekali</strong> — biasanya pada bulan Oktober.</p>

<h2>Prosesi dan Ritual Utama</h2>

<h3>Ritual Pembukaan dan Doa Adat</h3>
<p>Festival dimulai dengan doa-doa adat yang dipimpin oleh <em>tetua adat Tidung</em>. Doa-doa ini memadukan unsur tradisi leluhur dengan nilai-nilai Islam yang telah dianut mayoritas Suku Tidung, memohon keselamatan, berkah, dan kelimpahan dari Yang Maha Kuasa.</p>

<h3>Penurunan Padaw Tuju Dulung (Inti Ritual)</h3>
<p>Ini adalah momen paling sakral dan dramatis dalam seluruh festival. <strong>Padaw Tuju Dulung</strong> — yang secara harfiah berarti "Perahu Tujuh Haluan" — adalah replika perahu tradisional Tidung berukuran besar (panjang bisa mencapai 15–20 meter) yang dihias sangat meriah dengan ornamen warna-warni, bendera, bunga, sesajen, dan berbagai perlengkapan adat.</p>
<p>Perahu ini diarak dengan penuh kegembiraan oleh ratusan orang dari pusat kota menuju tepi laut, kemudian diturunkan ke dalam air sebagai persembahan dan harapan. Angka tujuh dalam "Tuju Dulung" memiliki makna spiritual — tujuh adalah angka keberuntungan dalam tradisi Tidung yang melambangkan kesempurnaan dan keberkahan.</p>

<h3>Arak-arakan Budaya</h3>
<ul>
  <li>💃 Penari-penari Zapin Tidung berbusana adat lengkap</li>
  <li>🥁 Kelompok musik tradisional memainkan gambus, ketipak, dan gong</li>
  <li>👑 Para tokoh adat dan pemimpin masyarakat Tidung dalam busana resmi kebesaran</li>
  <li>🎎 Barisan pembawa sesajen dan persembahan</li>
  <li>🎪 Kelompok-kelompok seni dari berbagai komunitas di Tarakan</li>
</ul>

<h2>Makna dan Nilai yang Terkandung</h2>
<table>
  <tr><th>Nilai</th><th>Penjelasan</th></tr>
  <tr><td>🙏 Syukur dan Ketundukan</td><td>Rasa terima kasih kepada Tuhan atas rezeki laut yang melimpah. Pengakuan bahwa manusia tergantung pada alam dan Sang Pencipta.</td></tr>
  <tr><td>🤝 Solidaritas Komunitas</td><td>Festival menyatukan seluruh elemen masyarakat — dari sultan adat hingga nelayan biasa — dalam satu perayaan bersama.</td></tr>
  <tr><td>🌊 Hubungan dengan Laut</td><td>Penegasan ulang ikatan historis dan spiritual Suku Tidung dengan laut sebagai sumber identitas dan kehidupan.</td></tr>
  <tr><td>🎭 Pelestarian Budaya</td><td>Festival menjadi media transmisi budaya yang efektif — mengenalkan tradisi kepada generasi muda dalam konteks yang hidup dan bermakna.</td></tr>
  <tr><td>🌏 Diplomasi Budaya</td><td>Festival menarik wisatawan domestik dan mancanegara, mempromosikan kekayaan budaya Kaltara di panggung yang lebih luas.</td></tr>
</table>

<h2>Iraw Tengkayu dan Identitas Kalimantan Utara</h2>
<p>Sejak pembentukan Provinsi Kalimantan Utara pada 2012, Festival Iraw Tengkayu semakin strategis posisinya sebagai <strong>festival kebudayaan unggulan Kaltara</strong>. Pemerintah Provinsi Kaltara mendukung penuh penyelenggaraan festival ini sebagai salah satu ikon budaya provinsi termuda di Indonesia.</p>

<h2>Referensi dan Sumber Belajar</h2>
<ul>
  <li>📚 Dinas Kebudayaan dan Pariwisata Kota Tarakan — <em>Panduan Festival Iraw Tengkayu</em>.</li>
  <li>📚 Balai Pelestarian Nilai Budaya (BPNB) Samarinda — <em>Dokumentasi Upacara Adat Suku Tidung</em> (2019).</li>
  <li>📚 BPS Kota Tarakan — <em>Statistik Pariwisata dan Budaya Tarakan</em> (2022).</li>
  <li>📚 Kemendikbud RI — <em>Modul Ajar Seni Budaya: Kebudayaan Kalimantan Utara</em> (2022).</li>
  <li>🌐 Wikipedia Bahasa Indonesia: Iraw Tengkayu (diakses 2024).</li>
</ul>
HTML;
    }

    private function createTariJepenTidung(): void
    {
        $material = Material::firstOrCreate(
            ['title' => 'Tari Zapin Tidung', 'category' => 'tidung'],
            [
                'slug'            => 'tari-zapin-tidung',
                'description'     => 'Tari tradisional Zapin yang dibawakan oleh masyarakat Suku Tidung, kental dengan nuansa pesisir dan pengaruh Islam.',
                'kompetensi_dasar'=> 'Memahami seni tari Pesisir.',
                'pertemuan_ke'    => 15,
                'status'          => 'approved',
                'teacher_id'      => $this->teacherId,
                'content'         => $this->contentZapin(),
                'image'           => 'https://placehold.co/800x450/2563eb/ffffff?text=Zapin+Tidung',
                'video_url'       => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'
            ]
        );

        $this->createQuizzes($material);
    }

    private function contentZapin(): string
    {
        return <<<'HTML'
<h2>Tari Zapin Tidung: Keindahan Pesisir yang Penuh Makna</h2>
<p><strong>Tari Zapin Tidung</strong> adalah tarian tradisional yang telah menjadi bagian integral dari kehidupan budaya Suku Tidung di Kalimantan Utara. Tarian ini merupakan varian lokal dari tradisi Zapin — genre tari Melayu-Islam yang tersebar luas di seluruh Nusantara pesisir, dari Riau hingga Kalimantan, dengan ciri khas yang unik di setiap daerahnya.</p>

<h2>Akar Sejarah: Zapin dan Islam</h2>
<p>Tradisi Zapin memiliki akar yang sangat dalam dalam sejarah penyebaran Islam di Nusantara. Secara historis, Zapin diyakini berasal dari <strong>Hadhramaut, Yaman</strong> — wilayah yang banyak menghasilkan ulama dan pedagang Muslim yang kemudian menyebar ke seluruh kawasan Asia Tenggara. Di Kalimantan Utara, Zapin masuk bersamaan dengan masuknya Islam ke komunitas Tidung — yang diyakini berlangsung pada abad ke-15 hingga ke-17.</p>

<h2>Karakteristik Gerakan Tari Zapin Tidung</h2>
<ul>
  <li>👣 <strong>Langkah Kaki yang Cepat dan Ritmis:</strong> Gerakan kaki adalah elemen paling dominan dalam Zapin Tidung. Langkah-langkah cepat yang berirama — maju, mundur, ke samping, dan berputar — dilakukan dengan presisi yang tinggi.</li>
  <li>🙌 <strong>Gerakan Tangan yang Sopan dan Terkontrol:</strong> Zapin Tidung mempertahankan gerakan tangan yang lebih terkontrol dan sopan — mencerminkan nilai-nilai kesopanan dan kehalusan budi yang dijunjung tinggi dalam budaya Melayu-Islam.</li>
  <li>🤸 <strong>Tubuh Tegak dan Anggun:</strong> Postur tubuh dalam Zapin Tidung selalu tegak — tidak membungkuk secara dramatis. Ini mencerminkan martabat dan rasa percaya diri yang menjadi nilai penting dalam tradisi Melayu.</li>
  <li>💫 <strong>Variasi Tempo:</strong> Dalam satu pertunjukan Zapin, tempo bisa bervariasi dari lambat-mengalun (pada bagian pembukaan) hingga sangat cepat-enerjik (pada klimaks tarian).</li>
  <li>🌊 <strong>Gerakan Bergelombang:</strong> Beberapa ragam gerak Zapin Tidung mengimitasi gerakan ombak laut — bergelombang dan mengalir — yang mencerminkan kedekatan Suku Tidung dengan kehidupan pesisir.</li>
</ul>

<h2>Musik Pengiring Zapin Tidung</h2>
<table>
  <tr><th>Instrumen</th><th>Peran</th><th>Deskripsi</th></tr>
  <tr><td>Gambus (Ud)</td><td>Melodi Utama</td><td>Instrumen petik berkandung Arab yang menghasilkan melodi utama bertema Islami. Suaranya hangat dan soulful — jantung dari musik Zapin.</td></tr>
  <tr><td>Ketipak</td><td>Ritme Utama</td><td>Gendang kecil berbentuk trapesoid yang dipukul dengan tangan. Memberikan ritme yang tegas dan menentukan tempo tarian.</td></tr>
  <tr><td>Marwas</td><td>Ritme Pendukung</td><td>Gendang kecil berbentuk bulat — berpasangan dengan ketipak untuk menciptakan pola ritmis yang lebih kompleks dan kaya.</td></tr>
  <tr><td>Akordeon (opsional)</td><td>Harmoni</td><td>Dalam beberapa pertunjukan modern, akordeon ditambahkan untuk memperkaya harmoni dan memberikan tekstur suara yang lebih penuh.</td></tr>
</table>

<h2>Kostum dan Busana</h2>
<ul>
  <li>👗 <strong>Baju Kurung:</strong> Pakaian dasar yang menutup aurat — baju lengan panjang dengan rok panjang. Warna biasanya cerah: merah, kuning, hijau, atau biru.</li>
  <li>🧣 <strong>Jilbab / Tudung:</strong> Penutup kepala bagi penari perempuan — dalam gaya tradisional Melayu yang anggun.</li>
  <li>👔 <strong>Baju Teluk Belanga (pria):</strong> Busana Melayu tradisional untuk penari laki-laki, dilengkapi kain samping (setengah sarung) dan songkok hitam.</li>
  <li>💍 <strong>Aksesori:</strong> Gelang, subang (anting), dan kalung sederhana dari logam atau manik-manik yang tidak berlebihan — sesuai prinsip kesederhanaan dalam Islam.</li>
</ul>

<h2>Fungsi Sosial Tari Zapin</h2>
<ul>
  <li>💒 <strong>Pernikahan Adat:</strong> Zapin selalu hadir dalam setiap pernikahan adat Tidung — dimainkan sebagai hiburan dan penyemarak suasana, sekaligus sebagai berkah bagi pengantin.</li>
  <li>🕌 <strong>Perayaan Hari Besar Islam:</strong> Maulid Nabi, Isra Mi'raj, dan perayaan Lebaran menjadi momen di mana Zapin Tidung tampil sebagai bagian dari ekspresi keislaman komunitas.</li>
  <li>🎪 <strong>Festival Budaya:</strong> Tari Zapin Tidung selalu tampil dalam Festival Iraw Tengkayu dan festival budaya Kaltara lainnya sebagai representasi budaya Suku Tidung.</li>
  <li>📚 <strong>Pendidikan:</strong> Diajarkan di sekolah-sekolah di Tarakan dan Nunukan sebagai bagian dari muatan lokal Seni Budaya.</li>
</ul>

<h2>Pelestarian Zapin Tidung</h2>
<ul>
  <li>🏆 Lomba Zapin dalam berbagai festival budaya tingkat kota dan provinsi.</li>
  <li>🏣 Pengajaran di sekolah-sekolah sebagai muatan lokal wajib.</li>
  <li>🎓 Sanggar-sanggar seni Tidung yang aktif melatih penari muda.</li>
  <li>📺 Dokumentasi audio-visual oleh Disbudpar Kaltara dan TVRI Kaltara.</li>
</ul>

<h2>Referensi dan Sumber Belajar</h2>
<ul>
  <li>📚 Balai Pelestarian Nilai Budaya (BPNB) Samarinda — <em>Dokumentasi Seni Tari Tradisional Kalimantan Utara</em> (2019).</li>
  <li>📚 Disbudpar Kota Tarakan — <em>Profil Seni dan Budaya Suku Tidung</em> (2020).</li>
  <li>📚 Kemendikbud RI — <em>Modul Ajar Seni Budaya: Tari Zapin Nusantara</em> (2022).</li>
  <li>📚 Mohd. Anis Md Nor, <em>Zapin: Folk Dance of the Malay World</em> (1993), Oxford University Press.</li>
  <li>🌐 Wikipedia Bahasa Indonesia: Zapin, Suku Tidung.</li>
</ul>
HTML;
    }

    private function createBahasaTidung(): void
    {
        $material = Material::firstOrCreate(
            ['title' => 'Mengenal Bahasa dan Sastra Tidung', 'category' => 'tidung'],
            [
                'slug'            => 'mengenal-bahasa-dan-sastra-tidung',
                'description'     => 'Pengenalan mengenai bahasa daerah Tidung serta karya sastra lisan turun-temurun.',
                'kompetensi_dasar'=> 'Menganalisis sastra lisan daerah.',
                'pertemuan_ke'    => 16,
                'status'          => 'approved',
                'teacher_id'      => $this->teacherId,
                'content'         => $this->contentBahasa(),
                'image'           => 'https://placehold.co/800x450/1e40af/ffffff?text=Sastra+Tidung',
                'video_url'       => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'
            ]
        );
        $this->createQuizzes($material);
    }

    private function contentBahasa(): string
    {
        return <<<'HTML'
<h2>Bahasa Tidung: Suara Jiwa Masyarakat Pesisir Kaltara</h2>
<p><strong>Bahasa Tidung</strong> adalah bahasa asli yang digunakan oleh Suku Tidung — masyarakat yang telah lama mendiami wilayah pesisir Kalimantan Utara, terutama di Kota Tarakan, Kabupaten Nunukan, dan Kabupaten Tana Tidung. Bahasa ini bukan sekadar alat komunikasi — ia adalah jendela ke dalam jiwa budaya, sejarah, dan pandangan dunia masyarakat Tidung yang kaya dan unik.</p>

<h2>Klasifikasi Linguistik</h2>
<p>Secara ilmiah, Bahasa Tidung tergolong dalam rumpun bahasa <strong>Austronesia</strong> — keluarga bahasa terbesar di dunia yang meliputi bahasa-bahasa di Indonesia, Filipina, Malaysia, Madagaskar, hingga pulau-pulau Pasifik.</p>
<p>Lebih spesifik, Bahasa Tidung masuk dalam kelompok <strong>bahasa-bahasa Borneo Utara</strong> yang memiliki hubungan kekerabatan dengan beberapa bahasa suku lain di Kalimantan dan Sabah, Malaysia.</p>

<h2>Dialek-Dialek Bahasa Tidung</h2>
<table>
  <tr><th>Dialek</th><th>Wilayah Utama</th><th>Ciri Khas</th></tr>
  <tr><td>Tidung Tarakan</td><td>Kota Tarakan</td><td>Dialek yang paling banyak digunakan dan dianggap sebagai "dialek standar" Bahasa Tidung. Paling banyak terpapar pengaruh bahasa Indonesia.</td></tr>
  <tr><td>Tidung Sesayap</td><td>Kabupaten Tana Tidung</td><td>Dialek yang lebih konservatif dan mempertahankan lebih banyak kosakata asli yang sudah tidak umum di dialek Tarakan.</td></tr>
  <tr><td>Tidung Nunukan</td><td>Kabupaten Nunukan</td><td>Memiliki pengaruh lebih kuat dari bahasa suku-suku tetangga (Dayak, Bugis) dan dari bahasa Melayu Sabah di Malaysia.</td></tr>
</table>
<p><em>Sumber: Balai Bahasa Kalimantan Utara — Peta Bahasa Kalimantan Utara (2021).</em></p>

<h2>Kosakata Dasar Bahasa Tidung</h2>
<table>
  <tr><th>Bahasa Indonesia</th><th>Bahasa Tidung</th><th>Keterangan Penggunaan</th></tr>
  <tr><td>Selamat datang</td><td>Pumu do luang</td><td>Sapaan formal menyambut tamu</td></tr>
  <tr><td>Terima kasih</td><td>Salamat / Maki salama</td><td>Ucapan syukur dan terima kasih</td></tr>
  <tr><td>Air</td><td>Danum / Aig</td><td>Elemen paling penting bagi masyarakat pesisir</td></tr>
  <tr><td>Laut</td><td>Solok</td><td>Sumber kehidupan utama Suku Tidung</td></tr>
  <tr><td>Rumah</td><td>Baloy / Balai</td><td>Tempat tinggal dan pusat kehidupan komunitas</td></tr>
  <tr><td>Hutan</td><td>Utan</td><td>Sumber daya alam yang dijaga komunitas</td></tr>
  <tr><td>Makan</td><td>Kuman</td><td>Kegiatan sehari-hari yang juga bernilai sosial</td></tr>
</table>
<p><em>Catatan: [PERLU VERIFIKASI] kosakata di atas perlu dikonfirmasi dengan penutur asli atau Balai Bahasa Kalimantan Utara sebelum digunakan dalam konteks pembelajaran formal.</em></p>

<h2>Sastra Lisan Tidung: Kekayaan yang Tak Ternilai</h2>
<p>Jauh sebelum ada aksara dan tulisan, masyarakat Tidung telah memiliki tradisi <strong>sastra lisan</strong> yang sangat kaya — sebuah perpustakaan hidup yang disimpan dalam ingatan dan dituturkan dari generasi ke generasi melalui mulut para tetua, pengisah, dan seniman.</p>

<h3>1. Pantun Tidung</h3>
<p>Pantun Tidung memiliki struktur khas: biasanya terdiri dari 4 baris dengan rima akhir a-b-a-b. Contoh pantun yang mewakili gaya pantun Tidung:</p>
<blockquote>
  <p><em>Berlayar perahu ke pulau seberang,</em><br>
  <em>Membawa ikan hasil dari laut;</em><br>
  <em>Jaga adat jangan bercerai karang,</em><br>
  <em>Agar kampung kita tetap bersaut.</em></p>
</blockquote>

<h3>2. Cerita Rakyat (Dongeng Tidung)</h3>
<ul>
  <li>🐊 <strong>Legenda Buaya Putih Tarakan:</strong> Kisah tentang buaya putih yang menjadi penjaga Sungai Tidung dan memberi perlindungan kepada nelayan yang berbudi baik.</li>
  <li>👑 <strong>Kisah Raja-raja Tidung:</strong> Serangkaian cerita tentang raja-raja Kerajaan Tidung yang bijaksana dan pemberani, menjaga ingatan kolektif tentang sejarah kerajaan.</li>
  <li>🌊 <strong>Legenda Asal-usul Tarakan:</strong> Berbagai versi cerita tentang asal-usul Pulau Tarakan dan mengapa tempat ini menjadi pusat pemukiman Suku Tidung.</li>
</ul>

<h3>3. Mantra dan Doa Adat</h3>
<p>Mantra dan doa-doa adat Tidung merupakan bentuk sastra lisan yang paling sakral. Diucapkan oleh tetua adat dalam konteks ritual (penyembuhan, pernikahan, berlayar), mantra-mantra ini mengandung permohonan kepada kekuatan gaib dan alam.</p>

<h2>Tantangan dan Upaya Pelestarian</h2>
<ul>
  <li>📉 <strong>Penurunan Jumlah Penutur:</strong> Generasi muda Tidung cenderung lebih fasih berbahasa Indonesia daripada bahasa ibu mereka.</li>
  <li>📚 <strong>Minimnya Dokumentasi Tertulis:</strong> Bahasa Tidung belum memiliki kamus dan tata bahasa yang komprehensif yang dipublikasikan secara luas.</li>
  <li>🏣 Balai Bahasa Kalimantan Utara aktif mendokumentasikan dan meneliti Bahasa Tidung.</li>
  <li>📖 Program "Revitalisasi Bahasa Daerah" dari Kemendikbud RI mencakup Bahasa Tidung sebagai salah satu bahasa prioritas.</li>
  <li>🏣 Beberapa sekolah di Tarakan dan Tana Tidung mulai mengajarkan Bahasa Tidung sebagai muatan lokal.</li>
</ul>

<h2>Referensi dan Sumber Belajar</h2>
<ul>
  <li>📚 Balai Bahasa Kalimantan Utara — <em>Peta Bahasa Kalimantan Utara</em> (2021).</li>
  <li>📚 Kemendikbud RI — Program Revitalisasi Bahasa Daerah (2022–2024), data Bahasa Tidung.</li>
  <li>📚 Balai Pelestarian Nilai Budaya (BPNB) Samarinda — <em>Sastra Lisan Suku Tidung</em> (2018).</li>
  <li>📚 Yusuf Syarif, <em>Suku Tidung: Identitas dan Budaya Pesisir Kalimantan Utara</em>.</li>
  <li>🌐 Wikipedia Bahasa Indonesia: Suku Tidung, Bahasa Tidung.</li>
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
            'options'        => ['Kesenian Tidung', 'Kesenian Banjar', 'Kesenian Jawa', 'Kesenian Dayak'],
            'correct_answer' => 'Kesenian Tidung',
            'explanation'    => 'Materi ini membahas kebudayaan Suku Tidung secara spesifik.'
        ]);

        // Posttest
        $posttest = $material->quizzes()->create([
            'title'       => 'Posttest: ' . $material->title,
            'quiz_type'   => 'posttest',
            'description' => 'Evaluasi akhir materi.',
            'teacher_id'  => $this->teacherId,
        ]);
        $posttest->questions()->create([
            'question'       => 'Suku Tidung identik dengan lingkungan apa?',
            'type'           => 'multiple_choice',
            'options'        => ['Pesisir dan laut', 'Pegunungan tinggi', 'Gurun pasir', 'Hutan lebat'],
            'correct_answer' => 'Pesisir dan laut',
            'explanation'    => 'Kebudayaan Tidung sangat dekat dengan budaya pesisir, seperti Pesta Laut Iraw Tengkayu.'
        ]);
    }
}
