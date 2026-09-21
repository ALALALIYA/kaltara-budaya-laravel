<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Seeder;

class BanjarMaterialSeeder extends Seeder
{
    public function run(): void
    {
        $guru = User::where('role', 'teacher')->first();

        $materials = [
            [
                'title' => 'Suku Banjar di Kalimantan Utara',
                'slug' => 'suku-banjar-di-kalimantan-utara',
                'description' => 'Mengenal sejarah, migrasi, dan persebaran budaya Suku Banjar di Kalimantan Utara.',
                'kompetensi_dasar' => '3.1 Memahami sejarah dan persebaran Suku Banjar di Kalimantan Utara.',
                'pertemuan_ke' => 1,
                'content' => $this->contentSukuBanjar(),
                'image' => 'https://placehold.co/800x450/92400e/ffffff?text=Suku+Banjar+Kaltara',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Suku Banjar aslinya berasal dari daerah mana?', 'opts' => ['Kalimantan Utara', 'Kalimantan Timur', 'Kalimantan Selatan', 'Kalimantan Tengah'], 'ans' => 'Kalimantan Selatan'],
                        ['q' => 'Faktor utama Suku Banjar bermigrasi ke seluruh pulau Kalimantan adalah karena budaya?', 'opts' => ['Bertani', 'Mencari emas', 'Merantau (badagang/berdagang)', 'Berburu hewan hutan'], 'ans' => 'Merantau (badagang/berdagang)'],
                        ['q' => 'Agama mayoritas yang dianut oleh Suku Banjar dan sangat melekat dengan identitas budaya mereka adalah?', 'opts' => ['Islam', 'Kristen', 'Hindu', 'Buddha'], 'ans' => 'Islam'],
                        ['q' => 'Rumah adat suku Banjar yang menjadi pusat kehidupan sosial keluarga besar disebut?', 'opts' => ['Rumah Lamin', 'Rumah Gadang', 'Rumah Bubungan Tinggi', 'Rumah Betang'], 'ans' => 'Rumah Bubungan Tinggi'],
                        ['q' => 'Selain berdagang, keahlian masyarakat Banjar di daerah pesisir sungai Kaltara adalah?', 'opts' => ['Membangun perahu dan berniaga di jalur sungai', 'Menebang pohon ulin', 'Membuat pedang besi', 'Bertani padi sawah terasering'], 'ans' => 'Membangun perahu dan berniaga di jalur sungai'],
                    ],
                    'posttest' => [
                        ['q' => 'Kawasan sungai yang paling banyak didiami perantau Banjar di Kaltara pada masa lalu adalah di sekitar?', 'opts' => ['Krayan', 'Pesisir Tarakan dan Bulungan', 'Pedalaman Malinau', 'Gunung Krayan'], 'ans' => 'Pesisir Tarakan dan Bulungan'],
                        ['q' => 'Kerajaan besar di Kalimantan Selatan yang sangat berpengaruh terhadap kebudayaan Banjar adalah Kesultanan?', 'opts' => ['Kutai Kartanegara', 'Bulungan', 'Banjar (Banjarmasin)', 'Berau'], 'ans' => 'Banjar (Banjarmasin)'],
                        ['q' => 'Budaya berdagang Banjar melahirkan sistem pertukaran yang khas di perairan Kalimantan yaitu?', 'opts' => ['Pasar Malam', 'Pasar Terapung', 'Pasar Senggol', 'Mall Sungai'], 'ans' => 'Pasar Terapung'],
                        ['q' => 'Kain tradisional hasil karya perempuan Banjar yang terkenal di seluruh Indonesia dinamakan kain?', 'opts' => ['Batik', 'Songket', 'Sasirangan', 'Ulap Doyo'], 'ans' => 'Sasirangan'],
                        ['q' => 'Bahasa penghubung (lingua franca) perdagangan antar suku di Kalimantan banyak mengadopsi kosakata dari bahasa?', 'opts' => ['Dayak Kenyah', 'Melayu Banjar', 'Tidung', 'Sunda'], 'ans' => 'Melayu Banjar'],
                    ]
                ]
            ],
            [
                'title' => 'Musik Panting: Harmoni Suku Banjar',
                'slug' => 'musik-panting-harmoni-suku-banjar',
                'description' => 'Mempelajari keindahan dan instrumen Musik Panting khas Banjar.',
                'kompetensi_dasar' => '3.2 Menganalisis elemen Musik Panting Banjar.',
                'pertemuan_ke' => 2,
                'content' => $this->contentMusikPanting(),
                'image' => 'https://placehold.co/800x450/92400e/ffffff?text=Musik+Panting',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Instrumen utama yang menghasilkan melodi pada Musik Panting terbuat dari kayu?', 'opts' => ['Jati', 'Besi (Ulin)', 'Nangka', 'Sengon'], 'ans' => 'Nangka'],
                        ['q' => 'Alat musik Panting dimainkan dengan cara?', 'opts' => ['Ditiup', 'Dipetik (Dawai)', 'Dipukul keras', 'Digesek'], 'ans' => 'Dipetik (Dawai)'],
                        ['q' => 'Alat perkusi pelengkap dari kuningan dalam ansambel Panting disebut?', 'opts' => ['Babun', 'Kendang', 'Garantung', 'Kangkung'], 'ans' => 'Kangkung'],
                        ['q' => 'Musik Panting berkembang pada era Kesultanan Banjar di abad ke?', 'opts' => ['Abad ke-10', 'Abad ke-17', 'Abad ke-21', 'Abad ke-12'], 'ans' => 'Abad ke-17'],
                        ['q' => 'Musik Panting tradisional digunakan untuk mengiringi?', 'opts' => ['Tari perang', 'Syair puisi Melayu (Madihin) dan cerita rakyat', 'Pesta panen', 'Perkelahian adat'], 'ans' => 'Syair puisi Melayu (Madihin) dan cerita rakyat'],
                    ],
                    'posttest' => [
                        ['q' => 'Suara yang dihasilkan Musik Panting memiliki ritme?', 'opts' => ['Melankolis dan suram', 'Lincah, dinamis dan menghibur', 'Sangat keras dan bising', 'Sangat lambat (langgam)'], 'ans' => 'Lincah, dinamis dan menghibur'],
                        ['q' => 'Gendang kecil yang berfungsi mengatur tempo (rhythm) Panting adalah?', 'opts' => ['Gong', 'Babun', 'Rebana', 'Tifa'], 'ans' => 'Babun'],
                        ['q' => 'Instrumen dawai modern (pengaruh Eropa/Timur Tengah) yang kemudian diadaptasi masuk ke ansambel Panting adalah?', 'opts' => ['Gitar listrik', 'Piano', 'Biola atau Piul', 'Terompet'], 'ans' => 'Biola atau Piul'],
                        ['q' => 'Kapan Musik Panting paling sering ditampilkan dalam acara masyarakat Banjar?', 'opts' => ['Pemakaman', 'Upacara pernikahan (Batamat Al-Quran) dan sambut tamu', 'Buka puasa', 'Penebangan hutan'], 'ans' => 'Upacara pernikahan (Batamat Al-Quran) dan sambut tamu'],
                        ['q' => 'Skala nada yang umum digunakan pada melodi Musik Panting adalah?', 'opts' => ['Diatonik Barat', 'Pentatonik Melayu', 'Kromatik', 'Pelog Jawa'], 'ans' => 'Pentatonik Melayu'],
                    ]
                ]
            ],
            [
                'title' => 'Seni Bertutur Madihin',
                'slug' => 'seni-bertutur-madihin',
                'description' => 'Mempelajari seni sastra lisan berpantun (Madihin) yang menghibur.',
                'kompetensi_dasar' => '3.3 Mengapresiasi sastra lisan Madihin Banjar.',
                'pertemuan_ke' => 3,
                'content' => $this->contentMadihin(),
                'image' => 'https://placehold.co/800x450/92400e/ffffff?text=Seni+Madihin',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Kesenian Madihin dari Suku Banjar pada intinya adalah seni?', 'opts' => ['Tari-tarian', 'Bertutur (pantun bersyair lisan)', 'Seni lukis', 'Seni pahat kayu'], 'ans' => 'Bertutur (pantun bersyair lisan)'],
                        ['q' => 'Seorang seniman yang membawakan seni Madihin disebut?', 'opts' => ['Pemadihin', 'Dalang', 'Pesinden', 'Mangkutak'], 'ans' => 'Pemadihin'],
                        ['q' => 'Alat musik perkusi khas yang dibawa dan ditabuh oleh seniman Madihin adalah?', 'opts' => ['Sape', 'Gong Besar', 'Tar / Terbang (Rebana besar)', 'Gendang panjang'], 'ans' => 'Tar / Terbang (Rebana besar)'],
                        ['q' => 'Salah satu fungsi utama Madihin dalam masyarakat adalah untuk?', 'opts' => ['Berkomunikasi dengan roh leluhur', 'Sarana dakwah agama Islam dan hiburan masyarakat', 'Meminta hujan turun', 'Menghukum penjahat'], 'ans' => 'Sarana dakwah agama Islam dan hiburan masyarakat'],
                        ['q' => 'Isi atau konten lirik Madihin biasanya bernuansa?', 'opts' => ['Tragedi', 'Horor dan mistis', 'Nasihat bijak (pepatah) yang disisipi humor/jenaka', 'Sejarah peperangan mematikan'], 'ans' => 'Nasihat bijak (pepatah) yang disisipi humor/jenaka'],
                    ],
                    'posttest' => [
                        ['q' => 'Kata "Madihin" diserap dari kata Arab "Madah" yang artinya?', 'opts' => ['Berdusta', 'Pujian atau nasehat', 'Menyanyi', 'Menangis'], 'ans' => 'Pujian atau nasehat'],
                        ['q' => 'Pertunjukan Madihin menuntut senimannya untuk memiliki kemampuan?', 'opts' => ['Melukis di kanvas', 'Bermain sulap', 'Improvisasi lirik / merangkai rima secara spontan', 'Menyelam di sungai'], 'ans' => 'Improvisasi lirik / merangkai rima secara spontan'],
                        ['q' => 'Struktur syair Madihin pada umumnya menggunakan pola persajakan?', 'opts' => ['a-b-a-b atau a-a-a-a (pantun dan syair)', 'Bebas tanpa rima', 'Haiku Jepang', 'Ghazal India'], 'ans' => 'a-b-a-b atau a-a-a-a (pantun dan syair)'],
                        ['q' => 'Bagian pembukaan dalam Madihin biasanya berupa pujian syukur yang disebut?', 'opts' => ['Gong', 'Sampiran', 'Salam / Mukadimah Puji-pujian kepada Tuhan', 'Penutup'], 'ans' => 'Salam / Mukadimah Puji-pujian kepada Tuhan'],
                        ['q' => 'Di Kalimantan Utara, kesenian Madihin sering dipentaskan di panggung budaya terutama saat perayaan?', 'opts' => ['Pesta Panen Padi', 'Hari Raya Islam (Idul Fitri/Maulid Nabi) atau resepsi pernikahan', 'Pemakaman', 'Musim kemarau'], 'ans' => 'Hari Raya Islam (Idul Fitri/Maulid Nabi) atau resepsi pernikahan'],
                    ]
                ]
            ],
            [
                'title' => 'Kain Sasirangan: Mahakarya Ikat Celup',
                'slug' => 'kain-sasirangan-mahakarya-ikat-celup',
                'description' => 'Mempelajari teknik ikat celup kain Sasirangan khas Banjar.',
                'kompetensi_dasar' => '3.4 Memahami teknik pembuatan dan filosofi motif Sasirangan.',
                'pertemuan_ke' => 4,
                'content' => $this->contentSasirangan(),
                'image' => 'https://placehold.co/800x450/92400e/ffffff?text=Kain+Sasirangan',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Kain tradisional kebanggaan Suku Banjar disebut kain?', 'opts' => ['Batik', 'Sasirangan', 'Songket', 'Ulap Doyo'], 'ans' => 'Sasirangan'],
                        ['q' => 'Teknik apa yang digunakan untuk membuat pola pada kain Sasirangan?', 'opts' => ['Cap stempel', 'Batik lilin (malam)', 'Ikat celup (menjahit/merintang dan mewarnai)', 'Mesin cetak tekstil'], 'ans' => 'Ikat celup (menjahit/merintang dan mewarnai)'],
                        ['q' => 'Nama "Sasirangan" berasal dari kata Banjar "Menyirang" yang artinya?', 'opts' => ['Menjemur kain', 'Mencuci baju', 'Menjelujur (menjahit sementara) pakai benang', 'Mencampur warna'], 'ans' => 'Menjelujur (menjahit sementara) pakai benang'],
                        ['q' => 'Pada zaman dahulu, kain Sasirangan dikenal sebagai kain "Pamintaan" yang dipercaya dapat?', 'opts' => ['Mendatangkan hujan', 'Dipakai sebagai obat atau pengusir penyakit (magis)', 'Membuat kebal senjata', 'Menangkap ikan'], 'ans' => 'Dipakai sebagai obat atau pengusir penyakit (magis)'],
                        ['q' => 'Motif Sasirangan yang menyerupai ombak disebut motif?', 'opts' => ['Gigi Haruan (Gigi Ikan Gabus)', 'Ombak Sinapur Karang', 'Naga Balimbur', 'Bayem Raja'], 'ans' => 'Ombak Sinapur Karang'],
                    ],
                    'posttest' => [
                        ['q' => 'Motif tajam seperti segitiga berjajar (gigi) pada Sasirangan yang terinspirasi dari ikan predator sungai adalah?', 'opts' => ['Gigi Hiu', 'Gigi Haruan (Gigi ikan gabus)', 'Gigi Buaya', 'Gigi Piranha'], 'ans' => 'Gigi Haruan (Gigi ikan gabus)'],
                        ['q' => 'Warna kuning pada kain Sasirangan zaman dahulu, selain dari kunyit, secara magis melambangkan diperuntukkan bagi?', 'opts' => ['Kaum tani', 'Pengobatan penyakit kuning (penyakit hati)', 'Perang', 'Penyakit mata'], 'ans' => 'Pengobatan penyakit kuning (penyakit hati)'],
                        ['q' => 'Langkah pertama membuat Sasirangan setelah mendesain motif di atas kain adalah?', 'opts' => ['Mencelup warna merah', 'Menjahit jelujur pada pola lalu ditarik erat (disirang)', 'Langsung dijemur matahari', 'Disetrika panas'], 'ans' => 'Menjahit jelujur pada pola lalu ditarik erat (disirang)'],
                        ['q' => 'Pewarna hitam alami untuk Sasirangan zaman lampau biasanya didapat dari?', 'opts' => ['Kunyit', 'Daun pandan', 'Jelaga (Kabuau) kayu / aren', 'Batu bara'], 'ans' => 'Jelaga (Kabuau) kayu / aren'],
                        ['q' => 'Di era modern di Kaltara, kain Sasirangan banyak diaplikasikan menjadi?', 'opts' => ['Atap rumah', 'Pakaian Dinas Harian (PDH) pegawai pemerintah atau seragam', 'Layar perahu', 'Jala ikan'], 'ans' => 'Pakaian Dinas Harian (PDH) pegawai pemerintah atau seragam'],
                    ]
                ]
            ],
            [
                'title' => 'Rumah Bubungan Tinggi dan Arsitektur Banjar',
                'slug' => 'rumah-bubungan-tinggi',
                'description' => 'Mengenal megahnya Rumah Bubungan Tinggi khas Suku Banjar.',
                'kompetensi_dasar' => '3.5 Menganalisis elemen arsitektur Bubungan Tinggi Banjar.',
                'pertemuan_ke' => 5,
                'content' => $this->contentArsitektur(),
                'image' => 'https://placehold.co/800x450/92400e/ffffff?text=Rumah+Bubungan+Tinggi',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Bangunan rumah adat paling ikonik peninggalan Kesultanan Banjar disebut?', 'opts' => ['Rumah Bubungan Tinggi', 'Rumah Lamin', 'Rumah Lanting', 'Rumah Joglo'], 'ans' => 'Rumah Bubungan Tinggi'],
                        ['q' => 'Bagian paling mencolok dari Rumah Bubungan Tinggi adalah?', 'opts' => ['Teras sangat panjang', 'Atap tengah yang sangat lancip (curam) ke atas', 'Tiang pendek menyentuh tanah', 'Tidak memiliki atap'], 'ans' => 'Atap tengah yang sangat lancip (curam) ke atas'],
                        ['q' => 'Material utama yang digunakan membangun rumah adat ini adalah?', 'opts' => ['Bambu kuning', 'Kayu Ulin (kayu besi)', 'Batu bata', 'Papan triplek'], 'ans' => 'Kayu Ulin (kayu besi)'],
                        ['q' => 'Selain adaptasi cuaca, mengapa Rumah Bubungan Tinggi berbentuk panggung tinggi?', 'opts' => ['Karena wilayah rawan gempa', 'Agar aman dari luapan banjir/pasang surut sungai dan serangan hewan buas', 'Untuk gudang mobil', 'Karena diwajibkan oleh sultan'], 'ans' => 'Agar aman dari luapan banjir/pasang surut sungai dan serangan hewan buas'],
                        ['q' => 'Ornamen ukiran kayu silang di ujung atap Rumah Bubungan Tinggi melambangkan kepala burung Enggang atau naga yang disebut?', 'opts' => ['Kubah emas', 'Sungkul / Jamang', 'Tali angin', 'Sirap'], 'ans' => 'Sungkul / Jamang'],
                    ],
                    'posttest' => [
                        ['q' => 'Tingkat kemiringan atap tengah yang sangat curam (bubungan) bertujuan untuk?', 'opts' => ['Mengusir roh jahat', 'Mempercepat turunnya air hujan agar atap tidak lapuk', 'Menyimpan padi di atap', 'Mengintai musuh'], 'ans' => 'Mempercepat turunnya air hujan agar atap tidak lapuk'],
                        ['q' => 'Ruang tamu depan terbuka di Rumah Bubungan Tinggi disebut?', 'opts' => ['Palatar', 'Panampik', 'Bilik', 'Dapur'], 'ans' => 'Palatar'],
                        ['q' => 'Pintu masuk ke dalam rumah utama sering dikelilingi oleh ukiran tumbuhan dan bunga yang disebut ukiran?', 'opts' => ['Motif floral Banjar', 'Motif Aso', 'Motif Parang', 'Motif Cakar'], 'ans' => 'Motif floral Banjar'],
                        ['q' => 'Secara tradisi Kesultanan, Rumah Bubungan Tinggi hanya boleh dibangun atau dimiliki oleh?', 'opts' => ['Petani biasa', 'Raja/Sultan atau keluarga kerajaan Banjar', 'Pedagang pasar', 'Prajurit'], 'ans' => 'Raja/Sultan atau keluarga kerajaan Banjar'],
                        ['q' => 'Atap Rumah Bubungan Tinggi aslinya terbuat dari susunan kepingan kayu ulin tipis yang disebut atap?', 'opts' => ['Genteng tanah', 'Sirap', 'Seng', 'Rumbia'], 'ans' => 'Sirap'],
                    ]
                ]
            ],
            [
                'title' => 'Kuliner Banjar: Cita Rasa Bumbu Rempah',
                'slug' => 'kuliner-banjar-cita-rasa-bumbu',
                'description' => 'Mempelajari kuliner ikonik masyarakat Banjar, seperti Soto Banjar.',
                'kompetensi_dasar' => '3.6 Mengetahui kekayaan resep tradisional kuliner Banjar.',
                'pertemuan_ke' => 6,
                'content' => $this->contentKulinerBanjar(),
                'image' => 'https://placehold.co/800x450/92400e/ffffff?text=Kuliner+Banjar',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Masakan berkuah kaldu ayam khas suku Banjar yang paling terkenal secara nasional adalah?', 'opts' => ['Coto Makassar', 'Soto Banjar', 'Soto Lamongan', 'Soto Betawi'], 'ans' => 'Soto Banjar'],
                        ['q' => 'Bumbu rempah yang membuat kaldu Soto Banjar sangat wangi dan sedikit menyerupai masakan Arab/Timur Tengah adalah?', 'opts' => ['Bawang putih saja', 'Kapulaga, Cengkeh, Kayu Manis, dan Pala', 'Cabai dan tomat', 'Lengkuas merah'], 'ans' => 'Kapulaga, Cengkeh, Kayu Manis, dan Pala'],
                        ['q' => 'Makanan pendamping utama pengganti nasi putih saat makan Soto Banjar adalah?', 'opts' => ['Singkong rebus', 'Ketupat', 'Roti tawar', 'Mie kuning besar'], 'ans' => 'Ketupat'],
                        ['q' => 'Ikan air tawar predator (ikan gabus) yang menjadi lauk favorit dan kebanggaan Banjar adalah ikan?', 'opts' => ['Lele', 'Haruan', 'Nila', 'Patin'], 'ans' => 'Haruan'],
                        ['q' => 'Kue tradisional manis (Wadai) Banjar yang berbentuk lingkaran lapis-lapis dan sangat lembut disebut?', 'opts' => ['Bingka', 'Lapis legit', 'Kue pukis', 'Kue putu'], 'ans' => 'Bingka'],
                    ],
                    'posttest' => [
                        ['q' => 'Soto Banjar memiliki warna kuah kaldu agak keruh dan kental karena dicampur dengan bahan pengental khusus yaitu?', 'opts' => ['Santan kelapa tebal', 'Susu cair atau kuning telur bebek', 'Tepung beras putih', 'Kecap manis'], 'ans' => 'Susu cair atau kuning telur bebek'],
                        ['q' => 'Masakan ikan Patin atau Haruan dengan bumbu kuning kemerahan rasa asam manis khas Banjar disebut?', 'opts' => ['Ikan bakar', 'Gangan Asam (Sayur Asam) Ikan', 'Pepes ikan', 'Ikan goreng tepung'], 'ans' => 'Gangan Asam (Sayur Asam) Ikan'],
                        ['q' => 'Ikan panggang khas Banjar biasanya selalu diolesi bumbu dasar yang kuat aroma?', 'opts' => ['Lada hitam', 'Terasi, asam jawa, dan kemiri', 'Keju', 'Mayones'], 'ans' => 'Terasi, asam jawa, dan kemiri'],
                        ['q' => 'Bingka kentang atau bingka barandam sering dijumpai pada saat bulan apa di pasar jajanan (wadai) Banjar?', 'opts' => ['Bulan kemarau', 'Bulan suci Ramadhan', 'Tahun baru masehi', 'Hari kemerdekaan'], 'ans' => 'Bulan suci Ramadhan'],
                        ['q' => 'Sambal pelengkap hidangan Banjar yang rasanya pedas menyengat, wangi limau kuit, dan berbahan dasar mangga muda/mangga kasturi disebut sambal?', 'opts' => ['Sambal kecap', 'Sambal Acan (Terasi) Mangga', 'Sambal bawang', 'Sambal kacang'], 'ans' => 'Sambal Acan (Terasi) Mangga'],
                    ]
                ]
            ],
            [
                'title' => 'Tradisi Daur Hidup Banjar: Batamat Al-Quran',
                'slug' => 'tradisi-daur-hidup-batamat-alquran',
                'description' => 'Mengenal upacara Batamat Al-Quran, syukuran khatam mengaji khas Banjar.',
                'kompetensi_dasar' => '3.7 Memahami perpaduan ajaran Islam dan budaya lokal Banjar.',
                'pertemuan_ke' => 7,
                'content' => $this->contentBatamat(),
                'image' => 'https://placehold.co/800x450/92400e/ffffff?text=Batamat+AlQuran',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Upacara tradisional Banjar bagi anak atau calon pengantin yang telah tamat mengaji Al-Quran disebut upacara?', 'opts' => ['Batamat Al-Quran', 'Bawalah', 'Balimau', 'Tepung Tawar'], 'ans' => 'Batamat Al-Quran'],
                        ['q' => 'Batamat Al-Quran biasanya dilangsungkan berbarengan dengan acara besar keluarga yaitu?', 'opts' => ['Pesta panen padi', 'Acara Resepsi Pernikahan (Pengantin Banjar)', 'Pemakaman massal', 'Tahun baru hijriah'], 'ans' => 'Acara Resepsi Pernikahan (Pengantin Banjar)'],
                        ['q' => 'Payung hias meriah bermotif warna-warni (merah/kuning) yang dibawa selama arak-arakan Batamat disebut?', 'opts' => ['Payung ubur-ubur', 'Payung Ubur-ubur / Payung Kertas Banjar', 'Payung terjun', 'Payung hitam'], 'ans' => 'Payung Ubur-ubur / Payung Kertas Banjar'],
                        ['q' => 'Alat musik tradisional yang bertalu-talu mengiringi arak-arakan khataman Al-Quran ini adalah?', 'opts' => ['Gitar listrik', 'Sinoman Hadrah (Terbang/Rebana besar)', 'Piano klasik', 'Seruling bambu'], 'ans' => 'Sinoman Hadrah (Terbang/Rebana besar)'],
                        ['q' => 'Makanan atau kue simbolis berbentuk kerucut ketan khas yang disajikan untuk dibagikan saat syukuran Batamat disebut?', 'opts' => ['Nasi tumpeng ketan (Nasi Astakona/Balai)', 'Kue tar besar', 'Roti buaya', 'Lemper raksasa'], 'ans' => 'Nasi tumpeng ketan (Nasi Astakona/Balai)'],
                    ],
                    'posttest' => [
                        ['q' => 'Apa tujuan dan nilai moral utama dari pelaksanaan upacara Batamat Al-Quran?', 'opts' => ['Menghabiskan harta keluarga', 'Rasa syukur dan pengingat bahwa calon pengantin/anak telah dibekali ilmu agama sebagai pedoman hidup', 'Unjuk kekayaan kepada tetangga', 'Sebagai hiburan malam hari'], 'ans' => 'Rasa syukur dan pengingat bahwa calon pengantin/anak telah dibekali ilmu agama sebagai pedoman hidup'],
                        ['q' => 'Dalam prosesi Batamat, sang anak/pengantin akan membaca surah-surah pendek juz ke berapa dari Al-Quran?', 'opts' => ['Juz 1', 'Juz 30 (Amma)', 'Seluruh Al-Quran 30 Juz saat acara', 'Tidak membaca, hanya duduk'], 'ans' => 'Juz 30 (Amma)'],
                        ['q' => 'Ornamen khas Batamat yang dibuat dari bambu dihiasi bendera kertas atau uang kertas (Pohon Uang) untuk diperebutkan disebut?', 'opts' => ['Pohon beringin', 'Pohon kembang / Payung Kembang Uang', 'Pohon kurma', 'Bunga mawar palsu'], 'ans' => 'Pohon kembang / Payung Kembang Uang'],
                        ['q' => 'Kesenian Hadrah (Sinoman Hadrah) yang mengiringi berasal dari akulturasi budaya Islam Timur Tengah dengan?', 'opts' => ['Budaya Arab murni tanpa campuran', 'Budaya Banjar / Melayu pesisir', 'Budaya Tiongkok', 'Budaya Eropa'], 'ans' => 'Budaya Banjar / Melayu pesisir'],
                        ['q' => 'Proses memercikkan air doa campuran kembang ke wajah anak/pengantin di akhir acara sebagai simbol keberkahan disebut prosesi?', 'opts' => ['Siraman / Bapalas', 'Mandi lumpur', 'Mandi hujan', 'Minum madu'], 'ans' => 'Siraman / Bapalas'],
                    ]
                ]
            ],
            [
                'title' => 'Budaya Perairan Banjar: Pasar Terapung dan Lanting',
                'slug' => 'budaya-perairan-banjar-lanting',
                'description' => 'Mempelajari cara hidup Suku Banjar yang tak terpisahkan dari sungai.',
                'kompetensi_dasar' => '3.8 Mengidentifikasi elemen budaya sungai Suku Banjar.',
                'pertemuan_ke' => 8,
                'content' => $this->contentLanting(),
                'image' => 'https://placehold.co/800x450/92400e/ffffff?text=Pasar+Terapung',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Rumah tradisional Suku Banjar yang dibangun terapung mengapung di atas sungai (dirakit di atas batang kayu besar) dinamakan rumah?', 'opts' => ['Rumah Panggung', 'Rumah Lanting', 'Rumah Bubungan Tinggi', 'Rumah Kaca'], 'ans' => 'Rumah Lanting'],
                        ['q' => 'Batang kayu raksasa penyangga Rumah Lanting di bawah air agar mengapung tidak tenggelam adalah?', 'opts' => ['Batang pisang', 'Batang Pohon Binuang atau Ulin besar utuh', 'Drum plastik', 'Semen beton'], 'ans' => 'Batang Pohon Binuang atau Ulin besar utuh'],
                        ['q' => 'Pasar tradisional masyarakat Banjar yang aktivitas jual belinya dilakukan sepenuhnya dari atas perahu klotok di sungai disebut?', 'opts' => ['Pasar Kaget', 'Pasar Terapung', 'Pasar Malam', 'Pasar Senggol'], 'ans' => 'Pasar Terapung'],
                        ['q' => 'Perahu kecil (sampan) bermesin tempel di buritan, yang bunyinya tok-tok-tok khas perairan sungai Kalimantan dinamakan perahu?', 'opts' => ['Kapal Feri', 'Klotok', 'Yacht', 'Kapal induk'], 'ans' => 'Klotok'],
                        ['q' => 'Perempuan-perempuan Banjar pedagang di pasar terapung biasanya mengenakan pelindung kepala dari panas berupa topi anyam yang disebut?', 'opts' => ['Topi Koboi', 'Tanggui', 'Peci / Kopiah', 'Helm motor'], 'ans' => 'Tanggui'],
                    ],
                    'posttest' => [
                        ['q' => 'Apa alasan utama suku Banjar lampau sering membangun rumah Lanting (terapung)?', 'opts' => ['Agar tidak bayar pajak tanah dan mudah berpindah mengikuti sumber rezeki sungai', 'Karena takut tanah longsor di gunung', 'Untuk berperang', 'Karena larangan raja membangun di darat'], 'ans' => 'Agar tidak bayar pajak tanah dan mudah berpindah mengikuti sumber rezeki sungai'],
                        ['q' => 'Kehidupan berpusat pada sungai menjadikan masyarakat Banjar memiliki julukan sebagai manusia?', 'opts' => ['Manusia Daratan', 'Urang Banyu (Masyarakat Air / Sungai)', 'Manusia Gunung', 'Orang Laut Lepas'], 'ans' => 'Urang Banyu (Masyarakat Air / Sungai)'],
                        ['q' => 'Topi Tanggui khas Banjar (terendak lebar) umumnya dibuat dari anyaman bahan alam, yaitu?', 'opts' => ['Plastik sintetis', 'Daun nipah atau pandan yang dianyam rapat', 'Besi alumunium', 'Kulit sapi kering'], 'ans' => 'Daun nipah atau pandan yang dianyam rapat'],
                        ['q' => 'Sistem barter (tukar barang dengan barang) di kalangan para pedagang di Pasar Terapung pada era lampau disebut dengan istilah?', 'opts' => ['Bapandir', 'Bapanduk / Bapandulan (Tukar menukar komoditas alam)', 'Uang koin', 'Kartu kredit'], 'ans' => 'Bapanduk / Bapandulan (Tukar menukar komoditas alam)'],
                        ['q' => 'Perahu panjang dan ramping tanpa mesin yang didayung dengan kayuh tunggal, andalan ibu-ibu berjualan di sungai adalah?', 'opts' => ['Jukung', 'Kapal pesiar', 'Sampan layar', 'Speedboat'], 'ans' => 'Jukung'],
                    ]
                ]
            ],
        ];

        foreach ($materials as $data) {
            $quizzes = $data['quizzes'];
            unset($data['quizzes']);

            $data['category'] = 'banjar';
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

    private function contentSukuBanjar(): string
    {
        return <<<'HTML'
<h2>Suku Banjar di Kalimantan Utara</h2>
<p>Suku Banjar merupakan salah satu suku terbesar yang bermigrasi (merantau) dan memiliki pengaruh kultural serta ekonomi yang sangat besar di seluruh daratan Borneo, tak terkecuali di Provinsi Kalimantan Utara. Akar rumpun dan sejarah Suku Banjar sejatinya berasal dari daerah Kalimantan Selatan, dengan pusat kejayaan masa lampau berada di wilayah Kesultanan Banjar (Banjarmasin).</p>

<h3>Budaya Merantau (Badagang)</h3>
<p>Suku Banjar memiliki karakter ulet dan pantang menyerah yang tergambar jelas dari tradisi merantau mereka. Merantau bagi masyarakat Banjar bukanlah sekadar pindah tempat tinggal, tetapi merupakan sebuah strategi ekonomi—terutama berdagang—di sepanjang alur-alur sungai raksasa di Kalimantan. Para saudagar Banjar bergerak menggunakan perahu melintasi pesisir timur Kalimantan, hingga masuk dan menetap di perairan Tarakan, Bulungan, dan Berau sejak ratusan tahun silam.</p>

<h3>Identitas Islam yang Kuat</h3>
<p>Karakteristik kultural yang paling mendasar bagi suku Banjar adalah identitas keislaman mereka yang teramat kuat. Berbeda dengan masyarakat pedalaman (Dayak) yang banyak mempertahankan tradisi leluhur, Suku Banjar membawa serta syiar Islam dalam interaksi perdagangan mereka. Budaya, bahasa, dan kesenian Banjar seluruhnya bernafaskan dan memiliki unsur perpaduan yang harmonis dengan syariat dan kesenian Islam (Melayu-Islam).</p>

<h3>Pengaruh Bahasa dan Asimilasi</h3>
<p>Bahasa Melayu Banjar terbukti sangat adaptif. Dalam perdagangan antar suku di pelabuhan Tarakan atau Bulungan pada era kerajaan, bahasa Melayu Banjar sering kali menjadi lingua franca (bahasa pengantar utama). Banyak kosa kata bahasa Banjar yang diadopsi ke dalam percakapan pasar pesisir masyarakat Kalimantan Utara saat ini.</p>
HTML;
    }

    private function contentMusikPanting(): string
    {
        return <<<'HTML'
<h2>Musik Panting: Harmoni Suku Banjar</h2>
<p>Kesenian suku Banjar memperlihatkan perpaduan antara budaya agraris (sungai) dengan budaya pesisir Melayu, yang menghasilkan sebuah instrumen musik petik yang elegan, lincah, dan penuh emosi: <strong>Musik Panting</strong>.</p>

<h3>Alat Musik Kayu Nangka</h3>
<p>Panting adalah alat musik dawai yang menjadi pusat (lead instrument) dari sebuah ansambel Banjar. Nama 'panting' sendiri dalam bahasa Banjar merujuk pada tindakan 'memetik' senar. Body (badan) alat musik ini umumnya diukir secara manual dari kayu pohon nangka yang terkenal akan resonansi suara organiknya yang bulat dan tidak cempreng. Panting pada awalnya dimainkan secara tunggal (solo), namun seiring perkembangan zaman digabung dengan alat musik lain hingga membentuk kelompok ansambel.</p>

<h3>Struktur Ansambel Panting</h3>
<p>Satu grup Musik Panting tidak hanya menyajikan bunyi dawai, melainkan diperkaya oleh ketukan instrumen perkusi ritmis:</p>
<ul>
    <li><strong>Babun (Gendang Kecil):</strong> Memberikan tempo lincah (rhythm).</li>
    <li><strong>Kangkung atau Agung (Gong Kuningan):</strong> Memberikan fondasi nada bass.</li>
    <li><strong>Biola (Piul):</strong> Instrumen dawai gesek dari Eropa ini diserap menjadi pelengkap yang memberikan nada mendayu panjang, selang-seling dengan petikan Panting.</li>
</ul>

<h3>Konteks Sosial Pertunjukan</h3>
<p>Pada awalnya, Panting dimainkan oleh seniman rakyat pada malam hari usai mereka bekerja, sebagai alat untuk bersenandung melantunkan syair-syair kasmaran (percintaan), nasihat kehidupan, maupun epik kepahlawanan. Saat ini, grup Musik Panting banyak disewa dan dipentaskan dalam pesta pernikahan (Resepsi/Pangantinan), sebagai bentuk sambutan kehormatan, serta dalam perayaan acara-acara formal pemerintahan di Kalimantan Utara untuk menyambut tamu-tamu VIP.</p>
HTML;
    }

    private function contentMadihin(): string
    {
        return <<<'HTML'
<h2>Seni Bertutur Madihin</h2>
<p>Selain instrumen musik melodis, masyarakat Banjar di Kalimantan memiliki salah satu jenis kesenian teater dan sastra lisan tertua yang sangat disukai publik: <strong>Madihin</strong>.</p>

<h3>Pengertian Madihin</h3>
<p>Kata <em>Madihin</em> berakar dari kata Arab "Madah" yang berarti pujian atau nasihat. Madihin pada dasarnya adalah seni bertutur (bercerita) menggunakan rima berpantun secara spontan dan berkesinambungan. Sang seniman, yang dijuluki <strong>Pemadihin</strong>, harus memiliki kecerdasan improvisasi tingkat tinggi karena ia diharuskan membalas pantun dari audiens atau rekannya, tanpa menggunakan naskah tertulis.</p>

<h3>Peralatan dan Gaya Pementasan</h3>
<p>Seorang Pemadihin tampil seorang diri atau berpasangan, dengan menggunakan pakaian adat Banjar lengkap (Laung atau ikat kepala khas Banjar). Selama melontarkan lirik, Pemadihin akan menabuh sebuah terbang atau rebana besar bertali (disebut Tar). Ketukan Tar berfungsi untuk memberikan jeda dramatis, menetapkan tempo kalimat, atau membangkitkan tawa penonton (punchline).</p>

<h3>Struktur Lirik dan Filosofi Nasihat</h3>
<p>Pertunjukan Madihin memiliki aturan baku meskipun liriknya spontan. Pertunjukan selalu diawali dengan <em>Salam dan Mukadimah</em> (puji-pujian pada Tuhan dan Nabi). Lalu dilanjutkan dengan <em>Isi Madihin</em>, dan diakhiri <em>Penutup</em> (permintaan maaf jika ada salah kata). Tema utama lirik Madihin biasanya adalah wejangan hidup, kritik sosial yang membangun, atau dakwah moral, yang semuanya dibungkus dalam bahasa yang amat jenaka, lucu, dan sangat menghibur, sehingga segala pesan moral tersebut mudah diterima oleh rakyat tanpa merasa digurui.</p>
HTML;
    }

    private function contentSasirangan(): string
    {
        return <<<'HTML'
<h2>Kain Sasirangan: Mahakarya Ikat Celup Banjar</h2>
<p>Setiap suku bangsa yang besar selalu memiliki warisan kain tradisional (tekstil) kebanggaan. Jika suku Jawa memiliki Batik, suku Dayak memilliki tenun Ulap Doyo, maka suku Banjar di perantauan Kalimantan Utara maupun Selatan sangat membanggakan mahakarya tekstil mereka: <strong>Kain Sasirangan</strong>.</p>

<h3>Filosofi "Menyirang"</h3>
<p>Istilah "Sasirangan" diambil dari kosa kata bahasa Banjar <em>sirang</em> atau <em>menyirang</em>, yang artinya menjelujur, yaitu menjahit pola menggunakan benang secara renggang, untuk kemudian diserut atau ditarik rapat. Kain yang telah terikat kuat inilah yang kemudian dicelupkan ke dalam tong berisi warna alami maupun buatan. Setelah kering dan benang jelujurnya dilepas, akan terbentuklah motif-motif rintang warna yang sangat memesona dan khas.</p>

<h3>Fungsi Magis "Kain Pamintaan" pada Masa Lampau</h3>
<p>Di masa Kesultanan Banjar kuno, Sasirangan bukanlah pakaian harian apalagi seragam. Kain ini dulunya disebut "Kain Pamintaan" (kain yang diminta/dipesan khusus) untuk keperluan ritual penyembuhan orang yang sakit. Dipercayai bahwa mengenakan kain Sasirangan berwarna tertentu akan menyembuhkan penyakit tertentu. Contohnya, kain sasirangan dasar kuning yang diwarnai dengan ekstrak rimpang kunyit khusus dibuat untuk pasien penderita penyakit kuning (liver).</p>

<h3>Ragam Motif dan Modernisasi</h3>
<p>Kain Sasirangan dihiasi berbagai motif khas yang diambil dari inspirasi alam liar Kalimantan:</p>
<ul>
    <li><strong>Motif Gigi Haruan:</strong> Terinspirasi dari gigi runcing ikan Gabus (Haruan) yang tajam; merupakan motif klasik dan sangat umum.</li>
    <li><strong>Motif Ombak Sinapur Karang:</strong> Melukiskan ombak yang membentur bebatuan karang.</li>
    <li><strong>Motif Naga Balimbur:</strong> Menggambarkan ular naga mistis yang sedang mandi atau berjemur.</li>
    <li><strong>Motif Bayam Raja:</strong> Menggambarkan garis-garis tegas bergelombang yang menunjukkan kelas sosial yang tinggi.</li>
</ul>
<p>Di masa sekarang, status kain Sasirangan bergeser dari ritual sakral menjadi fashion premium yang membanggakan. Di Kaltara, ASN, pegawai perbankan, dan anak-anak sekolah banyak menggunakan kain Sasirangan cerah sebagai seragam identitas lokal mereka di hari-hari tertentu.</p>
HTML;
    }

    private function contentArsitektur(): string
    {
        return <<<'HTML'
<h2>Rumah Bubungan Tinggi dan Arsitektur Banjar</h2>
<p>Kekayaan finansial hasil perniagaan serta tingginya budaya seni keraton Banjar pada masa lampau menghasilkan sebuah mahakarya arsitektur vernakular dari bahan kayu ulin utuh yang sangat megah. Yang paling ikonik di antara beragam jenis rumah adat Banjar adalah <strong>Rumah Bubungan Tinggi</strong>.</p>

<h3>Rumah Khusus Para Sultan dan Bangsawan</h3>
<p>Sesuai dengan namanya, ciri mutlak dari bangunan besar ini adalah atap pada bangunan sentral (inti) yang didesain melambung menukik sangat curam dan tajam ke langit. Kemiringan atap sirap ulin yang luar biasa curam ini (bisa mencapai 45 derajat lebih) diyakini mempercepat air curahan hujan lebat Borneo agar tidak tertahan dan melapukkan rangka atap.</p>
<p>Pada zaman dahulu, tidak sembarang rakyat jelata diizinkan mendirikan rumah bergaya ini. Rumah Bubungan Tinggi merupakan istana atau rumah tinggal eksklusif bagi kaum kerabat Sultan (bangsawan keraton). Jika ada penduduk kaya di luar kalangan bangsawan yang nekat mendirikan rumah ini, maka ia akan terkena sanksi adat dan sosial yang berat.</p>

<h3>Struktur Panggung yang Simbolik</h3>
<p>Rumah ini dibangun melayang pada tiang-tiang fondasi (panggung) yang amat tinggi (bisa lebih dari dua meter dari atas tanah). Hal ini sebagai respons adaptif atas kondisi topografi dataran rendah Kalimantan yang selalu dilanda pasang surut air sungai lebat rawa (pasang banyu), serta menjauhkan binatang liar dari ruangan inti rumah.</p>

<h3>Ruang dan Ornamen (Sungkul & Motif Floral)</h3>
<p>Tata ruang Rumah Bubungan Tinggi menggambarkan hierarki kesopanan:</p>
<ul>
    <li><strong>Palatar (Teras Depan):</strong> Tempat menerima tamu umum.</li>
    <li><strong>Panampik:</strong> Berjenjang tingkatannya (Panampik Bawah, Tengah, Atas) sesuai kasta sosial sang tamu sebelum masuk ke ruang utama raja.</li>
</ul>
<p>Sebagai masyarakat yang memeluk teguh agama Islam, ukiran kayu (tatah) di Rumah Banjar ini secara patuh menghindari motif makhluk hidup secara utuh (tidak ada figur dewa atau hewan penuh). Sebaliknya, ukiran yang mendominasi pintu, ventilasi, dan tiang adalah motif floral (kaligrafi bunga-bunga, daun-daun menjalar) serta ukiran berbentuk <strong>Jamang/Sungkul</strong> (puncak mahkota atap kayu yang menyerupai sayap burung yang diabstraksikan).</p>
HTML;
    }

    private function contentKulinerBanjar(): string
    {
        return <<<'HTML'
<h2>Kuliner Banjar: Cita Rasa Bumbu Rempah</h2>
<p>Menjelajah kuliner suku Banjar berarti kita sedang menelusuri sejarah kejayaan jalur rempah. Masakan khas Banjar sangat kaya dan kuat oleh bumbu-bumbu eksotis, dan cita rasanya sering memperlihatkan paduan antara masakan Melayu klasik dengan rempah khas hidangan Arab atau Timur Tengah.</p>

<h3>Soto Banjar: Raja dari Semua Soto</h3>
<p>Soto Banjar adalah duta besar kuliner suku Banjar yang telah merajai lidah nusantara. Kuah kaldu ayam Soto Banjar berwarna sedikit keruh kekuningan—bukan menggunakan santan, melainkan menggunakan campuran susu kental atau tumbukan kuning telur bebek yang membuatnya gurih menggiurkan. Rempah yang wajib ada untuk menciptakan wanginya adalah kapulaga, cengkeh, pala, kayu manis, dan bunga lawang. Soto ini disajikan bersama suwiran ayam kampung, potongan telur rebus, perkedel kentang, dan <strong>Ketupat</strong>, bukan nasi putih!</p>

<h3>Ikan Haruan (Gabus) dan Ikan Patin</h3>
<p>Orang Banjar memiliki kedekatan tak terpisahkan dengan ikan-ikan sungai berukuran besar, utamanya ikan Patin dan ikan Haruan (Gabus). Ada hidangan berkuah kaldu kuning kemerahan yang disebut <strong>Gangan Asam (Sayur Asam) Ikan Patin</strong>. Kuah ini memakai kunyit yang dibakar, sedikit terasi, dan belimbing wuluh yang menghasilkan sensasi kuah panas pedas dan super menyegarkan.</p>
<p>Untuk ikan panggang (Ikan Bakar khas Banjar), ikannya selalu dilumuri olesan bumbu pekat berbahan dasar terasi bakar, asam jawa, dan kemiri cincang sebelum dibakar di atas arang kayu ulin merah.</p>

<h3>Wadai (Kue) Bingka dan Pasar Ramadhan</h3>
<p>Sebagai masyarakat agraris maritim, Banjar memiliki koleksi penganan manis pencuci mulut (Wadai) yang sangat panjang ragamnya. Yang paling mahsyur adalah kue <strong>Bingka</strong> (baik bingka kentang maupun bingka telur/barandam). Kue basah berwarna kekuningan, empuk, dan legit ini dicetak di loyang bermotif kelopak bunga (biasanya enam kelopak bunga). Pada bulan Ramadhan, Pasar Wadai akan dibanjiri oleh puluhan ragam bingka yang diperuntukkan bagi hidangan berbuka puasa.</p>

<h3>Sambal Acan Limau Kuit</h3>
<p>Menutup sesi bersantap belum pas jika tidak ada sengatan pedas dari Sambal Acan. Sambal terasi Banjar sangat istimewa karena sering ditambahkan cacahan mangga muda (mangga kasturi) dan perasan air dari jeruk limau kuit lokal yang baunya amat wangi dan eksotik menembus hidung.</p>
HTML;
    }

    private function contentBatamat(): string
    {
        return <<<'HTML'
<h2>Tradisi Daur Hidup Banjar: Batamat Al-Quran</h2>
<p>Siklus hidup masyarakat Banjar ditandai dengan berbagai ritual tasyakuran (selamatan). Dari sekian banyak perayaan, ada satu tradisi daur hidup khas Melayu-Banjar yang memperlihatkan tingginya penghargaan keluarga terhadap pendidikan agama sang anak, yaitu upacara kelulusan membaca kitab suci, yang dinamakan <strong>Batamat Al-Quran</strong>.</p>

<h3>Makna dan Waktu Pelaksanaan</h3>
<p>Tradisi Batamat (khataman/menamatkan) Al-Quran biasanya digelar meriah saat seorang anak telah berhasil membaca (mengaji) kitab suci hingga juz terakhir (juz 30). Akan tetapi, pada masyarakat Banjar modern di Kaltara, upacara yang sarat kesakralan ini kerap disatukan dengan <strong>pesta resepsi pernikahan</strong> (Bapangantinan). Kedua mempelai pengantin, yang didandani memakai pakaian keraton (Ba'amar Galung Pancar Matahari), akan didudukkan di atas pelaminan untuk diuji kelancarannya membaca surah-surah pendek Juz Amma (mulai dari Surah Ad-Duha hingga An-Nas) di hadapan tetua agama desa (Tuan Guru) dan seluruh tetamu resepsi.</p>

<h3>Pohon Kembang Uang dan Payung Ubur-ubur</h3>
<p>Panggung Batamat dihiasi luar biasa meriah dan semarak warna merah-kuning keemasan khas keraton:</p>
<ul>
    <li><strong>Payung Ubur-ubur:</strong> Payung kertas minyak atau kain dengan tepi berjumbai panjang, yang dipayungkan di atas kepala anak yang sedang diarak menuju tempat khataman.</li>
    <li><strong>Pohon Bunga / Pohon Uang:</strong> Sebuah ornamen dari batang pisang atau bambu, yang ditusuk-tusuk dengan bilah-bilah lidi berhias bendera kertas dan dilekati lembaran-lembaran uang tunai (kertas). Saat upacara usai, tetamu dan anak-anak desa berhak berebut mencabut uang dari pohon tersebut.</li>
</ul>

<h3>Prosesi Sinoman Hadrah dan Balai Ketan</h3>
<p>Arak-arakan Batamat, khususnya bagi sang pengantin pria menuju ke rumah mempelai wanita, pasti akan diiringi oleh tabuhan dinamis nan megah dari kelompok <strong>Sinoman Hadrah</strong> (kesenian menabuh rebana besar sambil menyenandungkan salawat badar ala Timur Tengah). Setelah pembacaan doa syukur (doa khatam) selesai, upacara ditutup dengan sesi makan bersama dari <strong>Nasi Astakona atau Balai Ketan</strong> (tumpeng kerucut berbahan beras ketan kuning manis, kadang-kadang dihiasi telur bebek rebus dan irisan kelapa sangrai), sebagai simbol kegembiraan hati atas suksesnya tugas mulia keluarga menyekolahkan agama sang anak.</p>
HTML;
    }

    private function contentLanting(): string
    {
        return <<<'HTML'
<h2>Budaya Perairan Banjar: Pasar Terapung dan Lanting</h2>
<p>Suku Banjar sering pula dijuluki sebagai "Urang Banyu" atau Masyarakat Air. Identitas mereka tidak dapat dipisahkan dari peradaban bantaran sungai-sungai berarus lebar (seperti Sungai Barito, Sungai Mahakam, atau Sungai Kayan di Kaltara). Kebudayaan material Suku Banjar paling unik terlihat pada gaya hidup mereka yang bertumpu pada perahu dan rumah rakit.</p>

<h3>Rumah Lanting: Arsitektur Terapung Mengikuti Musim</h3>
<p>Berbeda dengan Rumah Bubungan Tinggi yang dipancang ke tanah dengan panggung kuat, masyarakat kelas pekerja dan nelayan di zaman dahulu banyak mendirikan tempat tinggal yang sepenuhnya terapung dan mengalun di atas air sungai. Struktur hunian ini dinamakan <strong>Rumah Lanting</strong>.</p>
<p>Rumah Lanting dibangun berbentuk gubuk kayu persegi sederhana, namun fondasinya adalah tumpukan batangan kayu hutan raksasa bulat yang disusun berjejer sejajar dan diikat rotan tebal. Batang kayu Binuang yang amat ringan (memiliki rongga berongga/udara) atau kayu ulin tua bertindak sebagai pelampung hidrolik alami. Ketika musim kemarau dan sungai surut, Rumah Lanting akan merendah mendekati dasar lumpur. Ketika musim hujan bandang turun dan debit sungai pasang meninggi, Rumah Lanting tetap aman mengapung naik ke atas, sehingga terhindar mutlak dari tragedi kebanjiran bandang (inundasi) yang sering menimpa rumah di daratan pesisir.</p>

<h3>Pasar Terapung dan Transaksi Bapanduk</h3>
<p>Tidak ada yang lebih indah dan otentik dari pemandangan niaga klasik masyarakat Banjar di waktu fajar menyingsing di atas riak air sungai: <strong>Pasar Terapung</strong>.</p>
<p>Ratusan pedagang—yang mayoritasnya adalah <em>Acil-Acil</em> (ibu-ibu paruh baya) menggunakan riasan bedak dingin pupur putih di wajah—mendayung perahu <strong>Jukung</strong> (sampan kayu mungil). Perahu-perahu mereka disesaki hasil ladang nan segar: buah jeruk, sayur mayur hijau, ikan gabus, hingga kue tradisional bingka hangat. Para pembeli menghampiri jukung tersebut menggunakan perahu mesin <strong>Klotok</strong> (perahu bermesin tempel berbahan bakar diesel yang suaranya tok-tok-tok berisik).</p>
<p>Menariknya, pada masa perdagangan tempo dulu, uang kartal/kertas jarang dipakai di tengah perahu goyang tersebut. Mereka mempraktikkan sistem dagang kuno bernama <em>Bapanduk</em> atau <em>Bapandulan</em>—yakni sistem barter atau tukar-menukar barang (misalnya sesisir pisang ambon ditukar dengan beberapa ekor ikan sepat kering). Ibu-ibu ini berlindung dari sengatan mentari fajar berbekal <strong>Tanggui</strong>, topi anyaman rotan dan daun nipah berdiameter super besar layaknya piring terbang parabola.</p>
<p>Walau di masa kini akses jalan tol darat sudah lebar terbentang dan swalayan menjamur di kota, esensi tradisi sungai Suku Banjar ini merupakan mahakarya kearifan sosiologis Asia yang dikagumi dunia turisme hingga kini.</p>
HTML;
    }
}
