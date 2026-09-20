# UML Diagrams — Kaltara Budaya

Semua diagram menggunakan **Mermaid** syntax.
Render di: VS Code (ext. Mermaid Preview), GitHub, Notion, draw.io (import), atau https://mermaid.live

---

## 1. Use Case Diagram

```mermaid
flowchart LR
    %% Actors
    GUEST(["👤 Tamu\n(Guest)"])
    STUDENT(["🎓 Siswa\n(Student)"])
    TEACHER(["📚 Guru\n(Teacher)"])
    SYSTEM(["⚙️ Sistem\n(System)"])

    %% Guest use cases
    subgraph UC_GUEST ["Use Cases — Tamu"]
        UC1["Lihat Landing Page"]
        UC2["Daftar Akun\n(pilih role: Siswa/Guru)"]
        UC3["Masuk / Login"]
    end

    %% Student use cases
    subgraph UC_STUDENT ["Use Cases — Siswa"]
        UC4["Lihat Dashboard\n(XP, streak, badge, history)"]
        UC5["Jelajahi Daftar Materi"]
        UC6["Baca Materi"]
        UC7["Tandai Materi Selesai\n(+30 XP)"]
        UC8["Lihat Daftar Quiz"]
        UC9["Kerjakan Quiz"]
        UC10["Lihat Hasil Quiz"]
        UC11["Main Game: Cocokkan Motif"]
        UC12["Main Game: Tebak Tarian"]
        UC13["Edit Profil"]
    end

    %% Teacher use cases
    subgraph UC_TEACHER ["Use Cases — Guru"]
        UC14["Lihat Dashboard Guru\n(statistik siswa)"]
        UC15["Kelola Materi (CRUD)"]
        UC16["Kelola Quiz (CRUD)"]
        UC17["Tambah / Hapus Soal"]
        UC18["Lihat Daftar Siswa"]
        UC19["Lihat Detail Skor Siswa"]
    end

    %% System use cases
    subgraph UC_SYSTEM ["Proses Otomatis — Sistem"]
        UC20["Beri XP ke Siswa"]
        UC21["Beri Badge ke Siswa"]
        UC22["Update Streak Harian"]
        UC23["Redirect by Role\n(student → /dashboard\nguuru → /teacher/dashboard)"]
    end

    %% Guest relationships
    GUEST --> UC1
    GUEST --> UC2
    GUEST --> UC3

    %% Student relationships (extends UC3)
    STUDENT --> UC4
    STUDENT --> UC5
    STUDENT --> UC6
    STUDENT --> UC7
    STUDENT --> UC8
    STUDENT --> UC9
    STUDENT --> UC10
    STUDENT --> UC11
    STUDENT --> UC12
    STUDENT --> UC13

    %% Teacher relationships (extends UC3)
    TEACHER --> UC14
    TEACHER --> UC15
    TEACHER --> UC16
    TEACHER --> UC17
    TEACHER --> UC18
    TEACHER --> UC19
    TEACHER --> UC13

    %% System triggers
    UC7 --> UC20
    UC9 --> UC20
    UC20 --> UC21
    UC7 --> UC22
    UC3 --> UC23
```

---

## 2. Class Diagram

