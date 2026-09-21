<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Seeder;

class KutaiMaterialSeeder extends Seeder
{
    public function run(): void
    {
        $guru = User::where('role', 'teacher')->first();

        $materials = [
            [
                'title' => 'Kerajaan Kutai dan Asal Usul Suku Kutai',
                'slug' => 'kerajaan-kutai-dan-asal-usul',
                'description' => 'Mempelajari akar sejarah Suku Kutai dari masa kerajaan Hindu tertua di Nusantara.',
                'kompetensi_dasar' => '3.1 Menganalisis sejarah Kerajaan Kutai Martadipura.',
                'pertemuan_ke' => 1,
                'content' => $this->contentSejarah(),
                'image' => 'https://placehold.co/800x450/991b1b/ffffff?text=Kerajaan+Kutai',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Kerajaan Kutai Martadipura diakui sebagai kerajaan bercorak apa yang tertua di Nusantara?', 'opts' => ['Kerajaan Islam', 'Kerajaan Hindu', 'Kerajaan Buddha', 'Kerajaan Kristen'], 'ans' => 'Kerajaan Hindu'],
                        ['q' => 'Bukti sejarah peninggalan Kerajaan Kutai berupa tiang batu bertuliskan huruf Pallawa disebut?', 'opts' => ['Prasasti Yupa', 'Prasasti Kedukan Bukit', 'Candi Borobudur', 'Arca Ganesha'], 'ans' => 'Prasasti Yupa'],
                        ['q' => 'Raja terkenal dari Kerajaan Kutai Martadipura yang memberikan sedekah 20.000 ekor sapi kepada kaum Brahmana adalah?', 'opts' => ['Raja Kudungga', 'Raja Mulawarman', 'Raja Aswawarman', 'Raja Hayam Wuruk'], 'ans' => 'Raja Mulawarman'],
                        ['q' => 'Lokasi pusat kerajaan Kutai kuno terletak di daerah hulu sungai apa di Kalimantan?', 'opts' => ['Sungai Kapuas', 'Sungai Barito', 'Sungai Mahakam', 'Sungai Kayan'], 'ans' => 'Sungai Mahakam'],
                        ['q' => 'Suku Kutai asli secara historis terbentuk dari asimilasi antara penduduk asli pedalaman (Dayak) dengan?', 'opts' => ['Pendatang Eropa', 'Pedagang Melayu dan India', 'Tentara Jepang', 'Penjajah Belanda'], 'ans' => 'Pedagang Melayu dan India'],
                    ],
                    'posttest' => [
                        ['q' => 'Kerajaan Kutai Kartanegara (bercorak Islam) akhirnya menaklukkan Kutai Martadipura. Siapakah pendiri Kutai Kartanegara?', 'opts' => ['Aji Batara Agung Dewa Sakti', 'Sultan Hasanuddin', 'Raja Mulawarman', 'Gajah Mada'], 'ans' => 'Aji Batara Agung Dewa Sakti'],
                        ['q' => 'Bahasa Kutai yang digunakan oleh masyarakat terbagi menjadi beberapa dialek. Salah satu dialek yang paling umum adalah?', 'opts' => ['Dialek Tenggarong', 'Dialek Banjarmasin', 'Dialek Tarakan', 'Dialek Nunukan'], 'ans' => 'Dialek Tenggarong'],
                        ['q' => 'Prasasti Yupa menggunakan bahasa kuno, yaitu?', 'opts' => ['Bahasa Indonesia', 'Bahasa Melayu Kuno', 'Bahasa Sansekerta', 'Bahasa Arab'], 'ans' => 'Bahasa Sansekerta'],
                        ['q' => 'Suku Kutai saat ini banyak mendiami wilayah Kabupaten Kutai Kartanegara di Provinsi mana?', 'opts' => ['Kalimantan Utara', 'Kalimantan Timur', 'Kalimantan Selatan', 'Kalimantan Barat'], 'ans' => 'Kalimantan Timur'],
                        ['q' => 'Identitas budaya Kutai merupakan perpaduan harmonis antara tiga unsur utama, yaitu?', 'opts' => ['Dayak, Melayu, dan Islam Keraton', 'Jawa, Bali, dan Sunda', 'Bugis, Makassar, dan Mandar', 'Cina, Arab, dan Eropa'], 'ans' => 'Dayak, Melayu, dan Islam Keraton'],
                    ]
                ]
            ],
            [
                'title' => 'Tari Jepen: Keanggunan Seni Melayu Kutai',
                'slug' => 'tari-jepen-keanggunan-kutai',
                'description' => 'Mengenal Tari Jepen yang elegan, hasil akulturasi budaya Islam dan lokal.',
                'kompetensi_dasar' => '3.2 Mengevaluasi gerak dan makna Tari Jepen.',
                'pertemuan_ke' => 2,
                'content' => $this->contentTariJepen(),
                'image' => 'https://placehold.co/800x450/991b1b/ffffff?text=Tari+Jepen',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Tari Jepen merupakan kesenian tari tradisional yang identik dengan suku?', 'opts' => ['Dayak', 'Banjar', 'Kutai', 'Tidung'], 'ans' => 'Kutai'],
                        ['q' => 'Nama "Jepen" diperkirakan diserap dari kata bahasa Arab atau tarian pesisir Melayu kuno yaitu?', 'opts' => ['Jaipong', 'Japin atau Zapin', 'Jathilan', 'Joged'], 'ans' => 'Japin atau Zapin'],
                        ['q' => 'Gerakan Tari Jepen sangat kental didominasi oleh unsur yang bersifat?', 'opts' => ['Agresif dan keras', 'Lembut, anggun, dan lincah kaki', 'Patah-patah tajam', 'Melompat-lompat tinggi (akrobat)'], 'ans' => 'Lembut, anggun, dan lincah kaki'],
                        ['q' => 'Kostum penari Jepen wanita Kutai menggunakan balutan kain warna-warni mengkilap serta memakai sanggul rambut berhias bunga yang disebut?', 'opts' => ['Sanggul Jawa', 'Sanggul Goyang', 'Siger', 'Mahkota Raja'], 'ans' => 'Sanggul Goyang'],
                        ['q' => 'Alat musik utama yang memberikan harmoni melodi Timur Tengah untuk Tari Jepen adalah?', 'opts' => ['Sape', 'Gambus', 'Gitar listrik', 'Suling'], 'ans' => 'Gambus'],
                    ],
                    'posttest' => [
                        ['q' => 'Gerakan khas kaki melangkah serentak ke depan dan belakang mengikuti ketukan pukulan rebana pada Tari Jepen melambangkan?', 'opts' => ['Keseragaman dan nilai kebersamaan gotong royong', 'Latihan baris berbaris militer', 'Kemarahan', 'Ketakutan kepada musuh'], 'ans' => 'Keseragaman dan nilai kebersamaan gotong royong'],
                        ['q' => 'Tari Jepen Eran adalah salah satu variasi Tari Jepen yang sering dipentaskan di?', 'opts' => ['Tengah hutan', 'Pesta rakyat dan penyambutan tamu', 'Upacara pemakaman', 'Medan pertempuran'], 'ans' => 'Pesta rakyat dan penyambutan tamu'],
                        ['q' => 'Dahulu kala, penari Jepen mayoritas adalah?', 'opts' => ['Anak kecil laki-laki', 'Pria dewasa (karena larangan wanita tampil publik di era ketat)', 'Hanya wanita tua', 'Bangsawan keraton murni'], 'ans' => 'Pria dewasa (karena larangan wanita tampil publik di era ketat)'],
                        ['q' => 'Gendang kecil berlapis kulit hewani yang dipukul untuk menjaga ritme gerak Jepen disebut?', 'opts' => ['Bedug', 'Rebana atau Ketipung', 'Tifa', 'Tambur'], 'ans' => 'Rebana atau Ketipung'],
                        ['q' => 'Nilai filosofis Tari Jepen mencerminkan keluhuran budi pekerti wanita yang sesuai dengan ajaran?', 'opts' => ['Animisme', 'Agama Islam yang santun', 'Ateisme', 'Dinamisme'], 'ans' => 'Agama Islam yang santun'],
                    ]
                ]
            ],
            [
                'title' => 'Erau: Festival Adat Kesultanan Kutai',
                'slug' => 'erau-festival-adat-kutai',
                'description' => 'Mempelajari upacara penobatan raja dan pesta rakyat tahunan Erau Kutai.',
                'kompetensi_dasar' => '3.3 Menganalisis nilai budaya dalam Festival Erau.',
                'pertemuan_ke' => 3,
                'content' => $this->contentErau(),
                'image' => 'https://placehold.co/800x450/991b1b/ffffff?text=Festival+Erau',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Festival atau upacara adat keraton terbesar dari Suku Kutai adalah?', 'opts' => ['Iraw Tengkayu', 'Erau (Erau Adat Pelas Benua)', 'Cap Go Meh', 'Lompat Batu'], 'ans' => 'Erau (Erau Adat Pelas Benua)'],
                        ['q' => 'Kata "Erau" berasal dari bahasa Kutai "Eroh" yang artinya?', 'opts' => ['Menangis', 'Ramai, riuh rendah, dan suasana gembira', 'Tidur', 'Makan'], 'ans' => 'Ramai, riuh rendah, dan suasana gembira'],
                        ['q' => 'Pada zaman Kesultanan Kutai kuno, upacara Erau pertama kali digelar dalam rangka?', 'opts' => ['Peringatan hari ulang tahun provinsi', 'Tijak tanah (turun tanah) dan pemberian nama putra mahkota', 'Keberangkatan pasukan perang', 'Pembangunan jembatan'], 'ans' => 'Tijak tanah (turun tanah) dan pemberian nama putra mahkota'],
                        ['q' => 'Hewan mitologi dari kain dan rangka bambu berwujud ular naga yang diarak dan ditenggelamkan ke Sungai Mahakam pada akhir Erau disebut?', 'opts' => ['Naga Basimbur / Mengulur Naga', 'Barongsai Naga', 'Naga Bonar', 'Ular Kobra Kuning'], 'ans' => 'Naga Basimbur / Mengulur Naga'],
                        ['q' => 'Acara puncak memercikkan/menyiram air kepada warga setelah naga ditenggelamkan untuk membuang kesialan (tolak bala) disebut?', 'opts' => ['Perang ketupat', 'Belimbur', 'Mandi uap', 'Siram rohani'], 'ans' => 'Belimbur'],
                    ],
                    'posttest' => [
                        ['q' => 'Pihak yang memimpin jalannya upacara ritual-ritual sakral dalam perayaan Erau (selain Sultan) adalah tetua adat yang disebut?', 'opts' => ['Dukun beranak', 'Belian dan Dewa (Pemimpin ritual)', 'Juru Kunci gunung', 'Kades (Kepala Desa)'], 'ans' => 'Belian dan Dewa (Pemimpin ritual)'],
                        ['q' => 'Tarian sakral mengelilingi tiang Ayu di Keraton Kutai yang ditarikan pada malam-malam pelaksanaan Erau adalah Tari?', 'opts' => ['Tari Kecak', 'Tari Dewa Memanah / Tari Belian', 'Tari Jepen', 'Tari Perang'], 'ans' => 'Tari Dewa Memanah / Tari Belian'],
                        ['q' => 'Kapan Festival Erau (Tenggarong) di masa kini biasa diselenggarakan sebagai daya tarik pariwisata internasional (TIFAF)?', 'opts' => ['Bertepatan hari Pahlawan 10 Nov', 'Dirangkaikan dengan peringatan hari jadi kota Tenggarong (September/Agustus)', 'Tahun Baru Masehi', 'Tiap akhir pekan'], 'ans' => 'Dirangkaikan dengan peringatan hari jadi kota Tenggarong (September/Agustus)'],
                        ['q' => 'Bagi masyarakat Kutai, air Sungai Mahakam yang dicipratkan saat prosesi Belimbur dipercaya telah disucikan oleh?', 'opts' => ['Bahan kimia penjernih', 'Air mata naga peliharaan dewa (Naga Erau)', 'Garam laut', 'Sinar rembulan'], 'ans' => 'Air mata naga peliharaan dewa (Naga Erau)'],
                        ['q' => 'Perayaan Erau secara filosofis menghubungkan hubungan harmonis antara Sultan (Keraton) dengan?', 'opts' => ['Penjajah asing', 'Rakyat biasa (komunitas adat dan masyarakat sungai)', 'Negara tetangga', 'Hanya bangsawan saja'], 'ans' => 'Rakyat biasa (komunitas adat dan masyarakat sungai)'],
                    ]
                ]
            ],
            [
                'title' => 'Musik Tingkilan dan Sastra Kutai',
                'slug' => 'musik-tingkilan-sastra-kutai',
                'description' => 'Mempelajari orkes Tingkilan yang mengiringi nyanyian (betingkilan).',
                'kompetensi_dasar' => '3.4 Mengapresiasi alat musik Tingkilan dan syair lisan Kutai.',
                'pertemuan_ke' => 4,
                'content' => $this->contentTingkilan(),
                'image' => 'https://placehold.co/800x450/991b1b/ffffff?text=Musik+Tingkilan',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Orkes / ansambel musik khas Suku Kutai yang sering membawakan lagu-lagu berbalas pantun disebut musik?', 'opts' => ['Gamelan', 'Tingkilan', 'Keroncong', 'Campursari'], 'ans' => 'Tingkilan'],
                        ['q' => 'Instrumen petik berlengan panjang khas Timur Tengah yang memegang peranan utama melodi dalam Tingkilan adalah?', 'opts' => ['Kecapi', 'Gambus', 'Sape', 'Biola'], 'ans' => 'Gambus'],
                        ['q' => 'Kata "Tingkilan" berasal dari bahasa Kutai "Tingkil" yang bermakna?', 'opts' => ['Menyanyi sedih', 'Saling sindir / berbalas pantun secara bergantian dengan nada', 'Berlari cepat', 'Memasak makanan'], 'ans' => 'Saling sindir / berbalas pantun secara bergantian dengan nada'],
                        ['q' => 'Lagu (syair) Kutai yang sangat populer dan sering dilantunkan menggunakan iringan Tingkilan adalah lagu berjudul?', 'opts' => ['Ampar-ampar Pisang', 'Buah Bolok', 'Yamko Rambe', 'Rasa Sayange'], 'ans' => 'Buah Bolok'],
                        ['q' => 'Fungsi sosial orkes Tingkilan pada masa lampau digunakan oleh para pemuda-pemudi Kutai sebagai sarana untuk?', 'opts' => ['Ajang mencari jodoh / bertukar kasih (pancaran)', 'Berlatih perang', 'Membangun rumah', 'Menidurkan bayi'], 'ans' => 'Ajang mencari jodoh / bertukar kasih (pancaran)'],
                    ],
                    'posttest' => [
                        ['q' => 'Alat perkusi pelengkap untuk menjaga ketukan dalam musik Tingkilan selain Ketipung (Rebana) adalah?', 'opts' => ['Drum set', 'Bedug mesjid', 'Kendang', 'Tamborin modern (di masa kini) / Gendang marwas'], 'ans' => 'Tamborin modern (di masa kini) / Gendang marwas'],
                        ['q' => 'Isi lirik pantun Tingkilan biasanya dibagi menjadi beberapa bait yang polanya sangat mirip dengan?', 'opts' => ['Pantun Melayu', 'Puisi kontemporer', 'Karangan bebas prosa', 'Lirik bahasa Inggris'], 'ans' => 'Pantun Melayu'],
                        ['q' => 'Lagu "Buah Bolok" yang sering dimainkan dengan iringan Tingkilan bercerita tentang buah asam khas Kalimantan dan mengandung pesan moral agar masyarakat Kutai rajin?', 'opts' => ['Berjudi', 'Bekerja, membangun daerah, dan tidak malas', 'Berburu binatang langka', 'Merantau jauh'], 'ans' => 'Bekerja, membangun daerah, dan tidak malas'],
                        ['q' => 'Ansambel Tingkilan saat ini sering digabungkan (kolaborasi fusion) dengan alat musik elektrik. Ini membuktikan bahwa musik Tingkilan sifatnya?', 'opts' => ['Kaku dan menolak perubahan', 'Fleksibel, adaptif, dan terus berkembang (dinamis)', 'Hanya untuk orang tua saja', 'Terlarang untuk diubah'], 'ans' => 'Fleksibel, adaptif, dan terus berkembang (dinamis)'],
                        ['q' => 'Ciri khas vokalis Tingkilan adalah menyanyi dengan cengkok suara meliuk-liuk yang diadaptasi dari kebudayaan?', 'opts' => ['Barat / Eropa', 'Qasidah / Tilawah Al-Quran dari Arab', 'Opera Cina', 'Blues Amerika'], 'ans' => 'Qasidah / Tilawah Al-Quran dari Arab'],
                    ]
                ]
            ],
            [
                'title' => 'Kuliner Kutai: Gence Ruan dan Nasi Bekepor',
                'slug' => 'kuliner-kutai-gence-ruan',
                'description' => 'Menjelajahi menu kuliner istana dan makanan rakyat sungai Mahakam.',
                'kompetensi_dasar' => '3.5 Memahami ragam bumbu dan teknik memasak masakan Kutai.',
                'pertemuan_ke' => 5,
                'content' => $this->contentKulinerKutai(),
                'image' => 'https://placehold.co/800x450/991b1b/ffffff?text=Kuliner+Kutai',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Nasi khas suku Kutai yang dicampur sayur mayur, ikan asin, rempah, dan dimasak secara tradisional (diputar-putar) di atas arang (kuali tanah liat) disebut?', 'opts' => ['Nasi Lemak', 'Nasi Bekepor', 'Nasi Kuning', 'Nasi Uduk'], 'ans' => 'Nasi Bekepor'],
                        ['q' => 'Lauk utama hidangan ikan gabus bakar bersiram sambal rempah kasar pedas (tomat, bawang merah, cabai) di atasnya dinamakan?', 'opts' => ['Gence Ruan', 'Ikan Pepes', 'Ikan Bakar Bumbu Rujak', 'Ikan Peda Goreng'], 'ans' => 'Gence Ruan'],
                        ['q' => 'Kata "Ruan" dalam "Gence Ruan" adalah singkatan nama lokal dari ikan predator sungai Kalimantan yaitu ikan?', 'opts' => ['Ikan Koi', 'Ikan Haruan (Gabus)', 'Ikan Paus', 'Ikan Mas'], 'ans' => 'Ikan Haruan (Gabus)'],
                        ['q' => 'Sayur berkuah santan khas Kutai berbahan sayur pakis/kelakai, umbi, dan disajikan bersama Nasi Bekepor adalah sayur?', 'opts' => ['Sayur Lodeh', 'Sayur Gangan Manok', 'Sayur Asam', 'Gangan Keladi (Sayur Asam Keladi Kutai)'], 'ans' => 'Gangan Keladi (Sayur Asam Keladi Kutai)'],
                        ['q' => 'Bumbu rahasia yang memberikan wangi menyengat khas daun (mirip daun kemangi) pada masakan daging/ayam Kutai adalah daun?', 'opts' => ['Daun Pisang', 'Daun Ruku-ruku atau Kemangi Kutai', 'Daun Singkong', 'Daun Teh'], 'ans' => 'Daun Ruku-ruku atau Kemangi Kutai'],
                    ],
                    'posttest' => [
                        ['q' => 'Nasi Bekepor pada masa lampau adalah makanan kaum bangsawan Kutai yang disajikan secara eksklusif menggunakan kendi berukir perak. Ini membuktikan kuliner ini berakar dari?', 'opts' => ['Hutan belantara', 'Masakan dapur Keraton Kesultanan Kutai', 'Warung pinggir jalan', 'Makanan laut'], 'ans' => 'Masakan dapur Keraton Kesultanan Kutai'],
                        ['q' => 'Kue tradisional (jajanan manis) Suku Kutai bertekstur legit seperti dodol yang dibungkus anyaman daun kelapa (janur) panjang disebut kue?', 'opts' => ['Kue Lapis', 'Jelore / Jajanan Ilat Sapi', 'Buras', 'Elat Sapi / Jenderal Mabuk'], 'ans' => 'Elat Sapi / Jenderal Mabuk'],
                        ['q' => 'Kata "Gence" pada hidangan "Gence Ruan" berarti teknik bumbu goreng setengah matang (sambal tumis kasar) yang disiramkan. Teknik bumbu ini menghasilkan rasa dominan?', 'opts' => ['Sangat manis seperti sirup', 'Pedas, manis samar, asin, dan segar asam', 'Pahit sekali', 'Hambar / tawar'], 'ans' => 'Pedas, manis samar, asin, dan segar asam'],
                        ['q' => 'Salah satu kue basah Kutai yang terbuat dari campuran telur bebek, gula merah, tepung, dikukus hingga matang (mirip puding karamel) dinamakan?', 'opts' => ['Puding coklat', 'Bolu macan', 'Sari Pengantin', 'Putu ayu'], 'ans' => 'Sari Pengantin'],
                        ['q' => 'Penggunaan alat masak kuno dari kendi tembikar tanah liat (kenceng) untuk Nasi Bekepor berfungsi untuk?', 'opts' => ['Menghancurkan beras', 'Mempertahankan aroma arang yang meresap wangi dan mempertahankan panas lebih lama', 'Hanya untuk hiasan dapur', 'Membuat masakan jadi beracun'], 'ans' => 'Mempertahankan aroma arang yang meresap wangi dan mempertahankan panas lebih lama'],
                    ]
                ]
            ],
            [
                'title' => 'Arsitektur Keraton: Istana Sultan Kutai Kartanegara',
                'slug' => 'istana-sultan-kutai-kartanegara',
                'description' => 'Mengenal megahnya struktur arsitektur Istana Kesultanan (Kedaton).',
                'kompetensi_dasar' => '3.6 Menganalisis elemen arsitektur Istana Kutai.',
                'pertemuan_ke' => 6,
                'content' => $this->contentIstanaKutai(),
                'image' => 'https://placehold.co/800x450/991b1b/ffffff?text=Kedaton+Kutai',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Pusat pemerintahan Kesultanan Kutai Kartanegara (Istana) dan arsitektur keratonnya terletak di kota?', 'opts' => ['Balikpapan', 'Tenggarong', 'Tarakan', 'Samarinda'], 'ans' => 'Tenggarong'],
                        ['q' => 'Bangunan peninggalan Keraton Kutai (Kedaton) saat ini beralih fungsi dan ditetapkan oleh pemerintah sebagai?', 'opts' => ['Gedung DPRD', 'Museum Mulawarman', 'Pasar Tradisional', 'Rumah Sakit Daerah'], 'ans' => 'Museum Mulawarman'],
                        ['q' => 'Arsitektur bangunan Museum Mulawarman (eks Istana Kutai generasi baru) dibangun kuat memadukan unsur seni ukir Kutai dengan arsitektur corak kolonial?', 'opts' => ['Jepang modern', 'Spanyol / Romawi Eropa dan Belanda (Indis)', 'Tiongkok', 'Timur Tengah klasik'], 'ans' => 'Spanyol / Romawi Eropa dan Belanda (Indis)'],
                        ['q' => 'Tiang bendera keraton bersejarah yang berdiri di depan Istana Kutai dan terbuat dari kayu ulin raksasa dikenal dengan sebutan?', 'opts' => ['Tiang Monas', 'Tiang Ayu / Tiang Bendera Sumbu Kurung', 'Tiang Pancang', 'Tiang Listrik'], 'ans' => 'Tiang Ayu / Tiang Bendera Sumbu Kurung'],
                        ['q' => 'Warna dominan yang menjadi simbol kebesaran Kerajaan Kutai dan dihiaskan pada panji-panji keraton adalah warna?', 'opts' => ['Biru langit', 'Kuning emas (Kuning keemasan)', 'Hitam pekat', 'Ungu gelap'], 'ans' => 'Kuning emas (Kuning keemasan)'],
                    ],
                    'posttest' => [
                        ['q' => 'Ornamen naga bersayap melingkar yang berada di gerbang istana maupun di singgasana Raja melambangkan penguasa alam mitologi Hindu Kutai yaitu legenda Lembuswana. Bentuk fisik hewan mitologi Lembuswana menggabungkan unsur?', 'opts' => ['Gajah, burung garuda, naga, dan harimau', 'Singa, ikan, dan burung pipit', 'Kuda, anjing, dan kera', 'Kerbau, buaya, dan gagak'], 'ans' => 'Gajah, burung garuda, naga, dan harimau'],
                        ['q' => 'Singgasana raja Kesultanan Kutai yang tersimpan di dalam museum terbuat dari?', 'opts' => ['Rotan anyam', 'Batu granit', 'Kayu berukir lapisan emas', 'Besi tua'], 'ans' => 'Kayu berukir lapisan emas'],
                        ['q' => 'Secara tata ruang kosmologis, bagian terdepan (alun-alun halaman luas) Istana Kutai berhadapan langsung dengan?', 'opts' => ['Gunung berapi', 'Sungai Mahakam', 'Hutan pinus', 'Gurun pasir'], 'ans' => 'Sungai Mahakam'],
                        ['q' => 'Di samping gedung museum, terdapat bangunan cungkup berarsitektur Jawa-Melayu tempat bersemayamnya makam para sultan yang disebut kompleks?', 'opts' => ['Makam Imogiri', 'Makam Pahlawan', 'Makam Raja-raja Kutai (Kubah)', 'Candi Prambanan'], 'ans' => 'Makam Raja-raja Kutai (Kubah)'],
                        ['q' => 'Istana kayu asli Kutai yang tertua sudah hancur lebur akibat terbakar/peperangan kuno, sehingga kedaton berbahan beton (Museum Mulawarman saat ini) sejatinya baru dibangun pada dekade tahun?', 'opts' => ['Tahun 1700-an', 'Tahun 1930-an (Oleh kontraktor H.B.A.M.S)', 'Tahun 1400-an', 'Tahun 2005'], 'ans' => 'Tahun 1930-an (Oleh kontraktor H.B.A.M.S)'],
                    ]
                ]
            ],
            [
                'title' => 'Tenun Ulap Doyo: Warisan Serat Alam Kutai Barat',
                'slug' => 'tenun-ulap-doyo-serat-kutai',
                'description' => 'Mempelajari seni tekstil tenun khas Suku Dayak Benuaq yang diakui Kesultanan Kutai.',
                'kompetensi_dasar' => '3.7 Memahami proses, bahan, dan makna Tenun Ulap Doyo.',
                'pertemuan_ke' => 7,
                'content' => $this->contentUlapDoyo(),
                'image' => 'https://placehold.co/800x450/991b1b/ffffff?text=Tenun+Ulap+Doyo',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Tenun Ulap Doyo adalah mahakarya seni tekstil tradisional kalimantan yang diciptakan oleh sub-suku dari wilayah pedalaman Kutai, yaitu?', 'opts' => ['Dayak Punan', 'Dayak Benuaq', 'Suku Bugis', 'Dayak Iban'], 'ans' => 'Dayak Benuaq'],
                        ['q' => 'Bahan dasar pintalan benang Ulap Doyo bukan berasal dari kapas atau sutra ulat, melainkan serat daun dari tanaman semak liar bernama?', 'opts' => ['Daun teh', 'Daun tanaman Doyo (Curculigo latifolia)', 'Daun pandan', 'Daun teratai'], 'ans' => 'Daun tanaman Doyo (Curculigo latifolia)'],
                        ['q' => 'Kata "Ulap" dalam bahasa Benuaq memiliki arti?', 'opts' => ['Ular phyton', 'Kain penutup tubuh / kain sarung', 'Pewarna kain', 'Mesin tenun'], 'ans' => 'Kain penutup tubuh / kain sarung'],
                        ['q' => 'Alat tenun tradisional yang digunakan wanita Benuaq untuk membuat Ulap Doyo diselipkan di belakang punggung pinggang penenunnya, disebut jenis alat tenun?', 'opts' => ['Alat Tenun Mesin (ATM)', 'Gedokan / Tenun Ikat Pinggang (Backstrap Loom)', 'Batik cap', 'Rotasi engkol otomatis'], 'ans' => 'Gedokan / Tenun Ikat Pinggang (Backstrap Loom)'],
                        ['q' => 'Pewarna tradisional merah pada tenun Ulap Doyo sering kali didapat dari getah atau serutan kulit batang pohon?', 'opts' => ['Pohon Jati', 'Pohon Secang / Pohon Gula (Tegeran)', 'Pohon Beringin', 'Pohon Pinus'], 'ans' => 'Pohon Secang / Pohon Gula (Tegeran)'],
                    ],
                    'posttest' => [
                        ['q' => 'Motif Ulap Doyo bagi pria bangsawan / kepala adat (Mantiq) biasanya diwajibkan bermotif corak margasatwa gagah, seperti motif?', 'opts' => ['Kucing dan tikus', 'Naga (Aso) dan Harimau', 'Ikan teri', 'Bunga melati'], 'ans' => 'Naga (Aso) dan Harimau'],
                        ['q' => 'Motif floral dan tumbuhan menjalar pada Ulap Doyo secara tradisi biasanya diperuntukkan untuk pakaian wanita bangsawan karena melambangkan?', 'opts' => ['Kesedihan', 'Kelembutan budi, pertumbuhan, dan kesuburan', 'Semangat perangkap musuh', 'Kegelapan'], 'ans' => 'Kelembutan budi, pertumbuhan, dan kesuburan'],
                        ['q' => 'Proses paling sulit dalam pembuatan benang Doyo adalah saat mengubah daun panjang menjadi helaian serat tipis. Daun doyo tidak dipotong dengan gunting, melainkan dikikis dengan hati-hati menggunakan alat ukir dari?', 'opts' => ['Bilah bambu pelat tipis', 'Besi panas gergaji', 'Kapak tebang', 'Korek api'], 'ans' => 'Bilah bambu pelat tipis'],
                        ['q' => 'Pemakaian Ulap Doyo memiliki aturan (pakem) strata sosial. Orang dari kelas rakyat biasa (pangkar) pada era lampau hanya boleh memakai Ulap Doyo dengan motif?', 'opts' => ['Naga emas murni bersisik batu', 'Hanya polos tanpa motif / sekadar garis warna', 'Sayap elang raksasa', 'Singa bermahkota'], 'ans' => 'Hanya polos tanpa motif / sekadar garis warna'],
                        ['q' => 'Saat ini, sentra kerajinan utama penghasil Tenun Ulap Doyo berada di wilayah kecamatan?', 'opts' => ['Kecamatan Jempang (Kampung Tanjung Isuy)', 'Kecamatan Tenggarong Kota', 'Kecamatan Tarakan Timur', 'Kecamatan Balikpapan Barat'], 'ans' => 'Kecamatan Jempang (Kampung Tanjung Isuy)'],
                    ]
                ]
            ],
        ];

        foreach ($materials as $data) {
            $quizzes = $data['quizzes'];
            unset($data['quizzes']);

            $data['category'] = 'kutai';
            $data['status'] = 'approved';
            $data['teacher_id'] = $guru->id;
            
            $material = Material::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );

            // Create Quizzes
            foreach (['pretest', 'posttest'] as $type) {
                $quiz = Quiz::firstOrCreate(
                    ['material_id' => $material->id, 'quiz_type' => $type],
                    [
                        'title'               => ucfirst($type) . ': ' . $material->title,
                        'teacher_id'          => $guru->id,
                        'passing_score'       => $type === 'posttest' ? 70 : 0,
                    ]
                );

                if ($quiz->questions()->count() === 0) {
                    $questions = $quizzes[$type];
                    foreach ($questions as $i => $q) {
                        Question::create([
                            'quiz_id'        => $quiz->id,
                            'question'       => $q['q'],
                            'type'           => 'multiple_choice',
                            'options'        => $q['opts'],
                            'correct_answer' => $q['ans'],
                            'order'          => $i + 1,
                        ]);
                    }
                }
            }
        }
    }

    private function contentSejarah(): string
    {
        return <<<'HTML'
<h2>Kerajaan Kutai dan Asal Usul Suku Kutai</h2>
<p>Membahas Suku Kutai tidak dapat dipisahkan dari narasi kebesaran sejarah <strong>Kerajaan Kutai Martadipura</strong>. Berpusat di daerah Muara Kaman (hulu Sungai Mahakam, Kalimantan Timur), kerajaan bercorak Hindu ini diakui secara akademis sebagai kerajaan pertama sekaligus kerajaan tertua di bumi Nusantara (berdiri sekitar abad ke-4 Masehi).</p>

<h3>Jejak Emas Prasasti Yupa</h3>
<p>Keagungan sejarah Kutai terukir abadi di atas batu. Para arkeolog menemukan 7 buah tiang batu andesit berhuruf Pallawa dalam bahasa Sansekerta yang disebut <strong>Prasasti Yupa</strong>. Prasasti ini menyanjung kemuliaan <strong>Raja Mulawarman</strong>, putra Aswawarman, cucu Kudungga. Dalam prasasti tersebut diceritakan bahwa Raja Mulawarman yang dermawan menyedekahkan 20.000 ekor lembu untuk kasta Brahmana, sebuah jumlah yang fantastis untuk ukuran peradaban abad ke-4. Masa pemerintahan Mulawarman disebut sebagai masa keemasan kerajaan, di mana rakyat hidup tenteram, makmur, dan berlimpah harta dari hasil interaksi dagang perairan sungai Mahakam yang menjadi urat nadi Nusantara timur.</p>

<h3>Berdirinya Kesultanan Kutai Kartanegara</h3>
<p>Berabad-abad kemudian (abad ke-13), berdirilah <strong>Kutai Kartanegara</strong> di Kutai Lama oleh Aji Batara Agung Dewa Sakti. Kerajaan yang lebih muda ini kemudian melakukan ekspansi, berseteru, dan akhirnya berhasil menaklukkan Kutai Martadipura. Sejak saat itu, dua kerajaan ini melebur menjadi satu entitas. Pada abad ke-16, pengaruh Islam masuk melalui ulama-ulama dari Minangkabau dan Bugis. Raja Mahkota pun memeluk agama Islam, sehingga Kerajaan Kutai Kartanegara resmi berubah status menjadi <strong>Kesultanan (Keraton Islam)</strong>.</p>

<h3>Evolusi Identitas Suku Kutai</h3>
<p>Identitas 'Suku Kutai' modern (Kutai Menyapa, Kutai Melayu) adalah hasil fusi (asimilasi) yang panjang dan damai antara suku penduduk asli Borneo pedalaman dengan gelombang pelaut-pedagang Melayu, Bugis, dan Arab yang masuk ke pedalaman Mahakam. Melalui perkawinan campur, penyebaran agama Islam, dan hegemoni budaya keraton Tenggarong, lahirlah sebuah komunitas sub-etnis yang menjunjung tinggi toleransi, sopan santun Melayu-Islam, serta memiliki dialek bahasa Kutai yang khas dan puitis.</p>
HTML;
    }

    private function contentTariJepen(): string
    {
        return <<<'HTML'
<h2>Tari Jepen: Keanggunan Seni Melayu Kutai</h2>
<p>Kalimantan menyimpan sebuah mahakarya tari tradisional yang memancarkan energi kelembutan, kesopanan, sekaligus keramahtamahan, yaitu <strong>Tari Jepen</strong>. Tari Jepen menjadi lambang identitas kultural Suku Kutai yang sangat dibanggakan dan kerap dipertunjukkan dalam acara perhelatan formal pemerintahan maupun resepsi pernikahan.</p>

<h3>Akar Zapin Melayu-Arab</h3>
<p>Nama "Jepen" dipercaya merupakan bentuk dialek lokal Kutai dari kata "Japin" atau "Zapin". Secara historis, tari Zapin adalah tarian pergaulan pesisir yang tumbuh subur seiring penyebaran agama Islam oleh para pedagang Arab di wilayah semenanjung Malaya, Sumatera, dan pesisir Kalimantan. Masuknya seniman Zapin ke pedalaman Mahakam perlahan-lahan diadaptasi oleh warga Kutai agar sesuai dengan tata krama lokal. Dahulu kala, karena aturan keraton yang sangat ketat mengenai batasan wanita tampil di hadapan umum, tarian ini ditarikan eksklusif oleh pemuda pria. Namun seiring perkembangan seni modern (pasca-kemerdekaan), Tari Jepen justru didominasi oleh penari wanita berkelompok.</p>

<h3>Ragam Gerak: "Penghormatan" & "Tali Tiga"</h3>
<p>Gerakan Tari Jepen sangat anggun, tidak mengentak-entak kasar, namun kaki penari melangkah selang-seling (menyilang) dengan lincah (step and tap) menyesuaikan irama kendang. Ada beberapa ragam gerak pakem (dasar) dalam Tari Jepen:</p>
<ul>
    <li><strong>Gerak Menghormat:</strong> Menundukkan badan sambil menyatukan tangan di dada, tanda bakti dan salam takzim kepada raja atau tamu agung.</li>
    <li><strong>Gerak Gelombang / Tali Tiga:</strong> Gerakan maju mundur berkelompok (formasi silang) secara serentak. Gerak sinkronisasi ini mendidik penari tentang nilai persatuan, kerja sama tim, dan kepatuhan pada aturan barisan masyarakat Kutai.</li>
</ul>

<h3>Busana dan Instrumen Pengiring (Tingkilan)</h3>
<p>Penari Jepen Kutai selalu berpenampilan elegan. Mereka memakai baju lengan panjang sutra atau kain mengkilap (Baju Kurung atau Baju Miskat) yang dihias sulaman benang emas berornamen floral kerajaan, dipadu sarung batik corak Kutai (Tapeh). Mahkota rambut bagi wanita dijepit rapi dan dihiasi dengan <em>Sanggul Goyang</em> berhias kembang goyang emas yang gemerlap setiap kali penari bergerak menganggukkan kepala.</p>
<p>Tarian ini mutlak harus diiringi oleh orkes musik pesisir: Tingkilan. Petikan instrumen dawai <strong>Gambus</strong> memainkan nada-nada maqam Arab/Melayu yang melengkung indah, disahut pukulan perkusi <strong>Rebana (Ketipung)</strong> yang memberikan hentakan tempo berdebar sebagai komando kapan penari harus berpindah posisi pijakan kaki.</p>
HTML;
    }

    private function contentErau(): string
    {
        return <<<'HTML'
<h2>Erau: Festival Adat Kesultanan Kutai</h2>
<p>Rakyat Suku Kutai merayakan momen persatuan kulturalnya melalui sebuah mega-festival keraton yang sakral sekaligus meriah, yang diberi nama <strong>Erau</strong> (atau Erau Adat Pelas Benua). Festival adat ini telah masuk ke dalam kalender pariwisata nasional dan bertransformasi menjadi <em>Tenggarong International Folk Art Festival (TIFAF)</em> yang dihadiri delegasi kesenian dari belasan negara di seluruh benua.</p>

<h3>Makna Kata 'Eroh'</h3>
<p>Istilah "Erau" bersumber dari kosa kata bahasa Kutai lama "Eroh", yang bermakna suasana yang ramai, hiruk-pikuk, gembira ria, dan sorak-sorai penuh sukacita. Secara tradisi Kesultanan Kutai Kartanegara ing Martadipura, Erau pertama kali diadakan berabad-abad lalu tatkala Aji Batara Agung Dewa Sakti dan permaisurinya, Putri Karang Melenu, menggelar perayaan <em>tijak tanah</em> (prosesi anak pertama kali menginjakkan kakinya ke tanah ibu pertiwi) untuk sang putra mahkota tercinta (Aji Batara Agung Paduka Nira).</p>

<h3>Prosesi Sakral "Mendirikan Ayu"</h3>
<p>Pelaksanaan Erau berlangsung selama sepekan penuh siang dan malam. Ritual dibuka dengan upacara <strong>Mendirikan Tiang Ayu</strong> oleh Sri Sultan dan para menteri keraton. Tiang Ayu adalah pusaka kebesaran berbentuk tombak raksasa yang dipercaya memiliki kekuatan melindungi kesejahteraan seluruh alam semesta Kerajaan Kutai. Tiang didirikan dengan diikatkan akar tambang yang sakral, melambangkan penancapan pondasi kekuasaan pemerintahan dan perlindungan moral sang Sultan terhadap nasib seluruh rakyat Kutai dari hulu hingga hilir Mahakam.</p>

<h3>Tarian Belian, Mengulur Naga, dan Belimbur</h3>
<p>Sepanjang malam festival, para pawang roh (disebut Belian) menari tiada henti mengitari Tiang Ayu di tengah ruang keraton sambil merapalkan mantra keselamatan, yang disebut Tari Dewa Memanah. </p>
<p>Puncak acara yang paling ditunggu puluhan ribu rakyat pada hari terakhir Erau adalah <strong>Mengulur Naga</strong>. Sepasang ornamen boneka raksasa naga mistis Kutai sepanjang puluhan meter yang terbuat dari kayu rotan berlapis kain dan sisik kain warna-warni, ditandu beramai-ramai menuju sebuah kapal di tepi Sungai Mahakam. Naga sakral ini diberangkatkan menuju Kutai Lama untuk "ditenggelamkan" atau dikembalikan habitatnya ke dasar air.</p>
<p>Segera setelah Sang Naga ditenggelamkan dan pusaka keratonnya diangkat, Sultan akan memberikan titah (Tepong Tawar) yang menandai dimulainya pesta penutup: <strong>Belimbur</strong>. Seluruh masyarakat Tenggarong—tua muda, pejabat atau rakyat—akan saling berkejaran menyiramkan/memercikkan air satu sama lain di jalanan atau menggunakan air suci dari Mahakam. Air Belimbur melambangkan tetesan berkah penghapus sial atau tolak bala, pembersih batin, yang menyucikan diri dari seluruh dengki, amarah, dan sifat kotor, untuk menyongsong tahun baru dengan jiwa yang suci dan murni bersama di tanah Kutai.</p>
HTML;
    }

    private function contentTingkilan(): string
    {
        return <<<'HTML'
<h2>Musik Tingkilan dan Sastra Kutai</h2>
<p>Bagi orang Kutai, mengekspresikan kritik halus, merayu sang pujaan hati, atau menasihati kaum muda tidak dilakukan secara terang-terangan dan kaku. Mereka menggunakan sastra lisan puitis yang dilantunkan bersama orkes musik pesisir istimewa yang dijuluki: <strong>Tingkilan</strong>.</p>

<h3>Seni Betingkilan (Berbalas Pantun Lisan)</h3>
<p>Istilah Tingkilan berakar dari kata bahasa daerah Kutai <em>"Tingkil"</em>, yang merujuk pada kegiatan bersenda gurau, menyindir dengan bahasa kiasan, atau berbalas pantun secara jenaka dan saling sahut. Pada zaman kerajaan, para pemuda pemudi Kutai merajut tali percintaan asmara melalui pantun Tingkilan. Sang pria akan melontarkan pantun teka-teki cinta yang dilantunkan secara mendayu dengan cengkok syair khas Melayu pesisir, yang seketika itu pula dijawab spontan (improvisasi) oleh pihak perempuan. Senandung ini bisa terus memanjang bersahut-sahutan hingga fajar menjelang, memancing gelak tawa warga penonton desa.</p>

<h3>Instrumen Utama: Gambus dan Ketipung (Rebana)</h3>
<p>Orkes pembawa melodi Tingkilan bersandar sepenuhnya pada instrumen petik berdawai dari kebudayaan Timur Tengah, yaitu <strong>Gambus</strong>. Gambus kayu khas Kutai biasanya tidak berlubang (solid body) pada bagian badannya, dilapisi kulit kambing sebagai penutup kotak resonansi suara, dan dipetik menggunakan pemetik tanduk. Nada gambus berbunyi sangat nyaring (treble). Suara melodis ini dikawal ketat oleh sekelompok pemain drum tradisional <strong>Ketipung / Rebana besar</strong> yang bertugas memukul irama (rhythm) bersahut-sahutan (poliritmik). Pola ketukan drum ini disebut pukulan tari / joget, yang otomatis akan mengundang kepala para pendengarnya ikut mengangguk menikmati irama.</p>

<h3>Lagu Kutai "Buah Bolok"</h3>
<p>Saat ini, irama Tingkilan melahirkan banyak lagu pop daerah legendaris yang me-nusantara. Salah satu mahakarya lagu daerah Kutai yang sangat populer adalah <strong>"Buah Bolok"</strong>. Lagu ini bermelodi manis dan bertempo santai lincah, yang berlirik puitis tentang asamnya buah bolok (buah mentega hutan) sebagai perumpamaan agar pemuda Kutai tidak boleh bermalas-malasan, harus tekun bekerja, terus bersekolah menimba ilmu, demi membangun daerah Kutai yang kaya sumber daya alam (emas hijau dan hitam) namun tetap mengakar kuat memelihara adat-istiadat tradisi lokalnya secara harmonis.</p>
HTML;
    }

    private function contentKulinerKutai(): string
    {
        return <<<'HTML'
<h2>Kuliner Kutai: Gence Ruan dan Nasi Bekepor</h2>
<p>Sungai Mahakam memberikan sumber protein melimpah berupa ikan air tawar, sementara dapur Keraton Kutai Kartanegara menyimpan resep kuliner peninggalan kerabat kesultanan kuno yang amat kaya akan khazanah rempah eksotis pedalaman Borneo.</p>

<h3>Gence Ruan: Mahkota Ikan Mahakam</h3>
<p>Sajian wajib dan terpopuler di warung-warung makan Kutai adalah <strong>Gence Ruan</strong>. Menu ini berbahan baku utama Ikan Haruan (ikan Gabus). Ikan Haruan yang berdaging tebal dibersihkan, dibelah (dibakar) di atas arang kayu ulin, dengan sedikit dilumuri asam garam. <br>
Kata <em>Gence</em> mengacu pada teknik mengolah saus (sambal) siramnya. Bumbu gence ini terdiri dari bawang merah, cabai rawit pedas, kemiri, irisan tomat segar, dan terasi udang yang diulek kasar (tidak sampai halus). Bumbu kasar inilah yang kemudian ditumis cepat (setengah matang) dengan minyak panas agar aromanya keluar tajam, lalu disiramkan berlimpah ruah menyelimuti seluruh punggung daging ikan Haruan bakar yang masih mengepul panas. Rasa pedas cabai yang menggigit dipadukan dengan kesegaran tomat setengah layu menciptakan perpaduan rasa umami alam liar Mahakam.</p>

<h3>Nasi Bekepor: Nasi Putar Bangsawan Keraton</h3>
<p>Jika nasi biasa dikukus di panci, maka Kutai mempunyai <strong>Nasi Bekepor</strong>. Secara silsilah resep, ini adalah sajian mewah eksklusif para bangsawan istana Kesultanan masa lampau, walau kini menjadi primadona publik.
<br>Nasi Bekepor dimasak menggunakan <em>kenceng</em> (kuali bulat / periuk dari kuningan atau tanah liat tebal). Beras dimasukkan bersama daun pandan, sedikit minyak kelapa sawit, rempah serai, dan potongan ikan asin (peda) serta kemangi hutan (daun ruku-ruku). 
<br>Cara memasaknya sangat unik: setelah air menyusut di atas tungku arang kayu berbara, kenceng akan diangkat dan ditepi-tepikan ke tepi bara api perlahan-lahan. Sang koki kemudian akan memutar-mutar (memutar-mutar = <em>Bekepor</em>) kuali tembikar dengan tangan di atas tungku, agar panas merata mengelilingi panci dan nasi matang dengan tekstur kering, pera (tidak lembek), sangat wangi herbal ruku-ruku, dan menyerap sempurna aroma arang bakaran dasar periuk. Nasi lezat berkerak tipis di dasarnya ini dihidangkan bersandingan dengan Gence Ruan atau Sayur Asam Kutai (Gangan Keladi).</p>

<h3>Jajanan Manis Istana: Jenderal Mabuk (Elat Sapi)</h3>
<p>Pencuci mulut Kutai juga sangat spesifik (cenderung bertekstur legit lengket). Ada kue yang dinamakan unik: <strong>Elat Sapi</strong> (artinya lidah sapi) karena bentuk potongannya yang lonjong rata mirip lidah, atau dijuluki Jenderal Mabuk karena rasanya konon membuat tentara penjajah terlena keenakan. Kue ini berbahan tepung terigu, telur, dan lelehan karamel gula merah aren (gula kelapa merah) murni yang diaduk lama laksana dodol.</p>
HTML;
    }

    private function contentIstanaKutai(): string
    {
        return <<<'HTML'
<h2>Arsitektur Keraton: Istana Sultan Kutai Kartanegara</h2>
<p>Kota Tenggarong (dijuluki Kota Raja) memendam jejak kemegahan peradaban istana, di mana Sang Sultan Kutai Kartanegara ing Martadipura pernah memerintah dan membangun mahakarya arsitektur, yakni <strong>Kedaton / Keraton Kutai</strong>. Kompleks ini bukan sebatas tempat tidur raja, melainkan pusat poros mikrokosmos kekuasaan politik, sakral keagamaan, budaya, dan kesenian Suku Kutai secara absolut.</p>

<h3>Dari Kayu Menjadi Beton (Museum Mulawarman)</h3>
<p>Istana kayu ulin kuno Kesultanan Kutai yang sangat luas sebenarnya telah rata dengan tanah (musnah karena peperangan zaman belanda, kebakaran, dll). Arsitektur keraton ikonik berwarna krem putih-kuning kokoh yang sekarang berdiri anggun dan kita nikmati saat ini, sejatinya baru mulai diarsiteki pada rentang dekade tahun <strong>1930-an (di bawah proyek biro arsitektur Belanda H.B.A.M.S)</strong>, pada masa takhta Sultan Aji Muhammad Parikesit.
<br>Di masa RI modern pasca pembubaran monarki daerah administratif tahun 1960-an, kompleks Kedaton agung ini dihibahkan kepada negara dan beralih fungsi menjadi sebuah museum purbakala berkelas nasional yang bernama <strong>Museum Mulawarman</strong>, tempat disimpannya seluruh koleksi pusaka, keramik Tiongkok, singgasana emas raja, gamelan, hingga pakaian perang keraton.</p>

<h3>Gaya Arsitektur Indis-Kolonial dan Ornamen Hindu</h3>
<p>Bangunan utama Keraton Tenggarong memiliki arsitektur perpaduan (eklektik) yang menawan. Kolom-kolom pilar penyangganya bergaya <em>Indis / Kolonial Belanda Klasik</em> yang menonjolkan struktur simetris tebal dengan deretan anak tangga lebar beranda khas istana-istana Eropa. 
<br>Walau demikian, roh dan ornamennya tetap memancarkan keagungan kearifan lokal. Di gerbang keraton maupun pelataran halaman dipatungkan arca <strong>Lembuswana</strong> emas. Lembuswana adalah satwa mitologi agung penguasa Sungai Mahakam dan maskot Kesultanan Kutai yang berwujud luar biasa (memiliki tubuh bertenaga Gajah, bersayap terbang selayak Burung Garuda, memiliki sisik ular naga perkasa pelindung, serta berkepala mengerikan laksana Singa). Patung ini adalah perlambang hegemoni Sang Sultan Kutai yang melindungi, terbang tinggi, sekaligus menancap kokoh kekuasaannya menjaga rakyat jelata Kutai (warna kebesaran bendera Kutai adalah kuning emas).</p>

<h3>Tiang Ayu dan Makam Kerajaan</h3>
<p>Di halaman istana berdiri sebuah tiang pusaka <strong>Tiang Bendera Sumbu Kurung (Tiang Ayu)</strong>. Tiang pancang kayu ulin tua peninggalan sultan-sultan zaman lampau ini menjadi titik poros mula dilaksanakannya upacara Erau dan ditancapkan tali tambang ritual magis.
<br>Semetara di sisi luar kedaton (sebelah barat museum) terdapat sebuah kompleks persemayaman bangunan kubah (paviliun) bergaya atap tumpang Jawa-Islam (Atap Joglo tumpang Melayu) yang diukir kaligrafi ayat Al-Quran. Bangunan sejuk dan hening ini adalah kompleks Pemakaman Raja-Raja Kutai (kubah makam Sultan A.M Sulaiman, Sultan A.M Parikesit, dll) yang selalu diziarahi secara hormat oleh para keturunan keraton dan rakyat Kutai hingga detik ini, membuktikan keabadian rasa cinta hormat mereka kepada leluhur pendiri peradaban Mahakam.</p>
HTML;
    }

    private function contentUlapDoyo(): string
    {
        return <<<'HTML'
<h2>Tenun Ulap Doyo: Warisan Serat Alam Kutai Barat</h2>
<p>Kebudayaan tekstil yang teramat langka dan membanggakan dari pedalaman benua Kalimantan (wilayah historis kekuasaan Kesultanan Kutai Lama, utamanya daerah Kutai Barat / Tanjung Isuy) adalah <strong>Tenun Ulap Doyo</strong>. Kain ini ditenun secara perlahan dan magis oleh tangan-tangan lembut para wanita dari masyarakat adat sub-suku Dayak Benuaq. Kain berserat kasar, eksotis, dan sarat mitologi ini telah mendapatkan pengakuan pelestarian nasional oleh keraton, dinas kebudayaan nasional, hingga desainer mode internasional.</p>

<h3>Mencukur Serat Daun (Curculigo latifolia)</h3>
<p>Hal paling sensasional dan fenomenal dari Ulap Doyo bukanlah pada alat tenunnya, melainkan pada material benangnya. Tenun Ulap Doyo tidak menggunakan sehelai pun kapas, wol, ataupun sutera buatan. Benang murninya dibuat dari ekstraksi serat tanaman liar berduri semak hutan bernama <strong>Daun Doyo (Curculigo latifolia)</strong>.
<br>Daun doyo segar dipotong, direndam air sungai, lalu para wanita suku Benuaq menggunakan semacam bilah atau belahan bambu tajam nipis untuk "mengerok / mengikis" daging daun hijau tersebut secara berulang-ulang dengan amat presisi. Hasil kerokan akan menyisakan helaian urat-urat serat daun alami yang berwarna putih kecoklatan pucat. Serat (urat) daun alot ini kemudian dikeringkan (dijemur) dan diikat memanjang satu sama lain hingga menjadi gulungan benang nabati yang amat kokoh dan kaku.</p>

<h3>Alat Tenun Gedokan Belakang Pinggang (Backstrap Loom)</h3>
<p>Para penenun wanita Dayak Benuaq tidak menggunakan mesin tekstil modern. Mereka melantai dan menenun lembaran Ulap Doyo menggunakan sebilah papan kayu penggulung (Alat Tenun Gedokan / Backstrap Loom). Ujung papan tenun tersebut disandarkan atau diikat sabuk melingkari punggung/pinggang penenunnya (sehingga si penenun tidak bisa berpindah tempat dan menjadi satu kesatuan mesin dengan alat kayunya saat bekerja merapatkan helaian pakan kayu pedang dan benang lusi).</p>

<h3>Zat Warna Hutan dan Pakem Kasta Motif</h3>
<p>Untuk menorehkan rupa corak (merintang warna benang), serat doyo diberi pewarna nabati hasil ekstraksi botani hutan asli Borneo: Warna hitam / gelap pekat didapat dari merendam getah arang kayu abu, dan warna Merah kecoklatan hangat (Terakota) didapat dari merebus getah serutan kulit batang pohon Secang (pohon Tegeran), tanpa menggunakan pewarna bahan kimia (non-sintetik).
<br>Di masa era adat yang ketat, sehelai Ulap Doyo bukan pakaian bebas pakai. Pola coraknya mendiktekan siapa kasta (jabatan status strata sosial) pemakainya dalam keraton suku Benuaq:</p>
<ul>
    <li>Corak flora, sulur-sulur tumbuhan, pucuk bambu (Pucuk rebung) eksklusif diperuntukkan bagi kaum wanita bangsawan (Paren) atau kepala suku, karena menarasikan kelembutan budi, pertumbuhan kekayaan, dan kemurahan hati bumi yang menyuburkan.</li>
    <li>Corak Hewan Ganas Bertaring / Margasatwa (Naga Aso bertanduk tajam, Harimau loreng mistis, atau Burung elang), mutlak diperuntukkan bagi hiasan kemeja jubah perang laki-laki elit (Mantiq) atau panglima perang suku penakluk pahlawan.</li>
    <li>Rakyat jelata (orang suruhan) hanya memakai tenun polosan atau paling tinggi corak garis salur warna sederhana di pinggiran kain.</li>
</ul>
<p>Di era masa kini, Ulap Doyo sering kali diaplikasikan dan dimodifikasi menjadi taplak meja, bahan kemeja mewah untuk pejabat pemerintahan dalam agenda acara dinas, kalung etnik fashion show, sarung elegan, hingga dekorasi interior dinding hotel bintang lima guna menonjolkan kearifan keanggunan budaya asli Kutai Benuaq ke mata mancanegara.</p>
HTML;
    }
}
