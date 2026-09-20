<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\User;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil akun guru sebagai pembuat materi
        $guru = User::where('role', 'teacher')->first();

        $materials = [
            [
                'title'       => 'Tari Hudoq – Ritual Sakral Suku Dayak',
                'slug'        => 'tari-hudoq-ritual-sakral-suku-dayak',
                'description' => 'Jelajahi keunikan Tari Hudoq, tarian sakral Suku Dayak yang penuh makna spiritual dan kental nuansa alam Kalimantan Utara.',
                'content'     => $this->contentDayak(),
                'image'       => 'https://placehold.co/800x450/166534/ffffff?text=Tari+Hudoq+Dayak',
                'video_url'   => null,
                'category'    => 'dayak',
                'teacher_id'  => $guru->id,
            ],
            [
                'title'       => 'Musik Panting – Harmoni Suku Banjar',
                'slug'        => 'musik-panting-harmoni-suku-banjar',
                'description' => 'Kenali Musik Panting, alat musik tradisional khas Suku Banjar yang melantunkan harmoni indah khas Kalimantan Utara.',
                'content'     => $this->contentBanjar(),
                'image'       => 'https://placehold.co/800x450/92400e/ffffff?text=Musik+Panting+Banjar',
                'video_url'   => null,
                'category'    => 'banjar',
                'teacher_id'  => $guru->id,
            ],
            [
                'title'       => 'Tari Jepen – Keanggunan Suku Kutai',
                'slug'        => 'tari-jepen-keanggunan-suku-kutai',
                'description' => 'Temukan keindahan Tari Jepen, tarian tradisional Suku Kutai yang memadukan gerakan anggun dengan irama Melayu yang merdu.',
                'content'     => $this->contentKutai(),
                'image'       => 'https://placehold.co/800x450/991b1b/ffffff?text=Tari+Jepen+Kutai',
                'video_url'   => null,
                'category'    => 'kutai',
                'teacher_id'  => $guru->id,
            ],
            [
                'title'       => 'Festival Iraw Tengkayu – Pesta Laut Suku Tidung',
                'slug'        => 'festival-iraw-tengkayu-pesta-laut-suku-tidung',
                'description' => 'Saksikan kemeriahan Festival Iraw Tengkayu, perayaan syukur laut Suku Tidung yang digelar meriah di Kota Tarakan setiap dua tahun sekali.',
                'content'     => $this->contentTidung(),
                'image'       => 'https://placehold.co/800x450/1e3a8a/ffffff?text=Iraw+Tengkayu+Tidung',
                'video_url'   => null,
                'category'    => 'tidung',
                'teacher_id'  => $guru->id,
            ],
            [
                'title'       => 'Rumah Baloy – Arsitektur Tradisional Kalimantan Utara',
                'slug'        => 'rumah-baloy-arsitektur-tradisional-kalimantan-utara',
                'description' => 'Kenali keunikan Rumah Baloy, rumah adat khas Kalimantan Utara yang kaya filosofi dan menjadi simbol identitas budaya masyarakat Kaltara.',
                'content'     => $this->contentRumahBaloy(),
                'image'       => 'https://placehold.co/800x450/3b1f0a/ffffff?text=Rumah+Baloy+Kaltara',
                'video_url'   => null,
                'category'    => null,
                'teacher_id'  => $guru->id,
            ],
            [
                'title'       => 'Tenun Tradisional – Warisan Kain Kalimantan Utara',
                'slug'        => 'tenun-tradisional-warisan-kain-kalimantan-utara',
                'description' => 'Telusuri keindahan tenun tradisional Kalimantan Utara, kain bercorak khas yang ditenun tangan dengan motif-motif alam dan budaya yang penuh makna.',
                'content'     => $this->contentTenun(),
                'image'       => 'https://placehold.co/800x450/7e22ce/ffffff?text=Tenun+Tradisional+Kaltara',
                'video_url'   => null,
                'category'    => null,
                'teacher_id'  => $guru->id,
            ],
            [
                'title'       => 'Mandau – Senjata Tradisional Kalimantan Utara',
                'slug'        => 'mandau-senjata-tradisional-kalimantan-utara',
                'description' => 'Pelajari sejarah dan filosofi Mandau, senjata tradisional ikonik yang bukan sekadar alat pertempuran, melainkan benda pusaka penuh makna spiritual.',
                'content'     => $this->contentMandau(),
                'image'       => 'https://placehold.co/800x450/7f1d1d/ffffff?text=Mandau+Senjata+Tradisional',
                'video_url'   => null,
                'category'    => null,
                'teacher_id'  => $guru->id,
            ],
            [
                'title'       => 'Kuliner Tradisional Kalimantan Utara',
                'slug'        => 'kuliner-tradisional-kalimantan-utara',
                'description' => 'Jelajahi kekayaan cita rasa kuliner tradisional Kalimantan Utara, dari masakan laut Tarakan hingga hidangan hutan pedalaman yang unik dan lezat.',
                'content'     => $this->contentKuliner(),
                'image'       => 'https://placehold.co/800x450/78350f/ffffff?text=Kuliner+Tradisional+Kaltara',
                'video_url'   => null,
                'category'    => null,
                'teacher_id'  => $guru->id,
            ],
            [
                'title'       => 'Seni Ukir dan Anyaman Kalimantan Utara',
                'slug'        => 'seni-ukir-anyaman-kalimantan-utara',
                'description' => 'Temukan keahlian para pengrajin Kalimantan Utara dalam seni ukir kayu dan anyaman rotan yang menghasilkan karya bernilai seni dan ekonomi tinggi.',
                'content'     => $this->contentUkirAnyaman(),
                'image'       => 'https://placehold.co/800x450/065f46/ffffff?text=Seni+Ukir+Anyaman+Kaltara',
                'video_url'   => null,
                'category'    => null,
                'teacher_id'  => $guru->id,
            ],
        ];

        foreach ($materials as $data) {
            $data['status'] = 'approved';
            Material::firstOrCreate(['slug' => $data['slug']], $data);
        }

        // Set any existing materials without status to approved
        Material::whereNull('status')->orWhere('status', '')->update(['status' => 'approved']);
    }

    private function contentDayak(): string
    {
        return <<<HTML
<h2>Apa itu Tari Hudoq?</h2>
<p>Tari Hudoq adalah tarian ritual sakral yang berasal dari Suku Dayak Bahau dan Dayak Modang di Kalimantan Utara. Tarian ini bukan sekadar hiburan — ia merupakan upacara spiritual yang dipersembahkan kepada roh leluhur untuk memohon kesuburan lahan dan hasil panen yang melimpah.</p>

<h2>Sejarah & Makna</h2>
<p>Tari Hudoq sudah ada sejak ratusan tahun lalu. Kata "Hudoq" berasal dari bahasa Dayak yang berarti "roh penolong". Para penari menggunakan topeng kayu berukir besar yang menggambarkan wajah roh-roh alam. Setiap topeng memiliki makna tersendiri yang diwariskan turun-temurun.</p>

<h2>Ciri Khas Tari Hudoq</h2>
<ul>
  <li>🎭 <strong>Topeng Kayu Besar</strong> – Diukir tangan dari kayu pilihan, menggambarkan roh pelindung.</li>
  <li>🌿 <strong>Kostum Daun Pisang</strong> – Seluruh tubuh penari ditutupi daun pisang dan rotan, melambangkan alam.</li>
  <li>🥁 <strong>Musik Garantung</strong> – Diiringi alat musik perkusi tradisional yang menggetarkan jiwa.</li>
  <li>🌾 <strong>Waktu Pelaksanaan</strong> – Dilakukan saat musim tanam padi sebagai doa memohon keberkahan.</li>
</ul>

<h2>Gerakan Tari</h2>
<p>Gerakan Tari Hudoq didominasi oleh langkah kaki yang berat dan bertenaga, melambangkan kekuatan roh. Tangan penari bergerak membentang lebar seperti sayap burung Enggang — burung suci orang Dayak. Tarian ini biasanya dilakukan secara berkelompok mengelilingi desa.</p>

<h2>Pelestarian di Era Modern</h2>
<p>Kini Tari Hudoq tidak hanya tampil dalam upacara adat, tetapi juga dipentaskan dalam festival budaya dan acara pariwisata di Kalimantan Utara. Pemerintah daerah aktif mendukung pelestarian tarian ini melalui sanggar-sanggar seni.</p>
HTML;
    }

    private function contentBanjar(): string
    {
        return <<<HTML
<h2>Mengenal Musik Panting</h2>
<p>Musik Panting adalah seni musik tradisional khas Suku Banjar yang ada di Kalimantan Utara. Nama "Panting" diambil dari alat musik utamanya — sebuah alat petik berdawai yang mirip dengan gitar kecil namun memiliki suara yang sangat khas dan merdu.</p>

<h2>Sejarah Musik Panting</h2>
<p>Musik Panting sudah berkembang sejak abad ke-17, dibawa oleh para pedagang dan nelayan Banjar yang menetap di pesisir Kalimantan. Awalnya musik ini dimainkan untuk mengiringi syair-syair puisi Melayu dan cerita rakyat.</p>

<h2>Alat Musik dalam Ensambel Panting</h2>
<ul>
  <li>🎸 <strong>Panting</strong> – Alat petik utama, dibuat dari kayu nangka dengan dawai rotan.</li>
  <li>🥁 <strong>Babun</strong> – Gendang kecil pemukul irama.</li>
  <li>🔔 <strong>Kangkung</strong> – Alat perkusi dari kuningan.</li>
  <li>🎵 <strong>Biola</strong> – Tambahan modern yang memperkaya melodi.</li>
</ul>

<h2>Fungsi Sosial</h2>
<p>Musik Panting memiliki peran penting dalam kehidupan masyarakat Banjar. Ia mengiringi upacara pernikahan, penyambutan tamu kehormatan, dan festival syukuran. Liriknya sering berisi nasihat bijak, ungkapan cinta, dan cerita kepahlawanan.</p>

<h2>Keunikan Suara</h2>
<p>Yang membuat Musik Panting istimewa adalah perpaduan antara melodi pentatonik Melayu dengan ritme yang lincah dan dinamis. Suaranya memiliki karakter hangat yang langsung menyentuh hati pendengar.</p>
HTML;
    }

    private function contentKutai(): string
    {
        return <<<HTML
<h2>Keindahan Tari Jepen</h2>
<p>Tari Jepen adalah tarian tradisional Suku Kutai yang memiliki unsur Melayu yang kental. Tarian ini terkenal dengan gerakannya yang anggun, lembut, namun penuh semangat. Tari Jepen biasanya dibawakan oleh penari perempuan dalam kelompok.</p>

<h2>Asal Usul</h2>
<p>Kata "Jepen" berasal dari kata "Japin" — tarian Melayu yang mendapat pengaruh budaya Arab. Suku Kutai yang memiliki akar sejarah kerajaan tertua di Indonesia ini kemudian mengembangkan tarian Japin menjadi Tari Jepen yang khas dengan nuansa Kalimantan.</p>

<h2>Ciri Khas Gerakan</h2>
<ul>
  <li>💃 <strong>Gerakan Lembut</strong> – Tangan bergerak lentur mengikuti irama, pinggul berayun perlahan.</li>
  <li>👣 <strong>Langkah Sinkron</strong> – Para penari bergerak serentak membentuk formasi indah.</li>
  <li>🌺 <strong>Kostum Berwarna</strong> – Kain bermotif Melayu Kutai berwarna cerah dan mahkota bunga.</li>
  <li>🎶 <strong>Iringan Gambus</strong> – Diiringi gambus dan rebana yang berirama merdu.</li>
</ul>

<h2>Makna Tarian</h2>
<p>Tari Jepen bukan sekadar hiburan. Ia mencerminkan nilai-nilai kehalusan budi pekerti, kebersamaan, dan kegembiraan masyarakat Kutai. Tarian ini juga menjadi simbol akulturasi budaya Melayu, Arab, dan lokal Kalimantan yang harmonis.</p>

<h2>Tari Jepen di Masa Kini</h2>
<p>Tari Jepen kini menjadi tarian wajib dalam berbagai acara resmi pemerintahan Kalimantan Utara dan sering ditampilkan dalam festival seni budaya nasional. Banyak sekolah mengajarkan tarian ini sebagai bagian dari kurikulum seni budaya.</p>
HTML;
    }

    private function contentTidung(): string
    {
        return <<<HTML
<h2>Festival Iraw Tengkayu – Pesta Laut yang Meriah</h2>
<p>Iraw Tengkayu adalah festival budaya terbesar Suku Tidung yang digelar di Kota Tarakan, Kalimantan Utara. Nama "Iraw Tengkayu" berarti "Pesta di Atas Air" — sebuah perayaan syukur atas limpahan rezeki dari laut yang menghidupi masyarakat Tidung sejak berabad-abad.</p>

<h2>Sejarah Festival</h2>
<p>Festival ini bermula dari tradisi ritual laut Suku Tidung yang disebut "Sesajian Laut" — upacara melarung sesaji ke laut sebagai ungkapan syukur kepada Yang Maha Kuasa. Sejak tahun 2000-an, tradisi ini dikembangkan menjadi festival besar yang dihadiri ribuan pengunjung dari seluruh Indonesia.</p>

<h2>Rangkaian Kegiatan</h2>
<ul>
  <li>⛵ <strong>Parade Perahu Hias</strong> – Puluhan perahu dihias cantik dengan ornamen khas Tidung berlayar di Tarakan Bay.</li>
  <li>🎭 <strong>Tari Garay</strong> – Tarian sakral pembuka festival yang dilakukan di atas perahu.</li>
  <li>🌸 <strong>Pelarungan Sesaji</strong> – Sesaji berupa makanan dan bunga dilarung ke laut sebagai ungkapan syukur.</li>
  <li>🎊 <strong>Pameran Budaya</strong> – Pameran kerajinan, kuliner, dan busana tradisional Tidung.</li>
  <li>🏅 <strong>Kompetisi Seni</strong> – Lomba tari, musik, dan kerajinan tangan antar suku di Kaltara.</li>
</ul>

<h2>Filosofi Hidup Suku Tidung</h2>
<p>Festival ini mencerminkan filosofi hidup Suku Tidung: "Tau Sama Tau, Berat Sama Dipikul" — saling menghargai dan gotong royong. Laut bukan hanya sumber penghidupan, tetapi juga "saudara" yang harus dijaga dan dihormati.</p>

<h2>Jadwal & Lokasi</h2>
<p>Festival Iraw Tengkayu diselenggarakan setiap dua tahun sekali di Kota Tarakan, biasanya pada bulan Oktober. Festival ini telah masuk dalam Kalender Event Nasional Indonesia dan menjadi daya tarik wisata unggulan Kalimantan Utara.</p>
HTML;
    }

    private function contentRumahBaloy(): string
    {
        return <<<HTML
<h2>Apa itu Rumah Baloy?</h2>
<p>Rumah Baloy adalah rumah adat resmi Kalimantan Utara yang ditetapkan sebagai simbol budaya provinsi termuda Indonesia ini. Dibangun megah di ibu kota Tanjung Selor, Rumah Baloy Mayo menjadi pusat kebudayaan yang merangkul keragaman suku-suku di Kaltara.</p>

<h2>Arsitektur dan Desain</h2>
<p>Rumah Baloy memadukan unsur arsitektur dari empat suku utama Kalimantan Utara: Dayak, Banjar, Kutai, dan Tidung. Bangunannya berbentuk panggung — kaki rumah diangkat dari tanah — sebagai adaptasi terhadap kondisi alam Kalimantan yang lembab dan rawan banjir.</p>
<ul>
  <li>🏛️ <strong>Atap Perisai</strong> – Atap berbentuk pelana tinggi dengan ornamen tanduk kerbau sebagai penangkal bala.</li>
  <li>🌳 <strong>Material Kayu Ulin</strong> – Seluruh struktur utama menggunakan kayu ulin (kayu besi) Kalimantan yang sangat kuat dan tahan rayap.</li>
  <li>🎨 <strong>Ukiran Motif Dayak</strong> – Dinding dan tiang dihiasi ukiran bermotif flora-fauna khas Borneo: burung Enggang, naga, dan sulur daun.</li>
  <li>🪟 <strong>Ventilasi Alami</strong> – Jendela lebar dan ruang terbuka dirancang untuk sirkulasi udara tropis yang optimal.</li>
</ul>

<h2>Ruangan dan Fungsinya</h2>
<p>Rumah Baloy terdiri dari beberapa ruangan dengan fungsi adat yang spesifik:</p>
<ul>
  <li><strong>Serambi (Teras)</strong> – Ruang penyambutan tamu dan tempat musyawarah ringan.</li>
  <li><strong>Lamin (Aula Utama)</strong> – Ruang serbaguna untuk upacara adat dan pertemuan resmi.</li>
  <li><strong>Dapur Umum</strong> – Area memasak untuk kegiatan adat bersama.</li>
  <li><strong>Tempat Penyimpanan Pusaka</strong> – Ruang khusus menyimpan benda-benda adat bernilai tinggi.</li>
</ul>

<h2>Makna Filosofis</h2>
<p>Rumah Baloy bukan sekadar bangunan. Ia adalah wujud fisik dari filosofi "Kalimantan Utara Bersatu" — bahwa meskipun beragam suku dan budaya, seluruh masyarakat Kaltara hidup dalam satu atap persaudaraan. Setiap ornamen dan ruangannya menyimpan pesan moral tentang kebersamaan, keseimbangan dengan alam, dan penghormatan pada leluhur.</p>

<h2>Rumah Baloy sebagai Destinasi Wisata</h2>
<p>Kini Rumah Baloy Mayo di Tanjung Selor menjadi salah satu destinasi wisata budaya unggulan Kalimantan Utara. Pengunjung dapat menyaksikan pameran budaya, pertunjukan seni, dan memahami warisan leluhur Kaltara secara langsung di tempat yang autentik.</p>
HTML;
    }

    private function contentTenun(): string
    {
        return <<<HTML
<h2>Tenun Tradisional Kalimantan Utara</h2>
<p>Tenun tradisional adalah salah satu warisan budaya yang paling berharga dari Kalimantan Utara. Dibuat secara manual menggunakan alat tenun bukan mesin, setiap helai kain menyimpan cerita, doa, dan identitas budaya pembuatnya yang tidak ternilai harganya.</p>

<h2>Jenis-Jenis Kain Tenun Kaltara</h2>
<ul>
  <li>🧵 <strong>Kain Tenun Ulap Doyo</strong> – Terbuat dari serat tanaman doyo, kain ini adalah kebanggaan Suku Dayak. Motifnya menggambarkan fauna dan flora hutan Borneo dengan warna alami coklat, krem, dan hitam.</li>
  <li>🎨 <strong>Kain Tenun Sasirangan</strong> – Kain khas Banjar yang dibuat dengan teknik ikat celup, menghasilkan motif geometris warna-warni yang cerah.</li>
  <li>🌊 <strong>Kain Tenun Tidung</strong> – Bermotif gelombang laut dan bintang laut, mencerminkan kehidupan masyarakat pesisir Tidung.</li>
</ul>

<h2>Proses Pembuatan</h2>
<p>Membuat selembar kain tenun bisa memakan waktu berminggu-minggu hingga berbulan-bulan. Prosesnya meliputi:</p>
<ol>
  <li><strong>Mempersiapkan benang</strong> – Memintal serat alami (kapas, doyo) menjadi benang halus.</li>
  <li><strong>Mewarnai benang</strong> – Menggunakan pewarna alami dari tumbuhan: indigo (biru), kulit mahoni (coklat), kunyit (kuning).</li>
  <li><strong>Menggulung pada alat tenun</strong> – Benang dipasang rapi pada alat tenun tradisional.</li>
  <li><strong>Menenun</strong> – Penenun (biasanya perempuan) bersilang benang lungsin dan pakan dengan ritme yang meditatif.</li>
  <li><strong>Finishing</strong> – Kain dicuci, dihaluskan, dan siap dipakai.</li>
</ol>

<h2>Motif dan Maknanya</h2>
<p>Setiap motif tenun Kalimantan Utara memiliki makna mendalam:</p>
<ul>
  <li>🦅 <strong>Burung Enggang</strong> – Simbol kebebasan, keberanian, dan kemuliaan.</li>
  <li>🌿 <strong>Sulur Pakis</strong> – Melambangkan pertumbuhan, kesuburan, dan kehidupan yang terus berkembang.</li>
  <li>💎 <strong>Berlian/Wajik</strong> – Simbol kekuatan dan keteguhan hati.</li>
  <li>🐉 <strong>Naga</strong> – Penjaga alam bawah dan pembawa keberkahan dalam kepercayaan adat.</li>
</ul>

<h2>Pelestarian dan Ekonomi Kreatif</h2>
<p>Pemerintah Kalimantan Utara aktif mendorong pelestarian tenun tradisional melalui program pelatihan penenun muda, festival kain tradisional, dan mendorong penggunaan kain lokal dalam seragam dinas pemerintah. Banyak produk tenun Kaltara kini dipasarkan hingga ke mancanegara sebagai produk ekonomi kreatif bernilai tinggi.</p>
HTML;
    }

    private function contentMandau(): string
    {
        return <<<HTML
<h2>Mandau – Lebih dari Sekadar Senjata</h2>
<p>Mandau adalah senjata tradisional ikonik yang identik dengan budaya Kalimantan, termasuk Kalimantan Utara. Bentuknya khas: bilah melengkung satu sisi dengan ukiran indah dan gagang dari tanduk rusa atau tulang. Bagi masyarakat adat, Mandau bukan sekadar alat — ia adalah pusaka yang memiliki jiwa dan kekuatan spiritual.</p>

<h2>Sejarah Mandau</h2>
<p>Mandau telah digunakan oleh masyarakat Dayak sejak ribuan tahun lalu. Awalnya, Mandau digunakan sebagai senjata perang untuk melindungi kampung dan berburu di hutan. Seiring waktu, ia berkembang menjadi simbol status sosial, benda pusaka keluarga, dan karya seni yang dipuja.</p>

<h2>Bagian-Bagian Mandau</h2>
<ul>
  <li>🗡️ <strong>Bilah (Mata)</strong> – Dibuat dari besi pilihan atau baja, panjang 50–70 cm, melengkung seperti parang namun lebih tipis dan ringan. Sisi tajamnya menghadap ke luar lengkungan.</li>
  <li>🦌 <strong>Gagang (Hulu)</strong> – Terbuat dari tanduk rusa, tulang, atau kayu keras. Dihias dengan bulu burung Enggang dan manik-manik.</li>
  <li>🪵 <strong>Sarung (Kumpang)</strong> – Penutup bilah dari kayu ukir, dihias motif fauna dan flora khas Dayak. Biasanya dilengkapi pisau kecil (pisau raut) di sisinya.</li>
</ul>

<h2>Jenis-Jenis Mandau</h2>
<ul>
  <li><strong>Mandau Biasa</strong> – Mandau untuk penggunaan sehari-hari, berburu, dan bertani.</li>
  <li><strong>Mandau Hiasan</strong> – Mandau upacara dengan ukiran lebih halus dan ornamen mewah, tidak digunakan untuk kerja.</li>
  <li><strong>Mandau Pusaka</strong> – Mandau warisan yang dipercaya memiliki kekuatan magis dan dijaga dengan ritual khusus.</li>
</ul>

<h2>Proses Pembuatan</h2>
<p>Pembuatan Mandau adalah seni yang membutuhkan keahlian tinggi. Para pandai besi (pande besi) Dayak menggunakan teknik tempa tradisional — memanaskan besi dalam api, lalu memukul berkali-kali hingga membentuk bilah yang kuat dan tajam. Proses ini bisa memakan waktu beberapa hari hingga berminggu-minggu untuk satu buah Mandau berkualitas tinggi.</p>

<h2>Mandau dalam Budaya Modern</h2>
<p>Kini Mandau menjadi simbol kebanggaan budaya Kalimantan. Ia hadir dalam lambang daerah, seragam adat, dan sering dijadikan cinderamata premium. Pemerintah Kalimantan Utara mendorong pelestarian seni tempa Mandau sebagai warisan budaya tak benda yang perlu dijaga generasi muda.</p>
HTML;
    }

    private function contentKuliner(): string
    {
        return <<<HTML
<h2>Kekayaan Kuliner Kalimantan Utara</h2>
<p>Kalimantan Utara menawarkan kekayaan kuliner yang luar biasa — perpaduan cita rasa pesisir yang kaya hasil laut, masakan pedalaman yang khas, dan pengaruh budaya Melayu, Dayak, serta Banjar yang berbaur harmonis di atas piring.</p>

<h2>Kuliner Khas yang Wajib Dicoba</h2>

<h3>🦀 Kepiting Soka Tarakan</h3>
<p>Tarakan dikenal sebagai "Kota Kepiting" karena menghasilkan kepiting bakau berkualitas terbaik di Indonesia. Kepiting Soka adalah kepiting yang dipanen saat baru selesai berganti cangkang, sehingga seluruh tubuhnya bisa dimakan — termasuk cangkangnya yang masih lunak. Digoreng tepung renyah atau dimasak saus padang, ini adalah kuliner ikonik Kaltara.</p>

<h3>🍜 Nasi Kuning Kaltara</h3>
<p>Berbeda dengan nasi kuning di daerah lain, Nasi Kuning Kaltara disajikan dengan lauk khas seperti ikan patin masak kuning, acar timun, perkedel ikan, dan sambal goreng hati. Warna kuning dari kunyit melambangkan kemakmuran dan kegembiraan.</p>

<h3>🐟 Amplang Kaltara</h3>
<p>Amplang adalah kerupuk ikan khas Kalimantan yang dibuat dari ikan pipih atau ikan tenggiri yang dicampur tepung kanji, bawang putih, dan telur. Teksturnya renyah dan gurih, cocok sebagai camilan atau pelengkap makanan. Amplang Kaltara terkenal hingga ke seluruh Indonesia.</p>

<h3>🌿 Sayur Asam Kaltara</h3>
<p>Sayur Asam Kaltara menggunakan bahan-bahan khas hutan Borneo seperti rebung muda, daun melinjo, terong asam, dan ikan sungai. Kuahnya segar kemerahan dengan rasa asam dari belimbing wuluh dan tomat hijau.</p>

<h3>🍡 Dodol Rumput Laut</h3>
<p>Kalimantan Utara adalah salah satu penghasil rumput laut terbesar Indonesia. Dodol rumput laut adalah inovasi kuliner modern yang menggabungkan teknik membuat dodol tradisional dengan rumput laut segar, menghasilkan camilan kenyal manis yang unik dan menyehatkan.</p>

<h2>Pengaruh Budaya dalam Kuliner</h2>
<p>Keanekaragaman kuliner Kaltara mencerminkan akulturasi budayanya. Rempah-rempah Melayu-Banjar (lengkuas, serai, kunyit), teknik memasak bambu khas Dayak, dan pengaruh makanan laut Tidung berpadu menciptakan identitas kuliner yang unik dan tidak ditemukan di tempat lain.</p>

<h2>Kuliner sebagai Warisan Budaya</h2>
<p>Pemerintah Kalimantan Utara aktif mempromosikan kuliner tradisional sebagai bagian dari pariwisata budaya. Festival kuliner tahunan, lomba memasak antar suku, dan program "Warung Asli Kaltara" bertujuan melestarikan resep-resep warisan leluhur agar tidak punah ditelan zaman.</p>
HTML;
    }

    private function contentUkirAnyaman(): string
    {
        return <<<HTML
<h2>Seni Ukir dan Anyaman – Ekspresi Jiwa Kalimantan Utara</h2>
<p>Di antara sekian banyak warisan budaya Kalimantan Utara, seni ukir kayu dan anyaman rotan menonjol sebagai ekspresi kreativitas yang paling kaya dan beragam. Dua seni ini telah menjadi bagian tak terpisahkan dari kehidupan sehari-hari masyarakat Kaltara selama ribuan tahun.</p>

<h2>Seni Ukir Kayu Kaltara</h2>
<p>Ukiran kayu Kalimantan Utara terkenal dengan motif-motif yang kompleks dan penuh makna. Para pengukir (biasa disebut <em>mangkutak</em> dalam bahasa Dayak) menghabiskan bertahun-tahun mempelajari pola-pola tradisional yang diwariskan dari generasi ke generasi.</p>

<h3>Motif Utama dalam Ukiran Kaltara</h3>
<ul>
  <li>🦅 <strong>Motif Burung Enggang (Kenyalang)</strong> – Motif paling sakral dalam ukiran Dayak. Burung Enggang melambangkan roh leluhur, keberanian, dan ketinggian derajat. Hanya boleh diukir oleh pengukir yang telah menjalani ritual khusus.</li>
  <li>🐍 <strong>Motif Naga/Aso</strong> – Naga dalam budaya Dayak adalah penjaga alam bawah dan pembawa kemakmuran. Motifnya meliuk-liuk dinamis, sering menghiasi tiang rumah adat dan perahu.</li>
  <li>🌿 <strong>Motif Sulur (Pilin Berganda)</strong> – Motif abstrak berupa gulungan dan sulur yang saling berkelindan, melambangkan kesinambungan hidup dan hubungan manusia dengan alam.</li>
  <li>👁️ <strong>Motif Mata Aso</strong> – Motif berbentuk mata yang dipercaya memiliki kekuatan melindungi dan mengusir roh jahat.</li>
</ul>

<h3>Media Ukiran</h3>
<p>Ukiran Kaltara dikerjakan di berbagai media: dinding dan tiang rumah baloy, perahu adat, topeng ritual, patung leluhur, gagang Mandau, dan berbagai peralatan upacara. Kayu yang digunakan terutama kayu ulin (besi), kayu belian, dan kayu meranti yang tahan lama.</p>

<h2>Seni Anyaman Kaltara</h2>
<p>Anyaman adalah seni merangkai serat-serat tumbuhan menjadi berbagai benda fungsional dan dekoratif. Di Kalimantan Utara, anyaman dibuat dari berbagai bahan alami yang berlimpah di hutan Borneo.</p>

<h3>Bahan-Bahan Anyaman</h3>
<ul>
  <li>🪴 <strong>Rotan</strong> – Bahan paling umum, lentur namun kuat. Digunakan untuk membuat keranjang, tikar, kursi, dan perabot rumah.</li>
  <li>🌿 <strong>Pandan Hutan</strong> – Daunnya dipintal menjadi tikar, topi, dan tas. Permukaan halus dan wangi khas.</li>
  <li>🎋 <strong>Bambu</strong> – Bilah bambu dianyam menjadi dinding rumah, peralatan dapur, dan wadah makanan.</li>
  <li>🌱 <strong>Serat Doyo</strong> – Serat tanaman doyo digunakan untuk anyaman halus dan tenun.</li>
</ul>

<h3>Produk Anyaman Unggulan</h3>
<ul>
  <li><strong>Bakul/Keranjang</strong> – Wadah serbaguna untuk membawa hasil panen, menyimpan makanan, dan wadah upacara.</li>
  <li><strong>Tikar Anyam</strong> – Alas duduk dan tidur yang menjadi kebutuhan pokok setiap rumah tangga.</li>
  <li><strong>Topi Sugu (Terendak)</strong> – Topi pelindung matahari berbentuk kerucut lebar yang dipakai petani dan nelayan.</li>
  <li><strong>Tas Belida</strong> – Tas anyaman rotan bermotif geometris yang kini menjadi aksesori fashion bernilai tinggi.</li>
</ul>

<h2>Pelestarian dan Peluang Ekonomi</h2>
<p>Generasi muda Kaltara kini mulai mengangkat seni ukir dan anyaman ke panggung ekonomi kreatif. Produk anyaman Kaltara mulai merambah pasar ekspor — terutama ke Eropa dan Jepang yang mengapresiasi produk kerajinan tangan natural. Pemerintah daerah mendukung melalui inkubator UMKM kerajinan dan pameran internasional.</p>
HTML;
    }
}