```mermaid
classDiagram
    direction TB

    class User {
        +int id
        +string name
        +string email
        +string password
        +enum role = student|teacher
        +int xp = 0
        +int streak = 0
        +timestamp last_activity_at
        +string avatar
        +timestamp email_verified_at
        +timestamps()
        +isTeacher() bool
        +isStudent() bool
    }

    class Material {
        +int id
        +string title
        +string slug
        +text description
        +longText content
        +string image
        +string video_url
        +enum category = dayak|banjar|kutai|tidung
        +int teacher_id FK
        +timestamps()
        +getCategoryLabelAttribute() string
        +getCategoryColorAttribute() string
    }

    class Quiz {
        +int id
        +string title
        +text description
        +int material_id FK
        +int teacher_id FK
        +timestamps()
    }

    class Question {
        +int id
        +int quiz_id FK
        +text question
        +enum type = multiple_choice|true_false
        +json options
        +string correct_answer
        +int order = 0
        +timestamps()
    }

    class QuizResult {
        +int id
        +int user_id FK
        +int quiz_id FK
        +int score
        +int total_questions
        +timestamp completed_at
        +timestamps()
        +getPercentageAttribute() float
        +getGradeAttribute() string
    }

    class MaterialProgress {
        +int id
        +int user_id FK
        +int material_id FK
        +timestamp completed_at
        +timestamps()
        +isCompleted() bool
    }

    class Badge {
        +int id
        +string name
        +text description
        +string icon
        +json criteria
        +timestamps()
    }

    class UserBadge {
        +int id
        +int user_id FK
        +int badge_id FK
        +timestamp earned_at
        +timestamps()
    }

    %% Relationships
    User "1" --> "0..*" Material       : creates (teacher)
    User "1" --> "0..*" Quiz           : creates (teacher)
    User "1" --> "0..*" QuizResult     : has
    User "1" --> "0..*" MaterialProgress : tracks
    User "1" --> "0..*" UserBadge      : earns

    Material "1" --> "0..*" Quiz       : has
    Material "1" --> "0..*" MaterialProgress : tracked by

    Quiz "1" --> "1..*" Question       : contains
    Quiz "1" --> "0..*" QuizResult     : produces

    Badge "1" --> "0..*" UserBadge     : awarded via
```

---

## 3. Entity Relationship Diagram (ERD)

```mermaid
erDiagram
    USERS {
        bigint id PK
        varchar name
        varchar email UK
        varchar password
        enum role "student|teacher"
        int xp
        int streak
        timestamp last_activity_at
        varchar avatar
        timestamp email_verified_at
        timestamp created_at
        timestamp updated_at
    }

    MATERIALS {
        bigint id PK
        varchar title
        varchar slug UK
        text description
        longtext content
        varchar image
        varchar video_url
        enum category "dayak|banjar|kutai|tidung"
        bigint teacher_id FK
        timestamp created_at
        timestamp updated_at
    }

    QUIZZES {
        bigint id PK
        varchar title
        text description
        bigint material_id FK
        bigint teacher_id FK
        timestamp created_at
        timestamp updated_at
    }

    QUESTIONS {
        bigint id PK
        bigint quiz_id FK
        text question
        enum type "multiple_choice|true_false"
        json options
        varchar correct_answer
        int order
        timestamp created_at
        timestamp updated_at
    }

    QUIZ_RESULTS {
        bigint id PK
        bigint user_id FK
        bigint quiz_id FK
        int score
        int total_questions
        timestamp completed_at
        timestamp created_at
        timestamp updated_at
    }

    MATERIAL_PROGRESS {
        bigint id PK
        bigint user_id FK
        bigint material_id FK
        timestamp completed_at
        timestamp created_at
        timestamp updated_at
    }

    BADGES {
        bigint id PK
        varchar name
        text description
        varchar icon
        json criteria
        timestamp created_at
        timestamp updated_at
    }

    USER_BADGES {
        bigint id PK
        bigint user_id FK
        bigint badge_id FK
        timestamp earned_at
        timestamp created_at
        timestamp updated_at
    }

    USERS         ||--o{ MATERIALS       : "membuat (guru)"
    USERS         ||--o{ QUIZZES         : "membuat (guru)"
    USERS         ||--o{ QUIZ_RESULTS    : "mengerjakan"
    USERS         ||--o{ MATERIAL_PROGRESS : "membaca"
    USERS         ||--o{ USER_BADGES     : "mendapat"
    MATERIALS     ||--o{ QUIZZES         : "memiliki"
    MATERIALS     ||--o{ MATERIAL_PROGRESS : "dilacak"
    QUIZZES       ||--o{ QUESTIONS       : "berisi"
    QUIZZES       ||--o{ QUIZ_RESULTS    : "menghasilkan"
    BADGES        ||--o{ USER_BADGES     : "diberikan"
```

