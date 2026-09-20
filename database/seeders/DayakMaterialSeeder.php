<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

/**
 * Seed 5 Dayak learning module materials (pertemuan 2–6).
 * Idempotent: uses firstOrCreate on title+category.
 *
 * Content accuracy notes:
 *  - Specific to Dayak sub-groups in Kalimantan Utara: Kenyah, Kayan, Lundayeh, Punan.
 *  - Facts marked [PERLU VERIFIKASI] indicate uncertain specifics; verify before publishing.
 *  - Sources: BPS Kaltara; Kemendikbud modul ajar; Dewan Adat Dayak Kaltara publications;
 *    academic works on Dayak Kenyah by Whittier (1973), Rousseau (1998);
 *    Balai Pelestarian Nilai Budaya (BPNB) Pontianak/Kaltara field reports;
 *    Wikipedia (id/en) cross-checked with BPNB.
 */
class DayakMaterialSeeder extends Seeder
{
    private int $teacherId = 1; // Bu Sari Guru

    public function run(): void
    {
        $this->createSukuDayak();
        $this->createTradisiAdat();
        $this->createLaguAlmusik();
        $this->createHukumAdat();
        $this->createKesenian();
    }

    // ── Materi 1 — Suku-Suku Dayak di Kalimantan Utara ───────────────────────

    private function createSukuDayak(): void
    {
        Material::firstOrCreate(
            ['title' => 'Suku-Suku Dayak di Kalimantan Utara', 'category' => 'dayak'],
            [
                'slug'            => 'suku-suku-dayak-di-kalimantan-utara',
                'description'     => 'Mengenal sub-suku Dayak yang mendiami wilayah Kalimantan Utara: Kenyah, Kayan, Lundayeh, dan Punan — sebaran wilayah, ciri khas, dan peran mereka dalam kekayaan budaya Kaltara.',
                'kompetensi_dasar'=> '3.2 Memahami keberagaman sub-suku Dayak di Kalimantan Utara, meliputi sebaran wilayah, karakteristik budaya, dan kontribusinya terhadap identitas budaya Kaltara.',
                'pertemuan_ke'    => 3,
                'status'          => 'approved',
                'teacher_id'      => $this->teacherId,
                'content'         => $this->contentSukuDayak(),
            ]
        );
    }

