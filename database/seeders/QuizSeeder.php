<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        $guru = User::where('role', 'teacher')->orWhere('role', 'admin')->first();

        foreach ($this->quizData() as $slug => $data) {
            $material = Material::where('slug', $slug)->first();
            if (! $material) continue;

            foreach (['pretest', 'posttest'] as $type) {
                $quiz = Quiz::firstOrCreate(
                    ['material_id' => $material->id, 'quiz_type' => $type],
                    [
                        'title'               => ($type === 'pretest' ? 'Pretest: ' : 'Posttest: ') . $material->title,
                        'teacher_id'          => $guru->id,
                        'passing_score'       => $type === 'posttest' ? 70 : 0,
                        'time_limit'          => null,
                        'min_harian_required' => 0,
                    ]
                );

                if ($quiz->questions()->count() > 0) continue;

                $questions = $data[$type];
                foreach ($questions as $i => $q) {
                    Question::create([
                        'quiz_id'        => $quiz->id,
                        'question'       => $q['question'],
                        'type'           => 'multiple_choice',
                        'options'        => $q['options'],
                        'correct_answer' => $q['answer'],
                        'order'          => $i + 1,
                    ]);
                }
            }
        }
    }

    private function quizData(): array
    {
        return [

            'tari-hudoq-ritual-sakral-suku-dayak' => [
                'pretest' => [
                    ['question' => 'Tari Hudoq berasal dari suku apa?', 'options' => ['Dayak Bahau', 'Banjar', 'Kutai', 'Tidung'], 'answer' => 'Dayak Bahau'],
                    ['question' => 'Apa fungsi utama Tari Hudoq dalam tradisi Dayak?', 'options' => ['Hiburan semata', 'Ritual memohon kesuburan ladang', 'Penyambutan tamu', 'Upacara pernikahan'], 'answer' => 'Ritual memohon kesuburan ladang'],
                    ['question' => 'Kostum khas penari Hudoq terbuat dari apa?', 'options' => ['Kain sutra', 'Daun pisang dan rotan', 'Bulu burung merak', 'Kulit hewan'], 'answer' => 'Daun pisang dan rotan'],
                    ['question' => 'Apa arti kata "Hudoq" dalam bahasa Dayak?', 'options' => ['Tari perang', 'Roh penolong', 'Burung sakti', 'Pesta panen'], 'answer' => 'Roh penolong'],
                    ['question' => 'Alat musik apa yang mengiringi Tari Hudoq?', 'options' => ['Gambus', 'Garantung', 'Rebana', 'Seruling'], 'answer' => 'Garantung'],
                ],
                'posttest' => [
                    ['question' => 'Tari Hudoq dilakukan pada saat apa?', 'options' => ['Hari raya nasional', 'Musim tanam padi', 'Upacara kematian', 'Hari ulang tahun raja'], 'answer' => 'Musim tanam padi'],
                    ['question' => 'Topeng dalam Tari Hudoq menggambarkan apa?', 'options' => ['Wajah raja', 'Wajah roh-roh alam', 'Tokoh wayang', 'Hewan buas'], 'answer' => 'Wajah roh-roh alam'],
                    ['question' => 'Burung suci dalam budaya Dayak yang gerakannya ditiru penari Hudoq?', 'options' => ['Burung Cendrawasih', 'Burung Enggang', 'Burung Merak', 'Burung Elang'], 'answer' => 'Burung Enggang'],
                    ['question' => 'Gerakan utama Tari Hudoq menirukan apa?', 'options' => ['Ombak laut', 'Sayap burung Enggang', 'Api unggun', 'Aliran sungai'], 'answer' => 'Sayap burung Enggang'],
                    ['question' => 'Di mana Tari Hudoq kini juga dipentaskan selain upacara adat?', 'options' => ['Gedung parlemen', 'Festival budaya dan acara pariwisata', 'Acara pernikahan saja', 'Hanya di hutan'], 'answer' => 'Festival budaya dan acara pariwisata'],
                ],
            ],

            'musik-panting-harmoni-suku-banjar' => [
                'pretest' => [
                    ['question' => 'Musik Panting berasal dari suku apa?', 'options' => ['Dayak', 'Banjar', 'Kutai', 'Tidung'], 'answer' => 'Banjar'],
                    ['question' => 'Dari apa alat musik Panting dibuat?', 'options' => ['Bambu', 'Kayu nangka dengan dawai rotan', 'Besi tempa', 'Kulit hewan'], 'answer' => 'Kayu nangka dengan dawai rotan'],
                    ['question' => 'Alat perkusi dari kuningan dalam ensambel Panting disebut?', 'options' => ['Gong', 'Kangkung', 'Rebana', 'Kendang'], 'answer' => 'Kangkung'],
                    ['question' => 'Musik Panting biasanya mengiringi apa?', 'options' => ['Pertandingan olahraga', 'Syair puisi Melayu dan cerita rakyat', 'Upacara perang', 'Pesta ulang tahun'], 'answer' => 'Syair puisi Melayu dan cerita rakyat'],
                    ['question' => 'Sejak abad berapa Musik Panting berkembang?', 'options' => ['Abad ke-10', 'Abad ke-17', 'Abad ke-20', 'Abad ke-5'], 'answer' => 'Abad ke-17'],
                ],
                'posttest' => [
                    ['question' => 'Gendang kecil dalam ensambel Musik Panting disebut?', 'options' => ['Babun', 'Kendang', 'Rebana', 'Tifa'], 'answer' => 'Babun'],
                    ['question' => 'Apa keunikan suara Musik Panting?', 'options' => ['Sangat keras', 'Perpaduan melodi pentatonik Melayu dengan ritme lincah', 'Nada tunggal monoton', 'Mirip musik rock'], 'answer' => 'Perpaduan melodi pentatonik Melayu dengan ritme lincah'],
                    ['question' => 'Instrumen modern yang ditambahkan dalam Musik Panting?', 'options' => ['Gitar listrik', 'Biola', 'Piano', 'Drum'], 'answer' => 'Biola'],
                    ['question' => 'Musik Panting ditampilkan dalam acara apa?', 'options' => ['Konser pop', 'Upacara pernikahan dan penyambutan tamu', 'Festival olahraga', 'Pasar malam'], 'answer' => 'Upacara pernikahan dan penyambutan tamu'],
                    ['question' => 'Karakter suara Musik Panting digambarkan sebagai?', 'options' => ['Keras dan memekakkan', 'Hangat dan menyentuh hati', 'Dingin dan melankolis', 'Cepat dan membingungkan'], 'answer' => 'Hangat dan menyentuh hati'],
                ],
            ],

            'tari-jepen-keanggunan-suku-kutai' => [
                'pretest' => [
                    ['question' => 'Tari Jepen merupakan tarian khas suku apa?', 'options' => ['Dayak', 'Banjar', 'Kutai', 'Tidung'], 'answer' => 'Kutai'],
                    ['question' => 'Dari kata apa nama "Jepen" berasal?', 'options' => ['Jepin', 'Japin', 'Jipeng', 'Japen'], 'answer' => 'Japin'],
                    ['question' => 'Budaya apa yang mempengaruhi Tari Jepen?', 'options' => ['Cina dan India', 'Melayu dan Arab', 'Eropa dan Amerika', 'Jawa dan Bali'], 'answer' => 'Melayu dan Arab'],
                    ['question' => 'Bagaimana gerakan khas Tari Jepen?', 'options' => ['Kasar dan energik', 'Lembut dan anggun', 'Melompat-lompat tinggi', 'Berputar cepat'], 'answer' => 'Lembut dan anggun'],
                    ['question' => 'Alat musik apa yang mengiringi Tari Jepen?', 'options' => ['Gong dan bedug', 'Gambus dan rebana', 'Piano dan biola', 'Gamelan Jawa'], 'answer' => 'Gambus dan rebana'],
                ],
                'posttest' => [
                    ['question' => 'Tari Jepen biasanya dibawakan oleh siapa?', 'options' => ['Penari laki-laki saja', 'Penari perempuan dalam kelompok', 'Anak-anak saja', 'Pasangan campuran'], 'answer' => 'Penari perempuan dalam kelompok'],
                    ['question' => 'Apa makna Tari Jepen bagi masyarakat Kutai?', 'options' => ['Simbol pemberontakan', 'Kehalusan budi pekerti dan kebersamaan', 'Tanda peperangan', 'Upacara kematian'], 'answer' => 'Kehalusan budi pekerti dan kebersamaan'],
                    ['question' => 'Kostum Tari Jepen menggunakan motif apa?', 'options' => ['Batik Jawa', 'Kain bermotif Melayu Kutai berwarna cerah', 'Kain polos putih', 'Kostum modern'], 'answer' => 'Kain bermotif Melayu Kutai berwarna cerah'],
                    ['question' => 'Tari Jepen kini diajarkan di mana?', 'options' => ['Hanya di istana', 'Kurikulum seni budaya sekolah', 'Hanya untuk orang dewasa', 'Kursus berbayar saja'], 'answer' => 'Kurikulum seni budaya sekolah'],
                    ['question' => 'Tari Jepen mencerminkan akulturasi budaya apa saja?', 'options' => ['Cina, Jepang, Korea', 'Melayu, Arab, dan lokal Kalimantan', 'India, Eropa, Afrika', 'Jawa, Sunda, Bali'], 'answer' => 'Melayu, Arab, dan lokal Kalimantan'],
                ],
            ],

            'festival-iraw-tengkayu-pesta-laut-suku-tidung' => [
                'pretest' => [
                    ['question' => 'Festival Iraw Tengkayu adalah festival dari suku apa?', 'options' => ['Dayak', 'Banjar', 'Kutai', 'Tidung'], 'answer' => 'Tidung'],
                    ['question' => 'Apa arti nama "Iraw Tengkayu"?', 'options' => ['Tari di pantai', 'Pesta di atas air', 'Upacara di hutan', 'Pasar malam suku'], 'answer' => 'Pesta di atas air'],
                    ['question' => 'Di kota mana Festival Iraw Tengkayu digelar?', 'options' => ['Tanjung Selor', 'Nunukan', 'Tarakan', 'Bulungan'], 'answer' => 'Tarakan'],
                    ['question' => 'Berapa tahun sekali Festival Iraw Tengkayu diselenggarakan?', 'options' => ['Setiap tahun', 'Setiap 2 tahun', 'Setiap 5 tahun', 'Setiap 10 tahun'], 'answer' => 'Setiap 2 tahun'],
                    ['question' => 'Tarian sakral pembuka Festival Iraw Tengkayu adalah?', 'options' => ['Tari Hudoq', 'Tari Jepen', 'Tari Garay', 'Tari Baksa Kembang'], 'answer' => 'Tari Garay'],
                ],
                'posttest' => [
                    ['question' => 'Tradisi asli cikal bakal festival ini disebut?', 'options' => ['Pesta Dayak', 'Sesajian Laut', 'Pasar Terapung', 'Upacara Bersih Desa'], 'answer' => 'Sesajian Laut'],
                    ['question' => 'Apa yang dilarung ke laut dalam festival ini?', 'options' => ['Uang dan emas', 'Makanan dan bunga sebagai sesaji', 'Perahu tua', 'Pakaian adat'], 'answer' => 'Makanan dan bunga sebagai sesaji'],
                    ['question' => 'Filosofi hidup Suku Tidung yang tercermin dalam festival?', 'options' => ['Hidup mandiri tanpa bergantung', 'Tau Sama Tau, Berat Sama Dipikul', 'Berani mati demi kehormatan', 'Kekayaan adalah segalanya'], 'answer' => 'Tau Sama Tau, Berat Sama Dipikul'],
                    ['question' => 'Festival Iraw Tengkayu biasanya digelar pada bulan?', 'options' => ['Januari', 'Juni', 'Oktober', 'Desember'], 'answer' => 'Oktober'],
                    ['question' => 'Festival ini telah masuk ke dalam?', 'options' => ['Daftar UNESCO', 'Kalender Event Nasional Indonesia', 'Rekor MURI', 'Buku sejarah dunia'], 'answer' => 'Kalender Event Nasional Indonesia'],
                ],
            ],

            'rumah-baloy-arsitektur-tradisional-kalimantan-utara' => [
                'pretest' => [
                    ['question' => 'Rumah Baloy adalah rumah adat resmi dari provinsi mana?', 'options' => ['Kalimantan Timur', 'Kalimantan Utara', 'Kalimantan Selatan', 'Kalimantan Tengah'], 'answer' => 'Kalimantan Utara'],
                    ['question' => 'Rumah Baloy berbentuk apa?', 'options' => ['Rumah bawah tanah', 'Rumah panggung', 'Rumah di atas air', 'Rumah dalam gua'], 'answer' => 'Rumah panggung'],
                    ['question' => 'Material utama Rumah Baloy terbuat dari?', 'options' => ['Batu bata', 'Kayu ulin (kayu besi)', 'Bambu', 'Baja ringan'], 'answer' => 'Kayu ulin (kayu besi)'],
                    ['question' => 'Rumah Baloy memadukan unsur arsitektur dari berapa suku?', 'options' => ['2 suku', '3 suku', '4 suku', '5 suku'], 'answer' => '4 suku'],
                    ['question' => 'Di kota mana Rumah Baloy Mayo berada?', 'options' => ['Tarakan', 'Nunukan', 'Tanjung Selor', 'Bulungan'], 'answer' => 'Tanjung Selor'],
                ],
                'posttest' => [
                    ['question' => 'Ruang utama (aula) dalam Rumah Baloy disebut?', 'options' => ['Joglo', 'Lamin', 'Pendopo', 'Gazebo'], 'answer' => 'Lamin'],
                    ['question' => 'Mengapa Rumah Baloy dibuat berbentuk panggung?', 'options' => ['Supaya terlihat megah', 'Adaptasi terhadap alam yang lembab dan rawan banjir', 'Tradisi nenek moyang', 'Lebih murah dibangun'], 'answer' => 'Adaptasi terhadap alam yang lembab dan rawan banjir'],
                    ['question' => 'Ornamen tanduk kerbau pada atap berfungsi sebagai?', 'options' => ['Hiasan semata', 'Penangkal bala', 'Tanda status pemilik', 'Penyalur petir'], 'answer' => 'Penangkal bala'],
                    ['question' => 'Filosofi utama Rumah Baloy adalah?', 'options' => ['Kemewahan dan kejayaan', 'Kalimantan Utara Bersatu dalam keberagaman', 'Kekuatan militer', 'Kemajuan teknologi'], 'answer' => 'Kalimantan Utara Bersatu dalam keberagaman'],
                    ['question' => 'Motif ukiran yang menghiasi Rumah Baloy adalah?', 'options' => ['Motif batik Jawa', 'Motif flora-fauna khas Borneo seperti burung Enggang', 'Motif abstrak modern', 'Motif kaligrafi Arab'], 'answer' => 'Motif flora-fauna khas Borneo seperti burung Enggang'],
                ],
            ],

            'tenun-tradisional-warisan-kain-kalimantan-utara' => [
                'pretest' => [
                    ['question' => 'Tenun Ulap Doyo terbuat dari serat apa?', 'options' => ['Kapas', 'Tanaman doyo', 'Bambu', 'Nanas'], 'answer' => 'Tanaman doyo'],
                    ['question' => 'Kain Sasirangan adalah kain khas dari suku?', 'options' => ['Dayak', 'Banjar', 'Kutai', 'Tidung'], 'answer' => 'Banjar'],
                    ['question' => 'Teknik pembuatan kain Sasirangan adalah?', 'options' => ['Tenun manual', 'Ikat celup', 'Batik tulis', 'Sablon'], 'answer' => 'Ikat celup'],
                    ['question' => 'Bahan pewarna alami kuning pada tenun berasal dari?', 'options' => ['Kunyit', 'Indigo', 'Kulit mahoni', 'Daun pandan'], 'answer' => 'Kunyit'],
                    ['question' => 'Motif apa yang sering ditemukan pada tenun Kaltara?', 'options' => ['Motif bunga mawar', 'Motif burung Enggang', 'Motif ikan koi', 'Motif bulan bintang'], 'answer' => 'Motif burung Enggang'],
                ],
                'posttest' => [
                    ['question' => 'Motif sulur pakis melambangkan?', 'options' => ['Kesedihan', 'Pertumbuhan, kesuburan, dan kehidupan berkembang', 'Kekuatan militer', 'Kematian'], 'answer' => 'Pertumbuhan, kesuburan, dan kehidupan berkembang'],
                    ['question' => 'Berapa lama membuat satu kain tenun berkualitas?', 'options' => ['Beberapa jam', 'Berminggu-minggu hingga berbulan-bulan', 'Satu hari saja', 'Beberapa menit'], 'answer' => 'Berminggu-minggu hingga berbulan-bulan'],
                    ['question' => 'Pewarna alami biru pada tenun berasal dari?', 'options' => ['Kunyit', 'Indigo', 'Kulit mahoni', 'Daun jati'], 'answer' => 'Indigo'],
                    ['question' => 'Ke negara mana produk tenun Kaltara mulai diekspor?', 'options' => ['Amerika dan Australia', 'Eropa dan Jepang', 'Cina dan India', 'Afrika dan Timur Tengah'], 'answer' => 'Eropa dan Jepang'],
                    ['question' => 'Upaya pelestarian tenun dilakukan melalui?', 'options' => ['Mengimpor kain dari luar negeri', 'Program pelatihan penenun muda dan festival kain', 'Pembuatan di pabrik besar', 'Disimpan di museum saja'], 'answer' => 'Program pelatihan penenun muda dan festival kain'],
                ],
            ],

            'mandau-senjata-tradisional-kalimantan-utara' => [
                'pretest' => [
                    ['question' => 'Mandau adalah senjata tradisional dari mana?', 'options' => ['Jawa', 'Kalimantan', 'Sulawesi', 'Sumatra'], 'answer' => 'Kalimantan'],
                    ['question' => 'Gagang Mandau (hulu) terbuat dari?', 'options' => ['Besi murni', 'Tanduk rusa atau tulang', 'Kayu jati', 'Plastik keras'], 'answer' => 'Tanduk rusa atau tulang'],
                    ['question' => 'Mandau bagi masyarakat adat merupakan?', 'options' => ['Alat dapur biasa', 'Benda pusaka berjiwa dan berkekuatan spiritual', 'Hadiah ulang tahun', 'Mainan anak-anak'], 'answer' => 'Benda pusaka berjiwa dan berkekuatan spiritual'],
                    ['question' => 'Berapa cm panjang bilah Mandau umumnya?', 'options' => ['10-20 cm', '50-70 cm', '100-120 cm', '30-40 cm'], 'answer' => '50-70 cm'],
                    ['question' => 'Pisau kecil di sarung Mandau disebut?', 'options' => ['Keris', 'Rencong', 'Pisau raut', 'Badik'], 'answer' => 'Pisau raut'],
                ],
                'posttest' => [
                    ['question' => 'Sarung Mandau disebut dengan nama?', 'options' => ['Warangka', 'Kumpang', 'Sarong', 'Ladung'], 'answer' => 'Kumpang'],
                    ['question' => 'Teknik pembuatan bilah Mandau menggunakan?', 'options' => ['Teknik cor logam', 'Teknik tempa tradisional', 'Teknik las modern', 'Dicetak dari mesin'], 'answer' => 'Teknik tempa tradisional'],
                    ['question' => 'Mandau Pusaka berbeda karena?', 'options' => ['Lebih besar', 'Dipercaya memiliki kekuatan magis dan dijaga dengan ritual', 'Dibuat dari emas', 'Bentuknya berbeda total'], 'answer' => 'Dipercaya memiliki kekuatan magis dan dijaga dengan ritual'],
                    ['question' => 'Kini Mandau dijadikan sebagai?', 'options' => ['Senjata perang aktif', 'Simbol kebanggaan budaya dan cinderamata premium', 'Alat pertanian', 'Peralatan memasak'], 'answer' => 'Simbol kebanggaan budaya dan cinderamata premium'],
                    ['question' => 'Bilah Mandau biasanya dibuat dari?', 'options' => ['Emas murni', 'Besi pilihan atau baja', 'Perunggu kuno', 'Kayu keras'], 'answer' => 'Besi pilihan atau baja'],
                ],
            ],

            'kuliner-tradisional-kalimantan-utara' => [
                'pretest' => [
                    ['question' => 'Kota yang dijuluki "Kota Kepiting" di Kalimantan Utara?', 'options' => ['Tanjung Selor', 'Nunukan', 'Tarakan', 'Bulungan'], 'answer' => 'Tarakan'],
                    ['question' => 'Amplang adalah kerupuk yang dibuat dari?', 'options' => ['Singkong', 'Ikan pipih atau ikan tenggiri', 'Udang segar', 'Kedelai'], 'answer' => 'Ikan pipih atau ikan tenggiri'],
                    ['question' => 'Warna kuning pada Nasi Kuning Kaltara berasal dari?', 'options' => ['Wortel', 'Kunyit', 'Jagung', 'Labu kuning'], 'answer' => 'Kunyit'],
                    ['question' => 'Kepiting Soka dipanen saat?', 'options' => ['Sedang bertelur', 'Baru selesai berganti cangkang', 'Berusia 5 tahun', 'Ukurannya paling besar'], 'answer' => 'Baru selesai berganti cangkang'],
                    ['question' => 'Kaltara terkenal sebagai penghasil terbesar?', 'options' => ['Padi dan jagung', 'Rumput laut', 'Kelapa sawit', 'Karet'], 'answer' => 'Rumput laut'],
                ],
                'posttest' => [
                    ['question' => 'Keistimewaan Kepiting Soka dibanding kepiting biasa?', 'options' => ['Ukurannya lebih besar', 'Seluruh tubuhnya termasuk cangkang bisa dimakan', 'Rasanya lebih pahit', 'Warnanya lebih merah'], 'answer' => 'Seluruh tubuhnya termasuk cangkang bisa dimakan'],
                    ['question' => 'Sayur Asam Kaltara menggunakan bahan khas hutan Borneo yaitu?', 'options' => ['Bayam dan kangkung', 'Rebung muda dan terong asam', 'Brokoli dan wortel', 'Selada dan tomat'], 'answer' => 'Rebung muda dan terong asam'],
                    ['question' => 'Rempah pengaruh budaya Melayu-Banjar dalam kuliner Kaltara?', 'options' => ['Lada hitam dan kayu manis', 'Lengkuas, serai, dan kunyit', 'Jintan dan ketumbar', 'Kapulaga dan pala'], 'answer' => 'Lengkuas, serai, dan kunyit'],
                    ['question' => 'Dodol rumput laut adalah inovasi kuliner dari bahan?', 'options' => ['Pantai Bali', 'Perairan Kalimantan Utara', 'Danau Toba', 'Selat Malaka'], 'answer' => 'Perairan Kalimantan Utara'],
                    ['question' => 'Upaya pemerintah melestarikan kuliner tradisional Kaltara?', 'options' => ['Melarang makanan asing masuk', 'Festival kuliner dan program Warung Asli Kaltara', 'Membangun pabrik makanan besar', 'Mengekspor semua bahan makanan'], 'answer' => 'Festival kuliner dan program Warung Asli Kaltara'],
                ],
            ],

            'seni-ukir-anyaman-kalimantan-utara' => [
                'pretest' => [
                    ['question' => 'Bahan utama anyaman yang paling umum di Kaltara?', 'options' => ['Benang nilon', 'Rotan', 'Kawat besi', 'Plastik'], 'answer' => 'Rotan'],
                    ['question' => 'Motif Burung Enggang dalam ukiran Dayak melambangkan?', 'options' => ['Kematian', 'Kebebasan, keberanian, dan kemuliaan', 'Kemiskinan', 'Musuh yang kalah'], 'answer' => 'Kebebasan, keberanian, dan kemuliaan'],
                    ['question' => 'Pengukir dalam tradisi Dayak disebut?', 'options' => ['Pandai besi', 'Mangkutak', 'Pengrajin', 'Seniman'], 'answer' => 'Mangkutak'],
                    ['question' => 'Topi anyaman kerucut lebar untuk petani disebut?', 'options' => ['Peci', 'Topi Sugu (Terendak)', 'Kopiah', 'Topi caping'], 'answer' => 'Topi Sugu (Terendak)'],
                    ['question' => 'Kayu tahan rayap untuk ukiran Kaltara adalah?', 'options' => ['Kayu jati', 'Kayu ulin (besi)', 'Kayu pinus', 'Kayu mahoni'], 'answer' => 'Kayu ulin (besi)'],
                ],
                'posttest' => [
                    ['question' => 'Motif Naga dalam ukiran Kaltara bermakna?', 'options' => ['Ancaman dan kutukan', 'Penjaga alam bawah dan pembawa kemakmuran', 'Musuh suku', 'Simbol kejahatan'], 'answer' => 'Penjaga alam bawah dan pembawa kemakmuran'],
                    ['question' => 'Daun apa yang dianyam menjadi tikar, topi, dan tas?', 'options' => ['Daun kelapa', 'Daun pandan hutan', 'Daun jati', 'Daun pisang'], 'answer' => 'Daun pandan hutan'],
                    ['question' => 'Tas anyaman rotan bermotif geometris bernilai tinggi disebut?', 'options' => ['Tas Belida', 'Tas Dayak', 'Tas Rotan', 'Tas Kalimantan'], 'answer' => 'Tas Belida'],
                    ['question' => 'Ke negara mana produk anyaman Kaltara diekspor?', 'options' => ['Amerika dan Australia', 'Eropa dan Jepang', 'Cina dan India', 'Afrika dan Timur Tengah'], 'answer' => 'Eropa dan Jepang'],
                    ['question' => 'Motif Pilin Berganda (sulur) melambangkan?', 'options' => ['Kehancuran', 'Kesinambungan hidup dan hubungan manusia dengan alam', 'Kekayaan material', 'Kekuatan perang'], 'answer' => 'Kesinambungan hidup dan hubungan manusia dengan alam'],
                ],
            ],
        ];
    }
}