---

## 4. User Flow — Tamu (Guest)

```mermaid
flowchart TD
    START([🌐 Buka Website]) --> LP[Halaman Landing Page]

    LP --> LP1[Lihat Hero Section]
    LP1 --> LP2[Scroll: Lihat 4 Suku Budaya]
    LP2 --> LP3[Scroll: Lihat Fitur Platform]
    LP3 --> LP4[Scroll: Lihat Gamifikasi / Badge]
    LP4 --> LP5[Lihat CTA Daftar]

    LP5 --> CHOICE{Pilihan User}

    CHOICE -->|Klik 'Daftar Sekarang'| REG[Halaman Register\n/register]
    CHOICE -->|Klik 'Masuk'| LGN[Halaman Login\n/login]
    CHOICE -->|Sudah login| DASH[Redirect ke Dashboard]

    REG --> REG1[Isi Nama, Email, Password]
    REG1 --> REG2[Pilih Role:\n🎓 Siswa  atau  📚 Guru]
    REG2 --> REG3{Validasi}
    REG3 -->|Gagal| REG4[Tampil Error Validasi]
    REG4 --> REG1
    REG3 -->|Berhasil| REG5[Akun Dibuat + Auto Login]
    REG5 --> REDIRECT

    LGN --> LGN1[Isi Email & Password]
    LGN1 --> LGN2{Autentikasi}
    LGN2 -->|Gagal| LGN3[Tampil Error: Email/password salah]
    LGN3 --> LGN1
    LGN2 -->|Berhasil| REDIRECT

    REDIRECT{Cek Role User}
    REDIRECT -->|role = student| STUDENT_DASH[/dashboard\nDashboard Siswa]
    REDIRECT -->|role = teacher| TEACHER_DASH[/teacher/dashboard\nDashboard Guru]
```

---

## 5. User Flow — Siswa (Student)