    private function contentSukuDayak(): string
    {
        return <<<'HTML'
<h2>Siapa Suku Dayak Kalimantan Utara?</h2>
<p>Suku Dayak adalah sebutan kolektif untuk rumpun masyarakat adat yang telah mendiami pedalaman Pulau Borneo jauh sebelum masuknya pengaruh Islam dan kolonialisme. Di Kalimantan Utara (Kaltara), komunitas Dayak tersebar terutama di wilayah Malinau, Bulungan, dan Nunukan — dengan keragaman sub-suku yang masing-masing memiliki bahasa, tradisi, dan seni budaya yang khas.</p>
<p>Penting untuk dipahami: "Dayak" bukan satu suku tunggal, melainkan payung untuk ratusan sub-kelompok etnis yang berbeda. Di Kaltara, empat rumpun utama yang dominan adalah:</p>

<h2>Sub-Suku Dayak Utama di Kaltara</h2>

<h3>1. Dayak Kenyah — Penjaga Tradisi Malinau dan Bulungan</h3>
<ul>
  <li>🏡 <strong>Wilayah:</strong> Tersebar luas di Kabupaten Malinau (Long Ampung, Nawang, Long Peso) dan bagian hulu Kabupaten Bulungan.</li>
  <li>🎵 <strong>Identitas kultural:</strong> Dikenal sebagai penjaga seni sape (alat musik petik khas Borneo), tarian Kancet, dan tradisi beadwork (manik-manik) yang rumit.</li>
  <li>👁️ <strong>Ciri fisik budaya:</strong> Secara tradisional kaum perempuan dan kaum bangsawan (Paren) dikenal dengan tradisi telinga panjang menggunakan anting pemberat (hiasan telinga), meski kini sudah jarang dipraktikkan generasi muda.</li>
  <li>🏘️ <strong>Arsitektur:</strong> Mendiami Rumah Lamin — rumah panjang berbentuk panggung yang bisa dihuni 20–30 keluarga sekaligus.</li>
</ul>

<h3>2. Dayak Kayan — Saudara Dekat Kenyah</h3>
<ul>
  <li>🏡 <strong>Wilayah:</strong> Terutama di wilayah hulu Malinau dan sebagian Bulungan. [PERLU VERIFIKASI: nama kampung spesifik Kayan di Kaltara]</li>
  <li>🎨 <strong>Identitas kultural:</strong> Tradisi tato (tempuling) dan ukiran kayu yang kaya ornamen. Bahasa Kayan berbeda dari Kenyah namun keduanya serumpun Austronesia Borneo Tengah.</li>
  <li>🎵 <strong>Musik:</strong> Juga menggunakan sape dan ansambel gong dalam upacara.</li>
</ul>

<h3>3. Dayak Lundayeh (Lun Dayeh / Lun Bawang) — Komunitas Perbatasan</h3>
<ul>
  <li>🏡 <strong>Wilayah:</strong> Kabupaten Nunukan — khususnya Kecamatan Krayan dan Long Bawan yang berbatasan langsung dengan Negeri Sabah, Malaysia.</li>
  <li>🌾 <strong>Identitas kultural:</strong> Masyarakat agraris penghasil beras adan (beras organik Krayan yang terkenal). Sangat menjaga tradisi gotong-royong dan harmoni komunitas.</li>
  <li>🤝 <strong>Lintas batas:</strong> Memiliki hubungan budaya erat dengan Lun Bawang di Sarawak dan Sabah karena secara historis hidup dalam satu wilayah adat sebelum ada batas negara.</li>
  <li>🎶 <strong>Musik:</strong> Menggunakan sape dan gong. [PERLU VERIFIKASI: nama tari/lagu khas Lundayeh Kaltara]</li>
</ul>

<h3>4. Dayak Punan — Penjaga Hutan Pedalaman</h3>
<ul>
  <li>🏡 <strong>Wilayah:</strong> Tersebar di pedalaman Malinau, terutama di daerah hutan hujan yang belum banyak dijangkau jalan darat.</li>
  <li>🌳 <strong>Identitas kultural:</strong> Secara historis adalah masyarakat semi-nomaden yang menggantungkan hidup pada hasil hutan. Kini sebagian besar telah menetap di desa-desa permanent.</li>
  <li>🎨 <strong>Tradisi:</strong> Dikenal dengan keahlian menganyam dan pengetahuan mendalam tentang tanaman hutan untuk pengobatan.</li>
</ul>

<h2>Foto dan Video</h2>
<p>[FOTO: Peta sebaran sub-suku Dayak di Kalimantan Utara]</p>
<p>[FOTO: Rumah Lamin Dayak Kenyah di Malinau]</p>
<p>[VIDEO: Profil komunitas Dayak Kenyah di Long Ampung, Malinau]</p>

<h2>Fakta Penting</h2>
<ul>
  <li>Sensus 2020 mencatat populasi suku Dayak di Kaltara sebagai salah satu kelompok etnis terbesar di Kabupaten Malinau dan Nunukan.</li>
  <li>Dewan Adat Dayak (DAD) Kalimantan Utara adalah lembaga resmi yang menjaga dan mengembangkan adat istiadat Dayak di provinsi ini.</li>
  <li>Banyak istilah "Dayak" di Kaltara sebenarnya merujuk pada kelompok lokal spesifik — seperti "Dayak Kenyah Lepo Tau" atau "Dayak Kenyah Uma Lung" — yang masing-masing memiliki dialek dan tradisi tersendiri.</li>
</ul>
HTML;
    }

    // ── Materi 2 — Tradisi dan Adat Istiadat Dayak ───────────────────────────

    private function createTradisiAdat(): void
    {
        Material::firstOrCreate(
            ['title' => 'Tradisi dan Adat Istiadat Dayak', 'category' => 'dayak'],
            [
                'slug'            => 'tradisi-dan-adat-istiadat-dayak',
                'description'     => 'Mengenal berbagai upacara adat, tradisi kehidupan, dan sistem kepercayaan masyarakat Dayak Kalimantan Utara — dari upacara kelahiran hingga kematian, serta ritual pertanian.',
                'kompetensi_dasar'=> '3.3 Mengidentifikasi dan mengapresiasi ragam tradisi serta adat istiadat suku Dayak Kalimantan Utara sebagai bagian dari warisan budaya nusantara.',
                'pertemuan_ke'    => 4,
                'status'          => 'approved',
                'teacher_id'      => $this->teacherId,
                'content'         => $this->contentTradisiAdat(),
            ]
        );
    }

