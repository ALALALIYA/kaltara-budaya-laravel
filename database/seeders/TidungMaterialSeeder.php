<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Seeder;

class TidungMaterialSeeder extends Seeder
{
    public function run(): void
    {
        $guru = User::where('role', 'teacher')->first();

        $materials = [
            [
                'title' => 'Asal Usul Suku Tidung dan Kerajaan Tarakan',
                'slug' => 'asal-usul-suku-tidung-kerajaan',
                'description' => 'Mempelajari sejarah dan rumpun budaya Suku Tidung (Tengara) di Kalimantan Utara.',
                'kompetensi_dasar' => '3.1 Memahami sejarah Kerajaan Tidung dan pesisir Kaltara.',
                'pertemuan_ke' => 1,
                'content' => $this->contentSejarah(),
                'image' => 'https://placehold.co/800x450/4338ca/ffffff?text=Suku+Tidung',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Suku Tidung merupakan penduduk asli yang mayoritas mendiami wilayah pesisir utara dan pulau-pulau di provinsi?', 'opts' => ['Kalimantan Selatan', 'Kalimantan Timur', 'Kalimantan Utara (khususnya Tarakan & Nunukan)', 'Kalimantan Barat'], 'ans' => 'Kalimantan Utara (khususnya Tarakan & Nunukan)'],
                        ['q' => 'Nama "Tidung" diperkirakan berasal dari kata bahasa lokal "Tideng" yang artinya?', 'opts' => ['Gunung atau bukit', 'Sungai panjang', 'Laut dalam', 'Hutan pinus'], 'ans' => 'Gunung atau bukit'],
                        ['q' => 'Secara asal usul rumpun, Suku Tidung (Tengara) masih memiliki kedekatan kekerabatan darah (serumpun) dengan suku?', 'opts' => ['Suku Bugis Makassar', 'Suku Dayak (Rumpun Murut / Dayak Utara)', 'Suku Jawa Mataram', 'Suku Madura'], 'ans' => 'Suku Dayak (Rumpun Murut / Dayak Utara)'],
                        ['q' => 'Agama mayoritas yang dianut oleh masyarakat Suku Tidung saat ini dan membentuk kebudayaannya secara kuat (menjadi suku pesisir) adalah?', 'opts' => ['Kristen Katolik', 'Islam', 'Hindu Kaharingan', 'Konghucu'], 'ans' => 'Islam'],
                        ['q' => 'Pusat kebudayaan maritim dan pusat kerajaan historis Suku Tidung dahulu berada di wilayah kerajaan/kesultanan?', 'opts' => ['Kesultanan Ternate', 'Kerajaan Kutai', 'Kerajaan Tidung / Dinasti Tengara (Tarakan)', 'Kerajaan Banten'], 'ans' => 'Kerajaan Tidung / Dinasti Tengara (Tarakan)'],
                    ],
                    'posttest' => [
                        ['q' => 'Karena letaknya di wilayah pesisir kepulauan, mata pencaharian tradisional mayoritas masyarakat Suku Tidung adalah sebagai?', 'opts' => ['Petani apel', 'Nelayan (pencari ikan laut) dan pedagang pesisir', 'Penambang emas', 'Penebang pohon jati'], 'ans' => 'Nelayan (pencari ikan laut) dan pedagang pesisir'],
                        ['q' => 'Suku Tidung sering disebut sebagai suku "Pesisir" bersama dengan suku tetangganya yang erat sejarahnya dengan Kesultanan?', 'opts' => ['Suku Bulungan', 'Suku Asmat', 'Suku Mentawai', 'Suku Sasak'], 'ans' => 'Suku Bulungan'],
                        ['q' => 'Sistem monarki/pemerintahan suku Tidung masa lampau dipimpin oleh penguasa yang bergelar?', 'opts' => ['Gubernur', 'Raja / Sultan (Gelar Datuk atau Amiril)', 'Presiden', 'Bupati'], 'ans' => 'Raja / Sultan (Gelar Datuk atau Amiril)'],
                        ['q' => 'Perbedaan Suku Tidung dengan suku Dayak pedalaman di Kaltara sangat jelas terlihat pada?', 'opts' => ['Tidak ada perbedaan', 'Tidung lebih kuat berasimilasi budaya Melayu pesisir dan beragama Islam, sedangkan Dayak di pedalaman (agraris/hutan)', 'Tidung tinggal di atas pohon besar', 'Suku Dayak menguasai lautan dalam'], 'ans' => 'Tidung lebih kuat berasimilasi budaya Melayu pesisir dan beragama Islam, sedangkan Dayak di pedalaman (agraris/hutan)'],
                        ['q' => 'Warna identitas kebesaran (bendera/panji) masyarakat adat Tidung yang dominan digunakan dalam upacara, mirip dengan Kutai, adalah warna?', 'opts' => ['Kuning keemasan (melambangkan kebangsawanan kerajaan)', 'Hitam pekat', 'Merah darah', 'Abu-abu suram'], 'ans' => 'Kuning keemasan (melambangkan kebangsawanan kerajaan)'],
                    ]
                ]
            ],
            [
                'title' => 'Festival Iraw Tengkayu: Tolak Bala dan Sedekah Laut',
                'slug' => 'festival-iraw-tengkayu-tarakan',
                'description' => 'Mempelajari upacara adat laut Iraw Tengkayu masyarakat Tidung di Pantai Amal.',
                'kompetensi_dasar' => '3.2 Menganalisis nilai luhur upacara Iraw Tengkayu.',
                'pertemuan_ke' => 2,
                'content' => $this->contentIrawTengkayu(),
                'image' => 'https://placehold.co/800x450/4338ca/ffffff?text=Iraw+Tengkayu',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Upacara adat (festival budaya) turun-temurun terbesar milik masyarakat suku Tidung di Kota Tarakan dinamakan?', 'opts' => ['Erau Kutai', 'Iraw Tengkayu', 'Lompat Batu', 'Cap Go Meh'], 'ans' => 'Iraw Tengkayu'],
                        ['q' => 'Kata "Iraw" dalam bahasa lokal Tidung/Dayak bermakna?', 'opts' => ['Kesedihan', 'Pesta rakyat, perayaan, atau upacara gembira', 'Perang suku', 'Mencari ikan di laut'], 'ans' => 'Pesta rakyat, perayaan, atau upacara gembira'],
                        ['q' => 'Tujuan utama (filosofi) diselenggarakannya Iraw Tengkayu oleh masyarakat pesisir Tidung adalah sebagai ritual?', 'opts' => ['Syukuran / Sedekah laut atas rezeki tangkapan nelayan dan tolak bala', 'Menutup akses laut agar tidak ada kapal masuk', 'Hanya untuk lomba lari', 'Pamer kekayaan harta'], 'ans' => 'Syukuran / Sedekah laut atas rezeki tangkapan nelayan dan tolak bala'],
                        ['q' => 'Objek paling penting / ikonik yang diarak warga keliling kota sebelum dilarungkan ke tengah laut pada saat Iraw Tengkayu adalah?', 'opts' => ['Patung Naga Emas', 'Padaw Tuju Dulung (Perahu Tujuh Haluan)', 'Kereta Kencana Kuda', 'Meriam peninggalan Belanda'], 'ans' => 'Padaw Tuju Dulung (Perahu Tujuh Haluan)'],
                        ['q' => 'Biasanya acara puncak Iraw Tengkayu (pelarungan perahu adat) dilaksanakan setiap dua tahun sekali di lokasi?', 'opts' => ['Puncak Gunung Krayan', 'Pantai Amal Kota Tarakan (Tepi Laut Mamburungan)', 'Sungai Mahakam', 'Danau Toba'], 'ans' => 'Pantai Amal Kota Tarakan (Tepi Laut Mamburungan)'],
                    ],
                    'posttest' => [
                        ['q' => 'Angka "Tuju" (Tujuh) pada perahu Padaw Tuju Dulung bermakna sangat filosofis dan magis bagi suku Tidung karena angka 7 melambangkan?', 'opts' => ['Tujuh hari kemarau', 'Jumlah hari dalam sepekan kehidupan manusia dan keturunan lurus dewa-dewa Tidung', 'Tujuh warna pelangi', 'Tujuh pahlawan super'], 'ans' => 'Jumlah hari dalam sepekan kehidupan manusia dan keturunan lurus dewa-dewa Tidung'],
                        ['q' => 'Perahu Padaw Tuju Dulung dihias dengan perpaduan 3 warna sakral adat Tidung, yaitu?', 'opts' => ['Kuning, Hijau, dan Merah', 'Hitam, Putih, dan Abu', 'Pink, Biru, dan Ungu', 'Cokelat kayu polos'], 'ans' => 'Kuning, Hijau, dan Merah'],
                        ['q' => 'Apa sajakah isi bawaan persembahan (sesaji) yang dimuat ke dalam lambung kapal Padaw Tuju Dulung untuk dilarung ke laut?', 'opts' => ['Senjata tajam dan peluru', 'Makanan tradisional (Nasi rasul, kue-kue, hasil bumi/pertanian)', 'Emas batangan murni', 'Batu kali besar'], 'ans' => 'Makanan tradisional (Nasi rasul, kue-kue, hasil bumi/pertanian)'],
                        ['q' => 'Saat Padaw dilarung, masyarakat akan berebut air laut yang dilewati kapal atau bahkan berebut tiang panji kapal dengan kepercayaan akan mendapat?', 'opts' => ['Uang tunai', 'Keselamatan, kesembuhan penyakit, atau keberkahan rezeki dari Tuhan', 'Kekuatan terbang di udara', 'Kekuatan melawan polisi'], 'ans' => 'Keselamatan, kesembuhan penyakit, atau keberkahan rezeki dari Tuhan'],
                        ['q' => 'Dalam kalender wisata modern Nasional (Kharisma Event Nusantara - KEN), pelaksanaan Iraw Tengkayu ditetapkan sering bersamaan dengan perayaan?', 'opts' => ['Hari Natal', 'Hari Ulang Tahun (HUT) Kota Tarakan (bulan Desember)', 'Hari Raya Nyepi', 'Tahun Baru Imlek'], 'ans' => 'Hari Ulang Tahun (HUT) Kota Tarakan (bulan Desember)'],
                    ]
                ]
            ],
            [
                'title' => 'Tari Jepen Tidung: Gerak Pesisir Melayu',
                'slug' => 'tari-jepen-tidung-gerak-pesisir',
                'description' => 'Mengenal Tari Jepen versi suku Tidung yang anggun dan islami.',
                'kompetensi_dasar' => '3.3 Membandingkan kesenian tari Tidung dan suku lain.',
                'pertemuan_ke' => 3,
                'content' => $this->contentTariJepenTidung(),
                'image' => 'https://placehold.co/800x450/4338ca/ffffff?text=Tari+Jepen+Tidung',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Seni tari yang paling dominan di kalangan muda-mudi Suku Tidung Tarakan pada perayaan besar / penyambutan tamu adalah Tari?', 'opts' => ['Tari Kecak Bali', 'Tari Jepen (Zapin) Pesisir Tidung', 'Tari Kancet Papatai', 'Tari Hudoq'], 'ans' => 'Tari Jepen (Zapin) Pesisir Tidung'],
                        ['q' => 'Tari Jepen pesisir merupakan bukti nyata (akulturasi) pengaruh kuat masuknya agama dan kebudayaan dari daerah?', 'opts' => ['Amerika Latin', 'Islam Arab-Melayu', 'Jepang dan Korea', 'Pedalaman hutan rimba'], 'ans' => 'Islam Arab-Melayu'],
                        ['q' => 'Gerakan kaki pada Jepen Tidung terkenal dengan tempo gerak yang?', 'opts' => ['Lincah, patah-patah ringan selang-seling seirama rentak pukulan gendang', 'Terdiam tanpa gerak sama sekali', 'Berguling-guling di lantai keras', 'Melompat sangat tinggi melebihi kepala'], 'ans' => 'Lincah, patah-patah ringan selang-seling seirama rentak pukulan gendang'],
                        ['q' => 'Kesenian musik pengiring yang digunakan mirip dengan Jepen daerah lain, yaitu musik rebana dan petikan dawai arab yang disebut alat musik?', 'opts' => ['Gitar Spanyol', 'Gambus', 'Harpa Eropa', 'Piano klasik'], 'ans' => 'Gambus'],
                        ['q' => 'Penari wanita Tidung mengenakan pakaian sopan dan tertutup lengan panjang berbahan kain sutra polos/mengkilap warna kuning mencolok, pakaian ini dipengaruhi oleh nilai kesopanan dari agama?', 'opts' => ['Islam', 'Hindu', 'Buddha', 'Sikh'], 'ans' => 'Islam'],
                    ],
                    'posttest' => [
                        ['q' => 'Gerakan tangan menyilang di dada, menunduk anggun, dan senyum kecil (tidak berlebihan) dalam Jepen Tidung mengandung filosofi tentang?', 'opts' => ['Rasa angkuh dan sombong keluarga raja', 'Adab (budi pekerti), sopan santun, kerendahan hati wanita maritim', 'Menantang musuh untuk berkelahi fisik', 'Rasa sedih mendalam karena menangisi laut'], 'ans' => 'Adab (budi pekerti), sopan santun, kerendahan hati wanita maritim'],
                        ['q' => 'Selain Jepen, pada festival Iraw Tengkayu, para pemuda (laki-laki) Tidung juga mementaskan sebuah tarian massal (puluhan orang) untuk menyambut Padaw Tuju Dulung yang disebut tari?', 'opts' => ['Tari Kuda Lumping', 'Tari Kedandiu', 'Tari Tortor', 'Tari Piring'], 'ans' => 'Tari Kedandiu'],
                        ['q' => 'Alat perkusi pengetuk irama tempo (beat) khas Jepen pesisir yang terbuat dari kayu dilapis kulit rusa/kambing dipukul jari berbunyi "tak-dung" adalah?', 'opts' => ['Ketipung / Marawis (Rebana Pesisir)', 'Drum set listrik', 'Gong raksasa dari tembaga Cina', 'Bedug mesjid berukuran sangat besar'], 'ans' => 'Ketipung / Marawis (Rebana Pesisir)'],
                        ['q' => 'Saat ini, siapa yang berperan utama mengajarkan pakem Tari Jepen asli agar gerakannya tidak punah tergeser dance modern di Tarakan?', 'opts' => ['Turis asing', 'Sanggar-sanggar tari budaya lokal dan tokoh pelestari adat (Lembaga Adat Tidung)', 'Hanya dipelajari dari buku sejarah tanpa guru lisan', 'Tidak ada yang mengajarkan'], 'ans' => 'Sanggar-sanggar tari budaya lokal dan tokoh pelestari adat (Lembaga Adat Tidung)'],
                        ['q' => 'Pada acara apa biasanya pemuda pemudi (bujang dan gadis) Tidung menampilkan Jepen sebagai ajang saling lirik/berbalas senyum sambil berkesenian?', 'opts' => ['Pemakaman', 'Malam hari resepsi pernikahan / Pesta Rakyat kampung', 'Gotong royong membuat perahu layar utama', 'Panen buah hutan pedalaman'], 'ans' => 'Malam hari resepsi pernikahan / Pesta Rakyat kampung'],
                    ]
                ]
            ],
            [
                'title' => 'Rumah Adat Baloy: Mahakarya Arsitektur Tidung',
                'slug' => 'rumah-adat-baloy-arsitektur-tidung',
                'description' => 'Mengenal struktur bangunan kayu megah Baloy adat suku Tidung di Kaltara.',
                'kompetensi_dasar' => '3.4 Mengidentifikasi karakteristik dan filosofi Rumah Baloy.',
                'pertemuan_ke' => 4,
                'content' => $this->contentRumahBaloy(),
                'image' => 'https://placehold.co/800x450/4338ca/ffffff?text=Rumah+Baloy',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Bangunan rumah adat resmi (mahakarya panggung) peninggalan dari sejarah kebesaran Suku Tidung dinamakan rumah adat?', 'opts' => ['Rumah Betang', 'Rumah Baloy (Baloy Adat Tidung)', 'Rumah Gadang', 'Rumah Honai'], 'ans' => 'Rumah Baloy (Baloy Adat Tidung)'],
                        ['q' => 'Seperti arsitektur tradisional Borneo pada umumnya, Baloy dirancang menghadap ke arah sumber kehidupan yaitu?', 'opts' => ['Menghadap ke Selatan (Kutub)', 'Membelakangi jalan raya', 'Menghadap (Berorientasi) ke perairan / muara sungai (Utara/Timur)', 'Menghadap ke puncak gunung api'], 'ans' => 'Menghadap (Berorientasi) ke perairan / muara sungai (Utara/Timur)'],
                        ['q' => 'Rumah Baloy didirikan memanjang sebagai rumah panggung, ditopang tiang-tiang bulat besar yang dibuat utuh dari kayu yang terkenal anti lapuk, yaitu?', 'opts' => ['Kayu Sengon merah', 'Kayu Ulin (Kayu Besi Borneo)', 'Kayu Jati belanda', 'Bambu wulung tipis'], 'ans' => 'Kayu Ulin (Kayu Besi Borneo)'],
                        ['q' => 'Bentuk ujung atap (bubungan) rumah Baloy memiliki ukiran khas yang mencuat berornamen pucuk rebung atau naga laut, atap utama ini disebut atap bentuk?', 'opts' => ['Atap Kubah', 'Atap Tinggi / Limas ukiran (Beratap Tumpang)', 'Atap Genteng beton', 'Atap Rata asbes'], 'ans' => 'Atap Tinggi / Limas ukiran (Beratap Tumpang)'],
                        ['q' => 'Rumah Baloy kuno aslinya tidak dibangun menggunakan paku besi sama sekali, melainkan menggunakan sistem konstruksi?', 'opts' => ['Lem super korea', 'Sistem pasak kayu (paku kayu / bambu) saling kunci', 'Dililit kawat baja', 'Diikat tali tambang plastik'], 'ans' => 'Sistem pasak kayu (paku kayu / bambu) saling kunci'],
                    ],
                    'posttest' => [
                        ['q' => 'Fungsi asli ruangan utama dalam Rumah Baloy (ruang tengah) bagi masyarakat adat Tidung pada zaman kerajaan adalah sebagai ruang untuk?', 'opts' => ['Tempat tidur anak kecil semata', 'Kandang hewan ternak peliharaan', 'Ruang Balai Pertemuan (Bicara Adat), musyawarah peradilan, penyelesaian masalah / sengketa warga', 'Gudang senjata api'], 'ans' => 'Ruang Balai Pertemuan (Bicara Adat), musyawarah peradilan, penyelesaian masalah / sengketa warga'],
                        ['q' => 'Sebuah miniatur pusat pelestarian replika "Baloy Mayo" (Rumah Baloy Besar) Tidung telah dibangun megah oleh pemerintah kota dan menjadi cagar wisata di daerah?', 'opts' => ['Kota Samarinda', 'Kota Tarakan (Kawasan Amal / Juata)', 'Kota Pontianak', 'Kota Palangkaraya'], 'ans' => 'Kota Tarakan (Kawasan Amal / Juata)'],
                        ['q' => 'Ukiran-ukiran ornamen kuning-merah pada dinding kayu dan ventilasi rumah Baloy Tidung paling banyak bermotifkan unsur flora pesisir yakni daun?', 'opts' => ['Daun teh', 'Daun Pakis (Sulur pakis) atau Kaligrafi sulur-suluran', 'Daun Jati kering', 'Bunga Mawar besar'], 'ans' => 'Daun Pakis (Sulur pakis) atau Kaligrafi sulur-suluran'],
                        ['q' => 'Anak tangga masuk utama pada Baloy Tidung jumlahnya selalu melambangkan pakem angka ganjil sakral, sering kali berdasar rukun kehidupan Islam atau pitu/tujuh lapis langit. Siapa yang dilarang melanggar jumlah angka ganjil ini?', 'opts' => ['Tidak ada yang peduli karena hanya mitos belaka', 'Para tukang bangunan lokal / Mangkutak pembangun keraton adat', 'Kontraktor modern', 'Pemerintah belanda pada masanya'], 'ans' => 'Para tukang bangunan lokal / Mangkutak pembangun keraton adat'],
                        ['q' => 'Apa nilai gotong royong terpenting saat mendirikan tiang pertama (Tiang Guru) Rumah Baloy pada zaman dahulu oleh masyarakat kampung Tidung?', 'opts' => ['Dibangun rahasia tengah malam sendirian tanpa diketahui siapapun', 'Tiang ditegakkan secara bersama-sama seluruh kaum laki kampung sambil bersholawat (Gotong Royong Mufakat)', 'Menggunakan alat crane berat dari Eropa', 'Diserahkan sepenuhnya ke tukang sihir laut'], 'ans' => 'Tiang ditegakkan secara bersama-sama seluruh kaum laki kampung sambil bersholawat (Gotong Royong Mufakat)'],
                    ]
                ]
            ],
            [
                'title' => 'Kuliner Laut Suku Tidung: Kapah dan Sate Bandeng',
                'slug' => 'kuliner-laut-suku-tidung',
                'description' => 'Mengenal kerang kapah Tarakan dan masakan berbahan hasil laut pesisir.',
                'kompetensi_dasar' => '3.5 Mengidentifikasi ragam makanan khas (seafood) dari suku Tidung.',
                'pertemuan_ke' => 5,
                'content' => $this->contentKulinerTidung(),
                'image' => 'https://placehold.co/800x450/4338ca/ffffff?text=Kapah+Tarakan',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Sebagai masyarakat yang berakar di daerah pesisir pantai dan pulau kecil (Tarakan/Nunukan), kuliner Suku Tidung selalu didominasi oleh olahan bahan dasar?', 'opts' => ['Ayam buras hutan', 'Seafood / Hasil laut tangkapan (Kerang, Ikan, Udang)', 'Daging sapi', 'Sayuran pakis hutan kering'], 'ans' => 'Seafood / Hasil laut tangkapan (Kerang, Ikan, Udang)'],
                        ['q' => 'Jenis kerang khas laut Tarakan (endemik di pesisir berlumpur pantai Amal) yang cangkangnya tebal, isinya gemuk, dan paling terkenal direbus bersama sambal cocol adalah kerang?', 'opts' => ['Kerang Darah / Kerang Dara', 'Kerang Kapah', 'Kerang Hijau / Kupang', 'Tiram (Oyster)'], 'ans' => 'Kerang Kapah'],
                        ['q' => 'Sajian khas sate Tidung yang terbuat dari daging ikan (biasanya ikan bandeng) yang durinya dicabut utuh bersih, dagingnya dihaluskan dengan kelapa sangrai dan rempah, lalu dimasukkan lagi ke kulit ikannya kemudian dibakar di atas jepitan bambu disebut?', 'opts' => ['Sate Lilit Ayam', 'Sate Ikan Bandeng (Bandeng Tanpa Duri / Sate Pari)', 'Otak-otak Ikan Tenggiri', 'Sate Kerang bumbu kacang'], 'ans' => 'Sate Ikan Bandeng (Bandeng Tanpa Duri / Sate Pari)'],
                        ['q' => 'Cara memasak tradisional Tidung yang sangat menonjol agar bau amis hasil laut hilang adalah banyak menggunakan perpaduan bumbu aromatik beraroma tajam dan asam segar yakni?', 'opts' => ['Kecap manis dan penyedap MSG banyak-banyak', 'Jeruk nipis, asam jawa (Kamal), kunyit, sereh, dan terasi udang bakar', 'Saus tomat botolan', 'Mayones dan lada hitam tumbuk'], 'ans' => 'Jeruk nipis, asam jawa (Kamal), kunyit, sereh, dan terasi udang bakar'],
                        ['q' => 'Minuman segar atau jajanan kue cincin (Cincin Manis) berbahan gula merah khas Tidung biasa disajikan saat masyarakat mengadakan acara?', 'opts' => ['Gotong royong membangun rumah (Mendiami Baloy) / Kumpul kerabat', 'Berperang di laut (Ngayau lepas)', 'Menyendiri di hutan rimbun', 'Di pengadilan'], 'ans' => 'Gotong royong membangun rumah (Mendiami Baloy) / Kumpul kerabat'],
                    ],
                    'posttest' => [
                        ['q' => 'Sambal cocol khas Tarakan untuk makan Kerang Kapah rebus agar tidak amis dan perut terasa hangat pedas umumnya terbuat dari racikan?', 'opts' => ['Kacang tanah giling kasar', 'Kecap asin manis campur bawang goreng renyah', 'Tumbukan kasar cabai rawit pedas murni, bawang, perasan jeruk nipis kuat, dan sedikit petis/terasi', 'Saus keju gurih impor'], 'ans' => 'Tumbukan kasar cabai rawit pedas murni, bawang, perasan jeruk nipis kuat, dan sedikit petis/terasi'],
                        ['q' => 'Nasi khas suku Tidung yang sering dibawa sebagai bekal melaut atau saat festival Iraw Tengkayu, diolah dari beras campur santan mirip nasi uduk/lemak warna putih adalah nasi?', 'opts' => ['Nasi Liwet Solo', 'Nasi Subut / Nasi Rasul', 'Nasi Kuning ayam', 'Nasi Goreng merah'], 'ans' => 'Nasi Subut / Nasi Rasul'],
                        ['q' => 'Pencuci mulut (kue/wadai basah) dari suku Tidung yang teksturnya kenyal terbuat dari tepung beras ketan atau singkong lalu ditaburi kelapa parut asin-gurih sering disebut kue?', 'opts' => ['Putu Ayu dan Lapis', 'Ongol-ongol atau Kepurun Tidung', 'Bolu Susu', 'Martabak manis ukuran raksasa'], 'ans' => 'Ongol-ongol atau Kepurun Tidung'],
                        ['q' => 'Ikan asin tipis kering berbentuk layang-layang pipih hasil tangkapan nelayan pesisir (sering ikan pepija/tipis) yang digoreng garing laksana kerupuk ikan adalah primadona oleh-oleh kota Tarakan. Ikan ini sering disebut ikan?', 'opts' => ['Ikan Peda merah masin', 'Ikan Tipis (Ikan Kering Pepija / Kering Tarakan)', 'Ikan Tuna besar asap', 'Ikan Lele sungai'], 'ans' => 'Ikan Tipis (Ikan Kering Pepija / Kering Tarakan)'],
                        ['q' => 'Makna filosofis mengapa suku Tidung memakan hidangan laut (Kepiting, udang, ikan, kapah) bersama-sama (makan barantai) dalam loyang besar pada saat hajatan/resepsi adalah wujud pengakuan mereka sebagai?', 'opts' => ['Orang yang paling rakus makan', 'Anak nelayan yang paling miskin', 'Masyarakat setara dalam persaudaraan bahari (pesisir), nikmat bersama dan berbagi rezeki laut Tuhan', 'Kaum bangsawan arogan pesisir'], 'ans' => 'Masyarakat setara dalam persaudaraan bahari (pesisir), nikmat bersama dan berbagi rezeki laut Tuhan'],
                    ]
                ]
            ],
            [
                'title' => 'Seni Bela Diri Kuntau Tidung',
                'slug' => 'seni-bela-diri-kuntau-tidung',
                'description' => 'Mengenal seni bela diri / silat tangan kosong (Kuntau) dari suku Tidung.',
                'kompetensi_dasar' => '3.6 Mengapresiasi ketangkasan Kuntau Tidung.',
                'pertemuan_ke' => 6,
                'content' => $this->contentKuntau(),
                'image' => 'https://placehold.co/800x450/4338ca/ffffff?text=Kuntau+Tidung',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Seni pencak silat / ilmu bela diri asli kaum laki-laki yang turun temurun dilestarikan oleh masyarakat Tidung untuk melindungi diri atau keluarga dinamakan silat?', 'opts' => ['Silat Cimande', 'Silat Kuntau (Kuntau Tidung)', 'Karate sabuk hitam', 'Gulat gaya bebas'], 'ans' => 'Silat Kuntau (Kuntau Tidung)'],
                        ['q' => 'Bela diri Kuntau tidak hanya fokus pada kekuatan fisik (pukul meninju musuh), tetapi lebih mengutamakan kelenturan gerak reflek tubuh menghindari serangan (elakan) serta mengandalkan serangan tipuan atau teknik?', 'opts' => ['Teknik Kuncian patah tulang (Bantingan kilat) dan Kuda-kuda lentur', 'Teknik terbang layang pakai tali', 'Bersembunyi cepat (ninja) menghilang dari pandangan musuh', 'Menembak senapan angin dari jauh saja'], 'ans' => 'Teknik Kuncian patah tulang (Bantingan kilat) dan Kuda-kuda lentur'],
                        ['q' => 'Tarian penyambutan yang menggunakan alat tempur (pisau belati kembar pendek atau tanpa senjata sama sekali) dan dibawakan dua pesilat Kuntau sebelum berkelahi sering menjadi bagian persembahan saat acara adat?', 'opts' => ['Resepsi Pernikahan (pengantin diarak) atau penyambutan pejabat penting raja', 'Saat warga gotong royong panen ladang', 'Setiap kali nelayan naik perahu menangkap ikan kecil', 'Hanya di tengah hutan sendirian sepi'], 'ans' => 'Resepsi Pernikahan (pengantin diarak) atau penyambutan pejabat penting raja'],
                        ['q' => 'Dalam Kuntau Tidung, busana yang sering dikenakan oleh sang pesilat adalah pakaian kebesaran Melayu Tidung lengkap yang berwarna serba?', 'opts' => ['Putih polisi piyama santai', 'Hitam pekat, ikat pinggang kain (sabuk), dan celana gombrang besar (sarung pesak) ikat kepala merah / Laung', 'Seragam loreng militer darat komando Eropa Timur tebal', 'Pakaian selam tebal basah karena pesisir air laut'], 'ans' => 'Hitam pekat, ikat pinggang kain (sabuk), dan celana gombrang besar (sarung pesak) ikat kepala merah / Laung'],
                        ['q' => 'Alat musik ritmis pukul apa yang mengiringi gerakan (menentukan tempo cepat-lambatnya langkah kuda-kuda dan pukulan) dari sepasang pesilat Kuntau di atas arena panggung?', 'opts' => ['Pukulan Gendang bedug dan Gong ketipung', 'Suara piano klasik dari radio tua Belanda di pojok panggung', 'Suara mulut penyanyi opera tinggi', 'Hening murni mutlak tak bersuara agar khusyuk sakral'], 'ans' => 'Pukulan Gendang bedug dan Gong ketipung'],
                    ],
                    'posttest' => [
                        ['q' => 'Penguasaan beladiri Kuntau pesisir sangat penting di zaman kerajaan (hegemoni Tidung Tarakan) di masa kuno karena berfungsi praktis sebagai?', 'opts' => ['Tuntutan untuk menjadi model panggung hiburan pelawak raja belaka', 'Hanya untuk lomba 17 Agustus', 'Pertahanan dari serangan perompak laut (bajak laut/lanun) dan kemampuan berduel senjata tajam di dek perahu (area sempit maritim)', 'Tuntutan agar bisa mendaftar jadi tentara militer belanda'], 'ans' => 'Pertahanan dari serangan perompak laut (bajak laut/lanun) dan kemampuan berduel senjata tajam di dek perahu (area sempit maritim)'],
                        ['q' => 'Guru besar atau pelatih yang menurunkan ilmu bela diri rahasia (Kuntau) secara lisan dan praktek disebut?', 'opts' => ['Pendekar / Guru Silat Kuntau (Tuha/Tetua)', 'Dosen olahraga pencak silat kampus', 'Pelatih gym binaragawan atlet', 'Hakim mahkamah konstitusi negara'], 'ans' => 'Pendekar / Guru Silat Kuntau (Tuha/Tetua)'],
                        ['q' => 'Kuda-kuda dalam Kuntau pesisir Tidung cenderung?', 'opts' => ['Sangat tinggi berdiri kaku (kaku statis)', 'Rendah berjongkok menyentuh tanah rebahan mutlak diam', 'Merendah, lentur (dinamis), merunduk mengakar ke tanah bagai pohon kokoh agar sulit dibanting (Sikap Pasang)', 'Selalu melompat-lompat tiada henti laksana kanguru sirkus'], 'ans' => 'Merendah, lentur (dinamis), merunduk mengakar ke tanah bagai pohon kokoh agar sulit dibanting (Sikap Pasang)'],
                        ['q' => 'Di akhir masa pertunjukan Kuntau adat saat resepsi/festival, kedua pesilat selalu melakukan gerakan apa yang menandakan nilai moral Tidung (Kuntau bukan untuk permusuhan kebencian melainkan persaudaraan)?', 'opts' => ['Membakar panggung dan melarikan diri panik kalang kabut', 'Saling berjabat tangan (salam hormat), berpelukan, mundur teratur dengan sopan kepada raja/pengantin penonton tanpa membalik punggung', 'Menantang semua penonton maju berkelahi massal keroyokan', 'Meminta uang saweran paksa kepada pengantin pakai pisau keras'], 'ans' => 'Saling berjabat tangan (salam hormat), berpelukan, mundur teratur dengan sopan kepada raja/pengantin penonton tanpa membalik punggung'],
                        ['q' => 'Selain tangan kosong, Kuntau pesisir Tidung juga melatih kemampuan melumpuhkan musuh memakai senjata tajam khas Melayu-Kalimantan, yaitu pisau tikam satu tangan bernama?', 'opts' => ['Mandau panjang ulin', 'Tombak tombakan trisula trisula', 'Badik / Keris (senjata pusaka bilah pendek untuk pertarungan jarak sangat dekat mematikan)', 'Pistol api peninggalan jepang rahasia'], 'ans' => 'Badik / Keris (senjata pusaka bilah pendek untuk pertarungan jarak sangat dekat mematikan)'],
                    ]
                ]
            ],
            [
                'title' => 'Bahasa Tidung Tarakan: Dialek Pesisir dan Pantun',
                'slug' => 'bahasa-tidung-tarakan-dialek-pantun',
                'description' => 'Mempelajari karakteristik unik kosakata, dialek, dan sastra lisan (Pantun) Melayu-Tidung.',
                'kompetensi_dasar' => '3.7 Memahami perbendaharaan kata dan syair pantun Bahasa Tidung.',
                'pertemuan_ke' => 7,
                'content' => $this->contentBahasaTidung(),
                'image' => 'https://placehold.co/800x450/4338ca/ffffff?text=Bahasa+Tidung',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Bahasa suku Tidung yang diucapkan sehari-hari oleh penduduk pesisir Tarakan, Bulungan, Malinau, dan Nunukan digolongkan oleh ahli linguistik serumpun ke dalam keluarga bahasa?', 'opts' => ['Austronesia (Rumpun Dayak Murutik/Tidung Utara)', 'Bahasa Indo-Eropa Romawi Barat klasik kuno', 'Bahasa Sino-Tibet Mandarin', 'Bahasa Papua (Trans-Nugini) timur murni tanpa serapan asing'], 'ans' => 'Austronesia (Rumpun Dayak Murutik/Tidung Utara)'],
                        ['q' => 'Karena letaknya strategis di jalur persimpangan pelayaran (perdagangan laut rempah-rempah), banyak kosa kata bahasa Tidung pesisir menyerap atau dipengaruhi amat kuat oleh kosa kata dari bahasa penghubung niaga lama (lingua franca) yaitu?', 'opts' => ['Bahasa Inggris gaul London', 'Bahasa Melayu klasik (Arab Melayu) pesisir', 'Bahasa India (Tamil) selatan', 'Bahasa Thailand utara pegunungan es'], 'ans' => 'Bahasa Melayu klasik (Arab Melayu) pesisir'],
                        ['q' => 'Bentuk kesusastraan lisan (puisi bersajak) terpopuler dari Suku Tidung yang paling sering digunakan tetua adat untuk menyisipkan petuah bijak teguran jenaka atau merayu calon menantu lamaran adalah seni bertutur berbentuk?', 'opts' => ['Pantun (Berbalas Pantun empat baris bersajak a-b-a-b jenaka)', 'Puisi bebas berhuruf tak rima tanpa aturan', 'Haiku Jepang sastra tinggi kaku', 'Menulis kaligrafi dinding semata'], 'ans' => 'Pantun (Berbalas Pantun empat baris bersajak a-b-a-b jenaka)'],
                        ['q' => 'Kalimat sapaan/pertanyaan khas keseharian diucapkan orang Tidung Tarakan saat berjumpa kerabat untuk menanyakan "Apa kabar? (Bagaimana kabarmu?)" biasanya berbunyi?', 'opts' => ['"Kopisanangan?"', '"Pian kiyapa habar?"', '"Nyo kaba?"', '"Napa kabar (Atau: Napa Ulunmu)?"'], 'ans' => '"Napa kabar (Atau: Napa Ulunmu)?"'],
                        ['q' => 'Tradisi memadukan bahasa kiasan perumpamaan alam yang puitis, misalnya menyebut gadis cantik dan berbudi halus laksana "Bulan Purnama Kesiangan" dalam pidato tetua saat perkawinan Tidung mencerminkan filosofi tingginya masyarakat dalam merawat?', 'opts' => ['Seni perang kasar beringas menghardik musuh tawanan', 'Adab (kesopanan) dalam menjaga lisan dan diplomasi bermartabat tanpa melukai perasaan orang lain', 'Kesombongan merendahkan wanita miskin', 'Tidak ada maksud apa-apa semata karena bosan berbicara biasa'], 'ans' => 'Adab (kesopanan) dalam menjaga lisan dan diplomasi bermartabat tanpa melukai perasaan orang lain'],
                    ],
                    'posttest' => [
                        ['q' => 'Dalam dialek Tidung kuno (sastra adat sesepuh), sebutan kehormatan (gelar) yang ditujukan kepada Raja / Sultan tertinggi keraton (Penguasa Tarakan/Tengara) adalah sapaan gelar?', 'opts' => ['Datuk (Datuk Amiril) / Paduka', 'Gusti pangeran', 'Raden mas londo jawa', 'Presiden republik pesisir samudera'], 'ans' => 'Datuk (Datuk Amiril) / Paduka'],
                        ['q' => 'Seni berbalas pantun lisan pada saat rombongan pengantin pria tiba di depan pintu rumah pengantin wanita untuk memohon izin masuk meminang, sering dikenal sebagai tradisi sastra ritual?', 'opts' => ['Buka pintu lawang / Bepantun Lamaran (Bebalai)', 'Bertarung silat darah berdarah beringas tanpa ampun selamanya di depan pagar rumah (Kuntau mati)', 'Membakar pintu rumah marah memaksa menerobos', 'Diam seribu bahasa bisu membisu'], 'ans' => 'Buka pintu lawang / Bepantun Lamaran (Bebalai)'],
                        ['q' => 'Kosakata "Ulun" dalam bahasa ibu Suku Tidung secara harafiah berarti?', 'opts' => ['Binatang hutan buas ganas', 'Orang (Manusia / Hamba)', 'Sungai besar tak berujung batas samudera', 'Makanan pokok beras kuning'], 'ans' => 'Orang (Manusia / Hamba)'],
                        ['q' => 'Kata serapan dari unsur ajaran (kosakata) Arab Islami pada pantun-pantun Tidung berfungsi kuat untuk menanamkan pondasi etika kebudayaan, contohnya pantun-pantun yang sering berbunyi ajakan untuk saling?', 'opts' => ['Saling menjatuhkan dagangan orang (Menyihir pesaing toko hancur lebur debu)', 'Saling menjaga ukhuwah (persaudaraan), bersedekah, dan memohon ridho/rezeki yang halal di laut kepada Allah SWT Sang Khalik alam semesta (Tuhan)', 'Menguasai harta negara tetangga pulau terpencil tanpa hak paksa', 'Tidak beragama tak peduli (Atheis) murni seratus persen total absolut'], 'ans' => 'Saling menjaga ukhuwah (persaudaraan), bersedekah, dan memohon ridho/rezeki yang halal di laut kepada Allah SWT Sang Khalik alam semesta (Tuhan)'],
                        ['q' => 'Tantangan terbesar pelestarian bahasa Tidung (Bahasa Ibu) bagi generasi milenial kota metropolis Tarakan dewasa ini (sehingga harus diajarkan kembali melalui kurikulum pendidikan muatan lokal) adalah?', 'opts' => ['Banyak anak muda gengsi / jarang bertutur bahasa Tidung karena masifnya gempuran pergaulan pakai bahasa gaul nasional (Indonesia Jakartasentris) (bahasa populer televisi internet)', 'Bahasa Tidung sudah sama sekali musnah dilarang pemerintah secara undang-undang hukum pidana resmi keras kejam', 'Semua anak muda lebih fasih berbahasa perancis klasik murni aksen sempurna eropa belaka', 'Hanya orang tua yang diam bisu menolak bersuara mengajarkan pelit kikir'], 'ans' => 'Banyak anak muda gengsi / jarang bertutur bahasa Tidung karena masifnya gempuran pergaulan pakai bahasa gaul nasional (Indonesia Jakartasentris) (bahasa populer televisi internet)'],
                    ]
                ]
            ],
        ];

        foreach ($materials as $data) {
            $quizzes = $data['quizzes'];
            unset($data['quizzes']);

            $data['category'] = 'tidung';
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
<h2>Asal Usul Suku Tidung dan Kerajaan Tarakan</h2>
<p>Kepingan penting sejarah pesisir utara Kalimantan adalah eksistensi <strong>Suku Tidung</strong>. Wilayah administratif utama Suku Tidung saat ini terkonsentrasi di Provinsi Kalimantan Utara, menyebar mulai dari kepulauan Tarakan, pesisir Nunukan, Malinau, hingga Tana Tidung. Nama "Tidung" sendiri berakar dari dialek kuno "Tideng" yang konon bermakna perbukitan atau pegunungan. Namun anehnya, Suku Tidung justru melegenda sebagai masyarakat penguasa laut dan maritim pesisir.</p>

<h3>Rumpun Dayak Utara dan Pengaruh Kesultanan Islam</h3>
<p>Secara antropologis (genetika linguistik keluarga besar), asal muasal nenek moyang Suku Tidung (sering disebut pilar Tengara) memiliki pertalian darah (serumpun) yang amat dekat dengan rumpun suku Dayak Utara (Dayak Murut) pedalaman. Akan tetapi, letak geografis mereka yang menguasai pesisir muara sungai dan laut dalam, membuat nenek moyang suku Tidung menjadi pintu gerbang perniagaan (rempah, hasil laut) bagi kapal-kapal pendatang asing, terutama saudagar Arab dan Melayu pesisir semenanjung di abad belasan lampau.</p>
<p>Kontak budaya yang masif ini merubah total identitas suku. Masyarakat Tidung pesisir memeluk erat <strong>Agama Islam</strong>, meninggalkan sebagian sistem kepercayaan lama, dan mendirikan struktur monarki kerajaan pesisir maritim: <strong>Kerajaan Tidung (Dinasti Tengara)</strong> di Tarakan, yang dipimpin oleh raja bergelar <strong>Datuk (Amiril)</strong>.</p>
<p>Sejak menganut Islam berabad lalu, budaya adat istiadat, literatur lisan sastra (pantun), bahasa keseharian, pakaian upacara adat, serta tari-tariannya berakulturasi menjadi identitas perpaduan eksotis "Melayu-Islam Borneo", sehingga Suku Tidung membedakan dirinya dari saudara Dayaknya yang agraris-hutan. Hal ini mirip dengan sejarah asimilasi masyarakat Suku Banjar dan Kutai.</p>
HTML;
    }

    private function contentIrawTengkayu(): string
    {
        return <<<'HTML'
<h2>Festival Iraw Tengkayu: Tolak Bala dan Sedekah Laut</h2>
<p>Ritual tahunan termegah nan sakral kebanggaan masyarakat asli Kota Tarakan—sebuah pulau kecil penyangga strategis Kalimantan Utara—adalah <strong>Iraw Tengkayu</strong>. Festival ini diselenggarakan dua tahun sekali, lazimnya bertepatan atau mengiringi momentum peringatan Hari Ulang Tahun Kota Tarakan (sekitar bulan Desember) di pesisir luas Pantai Amal.</p>

<h3>Makna Iraw Tengkayu dan Simbol Angka Sakral</h3>
<p>Frasa <em>"Iraw"</em> dalam bahasa Tidung memiliki makna esensial berupa sebuah perayaan gembira massal warga, upacara besar adat yang riuh, dan pesta keselamatan rakyat (syukuran syiar alam). Sementara <em>"Tengkayu"</em> bermakna air laut, atau pesisir tepian darat yang menyatu dengan pasang surut samudera lepas, lokasi di mana pusaran nadi ekonomi urang pesisir (tangkapan nelayan ikan kerang) bertumpu. Ritual ini adalah manifestasi doa tulus syukur komunal nelayan pesisir atas limpahan rezeki hasil laut dari Sang Pencipta dan doa keselamatan terhindar (Tolak Bala) dari amukan amarah bencana badai bahari lautan lepas.</p>

<h3>Puncak Ritual: Melarung Padaw Tuju Dulung</h3>
<p>Hari bersejarah ini dimulai dengan atraksi mengarak sebuah kapal kayu (miniatur raksasa perahu) berwarna mencolok (Kuning melambangkan kemuliaan/kebangsawanan, Hijau perlambang kesuburan rahmat iman Islami, Merah representasi keberanian berjuang keras, Putih lambang hati nurani suci). Perahu tersebut dinamakan <strong>Padaw Tuju Dulung</strong>.</p>
<p><em>Padaw</em> (Perahu), <em>Tuju</em> (Tujuh, lambang jumlah hitungan takdir dewa hari sepekan alam gaib), <em>Dulung</em> (Haluan/moncong palka depan). Di dalam lambung perut perahu sakral magis inilah, sesepuh ketua adat meletakkan piring-piring besar berisi beraneka ragam penganan lokal (Nasi rasul kuning kunyit, kue tradisional cincin, hasil panen panen pisang umbi dll) sebagai sajian (sesaji persembahan kasih alam).</p>
<p>Tepat pada waktu air laut Pantai Amal sedang puncak surut batas minimal jauh, ribuan pemuda adat Tidung berbaju serba hitam sabuk kuning membopong bahu perahu ini menuju lautan lumpur lepas, menunggu tibanya deburan ombak pasang naik. Ketika ombak mulai pasang menerjang menelan pesisir, perahu ini dihanyutkan (dilarung) perlahan-lahan ke tengah perairan. Segera setelah perahu ditelan cakrawala samudera lepas, berhamburanlah warga terjun ke air berebut mengusapkan "air doa" bekas lintasan perahu atau secuil kayu tiang perahu, dilandasi rasa kepercayaan kuno mistis bahwa tetesan tersebut mendatangkan tuah berkah kekayaan rezeki selamat dari kesialan umur.</p>
HTML;
    }

    private function contentTariJepenTidung(): string
    {
        return <<<'HTML'
<h2>Tari Jepen Tidung: Gerak Pesisir Melayu</h2>
<p>Kesenian dan hiburan massa di pesisir Tarakan dan Nunukan berpusat pada sebuah tarian komunal keramaian nan rancak lincah dinamis: <strong>Tari Jepen (Zapin) Tidung</strong>. Tarian inilah yang menjadi panggung sosial (pergaulan santun) bagi muda-mudi, sarana tegur sapa dan silaturahmi yang menyejukkan hati tanpa harus berpelukan badan. Seni gerak tubuh memutar-mutar (melangkah menyilang ritmis) dihentak irama rebana marawis dan betikan gambus Arab pesisir yang mendayu sendu ini merupakan simbol adaptasi sempurna dari estetika Melayu Timur Tengah ke bumi Borneo.</p>

<h3>Falsafah Gerak: Sopan Santun dan Budi Pekerti</h3>
<p>Penari Jepen Tidung tidak melakukan gerak akrobatik yang liar ataupun agresif (tidak merunduk kaku, tidak melompat menendang langit) layaknya tarian perang magis saudara suku Dayaknya di pedalaman rimba Kaltara. Sebaliknya, lengan tangan para penari wanita berbusana kurung tertutup rapi selalu dalam formasi menelungkup/menyilang santun di depan pusar dada. Telapak kaki (step) mereka melangkah selang-seling (tali tiga, maju mundur ritmis zigzag lincah patah-patah namun tidak putus melodi), diselingi anggukan pundak merendah.</p>
<p>Gestur menunduk tersenyum tipis (tanpa menatap tajam mata audiens apalagi raja/Datuk secara pongah) mengandung sarat muatan pendidikan filosofis akhlak yang tinggi, yakni representasi mutlak sifat <strong>budi pekerti luhur pesisir maritim</strong>: "Tegas menjaga harga diri namun lembut dalam bertutur, saling tenggang rasa bergotong royong menjalin persaudaraan, menjauhi sombong menantang amarah petaka". Inilah napas islamisasi kental suku pesisir yang menjunjung kedamaian hidup bersama.</p>

<h3>Tari Kedandiu dan Tarian Laki-Laki</h3>
<p>Selain keanggunan Jepen perempuan, Iraw Tengkayu atau pesta panen laut juga sering mementaskan formasi masal kaum laki-laki gagah perkasa yang menari lincah sambil mengacung-acungkan perlambang perisai dayung perahu bersahutan dengan pukulan bedug rebana nyaring tanpa instrumen petik dawai, yang biasanya dinamakan <strong>Tari Kedandiu</strong> (menari kompak dengan seruan-seruan penyemangat persatuan komunal gotong royong mengayuh perahu menembus badai besar).</p>
HTML;
    }

    private function contentRumahBaloy(): string
    {
        return <<<'HTML'
<h2>Rumah Adat Baloy: Mahakarya Arsitektur Tidung</h2>
<p>Pilar pelestarian budaya material peradaban asli Kaltara dapat disaksikan wujudnya dalam kompleks bangunan istana tradisional masyarakat suku Tidung yang disebut <strong>Rumah Adat Baloy (Baloy Adat Tidung)</strong>. Arsitektur Baloy adalah lambang superioritas dan puncak pencapaian ukiran kerajinan tangan pande kayu pesisir Kaltara di masa lampau kejayaan Kerajaan Tengara.</p>

<h3>Arsitektur Panggung Menghadap Sungai</h3>
<p>Sebagai masyarakat maritim urat nadi sungai, Rumah Baloy—seperti rumah panggung adat Kutai maupun Banjar (berbahan seratus persen batang kayu Ulin kalimantan keras kokoh)—dibangun dengan pilar tinggi di atas tanah / air rawa, dan diwajibkan secara adat untuk <strong>selalu diorientasikan (posisi arah muka depan rumah) menatap lapang langsung ke arah bentangan muara perairan atau jalan raya sungai besar utara pesisir</strong>. Hal ini bukan sekadar urusan fengshui angin belaka, melainkan logistik pertahanan: sungai adalah jalan raya maritim satu-satunya di masa lampau untuk melihat ancaman perompak laut musuh asing sedini mungkin, sekaligus mensyukuri datangnya berkah mentari nelayan perahu ikan dari lautan dalam ke muara.</p>

<h3>Atap Tumpang dan Ukiran Pakis Pesisir (Flora)</h3>
<p>Mata kita akan terbelalak mengagumi struktur atap <strong>Limas Tumpang</strong> Baloy yang tinggi mencuat megah, dengan ukiran <em>Pucuk Rebung</em> (tunas bambu) atau sulur naga pesisir membelah awan biru bersilangan tajam di ujung bubungan (tanduk ukir mahkota raja).</p>
<p>Konstruksi Baloy sama sekali mengharamkan penggunaan paku besi tempa (karena cuaca korosif laut pesisir cepat membuat karat hancur). Sebagai gantinya, pilar, balok-balok dinding dan lantai ulin disatukan memakai sistem teknologi kunci <strong>Pasak Kayu / Pasak Bambu Tarik saling jepit erat (Knock-down system lokal)</strong>. Ornamen ukiran yang melekat di tiang pintu keratonnya melulu berfokus pada corak kaligrafi tanaman Flora (Pakis sulur menjalar) yang diwarnai terang kuning dan merah darah, melambangkan kehalusan masyarakat dalam merawat alam lingkungan dan mematuhi norma ajaran keagamaan larangan mengukir wujud absolut makhluk hidup hewan / manusia.</p>

<h3>Baloy Balai Ruang Keadilan Hukum</h3>
<p>Filosofi tata letak ruang dalam baloy panggung memisahkan ruang tidur belakang pribadi penguasa, dengan beranda selasar yang luas membentang terbuka di bagian tengah (Ruang Balai). Area balai luas tanpa sekat kursi meja inilah yang dijadikan titik pijak forum dewan permusyawaratan desa hukum. Di tempat ini para tetua ketua adat kampung duduk bersila (majelis) menyidangkan, menghakimi secara damai, mendamaikan sengketa pelik perkelahian warga (restoratif adil). Saat ini replika panggung megahnya "Baloy Mayo" dapat dikunjungi publik dan wisatawan di Kota Tarakan Kaltara.</p>
HTML;
    }

    private function contentKulinerTidung(): string
    {
        return <<<'HTML'
<h2>Kuliner Laut Suku Tidung: Kapah dan Sate Bandeng</h2>
<p>Kuliner Suku Tidung tidak diciptakan dari jantung rimba belantara, melainkan diramu dari angin malam garam ombak pesisir Selat Makassar dan perairan lumpur laut dangkal di Pulau Tarakan dan Bunyu. Oleh sebab itu, protein hewani mutlak yang menguasai meja makan suku ini adalah hasil samudera: aneka jenis <strong>Seafood, Kerang laut, Ikan air payau, udang galah sungai muara, dan kepiting soka</strong>.</p>

<h3>Kerang Kapah Rebus: Emas Kuliner Lumpur Amal</h3>
<p>Menu kebanggaan yang menjadi maskot mutlak santapan bersantai keluarga-keluarga (khas pinggir Pantai Amal kota Tarakan) adalah hidangan <strong>Kerang Kapah Rebus</strong>. Kerang Kapah adalah varietas kerang putih endemik berukuran cukup besar, berkulit cangkang licin sangat keras tebal, yang hanya hidup menyusup menyelinap di bawah sedimen lumpur pesisir pantai dangkal berarus tenang utara Kaltara.</p>
<p>Mengolahnya terbilang sangat praktis polos sederhana (rebus kaldu murni perasan jeruk garam serai tanpa santan aneh). Kunci magis kenikmatan menyantap daging kapah yang gendut manis legit adalah dengan mencocolnya ke dalam sepiring <strong>Sambal Cocol Segar Jeruk Nipis Tarakan maut</strong> (cabai rawit, bawang merah tumbuk kasar, kucuran air perasan jeruk kalimantan asam kuat ekstrim merangsang air liur lapar, serta ujung terasi bakar halus). Sekali mencoba menyantap rebusan kapah cocol sambal ini diseruput kuah jahe hangat pada malam hari berangin pantai, dijamin perut tidak akan gatal amis dan selalu mengundang ketagihan lidah.</p>

<h3>Sate Ikan Bandeng Tanpa Duri (Sate Pari Ikan Tidung)</h3>
<p>Sebagai masyarakat maritim cerdas pembuat lauk dari masa ke masa, Suku Tidung memiliki menu khusus hasil pemanfaatan ikan bandeng air tawar payau yang penuh duri halus ribet: <strong>Sate Ikan Bandeng Bakar</strong>. Tubuh ikan dipukul lemas pelan tanpa memecahkan sisik kulit luarnya, lalu daging dan ribuan duri halusnya dicabut utuh bersih dari insang tulang utama ikan lewat proses pembedahan mulut sabar ulet. Daging bersih ini lalu ditumbuk halus dicampur aduk merata menyatu rempah (kemiri ketumbar kelapa sangrai kelapa parut bawang kunyit), lalu dipadatkan dikembalikan isi perutnya kembali menyusup membesarkan cangkang kulit badan bandeng kosong tadi. Ikan yang dijepit belahan bambu sate lalu dipanggang pelan di atas batok arang ini, disajikan berasap hangat sangat gurih garing tanpa ketakutan tersedak tercekik duri sama sekali! Sangat lezat menjadi peneman Nasi Subut (Nasi kuning uduk Tidung basah) pada acara selamatan nikahan besar kerabat pulau.</p>
HTML;
    }

    private function contentKuntau(): string
    {
        return <<<'HTML'
<h2>Seni Bela Diri Kuntau Tidung</h2>
<p>Bila peradaban Suku Tidung mengutamakan budi halus diplomasi kata-kata lisan pantun pesisir, bukan berarti kaum pria kampung tidak menyimpan senjata pembunuh pamungkas andaikata kerabat harta keluarga dilanggar direbut ancaman bajak laut perompak berdarah serakah. Mereka melestarikan kesenian ilmu silat mematikan gerak kilat yang diturunkan rahasia eksklusif mulut ke telinga dari pendekar masa lalu (Guru Tuha): <strong>Pencak Silat Kuntau (Kuntau Pesisir Melayu Tidung)</strong>.</p>

<h3>Kelenturan Pasang dan Kuncian Dek Perahu</h3>
<p>Gaya duel seni tempur Kuntau Tidung sangat unik dan berakar dari logika area arena tempat mereka bertarung: "Masyarakat laut, bertarung membela diri nyawa di atas sempitnya kayu geladak perahu layarnya yang sedang oleng dihantam gelombang badai atau bertarung berebut lahan tambak laut di lumpur dangkal pesisir licin".</p>
<p>Akibatnya, Kuntau pesisir Kaltara sama sekali tidak mengandalkan lompatan tinggi beringas layaknya elang atau tendangan putar terbang karate di udara kosong karena hal itu mematikan sang pesilat sendiri membuang energi salah pijak tercebur lumpur lautan. Filosofi Kuntau adalah: <strong>Kuda-kuda Pasang Rendah Rapat Membumi Bawah Merunduk mengintai.</strong> Pesilat merendahkan badan gravitasi bertumpu menyatu licin alas, kelenturan menghindar tipuan elakan serang fatal jarak sentimeter, serta memusatkan puncak serangan balik 1 detik di <strong>Kuncian sendi patah fatal (bantingan kilat tak terduga beringas mutlak) dari bawah perut musuh</strong> dan tikaman pusaka pisau pendek Badik ke sela rusuk rahasia dalam satu sabetan nafas napas terakhir perlawanan.</p>

<h3>Tarian Salam Hormat di Resepsi</h3>
<p>Akan tetapi, Kuntau hari ini tidak lagi ditujukan membunuh berdarah merusak kedamaian. Ia bertransformasi jadi mahakarya tarian ketangkasan fisik eksotis (Persembahan Penyambutan) yang sakral pada hajatan pengantinan/Erau festival agung Raja Tidung. Dua pesilat pemuda berbaju panglima perang hitam pekat celana gombrang bersabuk dan penutup ikat rambut merah (Laung Merah) akan duel menari lincah seiring degup hentakan kendang rebana gong riuh penonton tegang bertepuk tangan. Namun di penghujung sabetan parang dan tendangan tipuan, mereka selalu menyelesaikan laga secara terhormat dengan gerakan jabat tangan persaudaraan tulus (Salam mundur teratur) menolak mundur membalik punggung arogan, menyimbolkan pesilat Kuntau Tidung pantang berjiwa pengecut, pelindung kaum lemah wanita pemaaf, dan menjunjung tinggi harkat martabat hukum persaudaraan Kaltara damai.</p>
HTML;
    }

    private function contentBahasaTidung(): string
    {
        return <<<'HTML'
<h2>Bahasa Tidung Tarakan: Dialek Pesisir dan Pantun</h2>
<p>Dinamika sosial perdagangan pesisir bahari membentuk rumpun kebahasaan komunikasi silang antara saudagar pulau, pendatang kerajaan semenanjung, serta nelayan daratan asli pulau utara Borneo yang melahirkan entitas <strong>Bahasa Ibu Suku Tidung Tarakan (Dialek Tengara - Austronesia/Murutik Pesisir)</strong> yang sarat serapan halus kosakata <strong>Melayu Islam pesisiran arab pesisir</strong>.</p>

<h3>Kehalusan Dialek, Kesopanan, dan Kosakata Sapa</h3>
<p>Penduduk Tarakan atau Nunukan hingga hari ini sering tegur sapa ramah bertanya kabar keselamatan tetangga famili menggunakan sapaan akrab berlogat sedikit mengayun ujung senandung intonasi datar jenaka: <em>"Napa kabar?"</em> atau <em>"Napa Ulunmu?"</em> (Bagaimana kabar badan dirimu saudaraku?). Kata "Ulun" dimaknai sangat mendalam sebagai derajat kerendahan hati: bermakna "Orang / Hamba ciptaan / abdi pelayan", yang mencerminkan hilangnya arogansi ego manusia Tidung dalam memandang status kasta manusia lain sesama pelaut pesisir senasib mencari ikan rezeki Allah Tuhan Semesta. Sebutan kebesaran "Datuk (Datuk Amiril)" pun mengakar hormat sakral mutlak bagi pemuka tokoh adat tertua di dalam Baloy musyawarah peradilan kampung tanpa ada keraguan bantah setitikpun.</p>

<h3>Seni Bepantun Lamaran (Buka Pintu Buka Lawang)</h3>
<p>Kepiawaian sastra kata-kata Tidung (berbunga-bunga metafor perumpamaan bulan bintang mentari burung) tumpah ruah mewujud dalam tradisi puitis jenaka adat lamaran pernikahan pengantin bujang Tidung, yakni berbalas syair sajak (a-b-a-b) yang dijuluki tradisi <strong>Bepantun Bebalai Lawang Pintu Pagar Pengantin</strong>.
<br>Saat rombongan kerabat keluarga pemuda pria tiba hendak meminang masuk ke teras beranda rumah si dara pengantin wanita pujaan, sang ketua adat keluarga wanita tidak serta merta membukakan pintu kayu ukir dengan kaku garing membisu di siang terik mentari panas Tarakan. Ia menyergap bertanya menyindir halus penuh selidik niat (menanyakan asal usul calon besan niat suci hati atau hendak menipu) lewat pantun bersajak empat baris teka-teki kilat berima. Ketua adat pengantin bujang pria membalas mengiba meyakinkan sumpah cinta santun (juga dengan rima seirama nada senada tak kalah pintar puitis merayu kiasan). Jika perdebatan lisan pantun ini dimenangkan oleh kelihaian bahasa dan jawaban moral bijak Islami dari sang pria memuaskan hati, maka pagar perahu rumah pintu kayu itu pun berderit lega terbuka lebar-lebar merangkul kedua keluarga menjalin persaudaraan abadi hingga laut pesisir pasang surut surut di hari akhir zaman batas takdir usia peradaban kota Tarakan modern masa depan.
<br>Tantangan generasi masa kini adalah bagaimana sastra halus jenaka bahasa pergaulan unik ibu kota metropolis minyak Tarakan tidak pudar terlindas deras dominasi gempuran bahasa pergaulan layar kaca ibu kota televisi internet global digital milenial jakartasentris, agar senandung pantun ini tak diam mati bungkam tak bersuara hilang jejak lisan pesisir utara.</p>
HTML;
    }
}