```mermaid
flowchart TD
    ENTRY([✅ Login sebagai Siswa]) --> DASH

    DASH[Dashboard Siswa\n/dashboard]
    DASH --> DASH1[Lihat XP, Streak, Badge]
    DASH --> DASH2[Lihat Hasil Quiz Terbaru]
    DASH --> DASH3[Lihat Rekomendasi Materi]

    DASH --> NAV{Pilih Menu}

    NAV -->|📖 Materi| MAT_INDEX[Daftar Materi\n/materials]
    NAV -->|🧠 Quiz| QUIZ_INDEX[Daftar Quiz\n/quizzes]
    NAV -->|🎮 Mini Game| GAME_MENU[Pilih Game]
    NAV -->|Profil| PROFILE[Edit Profil\n/profile]
    NAV -->|Logout| LOGOUT([🚪 Keluar])

    %% ── MATERI FLOW ──
    MAT_INDEX --> MAT_FILTER[Filter Suku:\nSemua / Dayak / Banjar / Kutai / Tidung]
    MAT_FILTER --> MAT_CARD[Klik Card Materi]
    MAT_CARD --> MAT_SHOW[Detail Materi\n/materials/{slug}]
    MAT_SHOW --> MAT_READ[Baca Konten Materi]
    MAT_READ --> MAT_VIDEO{Ada Video?}
    MAT_VIDEO -->|Ya| MAT_WATCH[Tonton Video Embed]
    MAT_VIDEO -->|Tidak| MAT_STATUS
    MAT_WATCH --> MAT_STATUS

    MAT_STATUS{Sudah Selesai?}
    MAT_STATUS -->|Sudah| MAT_DONE[Tampil: ✓ Sudah Selesai]
    MAT_STATUS -->|Belum| MAT_BTN[Klik 'Tandai Selesai +30 XP']
    MAT_BTN --> MAT_COMPLETE[POST /materials/{slug}/complete]
    MAT_COMPLETE --> MAT_XP[+30 XP diberikan\nStreak diupdate\nBadge dicek]
    MAT_XP --> MAT_DONE
    MAT_DONE --> MAT_QUIZ{Ada Quiz Terkait?}
    MAT_QUIZ -->|Ya| MAT_QUIZ_LINK[Klik Quiz Terkait →]
    MAT_QUIZ_LINK --> QUIZ_TAKE
    MAT_QUIZ -->|Tidak| MAT_INDEX

    %% ── QUIZ FLOW ──
    QUIZ_INDEX --> QUIZ_CARD[Lihat Quiz + Skor Terbaik]
    QUIZ_CARD --> QUIZ_BTN[Klik 'Mulai Quiz' / 'Coba Lagi']
    QUIZ_BTN --> QUIZ_TAKE[Halaman Kerjakan Quiz\n/quizzes/{id}/take]
    QUIZ_TAKE --> QUIZ_Q[Baca Soal Satu per Satu\n(navigasi prev/next)]
    QUIZ_Q --> QUIZ_ANSWER[Pilih Jawaban\n(auto-next setelah pilih)]
    QUIZ_ANSWER --> QUIZ_MORE{Masih Ada Soal?}
    QUIZ_MORE -->|Ya| QUIZ_Q
    QUIZ_MORE -->|Soal Terakhir| QUIZ_SUBMIT[Klik 'Kumpulkan Jawaban']
    QUIZ_SUBMIT --> QUIZ_VALIDATE{Semua Dijawab?}
    QUIZ_VALIDATE -->|Belum semua\n(konfirmasi)| QUIZ_CONFIRM[Konfirmasi Browser]
    QUIZ_CONFIRM -->|Cancel| QUIZ_Q
    QUIZ_CONFIRM -->|OK| QUIZ_PROCESS
    QUIZ_VALIDATE -->|Semua dijawab| QUIZ_PROCESS

    QUIZ_PROCESS[POST /quizzes/{id}/submit\nHitung skor + simpan result]
    QUIZ_PROCESS --> QUIZ_XP[+5 XP per jawaban benar\nBadge dicek]
    QUIZ_XP --> QUIZ_RESULT[Halaman Hasil Quiz\n/quizzes/{id}/result/{result}]
    QUIZ_RESULT --> QUIZ_GRADE[Lihat Grade A-E & Persentase]
    QUIZ_RESULT --> QUIZ_DETAIL[Lihat Jawaban Benar Tiap Soal]
    QUIZ_RESULT --> QUIZ_ACTION{Pilihan}
    QUIZ_ACTION -->|Coba Lagi| QUIZ_TAKE
    QUIZ_ACTION -->|Kembali ke Quiz List| QUIZ_INDEX
    QUIZ_ACTION -->|Dashboard| DASH

    %% ── GAME FLOW ──
    GAME_MENU --> GAME1[Game 1: Cocokkan Motif\n/games/matching]
    GAME_MENU --> GAME2[Game 2: Tebak Tarian\n/games/guess-dance]

    GAME1 --> G1_PLAY[Klik Motif → Klik Nama Suku]
    G1_PLAY --> G1_MATCH{Cocok?}
    G1_MATCH -->|✓ Benar| G1_GREEN[Feedback Hijau + Toast]
    G1_MATCH -->|✗ Salah| G1_RED[Feedback Merah + Toast]
    G1_GREEN --> G1_MORE{Semua 4 Pasang Selesai?}
    G1_RED --> G1_MORE
    G1_MORE -->|Belum| G1_PLAY
    G1_MORE -->|Ya| G1_RESULT[Tampil Skor & Opsi: Main Lagi / Game 2]

    GAME2 --> G2_QUESTION[Lihat Gambar + Petunjuk Tarian]
    G2_QUESTION --> G2_ANSWER[Klik Jawaban Suku]
    G2_ANSWER --> G2_CORRECT{Benar?}
    G2_CORRECT -->|Ya| G2_SCORE[+1 Skor]
    G2_CORRECT -->|Tidak| G2_EXPLAIN[Tampil Penjelasan]
    G2_SCORE --> G2_NEXT{Soal Berikutnya?}
    G2_EXPLAIN --> G2_NEXT
    G2_NEXT -->|Ada| G2_QUESTION
    G2_NEXT -->|Habis| G2_RESULT[Layar Hasil: Skor/5 & Rating]
    G2_RESULT --> G2_ACTION{Aksi}
    G2_ACTION -->|Main Lagi| G2_QUESTION
    G2_ACTION -->|Game 1| GAME1
    G2_ACTION -->|Dashboard| DASH
```

