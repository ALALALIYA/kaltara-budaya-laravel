<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Seeder;

class DayakMaterialSeeder extends Seeder
{
    public function run(): void
    {
        $guru = User::where('role', 'teacher')->first();

        $materials = [
            [
                'title' => 'Suku-Suku Dayak di Kalimantan Utara',
                'slug' => 'suku-suku-dayak-di-kalimantan-utara',
                'description' => 'Mengenal sub-suku Dayak yang mendiami wilayah Kalimantan Utara: Kenyah, Kayan, Lundayeh, dan Punan.',
                'kompetensi_dasar' => '3.1 Memahami keberagaman sub-suku Dayak di Kalimantan Utara.',
                'pertemuan_ke' => 1,
                'content' => $this->contentSukuDayak(),
                'image' => 'https://placehold.co/800x450/166534/ffffff?text=Suku+Dayak+Kaltara',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Sub-suku Dayak mana yang dikenal dengan beras organik Krayan?', 'opts' => ['Dayak Kenyah', 'Dayak Punan', 'Dayak Lundayeh', 'Dayak Kayan'], 'ans' => 'Dayak Lundayeh'],
                        ['q' => 'Suku Dayak Punan secara historis dikenal sebagai masyarakat?', 'opts' => ['Pesisir laut', 'Penjaga hutan pedalaman (semi-nomaden)', 'Pedagang antar pulau', 'Petani padi sawah'], 'ans' => 'Penjaga hutan pedalaman (semi-nomaden)'],
                        ['q' => 'Daerah persebaran Dayak Kenyah terbesar di Kaltara berada di kabupaten?', 'opts' => ['Bulungan dan Malinau', 'Tarakan dan Nunukan', 'Tana Tidung dan Tarakan', 'Nunukan dan Bulungan'], 'ans' => 'Bulungan dan Malinau'],
                        ['q' => 'Rumah panjang tradisional Suku Dayak Kenyah disebut?', 'opts' => ['Rumah Gadang', 'Rumah Lamin', 'Rumah Honai', 'Rumah Limas'], 'ans' => 'Rumah Lamin'],
                        ['q' => 'Anting pemberat panjang adalah tradisi fisik dari suku?', 'opts' => ['Dayak Lundayeh', 'Dayak Kenyah dan Kayan', 'Dayak Punan', 'Dayak Agabag'], 'ans' => 'Dayak Kenyah dan Kayan'],
                    ],
                    'posttest' => [
                        ['q' => 'Lembaga adat resmi bagi Suku Dayak di Kalimantan Utara adalah?', 'opts' => ['Dewan Adat Dayak (DAD)', 'Majelis Ulama Indonesia', 'Dewan Kesenian Daerah', 'Lembaga Adat Melayu'], 'ans' => 'Dewan Adat Dayak (DAD)'],
                        ['q' => 'Suku Dayak Kayan memiliki tradisi khas berupa?', 'opts' => ['Pembuatan kapal layar', 'Tato (tempuling) dan ukiran kayu', 'Menenun songket', 'Tari Jepen'], 'ans' => 'Tato (tempuling) dan ukiran kayu'],
                        ['q' => 'Masyarakat agraris penghasil beras adan di Krayan adalah?', 'opts' => ['Dayak Punan', 'Dayak Kenyah', 'Dayak Lundayeh', 'Dayak Tahol'], 'ans' => 'Dayak Lundayeh'],
                        ['q' => 'Dayak Lundayeh di Krayan berbatasan langsung dengan negara bagian Malaysia, yaitu?', 'opts' => ['Sarawak', 'Sabah', 'Selangor', 'Johor'], 'ans' => 'Sabah'],
                        ['q' => 'Siapakah kelompok Dayak yang memiliki keahlian khusus dalam meracik tanaman hutan untuk pengobatan?', 'opts' => ['Dayak Kenyah', 'Dayak Lundayeh', 'Dayak Kayan', 'Dayak Punan'], 'ans' => 'Dayak Punan'],
                    ]
                ]
            ],
            [
                'title' => 'Tradisi dan Adat Istiadat Dayak',
                'slug' => 'tradisi-dan-adat-istiadat-dayak',
                'description' => 'Mengenal berbagai upacara adat, tradisi kehidupan, dan sistem kepercayaan masyarakat Dayak.',
                'kompetensi_dasar' => '3.2 Mengidentifikasi dan mengapresiasi ragam tradisi serta adat istiadat suku Dayak.',
                'pertemuan_ke' => 2,
                'content' => $this->contentTradisiAdat(),
                'image' => 'https://placehold.co/800x450/166534/ffffff?text=Tradisi+Adat+Dayak',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Kepercayaan tradisional Dayak sebelum masuknya agama samawi sering menghormati?', 'opts' => ['Dewa laut', 'Roh alam dan roh leluhur', 'Matahari dan bulan', 'Bintang-bintang'], 'ans' => 'Roh alam dan roh leluhur'],
                        ['q' => 'Apa nama istilah untuk mas kawin dalam pernikahan adat Dayak Kenyah?', 'opts' => ['Belis', 'Jujuran', 'Sinamot', 'Mahar'], 'ans' => 'Belis'],
                        ['q' => 'Barang apa yang sering dijadikan belis atau alat pembayaran denda adat?', 'opts' => ['Mobil dan rumah', 'Gong, tempayan, dan mandau', 'Uang koin emas', 'Kain sutra'], 'ans' => 'Gong, tempayan, dan mandau'],
                        ['q' => 'Ritual adat membuka ladang dilakukan dengan tujuan?', 'opts' => ['Meminta izin roh tanah dan hutan', 'Menghitung luas tanah', 'Mencari sumber air', 'Menghindari pajak'], 'ans' => 'Meminta izin roh tanah dan hutan'],
                        ['q' => 'Tato dalam masyarakat Dayak dianggap sebagai?', 'opts' => ['Hiasan tubuh semata', 'Tanda kejahatan', 'Peta perjalanan hidup dan status sosial', 'Pelindung dari hujan'], 'ans' => 'Peta perjalanan hidup dan status sosial'],
                    ],
                    'posttest' => [
                        ['q' => 'Salah satu bentuk syukuran setelah panen berhasil di kalangan Dayak disebut?', 'opts' => ['Nalem / Pesta Panen', 'Gawai Antu', 'Nyepi', 'Kasada'], 'ans' => 'Nalem / Pesta Panen'],
                        ['q' => 'Pemberian nama pada anak di tradisi Dayak Kenyah sering mencerminkan?', 'opts' => ['Bulan kelahiran', 'Harapan atau hubungan dengan leluhur', 'Nama pohon di sekitar', 'Nama dewa laut'], 'ans' => 'Harapan atau hubungan dengan leluhur'],
                        ['q' => 'Tradisi memanjangkan daun telinga menggunakan pemberat disebut sebagai simbol?', 'opts' => ['Kekuatan fisik', 'Kecantikan dan status sosial', 'Keberanian berperang', 'Hukuman adat'], 'ans' => 'Kecantikan dan status sosial'],
                        ['q' => 'Agama mayoritas yang kini dianut oleh masyarakat Dayak Kenyah, Kayan, dan Lundayeh di Kaltara adalah?', 'opts' => ['Islam', 'Hindu', 'Buddha', 'Kristen (Protestan dan Katolik)'], 'ans' => 'Kristen (Protestan dan Katolik)'],
                        ['q' => 'Pemimpin adat kampung dalam sistem kemasyarakatan Dayak bertugas untuk?', 'opts' => ['Memimpin pasukan perang', 'Memutuskan sengketa dan menjaga tradisi', 'Mengatur pemerintahan daerah', 'Mengelola keuangan desa'], 'ans' => 'Memutuskan sengketa dan menjaga tradisi'],
                    ]
                ]
            ],
            [
                'title' => 'Lagu Daerah dan Alat Musik Dayak',
                'slug' => 'lagu-daerah-dan-alat-musik-dayak',
                'description' => 'Mengenal sape sebagai alat musik ikonik Dayak Kaltara, ansambel gong, serta lagu tradisional.',
                'kompetensi_dasar' => '3.3 Menganalisis alat musik dan lagu tradisional suku Dayak.',
                'pertemuan_ke' => 3,
                'content' => $this->contentMusik(),
                'image' => 'https://placehold.co/800x450/166534/ffffff?text=Sape+dan+Gong',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Alat musik petik tradisional berbentuk perahu dari suku Dayak disebut?', 'opts' => ['Kecapi', 'Sape', 'Sasando', 'Panting'], 'ans' => 'Sape'],
                        ['q' => 'Sape dimainkan dengan cara?', 'opts' => ['Ditiup', 'Dipukul', 'Dipetik', 'Digesek'], 'ans' => 'Dipetik'],
                        ['q' => 'Alat musik tiup dari labu kering dan pipa bambu khas Dayak disebut?', 'opts' => ['Suling', 'Keluri / Keledi', 'Tifa', 'Saluang'], 'ans' => 'Keluri / Keledi'],
                        ['q' => 'Ansambel gong dalam upacara adat Dayak digunakan untuk?', 'opts' => ['Menidurkan anak', 'Memanggil roh, perayaan panen, dan pesta', 'Berburu di hutan', 'Memanggil hujan'], 'ans' => 'Memanggil roh, perayaan panen, dan pesta'],
                        ['q' => 'Sape biasanya digunakan untuk mengiringi tarian apa?', 'opts' => ['Tari Jepen', 'Tari Kancet', 'Tari Kecak', 'Tari Piring'], 'ans' => 'Tari Kancet'],
                    ],
                    'posttest' => [
                        ['q' => 'Suara Sape sering digambarkan seperti?', 'opts' => ['Gemuruh petir', 'Angin di hutan atau aliran sungai', 'Suara harimau', 'Suara deru ombak'], 'ans' => 'Angin di hutan atau aliran sungai'],
                        ['q' => 'Gong berukuran besar dalam keluarga Dayak dianggap sebagai?', 'opts' => ['Benda biasa', 'Alat komunikasi sehari-hari', 'Benda pusaka bernilai tinggi (mas kawin/denda)', 'Mainan anak-anak'], 'ans' => 'Benda pusaka bernilai tinggi (mas kawin/denda)'],
                        ['q' => 'Berapa jumlah senar (dawai) pada alat musik Sape tradisional?', 'opts' => ['1 senar', '3–4 senar', '6 senar', '12 senar'], 'ans' => '3–4 senar'],
                        ['q' => 'Lagu-lagu tradisional Dayak sering kali memiliki tema tentang?', 'opts' => ['Pemberontakan', 'Doa leluhur, alam, dan epik kepahlawanan', 'Perkotaan', 'Laut lepas'], 'ans' => 'Doa leluhur, alam, dan epik kepahlawanan'],
                        ['q' => 'Lagu perang/semangat pada masa lampau digunakan sebelum masyarakat Dayak pergi untuk?', 'opts' => ['Berdagang', 'Berburu atau berperang', 'Menikah', 'Membangun rumah'], 'ans' => 'Berburu atau berperang'],
                    ]
                ]
            ],
            [
                'title' => 'Tari Hudoq – Ritual Sakral Suku Dayak Bahau',
                'slug' => 'tari-hudoq-ritual-sakral-suku-dayak',
                'description' => 'Mengenal Tari Hudoq yang sakral, dari topeng, kostum hingga tujuannya.',
                'kompetensi_dasar' => '3.4 Memahami filosofi Tari Hudoq dalam tradisi Dayak Bahau.',
                'pertemuan_ke' => 4,
                'content' => $this->contentTariHudoq(),
                'image' => 'https://placehold.co/800x450/166534/ffffff?text=Tari+Hudoq',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Tari Hudoq berasal dari sub-suku Dayak mana?', 'opts' => ['Dayak Bahau', 'Dayak Lundayeh', 'Dayak Punan', 'Dayak Iban'], 'ans' => 'Dayak Bahau'],
                        ['q' => 'Topeng dalam Tari Hudoq menggambarkan?', 'opts' => ['Wajah roh-roh alam', 'Wajah manusia biasa', 'Pahlawan nasional', 'Hewan ternak'], 'ans' => 'Wajah roh-roh alam'],
                        ['q' => 'Kostum khas penari Hudoq terbuat dari?', 'opts' => ['Daun kelapa', 'Daun pisang dan rotan', 'Kain tenun', 'Bulu ayam'], 'ans' => 'Daun pisang dan rotan'],
                        ['q' => 'Apa tujuan utama Tari Hudoq?', 'opts' => ['Memanggil hujan besar', 'Ritual memohon kesuburan ladang', 'Merayakan tahun baru', 'Menyambut kelahiran bayi'], 'ans' => 'Ritual memohon kesuburan ladang'],
                        ['q' => 'Kapan biasanya Tari Hudoq dilaksanakan?', 'opts' => ['Musim tanam padi', 'Musim kemarau panjang', 'Setiap bulan purnama', 'Gerhana matahari'], 'ans' => 'Musim tanam padi'],
                    ],
                    'posttest' => [
                        ['q' => 'Arti kata "Hudoq" dalam bahasa Dayak adalah?', 'opts' => ['Roh penolong', 'Dewa pertanian', 'Burung elang', 'Hantu hutan'], 'ans' => 'Roh penolong'],
                        ['q' => 'Alat musik utama pengiring Tari Hudoq adalah?', 'opts' => ['Garantung (gong)', 'Sape', 'Gambus', 'Rebana'], 'ans' => 'Garantung (gong)'],
                        ['q' => 'Gerakan mengepakkan tangan dalam Tari Hudoq terinspirasi dari burung?', 'opts' => ['Rajawali', 'Enggang', 'Merak', 'Cendrawasih'], 'ans' => 'Enggang'],
                        ['q' => 'Mengapa Tari Hudoq dianggap sakral?', 'opts' => ['Hanya boleh ditarikan raja', 'Diyakini dapat mendatangkan roh penolong penjaga ladang', 'Rahasia gerakan yang tidak boleh dilihat orang asing', 'Membutuhkan biaya sangat besar'], 'ans' => 'Diyakini dapat mendatangkan roh penolong penjaga ladang'],
                        ['q' => 'Di era modern, Tari Hudoq sering dipentaskan di?', 'opts' => ['Festival budaya dan pariwisata', 'Mall dan bioskop', 'Kompetisi internasional olahraga', 'Gedung pencakar langit'], 'ans' => 'Festival budaya dan pariwisata'],
                    ]
                ]
            ],
            [
                'title' => 'Hukum Adat Dayak dan Wilayah Adat',
                'slug' => 'hukum-adat-dayak-dan-wilayah-adat',
                'description' => 'Mempelajari sistem hukum adat Dayak dalam menyelesaikan masalah dan mengelola wilayah adat.',
                'kompetensi_dasar' => '3.5 Menganalisis sistem hukum adat Suku Dayak.',
                'pertemuan_ke' => 5,
                'content' => $this->contentHukumAdat(),
                'image' => 'https://placehold.co/800x450/166534/ffffff?text=Hukum+Adat+Dayak',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Hukum adat Dayak dijalankan dan dipimpin oleh?', 'opts' => ['Bupati', 'Kepala Adat', 'Polisi', 'Ketua RT'], 'ans' => 'Kepala Adat'],
                        ['q' => 'Lembaga yang menaungi pelestarian adat Dayak secara formal di Kaltara adalah?', 'opts' => ['Dewan Perwakilan Daerah', 'Dewan Adat Dayak (DAD)', 'Badan Pertanahan', 'Kementerian Kehutanan'], 'ans' => 'Dewan Adat Dayak (DAD)'],
                        ['q' => 'Sengketa dalam masyarakat Dayak biasanya diselesaikan melalui?', 'opts' => ['Pengadilan negeri', 'Musyawarah adat/majelis adat', 'Pertarungan fisik', 'Pemungutan suara'], 'ans' => 'Musyawarah adat/majelis adat'],
                        ['q' => 'Tujuan utama penyelesaian konflik melalui hukum adat Dayak adalah?', 'opts' => ['Menghukum seberat-beratnya', 'Pemulihan harmoni sosial dan perdamaian', 'Mendapatkan uang denda', 'Memenjarakan pelaku'], 'ans' => 'Pemulihan harmoni sosial dan perdamaian'],
                        ['q' => 'Konsep wilayah adat bagi Dayak berarti tanah dimiliki secara?', 'opts' => ['Pribadi', 'Komunal (bersama)', 'Negara', 'Perusahaan'], 'ans' => 'Komunal (bersama)'],
                    ],
                    'posttest' => [
                        ['q' => 'Hukuman dalam hukum adat Dayak umumnya berbentuk apa?', 'opts' => ['Kurungan penjara', 'Denda barang berharga (babi, gong, tempayan, dll)', 'Hukuman mati', 'Kerja paksa'], 'ans' => 'Denda barang berharga (babi, gong, tempayan, dll)'],
                        ['q' => 'Apa yang terjadi setelah denda adat disepakati dan dibayar?', 'opts' => ['Pelaku tetap diasingkan', 'Dilakukan ritual pemulihan hubungan / perdamaian', 'Pelaku dipenjara', 'Masalah dibawa ke polisi'], 'ans' => 'Dilakukan ritual pemulihan hubungan / perdamaian'],
                        ['q' => 'Benda pusaka kuno yang sering dipakai sebagai alat bayar denda berat adalah?', 'opts' => ['Tempayan dan Gong', 'Mobil', 'Emas batangan', 'Sertifikat tanah'], 'ans' => 'Tempayan dan Gong'],
                        ['q' => 'Dalam konsep lahan Dayak, hutan adat tidak boleh?', 'opts' => ['Ditanami pohon', 'Dirusak sembarangan karena hutan adalah milik bersama', 'Digunakan untuk berburu', 'Disentuh manusia'], 'ans' => 'Dirusak sembarangan karena hutan adalah milik bersama'],
                        ['q' => 'Salah satu alasan mengapa hukum adat masih sangat relevan saat ini adalah?', 'opts' => ['Bisa menghasilkan banyak uang', 'Penyelesaian sengketa lebih cepat, damai, dan mengakar pada budaya lokal', 'Untuk melawan pemerintah', 'Karena tidak ada hukum negara'], 'ans' => 'Penyelesaian sengketa lebih cepat, damai, dan mengakar pada budaya lokal'],
                    ]
                ]
            ],
            [
                'title' => 'Mandau: Senjata Tradisional dan Pusaka Dayak',
                'slug' => 'mandau-senjata-tradisional-pusaka',
                'description' => 'Mempelajari Mandau sebagai senjata yang berjiwa dan menjadi identitas suku Dayak.',
                'kompetensi_dasar' => '3.6 Mengenal nilai sejarah, proses pembuatan, dan jenis Mandau.',
                'pertemuan_ke' => 6,
                'content' => $this->contentMandau(),
                'image' => 'https://placehold.co/800x450/166534/ffffff?text=Mandau+Pusaka',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Senjata parang panjang khas Kalimantan disebut?', 'opts' => ['Keris', 'Mandau', 'Badik', 'Rencong'], 'ans' => 'Mandau'],
                        ['q' => 'Gagang (Hulu) Mandau biasanya terbuat dari?', 'opts' => ['Besi tuang', 'Tanduk rusa atau tulang', 'Kaca', 'Plastik'], 'ans' => 'Tanduk rusa atau tulang'],
                        ['q' => 'Pisau kecil pelengkap yang disisipkan di sarung Mandau bernama?', 'opts' => ['Pisau raut', 'Golok', 'Pisau dapur', 'Belati'], 'ans' => 'Pisau raut'],
                        ['q' => 'Sarung pelindung bilah Mandau yang terbuat dari kayu berukir disebut?', 'opts' => ['Warangka', 'Kumpang', 'Selong', 'Bungkus'], 'ans' => 'Kumpang'],
                        ['q' => 'Bilah Mandau dibuat dengan teknik apa?', 'opts' => ['Cor (cetak)', 'Tempa tradisional oleh Pandai Besi', 'Las modern', 'Pahatan batu'], 'ans' => 'Tempa tradisional oleh Pandai Besi'],
                    ],
                    'posttest' => [
                        ['q' => 'Mandau Pusaka diyakini berbeda dengan Mandau harian karena?', 'opts' => ['Bentuknya lebih panjang', 'Dipercaya memiliki kekuatan magis dan dijaga dengan ritual khusus', 'Dibuat dari emas', 'Digunakan untuk menebang pohon besar'], 'ans' => 'Dipercaya memiliki kekuatan magis dan dijaga dengan ritual khusus'],
                        ['q' => 'Hiasan pada hulu Mandau sering menggunakan bulu burung apa?', 'opts' => ['Burung Elang', 'Burung Enggang', 'Burung Hantu', 'Burung Merpati'], 'ans' => 'Burung Enggang'],
                        ['q' => 'Sisi tajam pada bilah Mandau biasanya menghadap ke arah?', 'opts' => ['Lengkungan dalam', 'Lengkungan luar', 'Tidak ada sisi tajam', 'Kedua sisi tajam'], 'ans' => 'Lengkungan luar'],
                        ['q' => 'Fungsi Pisau Raut pada Mandau adalah untuk?', 'opts' => ['Menebang pohon', 'Pekerjaan meraut, mengukir, atau tugas presisi halus', 'Sebagai perhiasan semata', 'Alat musik'], 'ans' => 'Pekerjaan meraut, mengukir, atau tugas presisi halus'],
                        ['q' => 'Di era modern, selain sebagai senjata warisan, Mandau berfungsi sebagai?', 'opts' => ['Alat pertanian masal', 'Cinderamata premium dan simbol kebanggaan identitas', 'Alat olahraga senam', 'Mainan anak-anak'], 'ans' => 'Cinderamata premium dan simbol kebanggaan identitas'],
                    ]
                ]
            ],
            [
                'title' => 'Kesenian Tari Dayak dan Arsitektur Lamin',
                'slug' => 'kesenian-tari-dayak-dan-lamin',
                'description' => 'Eksplorasi Tari Kancet, Tari Datun Julut, dan Arsitektur Rumah Lamin komunal.',
                'kompetensi_dasar' => '3.7 Mengapresiasi keindahan Tari Kancet dan bangunan Rumah Lamin.',
                'pertemuan_ke' => 7,
                'content' => $this->contentTariLamin(),
                'image' => 'https://placehold.co/800x450/166534/ffffff?text=Tari+dan+Rumah+Lamin',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Tarian tunggal perempuan Dayak yang lemah gemulai di atas gong disebut?', 'opts' => ['Kancet Ledo', 'Datun Julut', 'Tari Hudoq', 'Tari Piring'], 'ans' => 'Kancet Ledo'],
                        ['q' => 'Tari berkelompok pria Dayak yang menunjukkan ketangkasan dan membawa perisai adalah?', 'opts' => ['Tari Kancet Punan Lettu', 'Tari Serampang', 'Tari Saman', 'Tari Kecak'], 'ans' => 'Tari Kancet Punan Lettu'],
                        ['q' => 'Tari masal perempuan Dayak Kenyah yang gerakannya seperti ombak bergelombang adalah?', 'opts' => ['Tari Pendet', 'Tari Datun Julut', 'Tari Gending Sriwijaya', 'Tari Jaipong'], 'ans' => 'Tari Datun Julut'],
                        ['q' => 'Rumah panjang tradisional komunal masyarakat Dayak Kenyah disebut?', 'opts' => ['Rumah Joglo', 'Rumah Gadang', 'Rumah Lamin / Uma Daru', 'Rumah Panggung Biasa'], 'ans' => 'Rumah Lamin / Uma Daru'],
                        ['q' => 'Salah satu alasan mengapa Rumah Lamin dibangun panjang adalah untuk?', 'opts' => ['Menampung seluruh anggota suku (puluhan keluarga) dalam satu atap', 'Menyimpan hasil hutan', 'Menjadi tempat parkir perahu', 'Menghalangi jalan'], 'ans' => 'Menampung seluruh anggota suku (puluhan keluarga) dalam satu atap'],
                    ],
                    'posttest' => [
                        ['q' => 'Dalam tarian Kancet, gerakan membentangkan tangan mencerminkan keluwesan burung apa?', 'opts' => ['Cendrawasih', 'Enggang', 'Merak', 'Bangau'], 'ans' => 'Enggang'],
                        ['q' => 'Tiang-tiang Rumah Lamin biasanya dihiasi oleh?', 'opts' => ['Ukiran kayu dengan motif Aso dan flora khas Borneo', 'Batu bata ekspos', 'Kaca berwarna', 'Cat polos saja'], 'ans' => 'Ukiran kayu dengan motif Aso dan flora khas Borneo'],
                        ['q' => 'Bagian teras panjang di depan kamar-kamar Rumah Lamin berfungsi untuk?', 'opts' => ['Dapur kotor', 'Ruang komunal untuk berkumpul, musyawarah, dan bekerja', 'Kandang ternak', 'Gudang senjata'], 'ans' => 'Ruang komunal untuk berkumpul, musyawarah, dan bekerja'],
                        ['q' => 'Selain untuk hunian, Rumah Lamin di masa lalu juga berfungsi sebagai?', 'opts' => ['Benteng pertahanan komunitas dari serangan luar', 'Pasar tradisional', 'Pelabuhan perahu', 'Hanya untuk kuburan'], 'ans' => 'Benteng pertahanan komunitas dari serangan luar'],
                        ['q' => 'Pembangunan Lamin Adat modern di kota-kota Kaltara ditujukan untuk?', 'opts' => ['Tempat tinggal massal', 'Ruang pelestarian budaya, upacara adat, dan pariwisata', 'Pusat perbelanjaan', 'Pusat pemerintahan kota'], 'ans' => 'Ruang pelestarian budaya, upacara adat, dan pariwisata'],
                    ]
                ]
            ],
            [
                'title' => 'Motif Ukiran dan Anyaman Dayak Kaltara',
                'slug' => 'motif-ukiran-dan-anyaman-dayak',
                'description' => 'Mempelajari seni manik-manik, anyaman doyo/rotan, dan ukiran mistis Dayak.',
                'kompetensi_dasar' => '3.8 Mengenali seni manik-manik dan ukiran Dayak.',
                'pertemuan_ke' => 8,
                'content' => $this->contentUkir(),
                'image' => 'https://placehold.co/800x450/166534/ffffff?text=Motif+dan+Anyaman',
                'quizzes' => [
                    'pretest' => [
                        ['q' => 'Motif makhluk mitologi gabungan naga dan anjing pada ukiran Dayak disebut?', 'opts' => ['Motif Aso', 'Motif Garuda', 'Motif Enggang', 'Motif Pakis'], 'ans' => 'Motif Aso'],
                        ['q' => 'Warna dominan yang sangat khas pada seni manik-manik Dayak Kenyah adalah?', 'opts' => ['Hitam, putih, kuning, dan merah (warna alam)', 'Merah muda dan ungu', 'Coklat dan abu-abu', 'Warna pastel terang'], 'ans' => 'Hitam, putih, kuning, dan merah (warna alam)'],
                        ['q' => 'Tanaman endemik Kalimantan yang daunnya dianyam/dipintal menjadi benang kain tenun (Ulap Doyo) adalah?', 'opts' => ['Pandan', 'Tanaman Doyo', 'Rotan', 'Bambu'], 'ans' => 'Tanaman Doyo'],
                        ['q' => 'Profesi pengukir ahli dalam masyarakat Dayak sering disebut dengan istilah?', 'opts' => ['Mangkutak', 'Pande Besi', 'Dalang', 'Undagi'], 'ans' => 'Mangkutak'],
                        ['q' => 'Motif Sulur atau paku pakis melambangkan apa bagi orang Dayak?', 'opts' => ['Kematian', 'Kesinambungan hidup dan hubungan manusia dengan alam hutan', 'Peperangan yang panjang', 'Air sungai'], 'ans' => 'Kesinambungan hidup dan hubungan manusia dengan alam hutan'],
                    ],
                    'posttest' => [
                        ['q' => 'Selain untuk dekorasi rumah, ukiran motif Aso sering diaplikasikan pada?', 'opts' => ['Kertas surat', 'Gagang Mandau, perisai, dan tameng', 'Sepatu modern', 'Plastik pembungkus'], 'ans' => 'Gagang Mandau, perisai, dan tameng'],
                        ['q' => 'Seni merangkai manik-manik (beadwork) tradisional Dayak paling ahli dilakukan oleh?', 'opts' => ['Pria Dayak Punan', 'Wanita Dayak Kenyah dan Kayan', 'Anak-anak Lundayeh', 'Pendatang baru'], 'ans' => 'Wanita Dayak Kenyah dan Kayan'],
                        ['q' => 'Pembuatan baju manik-manik atau Seraung (topi khas) membutuhkan waktu?', 'opts' => ['Beberapa menit', 'Beberapa hari hingga berbulan-bulan karena kerumitan polanya', 'Satu jam', 'Bertahun-tahun'], 'ans' => 'Beberapa hari hingga berbulan-bulan karena kerumitan polanya'],
                        ['q' => 'Burung Enggang merupakan simbol dari?', 'opts' => ['Roh jahat', 'Alam bawah', 'Roh leluhur, kemuliaan, dan dunia atas', 'Sumber air'], 'ans' => 'Roh leluhur, kemuliaan, dan dunia atas'],
                        ['q' => 'Ke negara manakah biasanya produk kerajinan anyaman rotan berkualitas dari Kaltara diekspor?', 'opts' => ['Amerika Selatan', 'Eropa dan Jepang', 'Hanya di dalam negeri', 'Afrika'], 'ans' => 'Eropa dan Jepang'],
                    ]
                ]
            ],
        ];

        foreach ($materials as $data) {
            $quizzes = $data['quizzes'];
            unset($data['quizzes']);

            $data['category'] = 'dayak';
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

    private function contentSukuDayak(): string
    {
        return <<<'HTML'
<h2>Suku-Suku Dayak di Kalimantan Utara</h2>
<p>Suku Dayak adalah salah satu kelompok masyarakat adat terbesar yang mendiami pedalaman Pulau Borneo. Di Kalimantan Utara, Dayak bukanlah entitas tunggal, melainkan sebuah keluarga besar yang terdiri dari berbagai sub-suku yang memiliki ciri khas, bahasa, dan tradisi unik masing-masing. Mempelajari suku Dayak berarti kita sedang menjelajahi kekayaan dan keragaman yang sangat mendalam dari warisan budaya Nusantara.</p>
<p>Sub-suku Dayak utama yang ada di Kalimantan Utara antara lain adalah Dayak Kenyah, Dayak Kayan, Dayak Lundayeh, dan Dayak Punan. Setiap sub-suku memiliki wilayah persebaran dan kebiasaan yang berbeda-beda, namun semuanya disatukan oleh rasa hormat yang mendalam terhadap alam semesta dan tradisi warisan leluhur.</p>

<h3>1. Dayak Kenyah</h3>
<p>Dayak Kenyah tersebar secara luas di wilayah Kabupaten Malinau dan sebagian besar Kabupaten Bulungan. Mereka dikenal sebagai penjaga tradisi yang sangat kokoh. Suku inilah yang mempopulerkan alat musik dawai yang khas, yaitu <strong>Sape</strong>, dan tarian sakral yang anggun seperti Tari Kancet. Masyarakat Kenyah tinggal dalam sebuah rumah panjang komunal yang megah yang dikenal sebagai Rumah Lamin. Mereka juga dikenal memiliki struktur sosial yang terorganisir dengan rapi dan mengedepankan asas musyawarah dalam setiap penyelesaian masalah.</p>

<h3>2. Dayak Lundayeh</h3>
<p>Dayak Lundayeh berpusat di wilayah Kabupaten Nunukan, khususnya di dataran tinggi Krayan yang berbatasan langsung dengan Sabah, Malaysia. Mereka adalah masyarakat agraris yang ulung. Mereka memproduksi Beras Adan, beras organik dataran tinggi yang memiliki kualitas premium dan telah mendapatkan pengakuan luas di Indonesia. Kehidupan masyarakat Lundayeh sangat bergantung pada pertanian lahan basah dan ternak kerbau, yang sering kali digunakan sebagai alat tukar dan mas kawin (belis) dalam perkawinan adat.</p>

<h3>3. Dayak Kayan</h3>
<p>Dayak Kayan sering dianggap sebagai saudara serumpun dengan Dayak Kenyah. Mereka mendiami kawasan hulu sungau di Malinau dan Bulungan. Identitas kultural mereka sangat kuat tercermin dari seni ukir kayu yang mendetail, serta tradisi tato tradisional (tempuling) yang melambangkan peta perjalanan hidup dan status sosial seseorang di dalam masyarakat.</p>

<h3>4. Dayak Punan</h3>
<p>Dayak Punan merupakan suku yang sejarahnya adalah masyarakat semi-nomaden pemburu-pengumpul. Mereka hidup jauh di pedalaman hutan tropis Kalimantan. Mereka adalah ahli dalam memanfaat hasil hutan bukan kayu, seperti rotan dan madu hutan. Mereka memiliki pengetahuan herbal dan pengobatan tradisional yang luar biasa canggih. Saat ini, sebagian besar masyarakat Punan telah menetap di desa-desa permanen, namun keterikatan batin mereka dengan hutan masih sangat kuat terjalin.</p>

<p>Pelestarian identitas dan adat istiadat dari suku-suku ini secara resmi dijaga dan dinaungi oleh Dewan Adat Dayak (DAD) Kalimantan Utara, sebuah lembaga yang secara gigih memperjuangkan hak-hak adat dan pengakuan terhadap kearifan lokal dalam sistem hukum positif di Indonesia.</p>
HTML;
    }

    private function contentTradisiAdat(): string
    {
        return <<<'HTML'
<h2>Tradisi dan Adat Istiadat Dayak</h2>
<p>Adat istiadat bagi Suku Dayak bukan sekadar kebiasaan usang, melainkan merupakan landasan filosofis, hukum, dan panduan moral dalam menjalankan setiap aspek kehidupan, mulai dari kelahiran hingga kematian. Segala peraturan tak tertulis ini dipelihara secara turun-temurun dan dijalankan secara kolektif di bawah kepemimpinan para Kepala Adat.</p>

<h3>Kepercayaan Tradisional</h3>
<p>Sebelum masuk dan berkembangnya agama samawi (khususnya Kristen Protestan dan Katolik) yang kini dianut mayoritas masyarakat Dayak Kenyah, Kayan, dan Lundayeh, leluhur mereka menganut kepercayaan animisme dan dinamisme. Kepercayaan lama ini sangat menghormati roh-roh alam yang bersemayam di gunung, hutan, dan sungai, serta memuja roh-roh nenek moyang. Penghormatan terhadap alam ini menjadikan masyarakat Dayak sebagai konservator hutan alami yang sangat tangguh; mereka tidak akan pernah menebang pohon atau membuka lahan tanpa melangsungkan ritual permohonan izin kepada penjaga alam semesta.</p>

<h3>Siklus Daur Hidup</h3>
<p>Siklus hidup masyarakat Dayak sarat akan makna ritual:</p>
<ul>
    <li><strong>Kelahiran:</strong> Anak yang baru lahir disambut dengan upacara pemberian nama yang diambil dari nama-nama leluhur atau peristiwa alam. Harapannya, roh leluhur akan senantiasa memberkati dan menjaga anak tersebut.</li>
    <li><strong>Pernikahan:</strong> Pernikahan adat melibatkan musyawarah panjang antar keluarga untuk menentukan Mas Kawin atau <em>Belis</em>. Barang-barang yang bernilai tinggi secara magis dan historis, seperti gong kuno, tempayan porselen, dan mandau pusaka, sering kali digunakan sebagai alat pembayaran utama, yang menandakan pengikatan persaudaraan yang sakral.</li>
    <li><strong>Kematian:</strong> Upacara kematian merupakan salah satu ritual terpenting dan membutuhkan persiapan berhari-hari. Prosesi ini diiringi tarian, nyanyian doa, dan pengorbanan babi atau kerbau, dengan tujuan agar roh jenazah menemukan jalan terang menuju dunia atas tempat para leluhur berada.</li>
</ul>

<h3>Tradisi Pertanian</h3>
<p>Masyarakat Dayak adalah masyarakat petani yang amat menghormati bumi. Ritual <strong>Nalem</strong> atau pesta panen adalah bentuk syukur terbesar. Seluruh anggota desa akan berkumpul, makan bersama, menari, dan membunyikan gong sepanjang malam sebagai wujud kebahagiaan atas melimpahnya hasil ladang.</p>

<h3>Simbol-Simbol Kecantikan dan Fisik</h3>
<p>Pada masa lalu, telinga yang dipanjangkan menggunakan pemberat anting besi atau emas merupakan standar kecantikan dan simbol kebangsawanan wanita Dayak. Sementara itu, tato merupakan jurnal hidup yang tergambar di kulit, mencatat asal-usul keluarga, kemampuan berburu, dan peperangan yang pernah diikuti.</p>
HTML;
    }

    private function contentMusik(): string
    {
        return <<<'HTML'
<h2>Lagu Daerah dan Alat Musik Dayak</h2>
<p>Musik Dayak adalah bahasa universal yang mampu menghubungkan manusia dengan alam, leluhur, dan Penciptanya. Alat musik tidak sekadar dipandang sebagai instrumen penghibur, melainkan media komunikasi transendental yang mengiringi setiap upacara adat penting.</p>

<h3>Sape: Dawai Mistis dari Jantung Borneo</h3>
<p><strong>Sape</strong> adalah alat musik petik yang memiliki bentuk fisik menyerupai perahu panjang dengan ukiran khas Dayak di permukaannya. Dibuat dari sebongkah kayu utuh (biasanya kayu aro atau adau), sape memiliki tiga hingga empat dawai. Pemain sape akan memetik senar tersebut dan menghasilkan melodi pentatonik yang terdengar amat lembut, syahdu, dan menghipnotis. Banyak yang menggambarkan suara sape seperti desiran angin di sela dedaunan hutan atau gemericik air sungai yang mengalir tenang. Sape adalah instrumen pengiring utama dalam tarian Kancet (Tari Enggang).</p>

<h3>Garantung (Gong) dan Ansambel Ritmis</h3>
<p>Tidak ada ritual perayaan panen (Nalem) atau upacara kematian besar yang tidak diiringi oleh tabuhan <strong>Garantung</strong> atau Gong besar. Ansambel gong terdiri dari berbagai ukuran gong dari kuningan atau perunggu yang menghasilkan pola poliritmik yang rumit. Selain sebagai alat musik, gong kuno merupakan salah satu pusaka keluarga yang menunjukkan kelas sosial serta sangat laku digunakan sebagai alat penengah denda dalam peradilan adat.</p>

<h3>Keledi / Keluri</h3>
<p>Instrumen tiup yang amat kuno adalah <strong>Keluri</strong> (juga disebut Keledi). Alat ini tersusun dari buah labu kering yang dilubangi dan dipasangi deretan pipa-pipa bambu berbagai ukuran. Cara memainkannya mirip dengan harmonika bambu raksasa atau alat musik organ mulut (mouth organ), menghasilkan suara mendengung yang unik, cocok untuk mengiringi tarian dan pesta rakyat di teras Rumah Lamin.</p>

<h3>Lagu Tradisional dan Epik</h3>
<p>Setiap sub-suku memiliki koleksi nyanyian daerah, mulai dari nyanyian pengantar tidur yang merdu, nyanyian yang dinyanyikan para wanita saat menanam padi di ladang, hingga nyanyian perang yang dibawakan kaum pria (sebelum era modern) guna membangkitkan keberanian magis sebelum menghadapi pertempuran. Musik dan lagu Dayak merupakan perpustakaan sejarah lisan yang diwariskan dari satu generasi ke generasi berikutnya.</p>
HTML;
    }

    private function contentTariHudoq(): string
    {
        return <<<'HTML'
<h2>Tari Hudoq – Ritual Sakral Suku Dayak Bahau</h2>
<p>Tari Hudoq adalah salah satu tarian yang paling ikonik dan memiliki unsur magis terkuat di Kalimantan. Tarian ini berasal dari tradisi Suku Dayak Bahau dan sub-suku Kenyah tertentu. Berbeda dengan tarian kreasi modern yang tujuannya semata untuk estetika dan hiburan, Tari Hudoq adalah sebuah <strong>ritual sakral agraris</strong> yang ditujukan untuk memohon kesuburan tanah pertanian dan perlindungan dari bala bencana alam.</p>

<h3>Makna Hudoq dan Topeng Suci</h3>
<p>Kata "Hudoq" dalam bahasa Dayak memiliki arti <strong>roh penolong</strong> atau roh pelindung utusan dewa. Inti dari tarian ini terletak pada properti <strong>topeng kayu besar berukir</strong> yang dikenakan oleh para penari. Topeng-topeng ini dipahat menyerupai figur binatang hutan yang menakutkan, roh-roh nenek moyang, bahkan figur naga atau monster alam gaib. Ketika topeng ini dipasang dalam sebuah ritual khusus, masyarakat percaya bahwa para penari telah kerasukan (trance) dan tubuh mereka dipinjam oleh roh-roh penolong tersebut untuk turun dari kayangan ke ladang penduduk.</p>

<h3>Kostum dan Gerakan Tari</h3>
<p>Menyesuaikan dengan fungsinya sebagai penguasa alam, penari Hudoq mengenakan jubah panjang yang terbuat dari rangkaian daun pisang, daun pinang, atau serat-serat rotan kering. Jubah daun pisang ini menutupi seluruh tubuh penari. </p>
<p>Gerakannya didominasi oleh hentakan kaki yang kuat menghantam bumi (untuk membangunkan roh tanah) serta kibasan kedua lengan yang lebar (menirukan kepakan sayap burung Enggang). Iringan musik utamanya adalah tabuhan bertalu-talu dari Garantung (gong) dan gendang kayu yang suaranya bisa terdengar hingga ke batas hutan.</p>

<h3>Konteks Sosial dan Modernisasi</h3>
<p>Secara tradisional, Tari Hudoq digelar tepat pada awal musim tanam padi ladang. Semua orang dewasa, baik laki-laki maupun perempuan, berkumpul dan menyaksikan roh-roh penjaga memberkati benih padi mereka agar dijauhkan dari serangan hama babi hutan dan monyet. Namun seiring berjalannya waktu dan berkembangnya industri pariwisata daerah, Tari Hudoq kini sering ditampilkan di acara-acara festival budaya (misalnya Festival Irau) tanpa menyertakan sesi kerasukan massal, demi memperkenalkan kekayaan spiritual nenek moyang Kaltara kepada turis domestik maupun mancanegara.</p>
HTML;
    }

    private function contentHukumAdat(): string
    {
        return <<<'HTML'
<h2>Hukum Adat Dayak dan Wilayah Adat</h2>
<p>Hukum adat Dayak adalah serangkaian sistem peraturan, larangan (pantangan), dan mekanisme keadilan sosial yang mengatur kehidupan bermasyarakat orang Dayak. Hukum ini sangat ditaati karena masyarakat Dayak meyakini bahwa pelanggaran terhadap adat tidak hanya merugikan manusia lain, melainkan juga mengusik keseimbangan kosmik (alam semesta), yang bisa memicu datangnya penyakit, hama ladang, hingga bencana alam menimpa seluruh desa.</p>

<h3>Struktur Lembaga Keadilan Adat</h3>
<p>Sistem peradilan ini dikepalai oleh seorang <strong>Kepala Adat</strong> (atau Tumenggung Adat), yang dipilih berdasarkan kebijaksanaan dan pengetahuan mendalamnya tentang silsilah serta tradisi. Jika terjadi perselisihan—seperti perkelahian, pencurian, atau sengketa batas tanah ladang—kasus tersebut tidak serta-merta dibawa ke kepolisian, melainkan disidangkan secara kekeluargaan di ruang komunal Rumah Lamin. Proses ini disebut sebagai <strong>Musyawarah Adat</strong> atau Majelis Adat. Fokus dari peradilan Dayak bukanlah balas dendam atau pemenjaraan, melainkan <strong>pemulihan harmoni, ganti rugi (restitusi), dan perdamaian</strong>.</p>

<h3>Bentuk-bentuk Hukuman dan Denda</h3>
<p>Jika seseorang dinyatakan bersalah, ia diwajibkan membayar denda (diyat) kepada pihak korban dan komunitas. Denda ini menggunakan barang-barang pusaka bernilai magis-ekonomis tinggi, seperti:</p>
<ul>
    <li>Babi atau Kerbau (yang akan disembelih untuk makan bersama sebagai tanda perdamaian).</li>
    <li>Gong kuno kuningan.</li>
    <li>Tempayan (guci) keramik warisan leluhur.</li>
    <li>Mandau pusaka.</li>
</ul>

<h3>Pengelolaan Wilayah Adat</h3>
<p>Filosofi masyarakat Dayak terkait tanah sangat bertentangan dengan kapitalisme modern. Tanah hutan tidak dapat "dimiliki" dan "diperjualbelikan" secara pribadi; tanah adalah hak milik komunal atau bersama seluruh komunitas adat desa. Hutan dianggap sebagai ibu yang memberikan makanan (berburu, memancing, mencari madu dan rotan). Aturan adat sangat ketat melarang penebangan pohon madu atau perusakan mata air. Pelanggar aturan lingkungan ini akan didenda sangat berat. Di era modern, Dewan Adat Dayak (DAD) Kalimantan Utara bersama pemerintah aktif merumuskan peta wilayah adat agar lahan masyarakat lokal tidak tergusur oleh ekspansi perkebunan massal dan tambang batu bara.</p>
HTML;
    }

    private function contentMandau(): string
    {
        return <<<'HTML'
<h2>Mandau: Senjata Tradisional dan Pusaka Dayak</h2>
<p>Mandau merupakan senjata parang tradisional suku Dayak yang pamor dan reputasinya terkenal ke seantero Nusantara bahkan dunia. Bentuknya tidak menyerupai pedang lurus, melainkan sebuah parang tebal yang asimetris: salah satu sisi bilahnya rata, sedangkan sisi luar lainnya berbentuk cembung dan tajam. Desain asimetris yang canggih ini membuat ayunan Mandau sangat mematikan di medan perang hutan, dan luar biasa efisien untuk memotong semak belukar kayu keras saat membuka perladangan.</p>

<h3>Bilah, Hulu, dan Kumpang</h3>
<p>Mandau berkualitas tidak dibuat secara massal di pabrik. Senjata ini ditempa secara manual oleh ahli logam tradisional (Pande Besi). Proses pemanasan, pelipatan baja, dan pencelupan air ini membutuhkan ritual batin khusus. Sebuah Mandau terdiri atas tiga bagian utama:</p>
<ol>
    <li><strong>Bilah Besi:</strong> Dihiasi ukiran dari kuningan (titik-titik bintang atau sulur paku pakis) di bagian punggungnya (tidak tajam).</li>
    <li><strong>Hulu (Gagang):</strong> Biasanya dipahat dari tanduk rusa yang sangat keras, atau dari kayu ulin. Gagangnya diukir sangat detail dengan motif naga atau kepala burung Enggang, lalu dihiasi dengan jumputan bulu binatang atau rambut untuk memberikan kesan magis.</li>
    <li><strong>Kumpang (Sarung):</strong> Terbuat dari dua keping kayu tipis yang direkatkan dan diikat rotan anyam. Sarung ini juga dihiasi manik-manik. Menempel pada kumpang, biasanya diselipkan sebuah <strong>Pisau Raut</strong>—pisau tipis dan kecil berujung sangat tajam yang digunakan untuk meraut bambu, mengambil duri, atau pekerjaan presisi lainnya.</li>
</ol>

<h3>Mandau Harian vs Mandau Pusaka</h3>
<p>Bagi orang Dayak, Mandau diklasifikasikan menjadi dua jenis. Pertama, Mandau kerja harian yang bentuknya biasa saja dan digunakan untuk berkebun. Kedua adalah <strong>Mandau Pusaka</strong>. Mandau pusaka ini dibuat dengan ritual tirakat khusus, tidak pernah digunakan untuk menebang kayu biasa, dan diyakini dihuni oleh entitas roh leluhur (khodam penjaga). Mandau pusaka hanya dikeluarkan pada upacara-upacara adat besar atau digunakan sebagai pusaka pamungkas untuk menolak serangan ilmu gaib.</p>

<p>Kini, Mandau bertransformasi tidak hanya sebagai pengingat sejarah masa lampau, melainkan menjadi simbol kebanggaan dan kedaulatan budaya bagi generasi muda Dayak di seluruh pelosok Kalimantan.</p>
HTML;
    }

    private function contentTariLamin(): string
    {
        return <<<'HTML'
<h2>Kesenian Tari Dayak dan Arsitektur Lamin</h2>
<p>Ekspresi keindahan jiwa suku Dayak termanifestasi secara sempurna melalui perpaduan tari-tarian komunal mereka dan kemegahan mahakarya arsitektur kayu mereka, yakni Rumah Lamin.</p>

<h3>Keindahan Tari Kancet dan Datun Julut</h3>
<p>Suku Dayak Kenyah sangat menonjol dengan repertoar tarian tradisional mereka yang berpusat pada keluwesan gerakan dan nilai-nilai harmoni. Salah satu tarian terpopuler adalah <strong>Kancet Ledo</strong> (Tari Gong). Dalam tarian solo ini, seorang wanita menari dengan gemulai sambil memegang rangkaian bulu ekor burung Enggang di kedua tangannya. Penari akan berdiri dan berputar perlahan di atas sebuah gong besar. Gerakan melengkung tangan dan pergelangan ini diadaptasi langsung dari burung Enggang yang terbang membumbung tinggi, merepresentasikan kelembutan hati sekaligus derajat yang agung.</p>

<p>Tarian lain yang bersifat epik dan masal adalah <strong>Datun Julut</strong>. Tarian persaudaraan massal ini ditarikan oleh barisan puluhan hingga ratusan wanita. Sambil berjalan melingkar di alun-alun desa, mereka serempak mengayunkan pinggul dan tangan. Datun Julut biasa dipersembahkan saat menyambut tamu agung kenegaraan, atau merayakan peristiwa gembira pasca-panen raya.</p>

<h3>Rumah Lamin (Uma Daru): Jantung Kehidupan Komunal</h3>
<p>Tari-tarian masal tersebut tak lengkap tanpa adanya alun-alun raksasa, yaitu <strong>Rumah Lamin</strong>. Rumah Lamin adalah rumah panggung komunal (longhouse) tradisional yang panjangnya bisa mencapai 100 hingga 300 meter. Ia dibangun setinggi 2-3 meter dari permukaan tanah, disokong oleh pilar-pilar kayu ulin raksasa.</p>

<p>Desain arsitektur Lamin membagi struktur menjadi koridor memanjang (teras komunal/serambi) di bagian depan, dan bilik-bilik pintu keluarga di bagian dalam. Satu Rumah Lamin dapat dihuni oleh belasan hingga puluhan kepala keluarga, yang dipimpin oleh seorang Kepala Adat yang menempati bilik paling tengah. Alasan historis mengapa rumah ini dibangun tinggi dan masal adalah demi keamanan; pada masa lalu, rumah ini berfungsi sebagai benteng perlindungan kolektif dari bahaya binatang buas hutan dan serangan mendadak (ngayau) dari musuh suku lain.</p>
HTML;
    }

    private function contentUkir(): string
    {
        return <<<'HTML'
<h2>Motif Ukiran dan Anyaman Dayak Kaltara</h2>
<p>Jika kita memperhatikan hulu parang Mandau, tiang-tiang penyangga Rumah Lamin, hingga sarung dari manik-manik, kita akan disuguhi dengan serangkaian geometri dan motif flora-fauna yang sangat khas dan beraura mistis. Seni ukir dan anyaman ini merupakan representasi spiritual suku Dayak tentang hubungan tripartit: Manusia, Hutan, dan Leluhur kosmik.</p>

<h3>Motif Aso, Enggang, dan Pakis</h3>
<p>Para pengukir tradisional ahli, atau yang disebut <strong>Mangkutak</strong>, tidak mengukir sembarangan; mereka tunduk pada pakem ukiran nenek moyang. Ada tiga motif utama dalam ukiran Dayak Kaltara:</p>
<ol>
    <li><strong>Motif Aso:</strong> Sebuah figur mitologi hibrida, gabungan dari anjing penjaga (aso) dan naga (dragon). Motif Aso sangat dominan dengan bentuk lekukan-lekukan spiral melingkar. Aso melambangkan perlindungan dari roh-roh pembawa penyakit dan merupakan simbol penguasa alam bawah (sungai dan bumi).</li>
    <li><strong>Motif Burung Enggang:</strong> Motif ini kebalikan dari Aso, mewakili dunia atas (kayangan dan para dewa). Enggang adalah simbol tertinggi perdamaian, keagungan, dan kemuliaan status sosial bangsawan Dayak.</li>
    <li><strong>Motif Paku Pakis / Sulur:</strong> Motif berupa tumbuhan pakis yang melingkar atau sulur tanaman rambat. Melambangkan roda kehidupan yang tiada henti, adaptasi manusia terhadap kerasnya alam rimba, dan harmoni komunal masyarakat Dayak yang terus tumbuh bersama.</li>
</ol>

<h3>Seni Manik-Manik Berwarna Alam</h3>
<p>Wanita Dayak Kenyah dan Kayan adalah seniman yang ulung dalam merangkai manik-manik (beadwork). Berabad-abad lampau, manik-manik ini didapat dari pedagang barter Tiongkok kuno. Kini manik kaca dirangkai menjadi pakaian adat (baju inoq), ikat kepala, anting-anting, dan menghiasi topi pelindung sinar matahari yang luas bernama <em>Seraung</em>. Pola-pola simetris dibuat secara presisi menggunakan paduan empat warna utama: Hitam, Putih, Merah, dan Kuning (melambangkan air, cahaya, darah, dan tanah).</p>

<h3>Anyaman Rotan dan Doyo</h3>
<p>Keseharian orang Dayak tidak bisa lepas dari rotan dan tanaman doyo. Para pria masuk ke dalam hutan mengumpulkan rotan berduri, membersihkannya, lalu membelahnya tipis-tipis. Helaian rotan fleksibel ini dianyam rapat menjadi ransel pengangkut (Anjat) atau keranjang. Anyaman Kaltara diakui amat kokoh dan presisi. Bahkan kini, produk anyaman rotan Dayak Kaltara memiliki nilai seni dekoratif interior yang sangat tinggi dan telah menembus pasar ekspor di Eropa dan Jepang.</p>
HTML;
    }
}