    private function contentTradisiAdat(): string
    {
        return <<<'HTML'
<h2>Adat Sebagai Pondasi Kehidupan</h2>
<p>Bagi masyarakat Dayak Kalimantan Utara, adat bukan sekadar tradisi turun-temurun — ia adalah sistem hukum, nilai moral, dan panduan spiritual yang mengatur seluruh aspek kehidupan. Kata "adat" sendiri mencakup aturan tak tertulis yang disepakati bersama dan dijaga oleh seluruh komunitas di bawah kepemimpinan <em>kepala adat</em>.</p>

<h2>Sistem Kepercayaan Tradisional</h2>
<p>Sebelum masuknya agama Kristen (yang kini dianut mayoritas Dayak Kenyah, Kayan, dan Lundayeh di Kaltara), masyarakat Dayak menganut kepercayaan animisme yang menghormati roh alam, roh leluhur, dan kekuatan gaib di hutan, sungai, serta tanah.</p>
<ul>
  <li>🌿 <strong>Kepercayaan Terhadap Roh Alam:</strong> Pohon besar, sungai, dan gunung dianggap memiliki penunggu (roh) yang perlu dihormati. Merusak alam tanpa ritual izin bisa mendatangkan bencana.</li>
  <li>👴 <strong>Pemujaan Leluhur:</strong> Roh leluhur yang telah meninggal diyakini tetap melindungi keturunannya. Berbagai upacara ditujukan untuk menjaga hubungan baik dengan mereka.</li>
  <li>⛪ <strong>Konteks Kini:</strong> Mayoritas Dayak Kenyah, Kayan, dan Lundayeh di Kaltara kini memeluk agama Kristen (Protestan dan Katolik), namun banyak tradisi adat tetap dijalankan sebagai warisan budaya, bukan lagi sebagai ritual keagamaan.</li>
</ul>

<h2>Upacara Daur Hidup</h2>

<h3>Kelahiran dan Nama</h3>
<p>Kelahiran anak disambut dengan syukuran dan pemberian nama yang sering mengandung makna harapan atau hubungan dengan leluhur. Pada tradisi Dayak Kenyah, nama juga bisa mencerminkan status sosial keluarga (bangsawan/rakyat biasa). [PERLU VERIFIKASI: nama upacara kelahiran spesifik dalam bahasa Kenyah]</p>

<h3>Pernikahan Adat</h3>
<ul>
  <li>Pernikahan adat Dayak Kenyah melibatkan penyerahan <em>belis</em> atau mas kawin dari pihak laki-laki kepada keluarga perempuan.</li>
  <li>Bentuk mas kawin umumnya berupa gong, tempayan (guci kuno), parang mandau, manik-manik, dan terkadang uang. Jumlahnya disepakati antar-keluarga dalam musyawarah adat.</li>
  <li>Upacara pernikahan biasanya berlangsung beberapa hari dan disertai tarian adat, musik sape, dan pesta makan bersama seluruh komunitas.</li>
  <li>[PERLU VERIFIKASI: nama tahapan pernikahan adat dalam bahasa Kenyah/Lundayeh]</li>
</ul>

<h3>Kematian dan Upacara Pemakaman</h3>
<p>Upacara kematian adalah salah satu upacara terpenting dalam adat Dayak. Prosesnya bisa berlangsung berhari-hari, melibatkan seluruh komunitas, dan memerlukan persiapan yang matang.</p>
<ul>
  <li>Jenazah diperlakukan dengan hormat dan disertai dengan doa, nyanyian, dan tarian ritual.</li>
  <li>Pada tradisi lama, beberapa kelompok Dayak mengenal tradisi penguburan sekunder (tulang dikumpulkan kembali setelah beberapa waktu). [PERLU VERIFIKASI: apakah praktik ini ada pada Dayak Kenyah Kaltara saat ini]</li>
  <li>Kini, dengan masuknya agama Kristen, upacara pemakaman mengintegrasikan doa Kristen dengan prosesi adat.</li>
</ul>

<h2>Tradisi Pertanian dan Panen</h2>
<p>Masyarakat Dayak secara tradisional adalah petani ladang (berladang/huma) dan pemburu-pengumpul. Siklus pertanian diiringi berbagai ritual:</p>
<ul>
  <li>🌱 <strong>Ritual Membuka Ladang:</strong> Sebelum menebas hutan untuk ladang baru, dilakukan doa dan upacara meminta izin kepada roh tanah/hutan.</li>
  <li>🌾 <strong>Pesta Panen (Nalem):</strong> Setelah panen berhasil, seluruh komunitas berkumpul untuk bersyukur bersama. Nalem ditandai dengan musik gong, tarian, dan makan bersama. [PERLU VERIFIKASI: istilah "nalem" dan apakah digunakan oleh semua sub-suku Dayak Kaltara atau spesifik suku tertentu]</li>
  <li>🍚 <strong>Beras Adan (Krayan):</strong> Dayak Lundayeh di Krayan, Nunukan dikenal menghasilkan <em>beras adan</em> — padi organik bersertifikat yang ditanam dengan metode tradisional tanpa pestisida dan kini diakui sebagai produk premium nasional.</li>
</ul>

<h2>Tradisi Tubuh: Tato dan Telinga Panjang</h2>
<ul>
  <li>🎨 <strong>Tato Tradisional (Tutang):</strong> Seni tato adalah bagian dari identitas Dayak Kenyah dan Kayan. Motif tato berbeda antara perempuan dan laki-laki, serta antara kaum bangsawan dan rakyat biasa. Tato dianggap sebagai peta perjalanan hidup seseorang. [PERLU VERIFIKASI: istilah "tutang" — apakah berlaku untuk Kenyah Kaltara atau istilah lain]</li>
  <li>👂 <strong>Telinga Panjang:</strong> Tradisi memanjangkan daun telinga menggunakan pemberat (anting-anting berat dari logam atau manik) pernah menjadi tanda kecantikan dan status sosial wanita Dayak Kenyah dan Kayan. Kini tradisi ini hampir tidak lagi dilanjutkan generasi baru.</li>
</ul>

<h2>Foto dan Video</h2>
<p>[FOTO: Upacara adat pernikahan Dayak Kenyah]</p>
<p>[FOTO: Perempuan Dayak Kenyah dengan tradisi telinga panjang]</p>
<p>[VIDEO: Pesta panen/nalem komunitas Dayak di Malinau]</p>
HTML;
    }