---

## 6. User Flow — Guru (Teacher)

```mermaid
flowchart TD
    ENTRY([✅ Login sebagai Guru]) --> TDASH

    TDASH[Dashboard Guru\n/teacher/dashboard]
    TDASH --> STATS[Lihat Statistik:\nTotal Siswa, Materi, Quiz, Avg Skor]
    TDASH --> RECENT[Lihat Pengerjaan Quiz Terbaru]
    TDASH --> LATEST[Lihat Materi Terbaru]

    TDASH --> TNAV{Pilih Menu}
    TNAV -->|📖 Materi Saya| TMAT_INDEX[Daftar Materi Saya\n/teacher/materials]
    TNAV -->|🧠 Quiz Saya| TQUIZ_INDEX[Daftar Quiz Saya\n/teacher/quizzes]
    TNAV -->|👥 Data Siswa| TSTUDENT_INDEX[Daftar Siswa\n/teacher/students]
    TNAV -->|Profil| TPROFILE[Edit Profil\n/profile]
    TNAV -->|Logout| TLOGOUT([🚪 Keluar])

    %% ── MATERI CRUD ──
    TMAT_INDEX --> TMAT_TABLE[Lihat Tabel Materi\n(Judul, Kategori, Aksi)]
    TMAT_TABLE --> TMAT_ACTION{Pilihan Aksi}

    TMAT_ACTION -->|+ Tambah Materi| TMAT_CREATE[Form Tambah Materi\n/teacher/materials/create]
    TMAT_CREATE --> TMAT_FILL[Isi: Judul, Kategori, Deskripsi,\nKonten HTML, Gambar, URL Video]
    TMAT_FILL --> TMAT_VALIDATE{Validasi}
    TMAT_VALIDATE -->|Gagal| TMAT_ERROR[Tampil Error Validasi]
    TMAT_ERROR --> TMAT_FILL
    TMAT_VALIDATE -->|Berhasil| TMAT_SAVE[POST /teacher/materials\nSimpan ke DB + Upload Gambar]
    TMAT_SAVE --> TMAT_INDEX

    TMAT_ACTION -->|Lihat| TMAT_SHOW[Detail Materi\n/teacher/materials/{id}]
    TMAT_SHOW --> TMAT_BACK[← Kembali ke List]

    TMAT_ACTION -->|Edit| TMAT_EDIT[Form Edit Materi\n/teacher/materials/{id}/edit]
    TMAT_EDIT --> TMAT_UPDATE[PATCH /teacher/materials/{id}]
    TMAT_UPDATE --> TMAT_INDEX

    TMAT_ACTION -->|Hapus| TMAT_CONFIRM{Konfirmasi Hapus?}
    TMAT_CONFIRM -->|Batal| TMAT_TABLE
    TMAT_CONFIRM -->|Hapus| TMAT_DELETE[DELETE /teacher/materials/{id}]
    TMAT_DELETE --> TMAT_INDEX

    %% ── QUIZ CRUD ──
    TQUIZ_INDEX --> TQUIZ_TABLE[Lihat Tabel Quiz\n(Judul, Soal, Aksi)]
    TQUIZ_TABLE --> TQUIZ_ACTION{Pilihan Aksi}

    TQUIZ_ACTION -->|+ Buat Quiz| TQUIZ_CREATE[Form Buat Quiz\n/teacher/quizzes/create]
    TQUIZ_CREATE --> TQUIZ_FILL[Isi: Judul, Deskripsi,\nKaitkan ke Materi]
    TQUIZ_FILL --> TQUIZ_SAVE[POST /teacher/quizzes\nRedirect ke Kelola Soal]
    TQUIZ_SAVE --> TQUIZ_SHOW

    TQUIZ_ACTION -->|Kelola Soal| TQUIZ_SHOW[Kelola Soal Quiz\n/teacher/quizzes/{id}]
    TQUIZ_SHOW --> TQUIZ_QLIST[Lihat Daftar Soal yang Ada]
    TQUIZ_SHOW --> TQUIZ_ADD_BTN[Klik 'Tambah Soal Baru']
    TQUIZ_ADD_BTN --> TQUIZ_TYPE{Pilih Tipe Soal}
    TQUIZ_TYPE -->|Pilihan Ganda| TQUIZ_MC[Isi 4 Opsi + Pilih Jawaban Benar]
    TQUIZ_TYPE -->|Benar/Salah| TQUIZ_TF[Pilih: Benar atau Salah]
    TQUIZ_MC --> TQUIZ_SUBMIT_Q[POST /teacher/quizzes/{id}/questions]
    TQUIZ_TF --> TQUIZ_SUBMIT_Q
    TQUIZ_SUBMIT_Q --> TQUIZ_SHOW

    TQUIZ_ACTION -->|Edit Info| TQUIZ_EDIT[Form Edit Quiz]
    TQUIZ_EDIT --> TQUIZ_UPDATE[PATCH /teacher/quizzes/{id}]
    TQUIZ_UPDATE --> TQUIZ_INDEX

    TQUIZ_ACTION -->|Hapus Quiz| TQUIZ_DEL_CONFIRM{Konfirmasi?}
    TQUIZ_DEL_CONFIRM -->|Batal| TQUIZ_TABLE
    TQUIZ_DEL_CONFIRM -->|Hapus| TQUIZ_DELETE[DELETE /teacher/quizzes/{id}]
    TQUIZ_DELETE --> TQUIZ_INDEX

    TQUIZ_QLIST --> TQUIZ_HAPUS_Q{Hapus Soal?}
    TQUIZ_HAPUS_Q -->|Ya| TQUIZ_DEL_Q[DELETE questions/{id}]
    TQUIZ_DEL_Q --> TQUIZ_SHOW

    %% ── DATA SISWA ──
    TSTUDENT_INDEX --> TSTUDENT_TABLE[Lihat Tabel Siswa\n(Nama, XP, Streak, Badge, Quiz Dikerjakan)]
    TSTUDENT_TABLE --> TSTUDENT_CLICK[Klik Nama Siswa]
    TSTUDENT_CLICK --> TSTUDENT_SHOW[Detail Siswa\n/teacher/students/{id}]
    TSTUDENT_SHOW --> TSTUDENT_SCORE[Lihat Semua Hasil Quiz Siswa]
    TSTUDENT_SHOW --> TSTUDENT_BADGE[Lihat Badge yang Diraih]
    TSTUDENT_SHOW --> TSTUDENT_BACK[← Kembali ke List]
```

