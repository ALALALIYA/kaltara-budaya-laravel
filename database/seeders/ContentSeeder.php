<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->approveMaterials();
        $this->updateMaterialsKD();
        $this->updateQuizTimeLimits();
        $this->updateQuestionExplanations();
        $this->createExamQuizzes();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info('ContentSeeder selesai.');
    }

    // ── 1. Approve 4 pending materials ───────────────────────────────────────
    private function approveMaterials(): void
    {
        Material::whereIn('id', [1, 2, 3, 4])->update(['status' => 'approved']);
        $this->command->info('Materials 1-4 approved.');
    }

    // ── 2. Update KD + pertemuan_ke ───────────────────────────────────────────
    private function updateMaterialsKD(): void
    {
        $data = [
            1 => ['pertemuan_ke' => 2, 'kompetensi_dasar' => '3.1 Menganalisis keunikan gerak, iringan, tata busana, tata rias, dan fungsi sosial tari tradisional Tari Hudoq dari Suku Dayak Kalimantan Utara'],
            2 => ['pertemuan_ke' => 3, 'kompetensi_dasar' => '3.2 Mengidentifikasi jenis, fungsi, dan nilai estetika musik tradisional Musik Panting dari Suku Banjar Kalimantan Utara'],
            3 => ['pertemuan_ke' => 4, 'kompetensi_dasar' => '3.3 Mengevaluasi akulturasi budaya yang tercermin dalam Tari Jepen Suku Kutai sebagai identitas budaya lokal'],
            4 => ['pertemuan_ke' => 5, 'kompetensi_dasar' => '3.4 Menganalisis makna, fungsi, dan nilai filosofis Festival Iraw Tengkayu sebagai warisan budaya Suku Tidung'],
            6 => ['pertemuan_ke' => 6, 'kompetensi_dasar' => '3.5 Memahami konsep arsitektur tradisional Rumah Baloy sebagai representasi identitas dan nilai budaya Kalimantan Utara'],
            7 => ['pertemuan_ke' => 7, 'kompetensi_dasar' => '3.6 Mengidentifikasi teknik pembuatan, motif, dan makna simbolik tenun tradisional sebagai warisan budaya Kalimantan Utara'],
            8 => ['pertemuan_ke' => 8, 'kompetensi_dasar' => '3.7 Menganalisis nilai budaya, fungsi, dan keunikan senjata tradisional Mandau dalam kehidupan masyarakat Kalimantan Utara'],
            9 => ['pertemuan_ke' => 9, 'kompetensi_dasar' => '3.8 Memahami kekayaan kuliner tradisional Kalimantan Utara sebagai bagian dari identitas dan warisan budaya daerah'],
            10 => ['pertemuan_ke' => 10, 'kompetensi_dasar' => '3.9 Mengapresiasi nilai estetika, teknik pembuatan, dan makna simbolik seni ukir dan anyaman tradisional Kalimantan Utara'],
        ];

        foreach ($data as $id => $fields) {
            Material::where('id', $id)->update($fields);
        }
        $this->command->info('KD dan pertemuan_ke diupdate untuk 9 materi.');
    }

    // ── 3. Set time_limit on all quizzes ─────────────────────────────────────
    private function updateQuizTimeLimits(): void
    {
        Quiz::whereIn('quiz_type', ['pretest', 'posttest', 'standalone'])->update(['time_limit' => null]);
        Quiz::where('quiz_type', 'ujian_harian')->update(['time_limit' => 15]);
        Quiz::where('quiz_type', 'uts')->update(['time_limit' => 30]);
        Quiz::where('quiz_type', 'uas')->update(['time_limit' => 45]);
        $this->command->info('time_limit diupdate untuk semua quiz.');
    }

    // ── 4. Fill explanations for 100 existing questions ──────────────────────
    private function updateQuestionExplanations(): void
    {
        $explanations = [
            1  => 'Tari Hudoq berasal dari Suku Dayak Bahau, sub-suku Dayak yang mendiami kawasan pedalaman Kalimantan. Mereka memiliki ritual ladang yang sangat kuat dan sakral.',
            2  => 'Tari Hudoq bukan sekadar hiburan—ia adalah ritual sakral untuk memohon kesuburan ladang dan perlindungan roh leluhur agar panen berlimpah.',
            3  => 'Topeng kayu berukuran besar adalah ciri paling khas Tari Hudoq. Topeng ini diukir menggambarkan roh-roh alam dan diyakini mengandung kekuatan spiritual.',
            4  => 'Tari Hudoq dilaksanakan pada musim tanam padi sebagai permohonan kepada roh-roh alam agar ladang subur dan terhindar dari hama.',
            5  => 'Musik pengiring Tari Hudoq menggunakan alat musik tradisional seperti Garantung (sejenis gong), bukan alat musik modern seperti keyboard.',
            6  => 'Burung Enggang atau Rangkong adalah simbol tertinggi dalam budaya Dayak, melambangkan keberanian, kemuliaan, dan kebebasan. Bulunya sering menghiasi pakaian adat.',
            7  => 'Festival Iraw Tengkayu adalah perayaan budaya khas Suku Tidung di Tarakan sebagai bentuk syukur atas hasil laut dan keharmonisan dengan alam.',
            8  => 'Musik Panting memang merupakan kesenian musik tradisional Suku Banjar, menggunakan alat musik petik bernama Panting sebagai instrumen utamanya.',
            9  => 'Tarakan adalah kota terbesar dan pusat perekonomian Kalimantan Utara, dikenal sebagai kota kepiting dan salah satu kota paling dinamis di provinsi ini.',
            10 => 'Tari Jepen berakar dari budaya Melayu yang mengalami akulturasi dengan pengaruh Arab dan budaya lokal, menjadikannya tarian khas Suku Kutai Kalimantan Utara.',
            11 => 'Tari Hudoq berasal dari Suku Dayak Bahau. Identitas etnis ini mencerminkan sub-suku Dayak dengan ritual ladang yang kuat di pedalaman Kalimantan.',
            12 => 'Fungsi utama Tari Hudoq adalah ritual keagamaan memohon kesuburan ladang. Para penari bertopeng roh dipercaya dapat mengundang kekuatan supranatural untuk melindungi tanaman padi.',
            13 => 'Kostum penari Hudoq dibuat dari bahan alami—daun pisang yang dianyam dan rotan—mencerminkan kedekatan masyarakat Dayak dengan alam sekitarnya.',
            14 => 'Kata "Hudoq" dalam bahasa Dayak Bahau berarti "roh penolong". Penari diyakini dirasuki roh-roh penolong saat melaksanakan ritual ini.',
            15 => 'Garantung adalah alat musik perkusi dari logam, mirip gong, yang menjadi pengiring utama Tari Hudoq dalam setiap ritual adat Dayak.',
            16 => 'Tari Hudoq dilaksanakan khusus pada musim tanam padi sebagai ritual adat untuk memohon berkat dan perlindungan agar panen berhasil melimpah.',
            17 => 'Topeng dalam Tari Hudoq menggambarkan wajah berbagai roh alam yang dipercaya memiliki kekuatan menjaga dan menyuburkan ladang masyarakat Dayak.',
            18 => 'Burung Enggang (Hornbill) adalah burung suci dalam budaya Dayak. Gerakannya yang anggun dijadikan inspirasi gerakan dalam berbagai tarian adat, termasuk Hudoq.',
            19 => 'Gerakan utama Tari Hudoq menirukan kibasan sayap Burung Enggang yang lebar dan anggun, melambangkan kebebasan jiwa dan kekuatan spiritual.',
            20 => 'Tari Hudoq kini dipentaskan di festival budaya dan acara pariwisata untuk memperkenalkan warisan budaya Dayak kepada masyarakat luas dan dunia.',
            21 => 'Musik Panting berasal dari Suku Banjar, salah satu suku terbesar di Kalimantan Selatan yang juga banyak bermukim di Kalimantan Utara.',
            22 => 'Alat musik Panting dibuat dari kayu nangka karena resonansinya baik, dengan dawai dari rotan yang ditipiskan, menghasilkan suara khas yang merdu.',
            23 => 'Kangkung adalah alat perkusi dari kuningan dalam ensambel Musik Panting yang memberikan warna ritmis tersendiri dalam harmoni musik Banjar.',
            24 => 'Musik Panting tradisionalnya mengiringi syair-syair puisi Melayu dan penceritaan kisah rakyat, menjadikannya media komunikasi budaya yang kaya makna.',
            25 => 'Musik Panting berkembang sejak abad ke-17, bersamaan dengan kejayaan Kesultanan Banjar, menunjukkan kedalaman sejarah warisan budaya ini.',
            26 => 'Babun adalah gendang kecil dalam ensambel Musik Panting yang berperan penting mengatur ritme dan tempo keseluruhan permainan musik.',
            27 => 'Keunikan Musik Panting terletak pada perpaduan melodi pentatonik Melayu yang mengalun indah dengan ritme yang lincah dan dinamis, khas dan mudah dikenali.',
            28 => 'Seiring perkembangan zaman, biola ditambahkan ke dalam ensambel Musik Panting untuk memperkaya warna melodi tanpa meninggalkan karakter tradisionalnya.',
            29 => 'Musik Panting dimainkan dalam upacara pernikahan adat Banjar dan penyambutan tamu kehormatan sebagai tanda penghormatan tertinggi.',
            30 => 'Karakter suara Musik Panting yang hangat dan menyentuh hati adalah ekspresi jiwa Banjar yang penuh perasaan dan kecintaan pada tradisi leluhur.',
            31 => 'Tari Jepen adalah tarian tradisional khas Suku Kutai yang memiliki akar budaya Melayu kuat dan sejarah panjang sebagai warisan kerajaan tertua Nusantara.',
            32 => 'Nama "Jepen" berasal dari kata "Japin", istilah untuk sejenis tarian Melayu-Arab, mencerminkan akulturasi budaya Melayu lokal dengan pengaruh Islam dari Arab.',
            33 => 'Tari Jepen merupakan perpaduan unik antara budaya Melayu Kalimantan dan pengaruh Arab yang masuk melalui jalur perdagangan dan penyebaran Islam.',
            34 => 'Gerakan Tari Jepen bercirikan kelembutan dan keanggunan yang mencerminkan budi pekerti halus masyarakat Kutai dan nilai-nilai keislaman yang dijunjung tinggi.',
            35 => 'Gambus (alat petik berpengaruh Arab) dan Rebana (gendang kecil) mengiringi Tari Jepen, mencerminkan akulturasi budaya Melayu-Arab dalam seni musik.',
            36 => 'Tari Jepen biasanya dibawakan oleh penari perempuan dalam kelompok dengan gerakan serasi dan harmonis, menggambarkan keindahan dan keanggunan perempuan Kutai.',
            37 => 'Tari Jepen bermakna sebagai ekspresi kehalusan budi pekerti dan semangat kebersamaan—nilai-nilai yang dijunjung tinggi dalam kehidupan sosial masyarakat Kutai.',
            38 => 'Kostum Tari Jepen menggunakan kain bermotif Melayu Kutai dengan warna cerah dan meriah, mencerminkan kegembiraan dan kekayaan budaya Kutai.',
            39 => 'Tari Jepen dimasukkan dalam kurikulum seni budaya sekolah sebagai upaya pelestarian agar generasi muda dapat mempelajari warisan leluhur mereka.',
            40 => 'Tari Jepen mencerminkan akulturasi tiga budaya: Melayu (lokal Kalimantan), Arab (masuk melalui Islam), dan lokal Kalimantan—simbol toleransi dan kekayaan budaya.',
            41 => 'Festival Iraw Tengkayu adalah festival budaya Suku Tidung yang dikenal sebagai "Suku Laut" karena tradisi mereka sangat erat dengan lautan.',
            42 => '"Iraw Tengkayu" dalam bahasa Tidung berarti "pesta di atas air", menggambarkan perayaan di laut sebagai simbol syukur atas rezeki dari lautan.',
            43 => 'Festival Iraw Tengkayu digelar di Tarakan, kota terbesar Kalimantan Utara yang sekaligus menjadi pusat budaya Suku Tidung.',
            44 => 'Festival Iraw Tengkayu diselenggarakan setiap dua tahun sekali, menjadikannya event budaya yang paling dinantikan masyarakat Tarakan dan wisatawan.',
            45 => 'Tari Garay adalah tarian sakral pembuka Festival Iraw Tengkayu, dibawakan untuk mengawali rangkaian ritual dan memohon berkah kepada Yang Maha Kuasa.',
            46 => '"Sesajian Laut" adalah tradisi asli cikal bakal Festival Iraw Tengkayu—ritual melarung sesaji ke laut sebagai ungkapan syukur nelayan atas hasil tangkapan.',
            47 => 'Makanan dan bunga sebagai sesaji dilarung ke laut dalam ritual Iraw Tengkayu sebagai persembahan kepada laut yang menjadi sumber kehidupan masyarakat Tidung.',
            48 => 'Filosofi "Tau Sama Tau, Berat Sama Dipikul" dari Suku Tidung berarti saling mengenal dan berbagi beban bersama—cerminan semangat gotong royong yang kuat.',
            49 => 'Festival Iraw Tengkayu digelar pada bulan Oktober, bertepatan dengan waktu yang dianggap baik menurut tradisi Suku Tidung untuk menggelar perayaan laut.',
            50 => 'Festival Iraw Tengkayu telah masuk Kalender Event Nasional Indonesia, menegaskan statusnya sebagai warisan budaya penting yang diakui di tingkat nasional.',
            51 => 'Rumah Baloy ditetapkan sebagai rumah adat resmi Provinsi Kalimantan Utara—provinsi ke-34 Indonesia yang diresmikan pada tahun 2012.',
            52 => 'Rumah Baloy berbentuk panggung sebagai adaptasi arsitektur terhadap kondisi alam Kalimantan yang lembab, sering hujan, dan rawan banjir.',
            53 => 'Kayu ulin (kayu besi) adalah material utama Rumah Baloy—kayu asli Kalimantan yang sangat kuat, tahan rayap, dan bertahan ratusan tahun.',
            54 => 'Rumah Baloy memadukan unsur arsitektur 4 suku utama Kaltara (Dayak, Banjar, Kutai, Tidung), menjadi simbol persatuan dan keberagaman masyarakat.',
            55 => 'Rumah Baloy Mayo, representasi terbesar rumah adat ini, berada di Tanjung Selor, ibu kota Provinsi Kalimantan Utara.',
            56 => 'Lamin adalah ruang utama Rumah Baloy—aula besar tempat pertemuan adat, musyawarah, dan upacara-upacara penting dilangsungkan.',
            57 => 'Bentuk panggung Rumah Baloy adalah adaptasi cerdas arsitektur lokal terhadap iklim tropis Kalimantan yang lembab dan rawan banjir.',
            58 => 'Ornamen tanduk kerbau di atap Rumah Baloy berfungsi sebagai penangkal bala sesuai kepercayaan tradisional masyarakat Kalimantan.',
            59 => 'Filosofi "Kalimantan Utara Bersatu dalam Keberagaman" pada Rumah Baloy mencerminkan tekad masyarakat Kaltara bersatu meski berasal dari berbagai suku.',
            60 => 'Ukiran Rumah Baloy didominasi motif flora-fauna khas Borneo terutama Burung Enggang yang melambangkan kemuliaan, dan tumbuhan hutan Kalimantan.',
            61 => 'Tenun Ulap Doyo menggunakan serat dari tanaman doyo (Curculigo latifolia), tanaman endemik Kalimantan, yang daunnya dipintal menjadi benang tenun.',
            62 => 'Kain Sasirangan adalah kain tradisional Suku Banjar. Nama "Sasirangan" berasal dari "menyirang" yang berarti diikat atau dijahit sebelum dicelup warna.',
            63 => 'Teknik ikat celup pada Sasirangan: kain dijahit dengan pola tertentu, diikat, lalu dicelup ke larutan pewarna—menghasilkan motif khas setelah ikatan dilepas.',
            64 => 'Kunyit adalah sumber pewarna alami kuning dalam tenun tradisional. Penggunaan pewarna alami ini merupakan kearifan lokal yang menjaga kelestarian lingkungan.',
            65 => 'Motif Burung Enggang paling ikonik dalam tenun Kaltara—melambangkan kebebasan, keberanian, dan kemuliaan yang dijunjung tinggi masyarakat Dayak Kalimantan.',
            66 => 'Motif sulur pakis melambangkan pertumbuhan, kesuburan, dan kehidupan yang terus berkembang—filosofi masyarakat yang berharap tumbuh selaras dengan alam.',
            67 => 'Membuat satu helai kain tenun berkualitas tinggi memerlukan berminggu-minggu hingga berbulan-bulan, mencerminkan nilai keterampilan dan dedikasi penenun.',
            68 => 'Tanaman Indigo (Indigofera tinctoria) menghasilkan zat warna biru alami yang tahan lama dan aman lingkungan, digunakan sebagai pewarna dalam tenun tradisional.',
            69 => 'Tenun tradisional Kalimantan Utara telah menembus pasar ekspor ke Eropa dan Jepang—dua kawasan yang sangat menghargai kerajinan tangan artisanal berkualitas tinggi.',
            70 => 'Program pelatihan penenun muda dan festival kain adalah cara melestarikan tenun tradisional agar warisan budaya ini tidak punah dan terus berkembang.',
            71 => 'Mandau adalah senjata tradisional ikonik dari Kalimantan, khususnya milik Suku Dayak. Senjata berbentuk parang panjang ini merupakan identitas budaya yang sangat dihormati.',
            72 => 'Gagang atau hulu Mandau secara tradisional dibuat dari tanduk rusa atau tulang hewan, dihiasi ukiran indah dan rambut sebagai ornamen keberanian.',
            73 => 'Bagi masyarakat adat Dayak, Mandau adalah benda pusaka yang diyakini berjiwa—memiliki kekuatan spiritual dan harus diperlakukan hormat melalui ritual khusus.',
            74 => 'Bilah Mandau umumnya sepanjang 50-70 cm—cukup efektif di hutan lebat Kalimantan, panjang untuk membersihkan semak namun tidak terlalu berat dibawa.',
            75 => 'Pisau Raut adalah pisau kecil yang tersimpan di sarung Mandau, biasanya digunakan untuk pekerjaan sehari-hari yang lebih halus dan presisi.',
            76 => 'Kumpang adalah sebutan untuk sarung atau wadah Mandau, biasanya terbuat dari kayu yang diukir indah—sekaligus media ekspresi seni ukir Dayak.',
            77 => 'Bilah Mandau dibuat dengan teknik tempa tradisional—logam dipanaskan dan dipukul berulang oleh pandai besi hingga terbentuk bilah yang kuat dan tajam.',
            78 => 'Mandau Pusaka diyakini memiliki kekuatan magis (supranatural) dan harus dijaga melalui ritual khusus—berbeda dari Mandau biasa yang hanya senjata sehari-hari.',
            79 => 'Di era modern, Mandau bertransformasi menjadi simbol kebanggaan budaya Dayak sekaligus cinderamata premium yang dicari wisatawan dan kolektor seni.',
            80 => 'Bilah Mandau dibuat dari besi pilihan atau baja berkualitas tinggi agar kuat, tahan lama, dan dapat mempertahankan ketajaman dalam jangka panjang.',
            81 => 'Tarakan dijuluki "Kota Kepiting" karena merupakan penghasil kepiting soka (kepiting cangkang lunak) terbesar di Indonesia, menjadi ikon kuliner kota ini.',
            82 => 'Amplang adalah kerupuk ikan khas Kalimantan dari daging ikan pipih atau tenggiri yang dihaluskan, dicampur tepung sagu, dan digoreng hingga renyah mengembang.',
            83 => 'Kunyit (Curcuma longa) memberi warna kuning cerah pada Nasi Kuning Kaltara, sekaligus aroma khas dan kandungan antioksidan yang bermanfaat bagi kesehatan.',
            84 => 'Kepiting Soka dipanen tepat saat molting—baru selesai berganti cangkang. Pada fase ini seluruh tubuhnya masih lunak sehingga bisa dimakan utuh termasuk cangkangnya.',
            85 => 'Kalimantan Utara, terutama Tarakan, adalah penghasil rumput laut terbesar Indonesia. Kondisi perairan yang ideal menjadikannya sentra budidaya rumput laut nasional.',
            86 => 'Keistimewaan Kepiting Soka adalah seluruh tubuhnya—termasuk cangkang lunak—bisa dimakan tanpa dikupas, sangat praktis dan kaya nilai gizi.',
            87 => 'Rebung muda (tunas bambu) dan terong asam khas hutan Borneo menjadi bahan istimewa Sayur Asam Kaltara, memberikan cita rasa segar dan asam alami.',
            88 => 'Lengkuas, serai, dan kunyit adalah rempah pengaruh Melayu-Banjar yang menjadi ciri khas aroma dan cita rasa masakan tradisional Kalimantan Utara.',
            89 => 'Dodol rumput laut adalah inovasi kuliner yang memanfaatkan komoditas unggulan perairan Kalimantan Utara—rumput laut—diolah menjadi makanan manis tradisional.',
            90 => 'Festival kuliner daerah dan program Warung Asli Kaltara adalah inisiatif pemerintah untuk mempromosikan dan mempertahankan cita rasa kuliner tradisional lokal.',
            91 => 'Rotan adalah bahan anyaman paling umum di Kaltara—tumbuh subur di hutan Kalimantan dan dikenal karena kekuatan serta fleksibilitasnya untuk berbagai kerajinan.',
            92 => 'Motif Burung Enggang dalam ukiran Dayak melambangkan kebebasan, keberanian, dan kemuliaan—tiga nilai tertinggi yang dijunjung dalam filosofi hidup Suku Dayak.',
            93 => 'Mangkutak adalah sebutan untuk pengukir ahli dalam tradisi Dayak—profesi yang sangat dihormati karena kemampuan mengukir karya seni bernilai tinggi bermakna spiritual.',
            94 => 'Topi Sugu (Terendak) adalah topi anyaman kerucut lebar yang digunakan petani melindungi kepala dari terik—terbuat dari anyaman bambu atau daun pandan hutan.',
            95 => 'Kayu Ulin (kayu besi) khas Kalimantan sangat tahan rayap, cuaca ekstrem, dan kelembaban—inilah mengapa ia menjadi pilihan utama untuk ukiran dan bangunan adat.',
            96 => 'Motif Naga bermakna penjaga alam bawah (laut/sungai) dan pembawa kemakmuran bagi masyarakat yang hidup di sekitar perairan Kalimantan.',
            97 => 'Daun pandan hutan adalah bahan anyaman alami yang mudah ditemukan di hutan Kalimantan, dianyam menjadi tikar, topi, dan tas yang kuat dan tahan lama.',
            98 => 'Tas Belida adalah tas anyaman rotan bermotif geometris bernilai tinggi dari Kalimantan Utara—keunikan motifnya yang rumit menjadikannya karya seni premium.',
            99 => 'Produk anyaman tradisional Kalimantan Utara berhasil diekspor ke Eropa dan Jepang—pasar yang sangat menghargai kerajinan tangan berkualitas tinggi dan autentik.',
            100 => 'Motif Pilin Berganda (sulur) melambangkan kesinambungan hidup dan hubungan erat manusia dengan alam—filosofi dasar kehidupan masyarakat Borneo secara turun-temurun.',
        ];

        foreach ($explanations as $id => $text) {
            Question::where('id', $id)->update(['explanation' => $text]);
        }
        $this->command->info('Penjelasan diisi untuk 100 soal.');
    }

    // ── 5. Create exam quizzes (idempotent) ───────────────────────────────────
    private function createExamQuizzes(): void
    {
        $this->createUjianHarian();
        $this->createUTS();
        $this->createUAS();
        $this->command->info('Quiz Ujian Harian, UTS, dan UAS berhasil dibuat.');
    }

    private function createUjianHarian(): void
    {
        $exams = [
            [
                'title'       => 'Ujian Harian 1: Suku-Suku Kalimantan Utara',
                'description' => 'Ujian harian tentang pengenalan suku-suku utama yang mendiami Kalimantan Utara.',
                'questions'   => [
                    ['q' => 'Berapa jumlah suku utama yang mewakili budaya Kalimantan Utara dalam media pembelajaran ini?', 'opts' => ['2 suku', '3 suku', '4 suku', '5 suku'], 'ans' => '4 suku', 'exp' => 'Empat suku utama dipelajari: Dayak, Banjar, Kutai, dan Tidung—mewakili keberagaman budaya Kalimantan Utara.'],
                    ['q' => 'Provinsi Kalimantan Utara resmi terbentuk pada tahun berapa?', 'opts' => ['2008', '2010', '2012', '2015'], 'ans' => '2012', 'exp' => 'Kalimantan Utara resmi menjadi provinsi ke-34 Indonesia pada tahun 2012, menjadikannya provinsi termuda saat itu.'],
                    ['q' => 'Ibu kota Provinsi Kalimantan Utara adalah?', 'opts' => ['Tarakan', 'Nunukan', 'Tanjung Selor', 'Bulungan'], 'ans' => 'Tanjung Selor', 'exp' => 'Tanjung Selor adalah ibu kota Provinsi Kalimantan Utara, berlokasi di Kabupaten Bulungan di tepi Sungai Kayan.'],
                    ['q' => 'Suku yang dikenal sebagai "Suku Laut" di Kalimantan Utara adalah?', 'opts' => ['Dayak', 'Banjar', 'Kutai', 'Tidung'], 'ans' => 'Tidung', 'exp' => 'Suku Tidung dikenal sebagai "Suku Laut" karena kehidupan dan tradisi mereka sangat erat kaitannya dengan laut.'],
                    ['q' => 'Kerajaan kuno yang berkaitan dengan Suku Kutai di Kalimantan adalah?', 'opts' => ['Kerajaan Majapahit', 'Kerajaan Kutai Martadipura', 'Kerajaan Sriwijaya', 'Kerajaan Banjar'], 'ans' => 'Kerajaan Kutai Martadipura', 'exp' => 'Kerajaan Kutai Martadipura diakui sebagai kerajaan Hindu tertua di Nusantara (sekitar abad ke-4 M), akar sejarah Suku Kutai.'],
                    ['q' => 'Suku yang paling banyak mendiami kawasan pedalaman dan hutan Kalimantan adalah?', 'opts' => ['Tidung', 'Kutai', 'Dayak', 'Banjar'], 'ans' => 'Dayak', 'exp' => 'Suku Dayak adalah masyarakat adat yang telah lama mendiami pedalaman Kalimantan, hidup harmonis berdampingan dengan alam hutan Borneo.'],
                    ['q' => 'Kota terbesar di Kalimantan Utara yang juga merupakan pusat ekonomi provinsi ini adalah?', 'opts' => ['Tanjung Selor', 'Nunukan', 'Malinau', 'Tarakan'], 'ans' => 'Tarakan', 'exp' => 'Tarakan adalah kota terbesar dan pusat perekonomian Kalimantan Utara, dikenal sebagai kota kepiting dan pintu masuk utama provinsi.'],
                    ['q' => 'Suku Banjar berasal dari Kalimantan bagian mana sebelum banyak bermigrasi ke Kalimantan Utara?', 'opts' => ['Kalimantan Tengah', 'Kalimantan Selatan', 'Kalimantan Timur', 'Kalimantan Barat'], 'ans' => 'Kalimantan Selatan', 'exp' => 'Suku Banjar berasal dari Kalimantan Selatan (sekitar Banjarmasin), dan banyak bermigrasi ke Kalimantan Utara sambil membawa tradisi budaya mereka.'],
                    ['q' => 'Burung yang menjadi simbol kemuliaan dan keberanian bagi banyak suku di Kalimantan adalah?', 'opts' => ['Merak', 'Elang Bondol', 'Enggang (Rangkong)', 'Merpati'], 'ans' => 'Enggang (Rangkong)', 'exp' => 'Burung Enggang atau Rangkong adalah simbol tertinggi di banyak suku Kalimantan, terutama Dayak. Bulunya yang indah melambangkan kemuliaan.'],
                    ['q' => 'Nilai budaya yang menjadi landasan kehidupan sosial semua suku di Kalimantan Utara adalah?', 'opts' => ['Persaingan antarkelompok', 'Individualisme', 'Gotong royong dan kebersamaan', 'Isolasi budaya'], 'ans' => 'Gotong royong dan kebersamaan', 'exp' => 'Gotong royong dan semangat kebersamaan adalah nilai universal yang dijunjung tinggi semua suku di Kaltara, tercermin dalam setiap upacara adat.'],
                ],
            ],
            [
                'title'       => 'Ujian Harian 2: Tradisi dan Adat Istiadat Kaltara',
                'description' => 'Ujian harian tentang tradisi, upacara adat, dan filosofi budaya masyarakat Kalimantan Utara.',
                'questions'   => [
                    ['q' => 'Festival Iraw Tengkayu digelar setiap berapa tahun sekali?', 'opts' => ['Setiap tahun', 'Setiap 2 tahun', 'Setiap 3 tahun', 'Setiap 5 tahun'], 'ans' => 'Setiap 2 tahun', 'exp' => 'Festival Iraw Tengkayu diselenggarakan setiap dua tahun sekali di Tarakan, menjadi event budaya yang paling dinantikan masyarakat Kaltara.'],
                    ['q' => 'Filosofi hidup Suku Tidung "Tau Sama Tau, Berat Sama Dipikul" mencerminkan nilai?', 'opts' => ['Kompetisi', 'Individualisme', 'Gotong royong', 'Isolasi'], 'ans' => 'Gotong royong', 'exp' => '"Tau Sama Tau, Berat Sama Dipikul" berarti saling mengenal dan menanggung beban bersama—cerminan semangat gotong royong inti budaya Tidung.'],
                    ['q' => 'Dalam Festival Iraw Tengkayu, apa yang dilarung ke laut?', 'opts' => ['Perahu besar', 'Makanan dan bunga sebagai sesaji', 'Uang logam', 'Patung leluhur'], 'ans' => 'Makanan dan bunga sebagai sesaji', 'exp' => 'Makanan dan bunga dilarung ke laut sebagai sesaji—persembahan kepada laut yang menjadi sumber kehidupan masyarakat Tidung.'],
                    ['q' => 'Tari sakral yang menjadi pembuka Festival Iraw Tengkayu disebut?', 'opts' => ['Tari Jepen', 'Tari Garay', 'Tari Hudoq', 'Tari Kancet'], 'ans' => 'Tari Garay', 'exp' => 'Tari Garay adalah tarian sakral pembuka Festival Iraw Tengkayu, dibawakan untuk mengawali ritual dan memohon berkah kepada Yang Maha Kuasa.'],
                    ['q' => 'Festival Iraw Tengkayu biasanya diselenggarakan pada bulan?', 'opts' => ['Juli', 'Agustus', 'September', 'Oktober'], 'ans' => 'Oktober', 'exp' => 'Festival Iraw Tengkayu biasanya digelar pada bulan Oktober, bertepatan dengan waktu yang dianggap baik menurut tradisi Suku Tidung.'],
                    ['q' => 'Filosofi Rumah Baloy sebagai rumah adat Kaltara adalah?', 'opts' => ['Keunggulan satu suku', 'Kaltara Bersatu dalam Keberagaman', 'Pemisahan budaya tiap suku', 'Persaingan antarbudaya'], 'ans' => 'Kaltara Bersatu dalam Keberagaman', 'exp' => 'Rumah Baloy mewujudkan filosofi "Kalimantan Utara Bersatu dalam Keberagaman"—tekad bersatu meski berbeda suku dan budaya.'],
                    ['q' => 'Upacara pernikahan adat Banjar di Kalimantan Utara biasanya diiringi musik?', 'opts' => ['Gamelan Jawa', 'Musik Panting', 'Kecapi Sunda', 'Angklung'], 'ans' => 'Musik Panting', 'exp' => 'Musik Panting adalah pengiring tradisional upacara pernikahan dan penyambutan tamu adat Banjar, sebagai tanda penghormatan tertinggi.'],
                    ['q' => 'Dalam tradisi Dayak Bahau, apa makna pemakaian topeng dalam Tari Hudoq?', 'opts' => ['Hiasan semata', 'Penari diyakini memanifestasikan roh pelindung', 'Agar penari tidak dikenali', 'Mengikuti mode'], 'ans' => 'Penari diyakini memanifestasikan roh pelindung', 'exp' => 'Topeng dalam Tari Hudoq bukan hiasan—penari diyakini memanifestasikan roh-roh pelindung yang dimohon hadir untuk menjaga ladang.'],
                    ['q' => 'Mandau Pusaka dalam tradisi Dayak diperlakukan berbeda karena?', 'opts' => ['Lebih mahal harganya', 'Dipercaya memiliki kekuatan spiritual dan dijaga dengan ritual', 'Bentuknya lebih bagus', 'Lebih tajam dari Mandau biasa'], 'ans' => 'Dipercaya memiliki kekuatan spiritual dan dijaga dengan ritual', 'exp' => 'Mandau Pusaka diyakini memiliki jiwa dan kekuatan magis (supranatural), harus dijaga melalui ritual khusus oleh pemilik atau tetua adat.'],
                    ['q' => 'Kain Sasirangan dibuat oleh Suku Banjar dengan teknik apa?', 'opts' => ['Tenun ATBM', 'Ikat celup', 'Batik tulis', 'Bordir'], 'ans' => 'Ikat celup', 'exp' => 'Sasirangan dibuat dengan teknik ikat celup: kain dijahit pola tertentu, diikat, dicelup ke larutan warna, lalu ikatan dilepas menghasilkan motif khas.'],
                ],
            ],
            [
                'title'       => 'Ujian Harian 3: Tari Tradisional Kaltara',
                'description' => 'Ujian harian tentang tari tradisional Kalimantan Utara: Tari Hudoq dan Tari Jepen.',
                'questions'   => [
                    ['q' => 'Tari Hudoq termasuk kategori tari apa?', 'opts' => ['Tari hiburan semata', 'Tari ritual sakral', 'Tari pergaulan modern', 'Tari pertunjukan komersial'], 'ans' => 'Tari ritual sakral', 'exp' => 'Tari Hudoq adalah tari ritual sakral yang dilakukan untuk memohon kesuburan ladang dan perlindungan dari roh-roh alam—bukan sekadar hiburan.'],
                    ['q' => 'Kata "Hudoq" dalam bahasa Dayak Bahau berarti?', 'opts' => ['Roh penjaga', 'Roh penolong', 'Roh nenek moyang', 'Dewa alam'], 'ans' => 'Roh penolong', 'exp' => '"Hudoq" berarti "roh penolong" dalam bahasa Dayak Bahau—penari diyakini dirasuki roh-roh penolong saat melaksanakan ritual ini.'],
                    ['q' => 'Tari Jepen berasal dari akulturasi budaya apa?', 'opts' => ['Dayak dan Arab', 'Melayu, Arab, dan lokal Kalimantan', 'Jawa dan Melayu', 'China dan Melayu'], 'ans' => 'Melayu, Arab, dan lokal Kalimantan', 'exp' => 'Tari Jepen mencerminkan akulturasi tiga budaya: Melayu (asal lokal), Arab (melalui Islam), dan lokal Kalimantan—simbol toleransi budaya.'],
                    ['q' => 'Gerakan Tari Jepen bercirikan apa?', 'opts' => ['Keras dan agresif', 'Lembut dan anggun', 'Cepat dan berenergi tinggi', 'Akrobatik dan atletis'], 'ans' => 'Lembut dan anggun', 'exp' => 'Gerakan Tari Jepen bercirikan kelembutan dan keanggunan—mencerminkan budi pekerti halus masyarakat Kutai dan nilai-nilai keislaman.'],
                    ['q' => 'Alat musik utama pengiring Tari Jepen adalah?', 'opts' => ['Garantung dan gendang', 'Gambus dan rebana', 'Kecapi dan suling', 'Biola dan panting'], 'ans' => 'Gambus dan rebana', 'exp' => 'Gambus (alat petik berpengaruh Arab) dan Rebana (gendang kecil) mengiringi Tari Jepen, mencerminkan akulturasi budaya Melayu-Arab.'],
                    ['q' => 'Tari Hudoq biasanya dilaksanakan pada saat?', 'opts' => ['Pesta pernikahan', 'Tahun baru adat', 'Musim tanam padi', 'Upacara kematian'], 'ans' => 'Musim tanam padi', 'exp' => 'Tari Hudoq dilaksanakan pada musim tanam padi sebagai ritual adat memohon berkat dan perlindungan agar panen melimpah.'],
                    ['q' => 'Gerakan utama Tari Hudoq terinspirasi dari?', 'opts' => ['Harimau berburu', 'Ikan berenang', 'Sayap Burung Enggang', 'Angin bertiup'], 'ans' => 'Sayap Burung Enggang', 'exp' => 'Gerakan utama Tari Hudoq menirukan kibasan sayap Burung Enggang yang anggun, melambangkan kebebasan jiwa dan kekuatan spiritual.'],
                    ['q' => 'Kostum Tari Jepen menggunakan motif apa?', 'opts' => ['Motif Dayak Kenyah', 'Kain bermotif Melayu Kutai berwarna cerah', 'Batik Jawa klasik', 'Kain polos tanpa motif'], 'ans' => 'Kain bermotif Melayu Kutai berwarna cerah', 'exp' => 'Kostum Tari Jepen menggunakan kain bermotif Melayu Kutai berwarna cerah, mencerminkan kegembiraan dan kekayaan budaya Kutai.'],
                    ['q' => 'Tari Jepen kini diajarkan di mana sebagai upaya pelestarian?', 'opts' => ['Hanya di keraton', 'Kurikulum seni budaya sekolah', 'Hanya di komunitas adat', 'Festival internasional saja'], 'ans' => 'Kurikulum seni budaya sekolah', 'exp' => 'Tari Jepen dimasukkan dalam kurikulum seni budaya sekolah agar generasi muda dapat mempelajari dan melestarikan warisan leluhur.'],
                    ['q' => 'Atribut terpenting yang membedakan Tari Hudoq dari tari lainnya adalah?', 'opts' => ['Kostum bulu-buluan', 'Topeng kayu berukir besar', 'Mahkota emas', 'Pedang di tangan'], 'ans' => 'Topeng kayu berukir besar', 'exp' => 'Topeng kayu berukuran besar yang menggambarkan roh-roh alam adalah ciri paling khas dan unik Tari Hudoq, tidak dimiliki tarian lain.'],
                ],
            ],
            [
                'title'       => 'Ujian Harian 4: Musik dan Kesenian Kaltara',
                'description' => 'Ujian harian tentang musik tradisional dan kesenian Kalimantan Utara.',
                'questions'   => [
                    ['q' => 'Alat musik utama Musik Panting terbuat dari?', 'opts' => ['Bambu dengan dawai sutra', 'Kayu nangka dengan dawai rotan', 'Kulit hewan dengan dawai nilon', 'Logam dengan dawai baja'], 'ans' => 'Kayu nangka dengan dawai rotan', 'exp' => 'Alat musik Panting dibuat dari kayu nangka (resonansi baik) dengan dawai rotan yang ditipiskan, menghasilkan suara khas dan merdu.'],
                    ['q' => 'Musik Panting mulai berkembang sejak abad berapa?', 'opts' => ['Abad ke-15', 'Abad ke-16', 'Abad ke-17', 'Abad ke-18'], 'ans' => 'Abad ke-17', 'exp' => 'Musik Panting berkembang sejak abad ke-17 bersamaan dengan kejayaan Kesultanan Banjar—bukti kedalaman sejarah warisan budaya ini.'],
                    ['q' => 'Kata "Jepen" berasal dari kata "Japin" yang berarti?', 'opts' => ['Jipen (nama sungai)', 'Jenis tarian Melayu-Arab', 'Japen (alat tenun)', 'Jipan (nama baju adat)'], 'ans' => 'Jenis tarian Melayu-Arab', 'exp' => '"Japin" adalah istilah untuk jenis tarian Melayu-Arab, mencerminkan akulturasi budaya Melayu lokal dengan pengaruh Islam dari pedagang Arab.'],
                    ['q' => 'Alat perkusi dari kuningan dalam ensambel Musik Panting disebut?', 'opts' => ['Babun', 'Kangkung', 'Tawak-tawak', 'Garantung'], 'ans' => 'Kangkung', 'exp' => 'Kangkung adalah alat perkusi dari kuningan dalam ensambel Musik Panting yang memberikan warna ritmis khas dalam harmoni musik Banjar.'],
                    ['q' => 'Karakter suara Musik Panting digambarkan sebagai?', 'opts' => ['Keras dan menggelegar', 'Dingin dan misterius', 'Hangat dan menyentuh hati', 'Cepat dan ritmis saja'], 'ans' => 'Hangat dan menyentuh hati', 'exp' => 'Suara Musik Panting yang hangat dan menyentuh hati adalah ekspresi jiwa Banjar yang penuh perasaan dan kecintaan pada tradisi leluhur.'],
                    ['q' => 'Instrumen modern yang ditambahkan dalam Musik Panting adalah?', 'opts' => ['Gitar elektrik', 'Piano', 'Biola', 'Saxophone'], 'ans' => 'Biola', 'exp' => 'Biola ditambahkan ke ensambel Musik Panting untuk memperkaya warna melodi tanpa meninggalkan karakter tradisionalnya yang khas.'],
                    ['q' => 'Gendang kecil dalam ensambel Musik Panting disebut?', 'opts' => ['Babun', 'Rebana', 'Bedug', 'Ketipung'], 'ans' => 'Babun', 'exp' => 'Babun adalah gendang kecil dalam ensambel Musik Panting yang berperan penting mengatur ritme dan tempo permainan musik.'],
                    ['q' => 'Alat musik pengiring utama Tari Hudoq adalah?', 'opts' => ['Rebana', 'Gamelan', 'Garantung', 'Serunai'], 'ans' => 'Garantung', 'exp' => 'Garantung adalah alat musik perkusi logam (mirip gong) yang menjadi pengiring utama Tari Hudoq dalam setiap ritual adat Dayak.'],
                    ['q' => 'Musik Panting umumnya mengiringi?', 'opts' => ['Upacara kematian', 'Syair puisi Melayu dan cerita rakyat', 'Olahraga tradisional', 'Ritual pertanian padi'], 'ans' => 'Syair puisi Melayu dan cerita rakyat', 'exp' => 'Musik Panting tradisionalnya mengiringi syair-syair puisi Melayu dan penceritaan kisah rakyat, sebagai media komunikasi budaya yang kaya makna.'],
                    ['q' => 'Keunikan Musik Panting terletak pada?', 'opts' => ['Suara keras yang memekakkan', 'Perpaduan melodi pentatonik Melayu dengan ritme lincah', 'Irama yang sangat lambat', 'Hanya menggunakan alat tiup'], 'ans' => 'Perpaduan melodi pentatonik Melayu dengan ritme lincah', 'exp' => 'Perpaduan melodi pentatonik Melayu yang mengalun indah dengan ritme lincah dan dinamis menjadikan Musik Panting mudah dikenali dan khas.'],
                ],
            ],
            [
                'title'       => 'Ujian Harian 5: Kerajinan, Kuliner, dan Budaya Material Kaltara',
                'description' => 'Ujian harian tentang kerajinan tangan, kuliner tradisional, dan budaya material Kalimantan Utara.',
                'questions'   => [
                    ['q' => 'Kota Tarakan dijuluki sebagai?', 'opts' => ['Kota Seribu Sungai', 'Kota Kepiting', 'Kota Melayu Sejati', 'Kota Borneo'], 'ans' => 'Kota Kepiting', 'exp' => 'Tarakan dijuluki "Kota Kepiting" karena merupakan penghasil kepiting soka terbesar di Indonesia, menjadikan kepiting ikon kuliner kota ini.'],
                    ['q' => 'Amplang adalah kerupuk yang terbuat dari?', 'opts' => ['Singkong', 'Ikan pipih atau ikan tenggiri', 'Udang vannamei', 'Tepung terigu murni'], 'ans' => 'Ikan pipih atau ikan tenggiri', 'exp' => 'Amplang dibuat dari daging ikan pipih atau tenggiri yang dihaluskan, dicampur tepung sagu, dan digoreng hingga renyah mengembang.'],
                    ['q' => 'Bahan utama anyaman yang paling umum di Kalimantan Utara adalah?', 'opts' => ['Bambu', 'Rotan', 'Pandan', 'Daun kelapa'], 'ans' => 'Rotan', 'exp' => 'Rotan adalah bahan anyaman paling umum di Kaltara—tumbuh subur di hutan Kalimantan dan dikenal karena kekuatan serta fleksibilitasnya.'],
                    ['q' => 'Tenun Ulap Doyo terbuat dari serat?', 'opts' => ['Kapas', 'Sutra alam', 'Tanaman doyo', 'Serat nilon'], 'ans' => 'Tanaman doyo', 'exp' => 'Tenun Ulap Doyo menggunakan serat dari tanaman doyo (Curculigo latifolia), tanaman endemik Kalimantan yang daunnya dipintal menjadi benang tenun.'],
                    ['q' => 'Motif dalam ukiran Dayak yang melambangkan kebebasan dan kemuliaan adalah?', 'opts' => ['Motif naga', 'Motif bunga teratai', 'Motif Burung Enggang', 'Motif ikan arwana'], 'ans' => 'Motif Burung Enggang', 'exp' => 'Motif Burung Enggang paling ikonik dalam seni Dayak—melambangkan kebebasan, keberanian, dan kemuliaan yang dijunjung tinggi masyarakat Kalimantan.'],
                    ['q' => 'Kepiting Soka dipanen saat dalam kondisi?', 'opts' => ['Sedang bertelur', 'Baru selesai berganti cangkang', 'Ukuran paling besar', 'Musim migrasi'], 'ans' => 'Baru selesai berganti cangkang', 'exp' => 'Kepiting Soka dipanen saat molting—baru berganti cangkang. Saat itu seluruh tubuh masih lunak sehingga bisa dimakan utuh termasuk cangkangnya.'],
                    ['q' => 'Material utama pembuatan Rumah Baloy adalah?', 'opts' => ['Kayu meranti', 'Bambu pilihan', 'Kayu ulin (kayu besi)', 'Beton bertulang'], 'ans' => 'Kayu ulin (kayu besi)', 'exp' => 'Kayu ulin (kayu besi) adalah material utama Rumah Baloy—kayu asli Kalimantan yang kuat, tahan rayap, dan dapat bertahan ratusan tahun.'],
                    ['q' => 'Kalimantan Utara terkenal sebagai penghasil terbesar?', 'opts' => ['Kelapa sawit', 'Karet alam', 'Rumput laut', 'Kopi Arabika'], 'ans' => 'Rumput laut', 'exp' => 'Kalimantan Utara, terutama Tarakan, adalah penghasil rumput laut terbesar Indonesia. Kondisi perairan ideal menjadikannya sentra budidaya nasional.'],
                    ['q' => 'Teknik pembuatan kain Sasirangan adalah?', 'opts' => ['Batik tulis tangan', 'Tenun ikat tradisional', 'Ikat celup', 'Bordir mesin'], 'ans' => 'Ikat celup', 'exp' => 'Sasirangan dibuat dengan teknik ikat celup: dijahit pola tertentu, diikat, dicelup warna, lalu ikatan dilepas—menghasilkan motif khas Banjar.'],
                    ['q' => 'Tas anyaman rotan bermotif geometris bernilai tinggi dari Kaltara disebut?', 'opts' => ['Tas Doyo', 'Tas Belida', 'Tas Sugu', 'Tas Enggang'], 'ans' => 'Tas Belida', 'exp' => 'Tas Belida adalah tas anyaman rotan bermotif geometris bernilai tinggi khas Kaltara. Keunikan motifnya yang rumit menjadikannya karya seni premium.'],
                ],
            ],
        ];

        foreach ($exams as $exam) {
            $quiz = Quiz::firstOrCreate(
                ['title' => $exam['title'], 'quiz_type' => 'ujian_harian'],
                [
                    'description'      => $exam['description'],
                    'teacher_id'       => 1,
                    'material_id'      => null,
                    'quiz_type'        => 'ujian_harian',
                    'passing_score'    => 70,
                    'time_limit'       => 15,
                    'min_harian_required' => 0,
                ]
            );

            if ($quiz->questions()->count() === 0) {
                foreach ($exam['questions'] as $i => $q) {
                    $quiz->questions()->create([
                        'question'       => $q['q'],
                        'type'           => 'multiple_choice',
                        'options'        => $q['opts'],
                        'correct_answer' => $q['ans'],
                        'explanation'    => $q['exp'],
                        'order'          => $i + 1,
                    ]);
                }
            }
        }
    }

    private function createUTS(): void
    {
        $quiz = Quiz::firstOrCreate(
            ['title' => 'UTS: Seni Budaya Kalimantan Utara (Materi 1-3)', 'quiz_type' => 'uts'],
            [
                'description'         => 'Ujian Tengah Semester mencakup materi Tari Hudoq, Musik Panting, dan Tari Jepen.',
                'teacher_id'          => 1,
                'material_id'         => null,
                'quiz_type'           => 'uts',
                'passing_score'       => 70,
                'time_limit'          => 30,
                'min_harian_required' => 3,
            ]
        );

        if ($quiz->questions()->count() === 0) {
            $questions = [
                ['q' => 'Suku Dayak Bahau mendiami wilayah utama di?', 'opts' => ['Pesisir pantai', 'Kawasan pedalaman Kalimantan', 'Pulau-pulau kecil', 'Dataran rendah'], 'ans' => 'Kawasan pedalaman Kalimantan', 'exp' => 'Suku Dayak Bahau mendiami kawasan pedalaman Kalimantan, jauh dari pesisir, hidup berdampingan dengan alam hutan Borneo yang kaya.'],
                ['q' => 'Tari Hudoq merupakan tarian yang berfungsi sebagai?', 'opts' => ['Hiburan masyarakat semata', 'Ritual sakral memohon kesuburan ladang', 'Pertunjukan wisata komersial', 'Olahraga tradisional'], 'ans' => 'Ritual sakral memohon kesuburan ladang', 'exp' => 'Tari Hudoq berfungsi sebagai ritual sakral memohon kesuburan ladang—penari bertopeng dipercaya mengundang roh pelindung untuk menjaga tanaman.'],
                ['q' => 'Kostum penari Hudoq terbuat dari bahan alami berupa?', 'opts' => ['Kulit binatang dan bulu burung', 'Daun pisang dan rotan', 'Kain sutra bordir', 'Bahan sintetis modern'], 'ans' => 'Daun pisang dan rotan', 'exp' => 'Kostum Tari Hudoq dibuat dari daun pisang yang dianyam dan rotan—bahan alami yang mencerminkan kedekatan Dayak Bahau dengan alam.'],
                ['q' => 'Kata "Hudoq" dalam bahasa Dayak Bahau bermakna?', 'opts' => ['Semangat perang', 'Roh penolong', 'Panen berlimpah', 'Doa keselamatan'], 'ans' => 'Roh penolong', 'exp' => '"Hudoq" berarti "roh penolong"—penari diyakini dirasuki roh-roh penolong yang datang melindungi ladang masyarakat Dayak Bahau.'],
                ['q' => 'Tari Hudoq kini juga dipentaskan di luar upacara adat, yaitu di?', 'opts' => ['Gedung pemerintahan', 'Festival budaya dan acara pariwisata', 'Tempat ibadah', 'Sekolah dasar'], 'ans' => 'Festival budaya dan acara pariwisata', 'exp' => 'Di era modern, Tari Hudoq dipentaskan di festival budaya dan pariwisata untuk memperkenalkan warisan Dayak kepada dunia yang lebih luas.'],
                ['q' => 'Musik Panting berasal dari Suku?', 'opts' => ['Dayak', 'Tidung', 'Kutai', 'Banjar'], 'ans' => 'Banjar', 'exp' => 'Musik Panting adalah kesenian musik tradisional milik Suku Banjar dari Kalimantan Selatan yang juga berkembang di Kalimantan Utara.'],
                ['q' => 'Instrumen utama Musik Panting terbuat dari kayu?', 'opts' => ['Kayu ulin', 'Kayu nangka', 'Kayu meranti', 'Kayu jati'], 'ans' => 'Kayu nangka', 'exp' => 'Alat musik Panting terbuat dari kayu nangka karena resonansinya sangat baik, menghasilkan suara yang khas dan merdu.'],
                ['q' => 'Peran gendang Babun dalam Musik Panting adalah?', 'opts' => ['Instrumen melodi', 'Instrumen harmoni latar', 'Mengatur ritme dan tempo', 'Improvisasi bebas'], 'ans' => 'Mengatur ritme dan tempo', 'exp' => 'Babun (gendang kecil) berperan penting mengatur ritme dan tempo dalam ensambel Musik Panting, menjaga kekompakan permainan.'],
                ['q' => 'Musik Panting paling sering ditampilkan dalam acara?', 'opts' => ['Upacara kematian dan perpisahan', 'Upacara pernikahan dan penyambutan tamu', 'Ritual pertanian', 'Perayaan tahun baru'], 'ans' => 'Upacara pernikahan dan penyambutan tamu', 'exp' => 'Musik Panting secara tradisional dimainkan dalam upacara pernikahan adat Banjar dan penyambutan tamu kehormatan sebagai penghormatan tertinggi.'],
                ['q' => 'Tari Jepen merupakan warisan akulturasi budaya antara?', 'opts' => ['Dayak dan Jawa', 'Melayu dan Arab', 'China dan Melayu', 'India dan Dayak'], 'ans' => 'Melayu dan Arab', 'exp' => 'Tari Jepen merupakan perpaduan budaya Melayu Kalimantan dan pengaruh Arab yang masuk melalui jalur perdagangan dan penyebaran Islam.'],
                ['q' => '"Jepen" berasal dari kata "Japin" yang merupakan istilah untuk?', 'opts' => ['Ritual pertanian kuno', 'Senjata tradisional', 'Jenis tarian Melayu-Arab', 'Alat musik petik'], 'ans' => 'Jenis tarian Melayu-Arab', 'exp' => '"Japin" adalah istilah untuk jenis tarian Melayu-Arab, mencerminkan masuknya pengaruh Arab ke budaya Melayu Kalimantan melalui Islam.'],
                ['q' => 'Alat musik yang mencerminkan pengaruh Arab dalam Tari Jepen adalah?', 'opts' => ['Suling bambu', 'Gamelan bronze', 'Gambus', 'Garantung gong'], 'ans' => 'Gambus', 'exp' => 'Gambus adalah alat musik petik bertangkai panjang berpengaruh Arab yang menjadi salah satu pengiring utama Tari Jepen.'],
                ['q' => 'Tari Jepen pada umumnya dibawakan oleh?', 'opts' => ['Penari laki-laki tunggal', 'Penari perempuan dalam kelompok', 'Pasangan campuran', 'Anak-anak'], 'ans' => 'Penari perempuan dalam kelompok', 'exp' => 'Tari Jepen biasanya dibawakan penari perempuan dalam kelompok dengan gerakan serasi, menggambarkan keanggunan perempuan Kutai.'],
                ['q' => 'Gerakan Tari Hudoq yang paling ikonik meniru?', 'opts' => ['Harimau memangsa', 'Sayap Burung Enggang', 'Ombak lautan', 'Angin ribut'], 'ans' => 'Sayap Burung Enggang', 'exp' => 'Gerakan paling ikonik Tari Hudoq menirukan kibasan sayap Burung Enggang yang lebar dan anggun—simbol kebebasan dan kekuatan spiritual.'],
                ['q' => 'Nilai yang terkandung dalam Tari Jepen bagi masyarakat Kutai adalah?', 'opts' => ['Keberanian dalam perang', 'Kehalusan budi pekerti dan kebersamaan', 'Kekuatan fisik', 'Kecepatan berlari'], 'ans' => 'Kehalusan budi pekerti dan kebersamaan', 'exp' => 'Tari Jepen mengekspresikan kehalusan budi pekerti dan semangat kebersamaan—nilai-nilai inti yang dijunjung tinggi dalam kehidupan sosial Kutai.'],
                ['q' => 'Alat musik Garantung adalah instrumen jenis?', 'opts' => ['Alat musik tiup', 'Alat musik gesek', 'Alat musik perkusi dari logam', 'Alat musik petik'], 'ans' => 'Alat musik perkusi dari logam', 'exp' => 'Garantung adalah instrumen perkusi logam mirip gong yang digunakan dalam ritual-ritual Dayak, termasuk sebagai pengiring Tari Hudoq.'],
                ['q' => 'Ciri khas kostum Tari Jepen adalah penggunaan?', 'opts' => ['Bulu Enggang warna-warni', 'Topeng kayu ukiran', 'Kain bermotif Melayu Kutai berwarna cerah', 'Pakaian serba hitam'], 'ans' => 'Kain bermotif Melayu Kutai berwarna cerah', 'exp' => 'Kain bermotif Melayu Kutai dengan warna cerah dan meriah adalah ciri khas kostum Tari Jepen, mencerminkan kegembiraan budaya Kutai.'],
                ['q' => 'Topeng dalam Tari Hudoq menggambarkan?', 'opts' => ['Binatang buas hutan', 'Wajah roh-roh alam', 'Leluhur yang telah meninggal', 'Dewa matahari'], 'ans' => 'Wajah roh-roh alam', 'exp' => 'Topeng Tari Hudoq menggambarkan wajah roh-roh alam yang dipercaya memiliki kekuatan menjaga dan menyuburkan ladang masyarakat Dayak.'],
                ['q' => 'Keunikan Musik Panting dibandingkan musik tradisional lainnya adalah?', 'opts' => ['Hanya menggunakan satu instrumen', 'Perpaduan melodi pentatonik Melayu dengan ritme lincah', 'Dimainkan saat subuh', 'Menggunakan tangga nada diatonis penuh'], 'ans' => 'Perpaduan melodi pentatonik Melayu dengan ritme lincah', 'exp' => 'Keunikan Musik Panting adalah perpaduan melodi pentatonik Melayu yang indah dengan ritme yang lincah dan dinamis—khas dan mudah dikenali.'],
                ['q' => 'Tari Jepen kini dimasukkan dalam kurikulum sekolah dengan tujuan?', 'opts' => ['Menggantikan tari modern', 'Pelestarian warisan budaya bagi generasi muda', 'Kewajiban ujian nasional', 'Promosi pariwisata internasional'], 'ans' => 'Pelestarian warisan budaya bagi generasi muda', 'exp' => 'Tari Jepen masuk kurikulum sekolah agar generasi muda dapat mempelajari, menghargai, dan melestarikan warisan budaya leluhur Kutai.'],
            ];

            foreach ($questions as $i => $q) {
                $quiz->questions()->create([
                    'question'       => $q['q'],
                    'type'           => 'multiple_choice',
                    'options'        => $q['opts'],
                    'correct_answer' => $q['ans'],
                    'explanation'    => $q['exp'],
                    'order'          => $i + 1,
                ]);
            }
        }
    }

    private function createUAS(): void
    {
        $quiz = Quiz::firstOrCreate(
            ['title' => 'UAS: Seni Budaya Kalimantan Utara', 'quiz_type' => 'uas'],
            [
                'description'         => 'Ujian Akhir Semester mencakup seluruh materi Seni Budaya Kalimantan Utara.',
                'teacher_id'          => 1,
                'material_id'         => null,
                'quiz_type'           => 'uas',
                'passing_score'       => 70,
                'time_limit'          => 45,
                'min_harian_required' => 1,
            ]
        );

        if ($quiz->questions()->count() === 0) {
            $questions = [
                ['q' => 'Berapa jumlah suku utama yang dipelajari dalam media Seni Budaya Kaltara ini?', 'opts' => ['3', '4', '5', '6'], 'ans' => '4', 'exp' => 'Empat suku utama dipelajari: Dayak, Banjar, Kutai, dan Tidung—representasi keberagaman budaya Kalimantan Utara.'],
                ['q' => 'Tari ritual sakral milik Suku Dayak yang dilakukan saat musim tanam padi adalah?', 'opts' => ['Tari Jepen', 'Tari Kancet', 'Tari Hudoq', 'Tari Garay'], 'ans' => 'Tari Hudoq', 'exp' => 'Tari Hudoq adalah ritual sakral Dayak Bahau yang dilaksanakan saat musim tanam padi untuk memohon kesuburan dan perlindungan ladang.'],
                ['q' => 'Musik tradisional petik khas Suku Banjar adalah?', 'opts' => ['Garantung', 'Kecapi Banjar', 'Musik Panting', 'Babun'], 'ans' => 'Musik Panting', 'exp' => 'Musik Panting adalah kesenian musik tradisional khas Suku Banjar, menggunakan alat musik petik bernama Panting sebagai instrumen utama.'],
                ['q' => 'Festival laut khas Suku Tidung di Tarakan adalah?', 'opts' => ['Festival Erau', 'Festival Iraw Tengkayu', 'Festival Gawai', 'Festival Hudoq'], 'ans' => 'Festival Iraw Tengkayu', 'exp' => 'Festival Iraw Tengkayu adalah festival budaya kebanggaan Suku Tidung—perayaan di atas air sebagai bentuk syukur atas rezeki laut.'],
                ['q' => 'Tarian anggun Suku Kutai yang berakar budaya Melayu-Arab adalah?', 'opts' => ['Tari Hudoq', 'Tari Jepen', 'Tari Gantar', 'Tari Garay'], 'ans' => 'Tari Jepen', 'exp' => 'Tari Jepen adalah tarian khas Suku Kutai hasil akulturasi budaya Melayu dan Arab, dibawakan dengan gerakan lembut dan anggun.'],
                ['q' => 'Rumah adat resmi Provinsi Kalimantan Utara bernama?', 'opts' => ['Rumah Lamin', 'Rumah Betang', 'Rumah Baloy', 'Rumah Banjar'], 'ans' => 'Rumah Baloy', 'exp' => 'Rumah Baloy ditetapkan sebagai rumah adat resmi Provinsi Kalimantan Utara, mencerminkan persatuan keempat suku utama dalam satu simbol arsitektur.'],
                ['q' => 'Senjata tradisional ikonik Suku Dayak adalah?', 'opts' => ['Rencong', 'Keris', 'Badik', 'Mandau'], 'ans' => 'Mandau', 'exp' => 'Mandau adalah senjata tradisional ikonik Suku Dayak berupa parang panjang, sekaligus identitas budaya yang dihormati dan dianggap memiliki kekuatan spiritual.'],
                ['q' => 'Kain tradisional Suku Banjar yang dibuat dengan teknik ikat celup adalah?', 'opts' => ['Ulos', 'Lurik', 'Sasirangan', 'Tenun Doyo'], 'ans' => 'Sasirangan', 'exp' => 'Kain Sasirangan khas Banjar dibuat dengan teknik ikat celup—kain dijahit pola tertentu, diikat, dicelup warna, menghasilkan motif yang khas.'],
                ['q' => 'Kuliner khas Tarakan yang merupakan kerupuk ikan Kalimantan adalah?', 'opts' => ['Emping', 'Amplang', 'Kerupuk Udang', 'Opak'], 'ans' => 'Amplang', 'exp' => 'Amplang adalah kerupuk ikan khas Kalimantan dari ikan pipih atau tenggiri—cemilan ikonik yang menjadi oleh-oleh favorit dari Tarakan.'],
                ['q' => 'Tenun yang menggunakan serat tanaman endemik Kalimantan disebut Tenun?', 'opts' => ['Sasirangan', 'Ulap Doyo', 'Gringsing', 'Songket'], 'ans' => 'Ulap Doyo', 'exp' => 'Tenun Ulap Doyo menggunakan serat dari tanaman doyo (Curculigo latifolia), tanaman endemik Kalimantan yang daunnya dipintal menjadi benang tenun.'],
                ['q' => 'Topeng Tari Hudoq menggambarkan?', 'opts' => ['Dewa-dewa langit', 'Wajah roh-roh alam', 'Pahlawan perang', 'Leluhur kerajaan'], 'ans' => 'Wajah roh-roh alam', 'exp' => 'Topeng Tari Hudoq menggambarkan wajah roh-roh alam yang dipercaya memiliki kekuatan menjaga dan menyuburkan ladang masyarakat Dayak.'],
                ['q' => 'Arti nama "Iraw Tengkayu" dalam bahasa Tidung adalah?', 'opts' => ['Laut biru', 'Pesta di atas air', 'Nelayan bersatu', 'Lautan rezeki'], 'ans' => 'Pesta di atas air', 'exp' => '"Iraw Tengkayu" berarti "pesta di atas air"—menggambarkan perayaan di laut sebagai simbol rasa syukur masyarakat Tidung atas rezeki laut.'],
                ['q' => 'Material utama Rumah Baloy yang tahan rayap adalah?', 'opts' => ['Kayu jati', 'Kayu meranti', 'Kayu ulin (besi)', 'Kayu kelapa'], 'ans' => 'Kayu ulin (besi)', 'exp' => 'Kayu ulin (kayu besi) khas Kalimantan sangat tahan rayap dan dapat bertahan ratusan tahun—pilihan ideal untuk bangunan adat Rumah Baloy.'],
                ['q' => 'Burung simbol kemuliaan yang sering muncul dalam motif ukiran Dayak adalah?', 'opts' => ['Merak', 'Elang', 'Enggang (Rangkong)', 'Kakaktua'], 'ans' => 'Enggang (Rangkong)', 'exp' => 'Burung Enggang atau Rangkong adalah simbol kemuliaan, kebebasan, dan keberanian yang paling dihormati di Kalimantan, terutama oleh Suku Dayak.'],
                ['q' => 'Sarung Mandau disebut?', 'opts' => ['Hulu', 'Kumpang', 'Pisau Raut', 'Lamin'], 'ans' => 'Kumpang', 'exp' => 'Kumpang adalah sarung atau wadah Mandau, biasanya terbuat dari kayu yang diukir indah—sekaligus media ekspresi seni ukir Dayak.'],
                ['q' => 'Festival Iraw Tengkayu diselenggarakan setiap?', 'opts' => ['Setiap tahun', 'Setiap 2 tahun', 'Setiap 3 tahun', 'Setiap 5 tahun'], 'ans' => 'Setiap 2 tahun', 'exp' => 'Festival Iraw Tengkayu digelar setiap dua tahun sekali di Tarakan, menjadikannya event budaya yang paling dinantikan masyarakat Kaltara.'],
                ['q' => '"Jepen" berasal dari kata "Japin" yang berarti?', 'opts' => ['Semangat pemuda Melayu', 'Jenis tarian Melayu-Arab', 'Alat musik tradisional', 'Ritual air sungai'], 'ans' => 'Jenis tarian Melayu-Arab', 'exp' => '"Japin" adalah istilah untuk jenis tarian Melayu-Arab, mencerminkan akulturasi budaya Melayu Kalimantan dengan pengaruh Islam dari pedagang Arab.'],
                ['q' => 'Filosofi "Kalimantan Utara Bersatu dalam Keberagaman" tercermin dalam?', 'opts' => ['Festival Iraw Tengkayu', 'Mandau Pusaka', 'Rumah Baloy', 'Tari Hudoq'], 'ans' => 'Rumah Baloy', 'exp' => 'Rumah Baloy mewujudkan filosofi persatuan Kaltara—memadukan unsur arsitektur 4 suku utama (Dayak, Banjar, Kutai, Tidung) dalam satu bangunan.'],
                ['q' => 'Pangan khas yang dipanen saat kepiting baru berganti cangkang adalah?', 'opts' => ['Amplang', 'Kepiting Soka', 'Ikan Pipih', 'Dodol Rumput Laut'], 'ans' => 'Kepiting Soka', 'exp' => 'Kepiting Soka dipanen saat molting (baru berganti cangkang). Saat itu cangkangnya masih lunak sehingga bisa dimakan utuh—keistimewaan khas Tarakan.'],
                ['q' => 'Motif sulur pakis dalam tenun Kaltara melambangkan?', 'opts' => ['Kekuatan perang', 'Pertumbuhan dan kesuburan', 'Duka cita', 'Kematian'], 'ans' => 'Pertumbuhan dan kesuburan', 'exp' => 'Motif sulur pakis melambangkan pertumbuhan, kesuburan, dan kehidupan yang terus berkembang—harapan masyarakat untuk tumbuh selaras dengan alam.'],
                ['q' => 'Teknik pembuatan bilah Mandau menggunakan?', 'opts' => ['Cetakan tuang logam', 'Teknik tempa tradisional', 'Mesin CNC modern', 'Pengecoran baja'], 'ans' => 'Teknik tempa tradisional', 'exp' => 'Bilah Mandau dibuat dengan teknik tempa tradisional—logam dipanaskan dan dipukul berulang oleh pandai besi hingga terbentuk bilah yang kuat.'],
                ['q' => 'Alat musik Babun dalam Musik Panting berfungsi sebagai?', 'opts' => ['Instrumen melodi utama', 'Instrumen harmoni latar', 'Instrumen pengatur ritme', 'Instrumen bass'], 'ans' => 'Instrumen pengatur ritme', 'exp' => 'Babun (gendang kecil) berperan sebagai instrumen pengatur ritme dan tempo dalam ensambel Musik Panting, menjaga kekompakan permainan.'],
                ['q' => 'Tari Jepen dibawakan sebagai ekspresi nilai?', 'opts' => ['Keberanian dalam perang', 'Kehalusan budi pekerti dan kebersamaan', 'Kekuatan magis', 'Duka cita'], 'ans' => 'Kehalusan budi pekerti dan kebersamaan', 'exp' => 'Tari Jepen mengekspresikan kehalusan budi pekerti dan semangat kebersamaan—nilai inti kehidupan sosial masyarakat Kutai yang dijunjung tinggi.'],
                ['q' => 'Ruang utama Rumah Baloy yang digunakan untuk pertemuan adat disebut?', 'opts' => ['Dapur adat', 'Lamin', 'Beranda utama', 'Balai pertemuan'], 'ans' => 'Lamin', 'exp' => 'Lamin adalah aula besar (ruang utama) Rumah Baloy tempat pertemuan adat, musyawarah, dan upacara-upacara penting dilangsungkan.'],
                ['q' => 'Bahan pewarna alami biru pada tenun tradisional berasal dari?', 'opts' => ['Kunyit', 'Indigo', 'Daun pandan', 'Akar kayu'], 'ans' => 'Indigo', 'exp' => 'Tanaman Indigo (Indigofera tinctoria) menghasilkan zat warna biru alami yang tahan lama dan aman lingkungan untuk pewarnaan tenun tradisional.'],
                ['q' => 'Kalimantan Utara menjadi penghasil terbesar komoditas laut berupa?', 'opts' => ['Ikan tuna', 'Udang vaname', 'Rumput laut', 'Kepiting bakau'], 'ans' => 'Rumput laut', 'exp' => 'Kalimantan Utara adalah penghasil rumput laut terbesar Indonesia. Kondisi perairan yang ideal menjadikannya sentra budidaya rumput laut nasional.'],
                ['q' => 'Pengukir ahli dalam tradisi Dayak disebut?', 'opts' => ['Mangkutak', 'Babun', 'Kumpang', 'Lamin'], 'ans' => 'Mangkutak', 'exp' => 'Mangkutak adalah sebutan untuk pengukir ahli dalam tradisi Dayak—profesi yang sangat dihormati karena kemampuan seni ukir bermakna spiritual.'],
                ['q' => 'Tas anyaman rotan bermotif geometris khas Kaltara bernilai tinggi disebut?', 'opts' => ['Tas Doyo', 'Tas Enggang', 'Tas Belida', 'Tas Sugu'], 'ans' => 'Tas Belida', 'exp' => 'Tas Belida adalah tas anyaman rotan bermotif geometris yang bernilai tinggi dari Kaltara. Kerumitan motifnya menjadikannya karya seni premium.'],
                ['q' => 'Motif Naga dalam ukiran Kalimantan bermakna sebagai?', 'opts' => ['Penguasa langit', 'Penjaga alam bawah dan pembawa kemakmuran', 'Dewa perang', 'Roh kesuburan tanaman'], 'ans' => 'Penjaga alam bawah dan pembawa kemakmuran', 'exp' => 'Motif Naga bermakna penjaga alam bawah (laut/sungai) dan pembawa kemakmuran bagi masyarakat yang hidup di sekitar perairan Kalimantan.'],
                ['q' => 'Semua aspek seni budaya Kalimantan Utara pada dasarnya mencerminkan?', 'opts' => ['Kemajuan teknologi modern', 'Hubungan harmonis manusia dengan alam dan nilai luhur leluhur', 'Pengaruh dominan budaya asing', 'Persaingan antarkelompok etnis'], 'ans' => 'Hubungan harmonis manusia dengan alam dan nilai luhur leluhur', 'exp' => 'Seluruh seni budaya Kaltara—tari, musik, arsitektur, kerajinan, kuliner—mencerminkan hubungan harmonis manusia dengan alam dan nilai-nilai luhur yang diwariskan turun-temurun.'],
            ];

            foreach ($questions as $i => $q) {
                $quiz->questions()->create([
                    'question'       => $q['q'],
                    'type'           => 'multiple_choice',
                    'options'        => $q['opts'],
                    'correct_answer' => $q['ans'],
                    'explanation'    => $q['exp'],
                    'order'          => $i + 1,
                ]);
            }
        }
    }
}