    // ── Materi 3 — Lagu Daerah dan Alat Musik Dayak ──────────────────────────

    private function createLaguAlmusik(): void
    {
        Material::firstOrCreate(
            ['title' => 'Lagu Daerah dan Alat Musik Dayak', 'category' => 'dayak'],
            [
                'slug'            => 'lagu-daerah-dan-alat-musik-dayak',
                'description'     => 'Mengenal sape sebagai alat musik ikonik Dayak Kaltara, ansambel gong, serta lagu-lagu tradisional yang mengiringi kehidupan dan upacara adat masyarakat Dayak.',
                'kompetensi_dasar'=> '3.4 Mengidentifikasi jenis, fungsi, dan nilai estetika alat musik serta lagu tradisional suku Dayak Kalimantan Utara dalam konteks kehidupan sosial dan budaya.',
                'pertemuan_ke'    => 5,
                'status'          => 'approved',
                'teacher_id'      => $this->teacherId,
                'content'         => $this->contentLaguAlmusik(),
            ]
        );
    }

    private function contentLaguAlmusik(): string
    {
        return <<<'HTML'
<h2>Musik dalam Kehidupan Dayak</h2>
<p>Musik bagi masyarakat Dayak Kalimantan Utara bukan sekadar hiburan — ia adalah bahasa yang menyampaikan doa, cerita leluhur, ungkapan cinta, dan semangat komunitas. Setiap upacara adat, dari kelahiran hingga kematian, dari panen hingga perang, diiringi musik yang khas dan bermakna.</p>

<h2>Sape — Alat Musik Ikonik Dayak Borneo</h2>
<p>Sape (juga dieja <em>sape'</em>, <em>sampe</em>, atau <em>sapek</em>) adalah alat musik petik tradisional berbentuk seperti perahu yang dilubangi. Ia adalah instrumen paling dikenal dari budaya Dayak Kenyah dan Dayak Kayan di Kalimantan Utara dan Sarawak, Malaysia.</p>
<ul>
  <li>🎸 <strong>Bentuk:</strong> Dibuat dari satu batang kayu utuh yang diukir dan dilubangi. Panjangnya sekitar 1–1,5 meter. Memiliki 3–4 senar (dawai) dari bahan nilon atau bahan tradisional.</li>
  <li>🌊 <strong>Suara:</strong> Suaranya lembut dan meditatif — sering digambarkan seperti suara angin di hutan atau aliran sungai. Sangat khas dan mudah dikenali.</li>
  <li>🎵 <strong>Fungsi tradisional:</strong> Dimainkan untuk mengiringi tarian Kancet, upacara adat, dan pertemuan sosial. Juga dimainkan sebagai hiburan pribadi di waktu senggang.</li>
  <li>🌍 <strong>Pengakuan dunia:</strong> Sape kini mulai dikenal di dunia internasional. Pemain sape dari Kalimantan (baik Kaltara, Kaltim, maupun Sarawak) telah tampil di berbagai festival dunia. Instrumen ini menjadi simbol identitas Dayak Borneo di panggung global.</li>
  <li>🏛️ <strong>Pengembangan:</strong> Sape juga dikembangkan sebagai instrumen fusion (perpaduan dengan musik modern), memperluas jangkauan pendengarnya kepada generasi muda.</li>
</ul>
<p>[FOTO: Sape dari koleksi budaya Dayak Kenyah Kaltara]</p>
<p>[VIDEO: Demonstrasi bermain sape oleh seniman Dayak Kaltara]</p>

<h2>Gong — Perkusi Sakral Komunitas</h2>
<p>Ansambel gong adalah jantung dari musik upacara Dayak. Gong (dalam berbagai ukuran) dimainkan secara berkelompok untuk menghasilkan irama yang kompleks.</p>
<ul>
  <li>🥁 <strong>Peran dalam upacara:</strong> Gong wajib hadir dalam hampir semua upacara adat besar: pernikahan, kematian, panen, dan penyambutan tamu penting.</li>
  <li>💰 <strong>Nilai gong:</strong> Gong kuno berukuran besar adalah benda pusaka bernilai tinggi dalam keluarga Dayak — sering diwariskan turun-temurun dan digunakan sebagai mas kawin atau pembayaran denda adat.</li>
  <li>[PERLU VERIFIKASI: nama-nama lokal untuk berbagai ukuran gong dalam bahasa Kenyah Kaltara]</li>
</ul>

<h2>Keluri / Keledi — Orkes Mulut dari Bambu dan Labu</h2>
<p>Keluri (atau keledi dalam beberapa dialek) adalah alat musik tiup yang terbuat dari labu kering sebagai resonator, dengan beberapa pipa bambu ditancapkan padanya. Setiap pipa menghasilkan nada yang berbeda. [PERLU VERIFIKASI: apakah "keluri" atau "keledi" adalah istilah yang digunakan di komunitas Dayak Kaltara spesifik, atau apakah ada nama lokal yang berbeda]</p>

<h2>Lagu-Lagu Tradisional Dayak</h2>
<p>Tradisi lisan Dayak kaya dengan nyanyian — dari lagu pengantar tidur hingga nyanyian epik panjang yang menceritakan sejarah suku.</p>
<ul>
  <li>🌙 <strong>Lagu Pengantar Tidur:</strong> Setiap sub-suku memiliki lagu ninabobo dalam bahasa mereka sendiri, yang biasanya bercerita tentang alam, roh pelindung, atau harapan orang tua untuk anak mereka.</li>
  <li>⚔️ <strong>Lagu Perang / Semangat:</strong> Nyanyian yang dulu dilantunkan untuk memberi semangat sebelum berangkat berburu atau berperang. Kini dimaknai sebagai ekspresi keberanian dan solidaritas.</li>
  <li>🎉 <strong>Lagu Pesta:</strong> Dilantunkan bersama-sama dalam pesta adat, sering diiringi gong dan tarian.</li>
  <li>[PERLU VERIFIKASI: judul dan lirik lagu tradisional Dayak Kenyah/Lundayeh/Kayan yang secara spesifik berasal dari Kaltara — mohon konfirmasi dengan guru seni budaya atau narasumber adat setempat sebelum ditambahkan ke materi]</li>
</ul>

<h2>Foto dan Video</h2>
<p>[FOTO: Ansambel gong Dayak dalam upacara adat di Malinau]</p>
<p>[FOTO: Keluri/keledi — alat musik tiup tradisional Dayak]</p>
<p>[VIDEO: Penampilan musik sape dan gong dalam festival budaya Kaltara]</p>

<h2>Pelestarian Musik Dayak</h2>
<p>Pemerintah Provinsi Kalimantan Utara dan berbagai sanggar seni aktif mendokumentasikan dan mengajarkan musik tradisional Dayak. Sape kini masuk dalam kurikulum seni budaya di beberapa sekolah di Malinau dan Bulungan. Festival seperti Pameran Budaya Kaltara rutin menampilkan pertunjukan musik Dayak untuk memperkenalkannya kepada generasi muda.</p>
HTML;
    }

    // ── Materi 4 — Hukum Adat Dayak ──────────────────────────────────────────

    private function createHukumAdat(): void
    {
        Material::firstOrCreate(
            ['title' => 'Hukum Adat Dayak', 'category' => 'dayak'],
            [
                'slug'            => 'hukum-adat-dayak',
                'description'     => 'Memahami sistem hukum adat masyarakat Dayak Kalimantan Utara: lembaga adat, mekanisme penyelesaian sengketa, hak atas tanah adat, dan bentuk denda/sanksi adat.',
                'kompetensi_dasar'=> '3.5 Menganalisis sistem hukum adat suku Dayak Kalimantan Utara sebagai mekanisme pengaturan kehidupan sosial dan perlindungan hak-hak komunitas adat.',
                'pertemuan_ke'    => 6,
                'status'          => 'approved',
                'teacher_id'      => $this->teacherId,
                'content'         => $this->contentHukumAdat(),
            ]
        );
    }

    private function contentHukumAdat(): string
    {
        return <<<'HTML'
<h2>Apa itu Hukum Adat Dayak?</h2>
<p>Hukum adat Dayak adalah sistem aturan tidak tertulis yang telah mengatur kehidupan sosial, ekonomi, dan spiritual masyarakat Dayak selama berabad-abad. Hukum ini bukan sekadar tradisi — ia adalah undang-undang hidup yang mengikat seluruh anggota komunitas dan dijalankan oleh lembaga adat yang berwibawa.</p>
<p>Di Kalimantan Utara, hukum adat Dayak diakui oleh pemerintah daerah sebagai bagian dari sistem hukum plural Indonesia, berdasarkan UU No. 41/1999 tentang Kehutanan dan berbagai peraturan daerah tentang pengakuan masyarakat adat.</p>

<h2>Lembaga Adat Dayak di Kaltara</h2>
<ul>
  <li>🏛️ <strong>Dewan Adat Dayak (DAD) Kalimantan Utara:</strong> Lembaga formal tertinggi yang mewakili masyarakat Dayak Kaltara secara keseluruhan. Berperan dalam advokasi hak adat, penyelesaian konflik antar-komunitas, dan pelestarian budaya.</li>
  <li>👴 <strong>Kepala Adat (Pemimpin Adat Kampung):</strong> Di tingkat kampung, kepala adat adalah figur sentral. Ia memimpin sidang adat, memutuskan sengketa, dan menjaga warisan tradisi. Jabatan ini bisa dipilih komunitas atau diwariskan secara turun-temurun, tergantung tradisi sub-suku.</li>
  <li>🤝 <strong>Majelis/Musyawarah Adat:</strong> Setiap sengketa diselesaikan melalui musyawarah terbuka yang melibatkan para tetua, kepala adat, dan pihak-pihak yang bersengketa. Asas mufakat sangat dijunjung tinggi.</li>
</ul>

<h2>Hak atas Tanah Adat</h2>
<p>Salah satu aspek paling penting dari hukum adat Dayak adalah pengakuan terhadap <em>wilayah adat</em> — tanah, hutan, dan sungai yang secara turun-temurun dikelola oleh komunitas.</p>
<ul>
  <li>🌳 <strong>Konsep Wilayah Adat:</strong> Komunitas Dayak tidak mengenal "kepemilikan tanah individual" dalam pengertian modern. Tanah dimiliki secara komunal — ada yang bisa dikelola keluarga tertentu (ladang/kebun), namun hutannya milik bersama untuk berburu, mengambil kayu, dan sumber air.</li>
  <li>📜 <strong>Hutan Adat:</strong> Beberapa komunitas Dayak di Kaltara, khususnya di Malinau, telah berhasil mendapatkan pengakuan hukum atas hutan adat mereka melalui peraturan daerah dan putusan pengadilan.</li>
  <li>⚠️ <strong>Tantangan:</strong> Ekspansi perkebunan kelapa sawit dan pertambangan telah menimbulkan konflik dengan hak-hak adat Dayak di berbagai wilayah Kalimantan, termasuk Kaltara. DAD berperan aktif dalam negosiasi dan advokasi.</li>
</ul>

<h2>Mekanisme Penyelesaian Sengketa</h2>
<p>Hukum adat Dayak mengutamakan <strong>perdamaian</strong> dan <strong>pemulihan harmoni sosial</strong> — bukan hukuman semata. Proses penyelesaiannya:</p>
<ol>
  <li><strong>Laporan kepada kepala adat</strong> — Pihak yang merasa dirugikan melaporkan masalahnya.</li>
  <li><strong>Musyawarah adat</strong> — Kedua belah pihak dan saksi-saksi dikumpulkan. Proses ini bisa berlangsung beberapa hari untuk kasus berat.</li>
  <li><strong>Keputusan adat</strong> — Kepala adat memutuskan siapa yang bersalah dan apa dendanya.</li>
  <li><strong>Pembayaran denda</strong> — Pihak yang bersalah membayar denda dalam bentuk barang atau uang.</li>
  <li><strong>Ritual pemulihan</strong> — Dalam beberapa kasus, dilakukan ritual bersama untuk memulihkan hubungan antara pihak yang bersengketa.</li>
</ol>

<h2>Bentuk Denda dan Sanksi Adat</h2>
<p>Denda adat Dayak tidak berbentuk penjara, melainkan penyerahan barang berharga kepada pihak yang dirugikan dan/atau kepada komunitas:</p>
<ul>
  <li>🐷 <strong>Babi:</strong> Denda paling umum dalam adat Dayak. Jumlah dan ukuran babi disesuaikan dengan berat pelanggaran.</li>
  <li>🥁 <strong>Gong:</strong> Gong kuno bernilai tinggi digunakan sebagai denda untuk pelanggaran berat, termasuk sengketa tanah atau pelanggaran dalam pernikahan.</li>
  <li>🏺 <strong>Tempayan (Guci Kuno):</strong> Tempayan porselen kuno warisan leluhur juga menjadi alat pembayaran denda bergengsi.</li>
  <li>💵 <strong>Uang:</strong> Di era modern, denda adat sering dikonversikan ke nilai uang atas kesepakatan kedua pihak.</li>
  <li>[PERLU VERIFIKASI: tarif denda adat spesifik (misalnya berapa babi untuk jenis pelanggaran tertentu) yang berlaku di komunitas Dayak Kenyah Kaltara saat ini — setiap kampung bisa berbeda]</li>
</ul>

<h2>Foto dan Video</h2>
<p>[FOTO: Sidang/musyawarah adat Dayak Kenyah di Malinau]</p>
<p>[FOTO: Gong dan tempayan sebagai benda pusaka bernilai tinggi dalam adat Dayak]</p>
<p>[VIDEO: Penjelasan Kepala Adat tentang sistem hukum adat Dayak Kaltara]</p>

<h2>Relevansi Hukum Adat di Era Modern</h2>
<p>Di tengah dinamika modernisasi, hukum adat Dayak terbukti relevan dan adaptif. Banyak kasus sengketa — terutama tentang tanah dan sumber daya alam — diselesaikan lebih cepat dan damai melalui jalur adat dibandingkan jalur pengadilan formal. Pemerintah pusat pun semakin mengakui pentingnya integrasi hukum adat dalam sistem hukum nasional Indonesia.</p>
HTML;
    }

    // ── Materi 5 — Kesenian Dayak ─────────────────────────────────────────────

    private function createKesenian(): void
    {
        Material::firstOrCreate(
            ['title' => 'Kesenian Dayak: Tari, Motif, dan Rumah Adat', 'category' => 'dayak'],
            [
                'slug'            => 'kesenian-dayak-tari-motif-dan-rumah-adat',
                'description'     => 'Eksplorasi kesenian Dayak Kalimantan Utara: tarian tradisional Kancet, kekayaan motif ukiran (aso, enggang), keindahan manik-manik, dan arsitektur Rumah Lamin yang monumental.',
                'kompetensi_dasar'=> '3.6 Mengapresiasi dan menganalisis nilai estetika serta makna simbolik dalam kesenian Dayak Kalimantan Utara — mencakup seni tari, motif dekoratif, dan arsitektur tradisional.',
                'pertemuan_ke'    => 7,
                'status'          => 'approved',
                'teacher_id'      => $this->teacherId,
                'content'         => $this->contentKesenian(),
            ]
        );
    }

    private function contentKesenian(): string
    {
        return <<<'HTML'
<h2>Kesenian sebagai Identitas dan Doa</h2>
<p>Kesenian Dayak Kalimantan Utara lahir bukan dari hasrat dekoratif semata, melainkan dari kebutuhan spiritual dan sosial yang mendalam. Setiap gerakan tari, setiap motif ukiran, dan setiap tiang Rumah Lamin menyimpan pesan tentang hubungan manusia dengan leluhur, alam, dan semesta.</p>

<h2>Tari Tradisional Dayak Kenyah</h2>
<p>Dayak Kenyah — kelompok Dayak terbesar di Kaltara — memiliki tradisi tari yang sangat kaya. Tarian mereka secara umum disebut <em>Kancet</em>, dengan berbagai ragam yang masing-masing memiliki konteks dan makna berbeda.</p>

<h3>Kancet Ledo (Tari Gong)</h3>
<ul>
  <li>💃 <strong>Jenis:</strong> Tari solo perempuan.</li>
  <li>🎵 <strong>Properti:</strong> Penari berdiri di atas atau berputar mengelilingi gong besar sambil menari dengan gerakan lembut dan anggun.</li>
  <li>🌸 <strong>Makna:</strong> Melambangkan keanggunan, kelemah-lembutan, dan kebanggaan wanita Dayak Kenyah. Gerakan tangan yang meliuk mengimitasi burung Enggang yang sedang terbang.</li>
  <li>[PERLU VERIFIKASI: apakah "Kancet Ledo" adalah nama yang digunakan di Kaltara secara spesifik, atau ada variasi nama lokal]</li>
</ul>

<h3>Kancet Punan Lettu</h3>
<ul>
  <li>👥 <strong>Jenis:</strong> Tari kelompok (laki-laki).</li>
  <li>⚔️ <strong>Makna:</strong> Menggambarkan ketangkasan dan keberanian pria Dayak — terkait tradisi berburu dan semangat melindungi komunitas.</li>
  <li>🪶 <strong>Kostum:</strong> Penari laki-laki mengenakan baju adat, ikat kepala berhias bulu burung Enggang, dan membawa perisai (keliau) serta tombak atau mandau.</li>
  <li>[PERLU VERIFIKASI: nama lengkap dan sub-varian tarian ini di Kaltara — mohon konfirmasi dengan sanggar seni Dayak setempat]</li>
</ul>

<h3>Tari Datun Julut</h3>
<ul>
  <li>👥 <strong>Jenis:</strong> Tari massal perempuan, bisa diikuti ratusan penari.</li>
  <li>🎊 <strong>Konteks:</strong> Ditampilkan dalam perayaan besar: menyambut tamu terhormat, pesta panen, atau festival budaya.</li>
  <li>✨ <strong>Keistimewaan:</strong> Koreografi yang serasi meski melibatkan banyak penari, dengan gerakan tangan bergelombang yang terkoordinasi indah.</li>
  <li>[PERLU VERIFIKASI: apakah Datun Julut umum di komunitas Dayak Kenyah Kaltara atau lebih spesifik Kenyah Sarawak]</li>
</ul>

<p>[FOTO: Penari Kancet Ledo dalam kostum adat lengkap dengan hiasan bulu Enggang]</p>
<p>[VIDEO: Penampilan Tari Datun Julut dalam Festival Budaya Kaltara]</p>

<h2>Motif Seni Dayak: Bahasa Visual Leluhur</h2>
<p>Motif-motif Dayak bukan sekadar ornamen — setiap bentuk dan warna memiliki makna filosofis yang dalam, berfungsi sebagai doa, penanda status, atau perlindungan spiritual.</p>

<h3>Motif Aso (Anjing/Naga)</h3>
<ul>
  <li>🐉 <strong>Bentuk:</strong> Makhluk hibrida menyerupai gabungan anjing dan naga dengan corak melingkar-liuk yang dinamis.</li>
  <li>🛡️ <strong>Makna:</strong> Penjaga dan pelindung. Motif aso ditemukan di hampir semua media seni Dayak Kenyah: ukiran tiang rumah, desain beadwork, tato, dan kain tenun.</li>
  <li>🔵 <strong>Warna khas:</strong> Biru, hitam, merah, dan putih adalah warna tradisional yang digunakan dalam motif Dayak.</li>
</ul>

<h3>Motif Burung Enggang (Rhinoceros Hornbill)</h3>
<ul>
  <li>🦅 <strong>Status:</strong> Burung Enggang adalah burung paling sakral dalam kosmologi Dayak — melambangkan roh leluhur, kemuliaan, dan hubungan antara dunia manusia dan dunia atas (langit).</li>
  <li>👑 <strong>Penggunaan:</strong> Bulu dan paruh Enggang (atau tiruannya) menghiasi topi adat bangsawan (Selong), tiang ukiran, dan digunakan dalam upacara paling penting.</li>
  <li>🌿 <strong>Saat ini:</strong> Karena Enggang dilindungi hukum, tiruannya dari kayu atau plastik kini menggantikan bulu asli dalam seni modern.</li>
</ul>

<h3>Motif Sulur dan Paku Pakis</h3>
<ul>
  <li>Motif sulur tanaman yang melingkar-liuk melambangkan kesinambungan hidup, pertumbuhan, dan hubungan manusia dengan alam hutan.</li>
  <li>Motif ini sangat umum dalam anyaman, ukiran, dan beadwork Dayak.</li>
</ul>

<h2>Seni Manik-Manik (Beadwork)</h2>
<p>Manik-manik adalah keahlian yang sangat dikuasai wanita Dayak Kenyah. Rangkaian manik kaca warna-warni dibuat menjadi ikat kepala, baju, gelang, kalung, dan hiasan pelana.</p>
<ul>
  <li>🔵 <strong>Asal manik:</strong> Secara historis, manik-manik diimpor dari Cina dan Eropa melalui jalur perdagangan. Manik kuno yang langka kini menjadi benda koleksi bernilai sangat tinggi.</li>
  <li>🎨 <strong>Motif:</strong> Pola manik-manik menampilkan motif aso, enggang, bunga, dan geometri yang simetris sempurna.</li>
  <li>⏱️ <strong>Proses:</strong> Satu helai baju manik penuh bisa memakan waktu berbulan-bulan untuk diselesaikan — sebuah bentuk meditasi dan dedikasi.</li>
</ul>
<p>[FOTO: Baju adat Dayak Kenyah berhias manik-manik]</p>

<h2>Rumah Lamin — Longhouse Dayak</h2>
<p>Rumah Lamin (atau Uma Daru dalam beberapa dialek Kenyah) adalah rumah panjang komunal tradisional yang menjadi simbol persatuan komunitas Dayak Kenyah.</p>
<ul>
  <li>📏 <strong>Ukuran:</strong> Panjangnya bisa mencapai 50–300 meter, cukup untuk menampung puluhan keluarga dalam satu atap.</li>
  <li>🏠 <strong>Struktur:</strong> Dibangun di atas tiang-tiang kayu setinggi 1,5–3 meter dari tanah (rumah panggung). Terdiri dari serambi panjang (teras bersama), kamar-kamar keluarga di sepanjang koridor, dan dapur di belakang.</li>
  <li>🎨 <strong>Dekorasi:</strong> Dinding luar dan tiang-tiang dihiasi dengan ukiran motif aso, enggang, dan sulur dalam warna-warna cerah. Di era modern, mural besar menggantikan ukiran tradisional di beberapa lamin.</li>
  <li>🤝 <strong>Fungsi sosial:</strong> Lamin bukan hanya tempat tinggal, melainkan pusat kehidupan komunitas — tempat musyawarah, upacara adat, dan kegiatan bersama.</li>
  <li>🏛️ <strong>Lamin Adat modern:</strong> Di banyak kota di Kaltara, dibangun Lamin Adat sebagai ruang kebudayaan yang berfungsi untuk upacara dan kegiatan pelestarian budaya, meski warganya sudah tinggal di rumah modern.</li>
</ul>
<p>[FOTO: Eksterior Rumah Lamin Dayak Kenyah dengan ukiran dan ornamen khas]</p>
<p>[FOTO: Interior serambi Rumah Lamin — ruang bersama komunitas]</p>
<p>[VIDEO: Tur virtual Rumah Lamin Adat di Kalimantan Utara]</p>

<h2>Pelestarian Kesenian Dayak</h2>
<p>Sanggar-sanggar seni Dayak di Malinau, Bulungan, dan Tarakan aktif melatih generasi muda dalam tari, musik, dan kerajinan tradisional. Festival Budaya Kaltara yang digelar rutin menjadi ajang penting untuk menampilkan dan memperkenalkan kekayaan seni Dayak kepada masyarakat luas dan wisatawan.</p>
HTML;
    }
}