---

## 7. Sequence Diagram — Login & Role Redirect

```mermaid
sequenceDiagram
    actor User as 👤 User (Browser)
    participant LoginPage as Login Page\n(/login)
    participant AuthController as AuthenticatedSession\nController
    participant AuthGuard as Laravel Auth Guard
    participant DB as Database
    participant Redirect as Role Redirect\n(DashboardController)

    User ->> LoginPage       : GET /login
    LoginPage -->> User      : Tampilkan form login

    User ->> AuthController  : POST /login\n{email, password, remember}
    AuthController ->> AuthGuard : attempt(email, password)
    AuthGuard ->> DB         : SELECT users WHERE email = ?
    DB -->> AuthGuard        : User record + hashed password
    AuthGuard ->> AuthGuard  : Bcrypt verify password

    alt Password Salah
        AuthGuard -->> AuthController : false
        AuthController -->> User      : Redirect back\n+ error "These credentials do not match"
    else Password Benar
        AuthGuard -->> AuthController : true + create session
        AuthController ->> Redirect   : redirect(route('dashboard'))
        Redirect ->> DB              : SELECT role FROM users WHERE id = ?
        DB -->> Redirect             : role = 'student' | 'teacher'

        alt role = student
            Redirect -->> User : Redirect /dashboard\n(Student Dashboard)
        else role = teacher
            Redirect -->> User : Redirect /teacher/dashboard\n(Teacher Dashboard)
        end
    end
```

