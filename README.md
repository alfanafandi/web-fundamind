[README_Fundamind_Indonesia.md](https://github.com/user-attachments/files/21589905/README_Fundamind_Indonesia.md)

# Fundamind

**Fundamind** adalah aplikasi web e-learning bergaya permainan (gamified) yang dirancang untuk membuat pembelajaran konsep dasar matematika, logika, dan pengetahuan umum menjadi menarik dan menyenangkan. Dibuat dengan tema RPG klasik bergaya pixel-art, pengguna akan memulai petualangan, menyelesaikan misi, melawan bos, dan meningkatkan level karakter mereka dengan menjawab pertanyaan dengan benar. Platform ini juga dilengkapi dengan dasbor admin lengkap untuk mengelola seluruh konten permainan.

## 🎯 Fitur Utama

- **Pengalaman Belajar Gamifikasi**: Pengguna berkembang dengan menyelesaikan misi yang terbagi dalam bab dan diakhiri dengan pertempuran bos yang menantang.
- **Sistem Perkembangan Pengguna**: Dapatkan XP (Poin Pengalaman) dan Koin dengan menyelesaikan tugas. Naik level dan capai peringkat lebih tinggi, dari Bronze hingga Diamond.
- **Sistem Misi Dinamis**:
  - **Misi Cerita**: Ikuti alur naratif melalui berbagai bab pelajaran.
  - **Tantangan Harian**: Berlomba melawan waktu dan pengguna lain di papan peringkat.
  - **Pertempuran Bos**: Hadapi bos kuat yang menguji pengetahuan setelah menyelesaikan bab tertentu.
- **Toko & Inventaris Dalam Game**: Gunakan koin untuk membeli item seperti `Insight Orb` (memberikan petunjuk), `Chrono Clock` (menambah waktu), dan `Portal Pass` (melewati soal).
- **Profil yang Dapat Disesuaikan**: Pengguna dapat mempersonalisasi profil dengan bio khusus dan avatar. Halaman profil juga menampilkan pencapaian, level, peringkat, dan progres XP.
- **Dasbor Admin Lengkap**: Panel backend aman yang memungkinkan admin melakukan CRUD penuh pada:
  - Pengguna  
  - Misi, Bab, dan Soal  
  - Bos dan Soal terkait  
  - Item Toko  
  - Pencapaian  
  - Melihat Nilai Tantangan

## 🛠️ Teknologi yang Digunakan

- **Backend**: PHP  
- **Database**: MySQL  
- **Frontend**: HTML, CSS, JavaScript, Bootstrap 5  

## 🗂️ Struktur Proyek

Repositori disusun dengan pola mirip MVC untuk memisahkan tanggung jawab:

```
└── web-fundamind/
    ├── index.php           # Router utama/front controller
    ├── assets/             # File statis (CSS, JS, gambar, font)
    ├── controllers/        # Logika bisnis dan input pengguna
    ├── models/             # Interaksi database dan logika data
    └── pages/              # Tampilan untuk pengguna dan admin
        ├── admin/          # Halaman dan komponen khusus admin
        └── includes/       # Komponen reusable seperti navbar
```

### 🔄 Alur Aplikasi

1. File `index.php` bertindak sebagai router pusat.
2. Permintaan diarahkan menggunakan parameter `modul` dan `fitur` (misalnya: `index.php?modul=user&fitur=list`).
3. Router memuat controller yang sesuai dari folder `controllers/`.
4. Controller berinteraksi dengan model terkait dari folder `models/` untuk mengambil atau memproses data di database MySQL.
5. Controller memuat tampilan dari folder `pages/` untuk menampilkan HTML akhir kepada pengguna.

## ⚙️ Cara Instalasi & Menjalankan

Untuk menjalankan proyek ini secara lokal, ikuti langkah-langkah berikut:

1. **Clone repositori:**
    ```bash
    git clone https://github.com/alfanafandi/web-fundamind.git
    ```

2. **Siapkan server lokal:**
    - Pastikan kamu memiliki lingkungan server lokal seperti XAMPP, WAMP, atau MAMP yang sudah aktif.
    - Tempatkan folder `web-fundamind` yang telah di-clone ke direktori root server kamu (misalnya `htdocs/` untuk XAMPP).

3. **Buat database:**
    - Buka phpMyAdmin atau alat manajemen database lainnya.
    - Buat database baru dengan nama `fundamind`.
    - Import file `.sql` yang disediakan untuk membuat tabel dan data awal.

4. **Konfigurasi koneksi database:**
    - Buka file `pages/db.php`.
    - Sesuaikan kredensial database (`$host`, `$user`, `$pass`, `$dbname`) sesuai dengan pengaturan lokal kamu. Konfigurasi default:
        ```php
        $host = "localhost";
        $user = "root";
        $pass = "";
        $dbname = "fundamind";
        ```

5. **Akses aplikasi:**
    - Buka browser dan arahkan ke direktori proyek, contoh:  
      `http://localhost/web-fundamind/pages/dashboard.php`
    - Untuk mengakses panel admin, login menggunakan kredensial admin. Default login admin dapat diarahkan ke:  
      `index.php?modul=admin&fitur=dashboard`