---

## 8. Sequence Diagram — Kerjakan Quiz & Award XP

```mermaid
sequenceDiagram
    actor Siswa as 🎓 Siswa (Browser)
    participant QuizTake   as QuizController\n@take
    participant QuizSubmit as QuizController\n@submit
    participant DB         as Database
    participant BadgeSvc   as Badge Award\nLogic

    Siswa ->> QuizTake   : GET /quizzes/{quiz}/take
    QuizTake ->> DB      : SELECT questions WHERE quiz_id = ?
    DB -->> QuizTake     : Collection of Questions
    QuizTake -->> Siswa  : Render form quiz (Alpine.js one-by-one)

    loop Untuk setiap soal
        Siswa ->> Siswa  : Pilih jawaban\n(Alpine.js auto-next)
    end

    Siswa ->> QuizSubmit  : POST /quizzes/{quiz}/submit\n{answers: {q_id: answer, ...}}
    QuizSubmit ->> DB     : SELECT questions (untuk validasi)
    DB -->> QuizSubmit    : Questions + correct_answers

    QuizSubmit ->> QuizSubmit : Hitung score\n(bandingkan answers vs correct)

    QuizSubmit ->> DB     : INSERT quiz_results\n{user_id, quiz_id, score, total}
    QuizSubmit ->> DB     : UPDATE users SET xp = xp + (score × 5)

    QuizSubmit ->> BadgeSvc : checkAndAwardBadges(user)
    BadgeSvc ->> DB       : SELECT user stats (xp, quizResults.count, perfectScore?)
    DB -->> BadgeSvc      : Stats data

    loop Setiap badge yang belum diraih
        BadgeSvc ->> BadgeSvc : Cek criteria badge terpenuhi?
        alt Criteria terpenuhi
            BadgeSvc ->> DB   : INSERT user_badges {user_id, badge_id, earned_at}
        end
    end

    BadgeSvc -->> QuizSubmit : selesai
    QuizSubmit -->> Siswa    : Redirect /quizzes/{quiz}/result/{result}
    Siswa ->> Siswa          : Lihat skor, grade, XP yang didapat
```

---

## 9. Sequence Diagram — Baca Materi & Complete

```mermaid
sequenceDiagram
    actor Siswa as 🎓 Siswa (Browser)
    participant MatController as MaterialController
    participant DB            as Database
    participant BadgeSvc      as Badge Award\nLogic

    Siswa ->> MatController : GET /materials/{slug}
    MatController ->> DB    : SELECT material WHERE slug = ?
    MatController ->> DB    : SELECT material_progress\nWHERE user_id = ? AND material_id = ?
    DB -->> MatController   : Material + Progress record (or null)
    MatController -->> Siswa : Render halaman materi\n(tombol "Tandai Selesai" jika belum)

    Siswa ->> Siswa          : Baca konten, tonton video (opsional)

    Siswa ->> MatController  : POST /materials/{slug}/complete

    MatController ->> DB     : SELECT material_progress (cek duplikat)

    alt Sudah pernah diselesaikan
        MatController -->> Siswa : Redirect back\n"Kamu sudah menyelesaikan materi ini"
    else Pertama kali selesai
        MatController ->> DB     : INSERT material_progress\n{user_id, material_id, completed_at}
        MatController ->> DB     : UPDATE users SET xp = xp + 30
        MatController ->> DB     : UPDATE users SET streak + update last_activity_at

        MatController ->> BadgeSvc : checkAndAwardBadges(user)
        BadgeSvc ->> DB            : Cek kriteria badge
        BadgeSvc ->> DB            : INSERT user_badges (jika ada yang terpenuhi)
        BadgeSvc -->> MatController : Done

        MatController -->> Siswa   : Redirect /materials/{slug}\n+ flash "Selamat! +30 XP"
    end
```

---

## 10. Activity Diagram — Sistem Pemberian Badge

```mermaid
flowchart TD
    START([Trigger: Selesai Materi ATAU Submit Quiz]) --> LOAD_USER

    LOAD_USER[Load User dengan Stats:\nxp, quizResults, materialProgress, badges]

    LOAD_USER --> CHECK_ALL[Loop: Cek Semua Badge]

    CHECK_ALL --> BADGE1{Badge: Penjelajah Budaya\n🌿 Selesaikan 1 materi}
    BADGE1 -->|materials_completed >= 1| CHECK_B1_OWN{Sudah punya?}
    CHECK_B1_OWN -->|Belum| AWARD_B1[INSERT user_badges]
    CHECK_B1_OWN -->|Sudah| SKIP1[Skip]
    BADGE1 -->|Belum memenuhi| SKIP1

    AWARD_B1 --> BADGE2
    SKIP1 --> BADGE2

    BADGE2{Badge: Sang Pejuang\n⚔️ Skor sempurna di 1 quiz}
    BADGE2 -->|Ada result dgn score = total| CHECK_B2_OWN{Sudah punya?}
    CHECK_B2_OWN -->|Belum| AWARD_B2[INSERT user_badges]
    CHECK_B2_OWN -->|Sudah| SKIP2[Skip]
    BADGE2 -->|Belum memenuhi| SKIP2

    AWARD_B2 --> BADGE3
    SKIP2 --> BADGE3

    BADGE3{Badge: Bintang Kaltara\n⭐ Selesaikan 4 materi}
    BADGE3 -->|materials_completed >= 4| CHECK_B3_OWN{Sudah punya?}
    CHECK_B3_OWN -->|Belum| AWARD_B3[INSERT user_badges]
    CHECK_B3_OWN -->|Sudah| SKIP3[Skip]
    BADGE3 -->|Belum memenuhi| SKIP3

    AWARD_B3 --> BADGE4
    SKIP3 --> BADGE4

    BADGE4{Badge: Streak Master\n🔥 Streak >= 7 hari}
    BADGE4 -->|streak >= 7| CHECK_B4_OWN{Sudah punya?}
    CHECK_B4_OWN -->|Belum| AWARD_B4[INSERT user_badges]
    CHECK_B4_OWN -->|Sudah| SKIP4[Skip]
    BADGE4 -->|Belum memenuhi| SKIP4

    AWARD_B4 --> BADGE5
    SKIP4 --> BADGE5

    BADGE5{Badge: Maestro Quiz\n🧙 Kerjakan 5 quiz}
    BADGE5 -->|quiz_results.count >= 5| CHECK_B5_OWN{Sudah punya?}
    CHECK_B5_OWN -->|Belum| AWARD_B5[INSERT user_badges]
    CHECK_B5_OWN -->|Sudah| SKIP5[Skip]
    BADGE5 -->|Belum memenuhi| SKIP5

    AWARD_B5 --> END([✅ Selesai])
    SKIP5 --> END
```
