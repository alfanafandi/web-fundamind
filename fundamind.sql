-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 05 Agu 2025 pada 04.42
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fundamind`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `achievements`
--

CREATE TABLE `achievements` (
  `id_achievement` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `syarat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `achievements`
--

INSERT INTO `achievements` (`id_achievement`, `nama`, `syarat`) VALUES
(1, 'First Login', 'Pertama kali login'),
(2, 'Completed Profile', 'Bio diisi & avatar diganti'),
(3, 'Level 5 Reached', 'level >= 5'),
(4, 'Bio Master', 'Bio diisi lebih dari 50 karakter'),
(5, 'Joined Guild', 'Masuk ke halaman guild.php pertama kali'),
(6, 'Fundamind Explorer', 'Buka semua halaman: guild, shop, profile');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$dNrlKR30J5RPxtkC21AtQuVRbPFFJpHo3P4/HOxwLW1lqhg3OI/Wi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `boss_questions`
--

CREATE TABLE `boss_questions` (
  `id_question` int NOT NULL,
  `id_boss` int DEFAULT NULL,
  `pertanyaan` text,
  `pilihan_a` text,
  `pilihan_b` text,
  `pilihan_c` text,
  `pilihan_d` text,
  `jawaban_benar` char(1) DEFAULT NULL,
  `petunjuk` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `boss_questions`
--

INSERT INTO `boss_questions` (`id_question`, `id_boss`, `pertanyaan`, `pilihan_a`, `pilihan_b`, `pilihan_c`, `pilihan_d`, `jawaban_benar`, `petunjuk`) VALUES
(1, 1, 'Seseorang memiliki 2 keranjang berisi 14 dan 9 apel. Jika ia memindahkan 7 apel dari keranjang pertama ke kedua, berapa selisih isi kedua keranjang sekarang?', '0', '2', '4', '6', 'a', 'Hitung isi akhir masing-masing keranjang, lalu cari selisih.'),
(2, 1, 'Ani membeli 3 buku seharga Rp12.500, Rp9.750, dan Rp13.250. Berapa total yang harus dibayar Ani?', 'Rp34.500', 'Rp35.000', 'Rp33.500', 'Rp36.250', 'a', 'Jumlahkan semua harga dengan benar.'),
(3, 1, 'Jika kamu memiliki Rp50.000 dan membeli barang seharga Rp17.500 dan Rp22.000, berapa sisa uangmu?', 'Rp11.500', 'Rp10.500', 'Rp12.000', 'Rp9.500', 'b', 'Hitung total pembelian, lalu kurangi dari Rp50.000.'),
(4, 1, 'Jumlah dari 27, 36, dan 48 adalah...', '110', '111', '112', '113', 'c', 'Jumlahkan satu per satu.'),
(5, 1, 'Selisih antara jumlah 85 dan 64 dengan jumlah 42 dan 28 adalah...', '79', '81', '83', '89', 'b', 'Hitung kedua jumlah dulu, lalu cari selisih.'),
(6, 2, 'Jika 3/4 dari sebuah angka adalah 36, maka angka tersebut adalah...', '42', '45', '48', '52', 'c', 'Bagi 36 dengan 3 lalu kalikan dengan 4.'),
(7, 2, 'Sebuah roti dibagi menjadi 8 bagian. Jika Andi memakan 5 bagian, berapa pecahan roti yang ia makan?', '5/8', '3/8', '3/5', '8/5', 'a', 'Jumlah bagian dimakan dibanding total.'),
(8, 2, '15 siswa duduk di 3 baris dengan jumlah yang sama. Berapa siswa di setiap baris?', '4', '5', '6', '7', 'b', 'Bagi jumlah siswa dengan jumlah baris.'),
(9, 2, '1/2 + 2/5 = ?', '7/10', '9/10', '6/7', '11/10', 'd', 'Samakan penyebut, lalu jumlahkan.'),
(10, 2, 'Jika 4 orang membagi uang Rp72.000 secara merata, masing-masing akan mendapat...', 'Rp17.000', 'Rp18.000', 'Rp19.000', 'Rp20.000', 'b', 'Bagi total uang dengan jumlah orang.'),
(11, 3, 'Jika 3x + 5 = 20, maka nilai x adalah...', '4', '5', '6', '7', 'b', 'Kurangi 20 dengan 5, lalu bagi 3.'),
(12, 3, 'FPB dari 60 dan 75 adalah...', '15', '20', '25', '30', 'a', 'Faktor terbesar yang sama dari kedua angka.'),
(13, 3, 'KPK dari 6, 8, dan 12 adalah...', '24', '48', '36', '60', 'a', 'Cari kelipatan terkecil yang bisa dibagi oleh semua.'),
(14, 3, '1 1/2 + 2 1/4 = ?', '3 3/4', '3 1/2', '4', '4 1/4', 'a', 'Ubah ke pecahan biasa, lalu jumlahkan.'),
(15, 3, 'Jika 2x - 4 = 10, maka x = ?', '6', '7', '8', '9', 'c', 'Tambah 4 ke 10, lalu bagi 2.'),
(16, 4, 'Jika √x = 9, maka nilai x adalah...', '81', '72', '64', '49', 'a', 'Kuasai akar kuadrat: balikkan akar.'),
(17, 4, 'Jika 5x = 3x + 10, maka x = ?', '2', '3', '5', '10', 'c', 'Pindahkan 3x ke kiri lalu bagi sisanya.'),
(18, 4, 'Perbandingan uang A dan B adalah 3:5. Jika A memiliki Rp30.000, berapa uang B?', 'Rp40.000', 'Rp45.000', 'Rp50.000', 'Rp60.000', 'c', 'Bandingkan rasio 3:5, 30 ribu adalah 3 bagian.'),
(19, 4, 'Jika x² = 121, maka nilai x adalah...', '10', '11', '12', '13', 'b', 'Cari bilangan yang kuadratnya 121.'),
(20, 4, 'Jika 2x + 4 = x + 9, maka x = ?', '4', '5', '6', '7', 'a', 'Pindahkan semua x ke satu sisi, angka ke sisi lain.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `boss_quests`
--

CREATE TABLE `boss_quests` (
  `id_boss` int NOT NULL,
  `id_quest` int DEFAULT NULL,
  `nama_boss` varchar(100) DEFAULT NULL,
  `chapter_start` int DEFAULT NULL,
  `chapter_end` int DEFAULT NULL,
  `deskripsi_boss` text,
  `background_image` varchar(255) DEFAULT NULL,
  `boss_image` varchar(255) DEFAULT NULL,
  `xp_reward` int DEFAULT '0',
  `coin_reward` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `boss_quests`
--

INSERT INTO `boss_quests` (`id_boss`, `id_quest`, `nama_boss`, `chapter_start`, `chapter_end`, `deskripsi_boss`, `background_image`, `boss_image`, `xp_reward`, `coin_reward`) VALUES
(1, 1, 'Penjaga Gerbang', 1, 3, 'Sang penjaga Aksara yang mengamuk karena matematika dilupakan.', 'boss_background_1.jpg', 'boss_1.jpg', 50, 25),
(2, 1, 'Raja Pecahan', 4, 6, 'Naga yang menjaga pintu menuju dunia digital. Hanya dapat ditaklukkan dengan logika biner.', 'boss_background_2.jpg', 'boss_2.jpg', 70, 35),
(3, 1, 'Dewa Persamaan', 7, 9, 'Penguasa pecahan yang menguji seberapa dalam pemahamanmu terhadap rasionalitas angka.', 'boss_background_3.jpg', 'boss_3.jpg', 100, 50),
(4, 1, 'Makhluk Akar Misteri', 10, 12, 'Makhluk misterius dari akar-akar hitam yang hanya muncul saat kekuatan matematika terganggu.', 'boss_background_4.jpg', 'boss_img_686f32c58a7549.91866817.jpg', 120, 60);

-- --------------------------------------------------------

--
-- Struktur dari tabel `boss_results`
--

CREATE TABLE `boss_results` (
  `id_result` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `id_boss` int DEFAULT NULL,
  `jumlah_benar` int DEFAULT NULL,
  `total_soal` int DEFAULT NULL,
  `xp_didapat` int DEFAULT NULL,
  `coin_didapat` int DEFAULT NULL,
  `tanggal` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `boss_results`
--

INSERT INTO `boss_results` (`id_result`, `id_user`, `id_boss`, `jumlah_benar`, `total_soal`, `xp_didapat`, `coin_didapat`, `tanggal`) VALUES
(1, 2, 4, 0, 0, 120, 60, '2025-07-04 22:39:02'),
(2, 1, 1, 3, 3, 50, 25, '2025-07-06 18:00:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `challenge_scores`
--

CREATE TABLE `challenge_scores` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `score` int NOT NULL,
  `waktu` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `challenge_scores`
--

INSERT INTO `challenge_scores` (`id`, `id_user`, `score`, `waktu`) VALUES
(1, 4, 0, '2025-07-04 18:50:23'),
(2, 6, 0, '2025-07-04 18:51:50'),
(3, 6, 60, '2025-07-04 18:55:50'),
(4, 14, 56, '2025-07-04 18:58:49'),
(5, 2, 70, '2025-07-04 19:02:54'),
(6, 2, 50, '2025-07-04 22:53:21'),
(7, 6, 0, '2025-07-05 13:19:06'),
(8, 14, 60, '2025-07-05 13:25:43'),
(9, 13, 50, '2025-07-05 13:30:35'),
(10, 22, 90, '2025-07-07 20:43:32'),
(11, 1, 60, '2025-07-09 19:52:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `quests`
--

CREATE TABLE `quests` (
  `id_quest` int NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` text,
  `kategori` enum('story','challenge','boss_battle') NOT NULL,
  `xp_reward` int DEFAULT '0',
  `coin_reward` int DEFAULT '0',
  `gambar_icon` varchar(255) DEFAULT NULL,
  `tersedia` tinyint(1) DEFAULT '1',
  `mulai_event` date DEFAULT NULL,
  `akhir_event` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `quests`
--

INSERT INTO `quests` (`id_quest`, `judul`, `deskripsi`, `kategori`, `xp_reward`, `coin_reward`, `gambar_icon`, `tersedia`, `mulai_event`, `akhir_event`) VALUES
(1, 'Awal Petualangan', 'Mulai petualanganmu di dunia Fundamind!', 'story', 100, 50, 'Ruin_of_Math 1.png', 1, NULL, NULL),
(2, 'Chalenge Harian', 'Tantang dirimu hari ini', 'challenge', 20, 10, 'The_Shattered_Aksara 1.png', 1, NULL, NULL),
(3, 'Boss', 'Kalahkan boss!', 'boss_battle', 200, 100, 'quest_icon_686f300e57aa07.63713319.png', 1, '2025-06-01', '2025-06-30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `quest_chapters`
--

CREATE TABLE `quest_chapters` (
  `id_chapter` int NOT NULL,
  `id_quest` int NOT NULL,
  `nomor_chapter` int NOT NULL,
  `judul_chapter` varchar(100) NOT NULL,
  `deskripsi` text,
  `coin_reward` int DEFAULT '0',
  `xp_reward` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `quest_chapters`
--

INSERT INTO `quest_chapters` (`id_chapter`, `id_quest`, `nomor_chapter`, `judul_chapter`, `deskripsi`, `coin_reward`, `xp_reward`) VALUES
(1, 1, 1, 'Desa Angka yang Hilang', 'Petualangan dimulai! Bantu penduduk desa menyusun kembali angka-angka dasar yang kacau.', 5, 50),
(2, 1, 2, 'Hutan Perkalian Gelap', 'Masuki hutan lebat dan hadapi tantangan dari monster perkalian dan pembagian dasar.', 6, 60),
(3, 1, 3, 'Gua Operasi Campuran', 'Gua penuh jebakan aritmatika. Butuh strategi untuk memadukan tambah, kurang, kali, dan bagi!', 7, 70),
(4, 1, 4, 'Menara Pola & Urutan', 'Panjat menara teka-teki dan pecahkan pola bilangan untuk naik ke tingkat selanjutnya.', 8, 80),
(5, 1, 5, 'Lembah Angka Negatif', 'Suasana mulai gelap. Temukan cara menghadapi bilangan negatif di lembah berkabut ini.', 9, 90),
(6, 1, 6, 'Kastil Faktor & Kelipatan', 'Dapatkan kunci rahasia dengan menguak faktor dan kelipatan di dalam kastil misterius.', 10, 100),
(7, 1, 7, 'Danau Pecahan & Desimal', 'Arungi danau ajaib dan ubah bentuk pecahan menjadi desimal untuk melanjutkan perjalanan.', 12, 110),
(8, 1, 8, 'Labirin Persamaan X', 'Tersesat di labirin! Gunakan persamaan sederhana untuk mencari jalan keluar.', 14, 120),
(9, 1, 9, 'Tebing Pecahan Berlapis', 'Tebing curam penuh teka-teki pecahan dan desimal. Uji ketangkasan berhitungmu!', 16, 130),
(10, 1, 10, 'Gerbang Logika Terakhir', 'Hadapi penjaga akhir di gerbang logika dengan soal cerita yang menguji akal dan strategi.', 20, 150);

-- --------------------------------------------------------

--
-- Struktur dari tabel `quest_questions`
--

CREATE TABLE `quest_questions` (
  `id_question` int NOT NULL,
  `id_chapter` int NOT NULL,
  `pertanyaan` text NOT NULL,
  `pilihan_a` varchar(255) DEFAULT NULL,
  `pilihan_b` varchar(255) DEFAULT NULL,
  `pilihan_c` varchar(255) DEFAULT NULL,
  `pilihan_d` varchar(255) DEFAULT NULL,
  `jawaban_benar` enum('a','b','c','d') NOT NULL,
  `petunjuk` text,
  `min_level` int DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `quest_questions`
--

INSERT INTO `quest_questions` (`id_question`, `id_chapter`, `pertanyaan`, `pilihan_a`, `pilihan_b`, `pilihan_c`, `pilihan_d`, `jawaban_benar`, `petunjuk`, `min_level`) VALUES
(1, 1, 'Berapa hasil dari 5 + 3?', '6', '7', '8', '9', 'c', 'Tambahkan 5 lalu hitung 3 langkah maju.', 1),
(2, 1, 'Jika kamu punya 10 permen dan dimakan 4, sisa berapa?', '5', '6', '4', '7', 'b', 'Kurangkan 10 dikurangi 4.', 1),
(3, 1, 'Nilai dari 7 - 2 adalah...', '4', '5', '6', '3', 'b', 'Bayangkan garis bilangan, mundur 2 dari 7.', 1),
(4, 1, '3 + 6 = ?', '9', '8', '10', '7', 'a', 'Jumlahkan 3 dan 6.', 1),
(5, 1, '15 - 5 = ?', '11', '12', '10', '9', 'c', 'Kurangkan 5 dari 15.', 1),
(6, 1, 'Hasil 8 + 4 adalah...', '13', '11', '12', '10', 'c', 'Jumlahkan kedua angka.', 1),
(7, 1, '10 - 6 = ?', '5', '3', '4', '2', 'c', 'Hitung mundur dari 10 sebanyak 6.', 1),
(8, 1, '2 + 2 + 2 = ?', '6', '4', '8', '5', 'a', 'Jumlahkan 2 tiga kali.', 1),
(9, 1, '9 - 3 = ?', '5', '6', '4', '7', 'b', '9 dikurangi 3 hasilnya?', 1),
(10, 1, 'Berapa hasil 1 + 9?', '10', '11', '9', '8', 'a', 'Penjumlahan sederhana.', 1),
(11, 2, 'Berapakah 4 × 2?', '6', '7', '8', '10', 'c', 'Kalikan 4 dua kali.', 1),
(12, 2, '12 dibagi 3 sama dengan...', '2', '3', '4', '5', 'c', 'Cari angka yang jika dikali 3 hasilnya 12.', 1),
(13, 2, 'Hasil dari 5 × 5 adalah...', '20', '25', '15', '30', 'b', 'Lima dikali lima = ?', 1),
(14, 2, '6 × 3 = ?', '18', '21', '16', '24', 'a', '6 ditambah 6 ditambah 6.', 1),
(15, 2, '9 ÷ 3 = ?', '2', '4', '3', '6', 'c', 'Berapa kali 3 masuk ke 9?', 1),
(16, 2, '2 × 7 = ?', '14', '12', '13', '15', 'a', 'Kalikan 2 dengan 7.', 1),
(17, 2, '8 ÷ 2 = ?', '4', '5', '6', '3', 'a', '8 dibagi 2 hasilnya?', 1),
(18, 2, '3 × 6 = ?', '18', '16', '12', '14', 'a', 'Perkalian dasar 3.', 1),
(19, 2, '10 ÷ 5 = ?', '3', '2', '1', '5', 'b', 'Berapa kali 5 masuk ke 10?', 1),
(20, 2, '7 × 0 = ?', '0', '7', '1', '7', 'a', 'Apapun dikali nol = 0.', 1),
(21, 3, 'Berapa hasil dari 3 + 2 × 4?', '20', '11', '10', '8', 'b', 'Kerjakan perkalian dulu.', 2),
(22, 3, '12 ÷ 3 + 2 = ?', '6', '4', '5', '3', 'c', 'Bagi dulu, baru tambahkan.', 2),
(23, 3, '7 + 6 × 0 = ?', '0', '7', '6', '13', 'b', 'Ingat bahwa apapun × 0 = 0.', 2),
(24, 3, '8 - 2 × 2 = ?', '4', '8', '2', '6', 'a', 'Kerjakan kali dulu.', 2),
(25, 3, '6 + 3 ÷ 3 = ?', '3', '7', '6', '9', 'b', '3 ÷ 3 = 1, lalu tambah 6.', 2),
(26, 3, '5 × 2 - 4 = ?', '4', '6', '8', '10', 'b', 'Kali dulu, lalu kurang.', 2),
(27, 3, '10 ÷ 2 + 3 = ?', '8', '6', '5', '4', 'a', 'Bagi 10, hasilnya tambah 3.', 2),
(28, 3, '9 - 3 × 2 = ?', '3', '0', '6', '4', 'a', 'Kali dulu, baru kurang.', 2),
(29, 3, '4 × 2 + 1 = ?', '9', '10', '8', '7', 'a', '8 + 1 = ?', 2),
(30, 3, '15 ÷ 5 + 2 × 3 = ?', '9', '8', '7', '6', 'b', '15 ÷ 5 = 3, 2×3=6, lalu 3+6.', 2),
(31, 4, 'Urutan bilangan 2, 4, 6, ... berikutnya adalah?', '7', '8', '9', '10', 'b', 'Itu adalah bilangan genap.', 2),
(32, 4, 'Pola 5, 10, 15, ... angka selanjutnya?', '20', '25', '30', '35', 'a', 'Tambah 5 setiap langkah.', 2),
(33, 4, 'Bilangan setelah 17 dalam urutan ganjil adalah?', '18', '19', '20', '21', 'b', 'Ganjil setelah 17.', 2),
(34, 4, '1, 2, 4, 8, ... apa angka berikutnya?', '12', '14', '16', '18', 'c', 'Ini kelipatan 2.', 2),
(35, 4, 'Pola: 100, 90, 80, ... angka selanjutnya?', '60', '50', '70', '75', 'c', 'Turun 10 tiap langkah.', 2),
(36, 4, '5, 15, 30, 50, ... ?', '65', '70', '75', '80', 'a', 'Lompatannya: +10, +15, +20.', 2),
(37, 4, '2, 3, 5, 8, 12, ... ?', '16', '17', '18', '19', 'a', 'Tambah 1, 2, 3, dst.', 2),
(38, 4, 'Urutan bilangan genap antara 10 sampai 18 adalah?', '10,12,14,16,18', '10,11,12,13', '11,13,15', '12,14,16,18,20', 'a', 'Bilangan genap habis dibagi 2.', 2),
(39, 4, 'Pola 1, 4, 9, 16, ... angka selanjutnya?', '20', '23', '25', '30', 'c', 'Ini adalah kuadrat sempurna.', 2),
(40, 4, 'Urutan 50, 45, 40, ... berkurang berapa tiap langkah?', '2', '3', '4', '5', 'd', 'Selisih antar angka.', 2),
(41, 5, 'Berapa hasil dari -3 + 5?', '2', '3', '1', '-2', 'a', 'Pikirkan di garis bilangan.', 3),
(42, 5, '5 - 8 = ?', '2', '-3', '3', '-1', 'b', 'Hasilnya negatif.', 3),
(43, 5, '-4 + 2 = ?', '-2', '2', '0', '1', 'a', 'Negatif ditambah positif.', 3),
(44, 5, 'Nilai dari -6 - 3 = ?', '-9', '-3', '3', '9', 'a', 'Keduanya negatif.', 3),
(45, 5, 'Jika suhu 2°C turun 5 derajat, suhu sekarang?', '3°C', '2°C', '-3°C', '-2°C', 'c', '2 - 5 = ?', 3),
(46, 5, 'Hasil dari -2 × 3 = ?', '-6', '6', '-3', '3', 'a', 'Negatif kali positif.', 3),
(47, 5, '-4 × -2 = ?', '8', '-8', '6', '-6', 'a', 'Negatif × negatif = positif.', 3),
(48, 5, 'Hasil dari -10 ÷ 2 = ?', '-5', '5', '-10', '2', 'a', 'Negatif dibagi positif.', 3),
(49, 5, '-9 + (-3) = ?', '-6', '-12', '-3', '6', 'b', 'Dua angka negatif dijumlahkan.', 3),
(50, 5, 'Nilai mutlak dari -7 adalah?', '-7', '0', '7', '-1', 'c', 'Nilai mutlak adalah jarak dari 0.', 3),
(51, 6, 'Faktor dari 12 adalah?', '1,2,3,4,6,12', '2,3,5,6,10', '1,2,3,5', '2,4,8,12', 'a', 'Bilangan yang membagi habis.', 3),
(52, 6, 'Kelipatan dari 4 yang kurang dari 20?', '4,8,12,16', '4,5,6,8', '2,4,6,8', '5,10,15,20', 'a', 'Perkalian 4.', 3),
(53, 6, 'FPB dari 12 dan 18 adalah?', '2', '4', '6', '8', 'c', 'Faktor terbesar yang sama.', 3),
(54, 6, 'KPK dari 4 dan 6 adalah?', '8', '12', '16', '24', 'b', 'Kelipatan persekutuan terkecil.', 3),
(55, 6, 'Bilangan yang bukan faktor dari 24?', '3', '4', '5', '6', 'c', 'Apakah 24 bisa dibagi 5?', 3),
(56, 6, 'Kelipatan persekutuan dari 3 dan 5?', '15', '30', '45', 'Semua benar', 'd', 'Perkalian 15.', 3),
(57, 6, 'Jumlah faktor dari 10 adalah?', '2', '3', '4', '5', 'c', '1, 2, 5, 10', 3),
(58, 6, 'Angka yang merupakan kelipatan dari 6?', '12', '13', '14', '15', 'a', '6 × 2 = ?', 3),
(59, 6, 'Faktor dari 36 adalah?', '1,2,3,4,6,9,12,18,36', '2,3,6,12', '1,2,4,8,16,32', '1,3,5,7', 'a', 'Semua pembagi 36.', 3),
(60, 6, 'KPK dari 5 dan 7 adalah?', '35', '12', '14', '70', 'a', 'Keduanya bilangan prima.', 3),
(61, 7, '1/2 sama dengan desimal...', '0.1', '0.2', '0.3', '0.5', 'd', '1 dibagi 2.', 4),
(62, 7, '3/4 = ?', '0.75', '0.25', '0.5', '0.3', 'a', '3 dibagi 4.', 4),
(63, 7, '2/5 dalam desimal adalah?', '0.4', '0.5', '0.2', '0.25', 'a', '2 dibagi 5.', 4),
(64, 7, '0.2 = ...%', '2%', '20%', '200%', '0.2%', 'b', 'Kalikan desimal dengan 100.', 4),
(65, 7, '0.75 dalam bentuk pecahan sederhana?', '1/2', '3/4', '2/5', '1/4', 'b', 'Bandingkan dengan 75/100.', 4),
(66, 7, '1/4 + 1/4 = ?', '1/4', '1/2', '2/4', '1', 'b', 'Jumlahkan pembilang.', 4),
(67, 7, '0.6 + 0.3 = ?', '0.9', '1.0', '0.8', '1.1', 'a', 'Jumlahkan langsung.', 4),
(68, 7, '1/2 + 1/3 = ?', '5/6', '2/5', '1/5', '3/5', 'a', 'Samakan penyebut: 3/6 + 2/6.', 4),
(69, 7, 'Pecahan 2/2 nilainya adalah...', '0', '2', '1', 'Tidak bisa', 'c', '2 dibagi 2.', 4),
(70, 7, '0.125 = ...', '1/8', '1/4', '1/2', '3/8', 'a', 'Coba ubah 125/1000 dan sederhanakan.', 4),
(71, 8, 'x + 3 = 7. Maka x = ?', '4', '5', '3', '6', 'a', 'Kurangkan 3 dari 7.', 5),
(72, 8, '2x = 10. Nilai x = ?', '4', '5', '6', '10', 'b', 'Bagi 10 dengan 2.', 5),
(73, 8, 'x - 5 = 3. Maka x = ?', '7', '8', '9', '10', 'a', 'Tambah 5 ke 3.', 5),
(74, 8, 'Jika x + 2 = 9, maka x = ?', '6', '7', '8', '9', 'b', 'Kurangi 2 dari 9.', 5),
(75, 8, '3x = 15. Maka x = ?', '5', '4', '3', '6', 'a', '15 dibagi 3.', 5),
(76, 8, 'x ÷ 2 = 6. Maka x = ?', '10', '12', '14', '16', 'b', '6 dikali 2.', 5),
(77, 8, 'x + x = 8. Maka x = ?', '2', '4', '6', '8', 'b', 'Gabungkan dua x.', 5),
(78, 8, 'x - 2 = 0. Maka x = ?', '0', '1', '2', '3', 'c', 'Tambah 2 ke 0.', 5),
(79, 8, 'Jika 5x = 25, maka x = ?', '10', '15', '5', '20', 'c', 'Bagi 25 dengan 5.', 5),
(80, 8, 'x + 4 = 2x. Maka x = ?', '4', '3', '2', '1', 'a', 'Pindahkan x ke kanan.', 5),
(81, 9, '1/2 + 1/4 = ?', '2/4', '3/4', '1', '1/3', 'b', 'Samakan penyebut: 2/4 + 1/4.', 6),
(82, 9, '3/4 - 1/2 = ?', '1/4', '1/2', '1/8', '2/4', 'a', 'Ubah ke penyebut 4.', 6),
(83, 9, '0.6 × 2 = ?', '1.2', '1.4', '1.0', '1.5', 'a', 'Kalikan desimal biasa.', 6),
(84, 9, '0.9 - 0.4 = ?', '0.3', '0.4', '0.5', '0.6', 'c', 'Kurangkan biasa.', 6),
(85, 9, '1/3 + 1/6 = ?', '1/2', '2/3', '3/6', '1/3', 'a', 'Samakan penyebut: 2/6 + 1/6.', 6),
(86, 9, '0.25 + 0.75 = ?', '0.5', '1', '0.9', '1.1', 'b', 'Gabungkan saja.', 6),
(87, 9, '3/5 × 2 = ?', '1', '1 1/5', '1 2/5', '2', 'c', 'Kalikan 3 dengan 2 lalu bagi 5.', 6),
(88, 9, '2/3 - 1/6 = ?', '1/2', '1/3', '2/6', '5/6', 'a', 'Samakan penyebut 6.', 6),
(89, 9, '0.4 × 0.5 = ?', '0.2', '0.25', '0.1', '0.15', 'a', 'Kalikan seperti biasa.', 6),
(90, 9, '1 - 2/5 = ?', '3/5', '2/5', '4/5', '1/2', 'a', 'Ubah 1 menjadi 5/5.', 6),
(91, 10, 'Ali membeli 3 buku seharga 15 ribu, total belanja Ali adalah?', '30 ribu', '45 ribu', '15 ribu', '60 ribu', 'b', '15 × 3.', 7),
(92, 10, 'Lina memiliki 5 apel. Dia memberikan 2 kepada teman, sisa apel?', '1', '2', '3', '4', 'c', 'Kurangi 5 dengan 2.', 7),
(93, 10, 'Jika 1 pensil seharga 2 ribu, berapa harga 6 pensil?', '10 ribu', '12 ribu', '14 ribu', '8 ribu', 'b', '2 × 6.', 7),
(94, 10, 'Budi berlari 5 km per hari. Dalam 7 hari, ia berlari...', '35 km', '25 km', '30 km', '40 km', 'a', '5 × 7.', 7),
(95, 10, 'Ada 4 kotak. Setiap kotak berisi 3 bola. Total bola?', '12', '10', '15', '13', 'a', '4 × 3.', 7),
(96, 10, 'Sebuah kue dibagi 4. Jika kamu ambil 2 potong, kamu ambil berapa bagian?', '1/2', '1/4', '3/4', '1/3', 'a', '2 dari 4 = 2/4 = 1/2.', 7),
(97, 10, 'Jika kamu punya 10 kelereng dan hilang 3, lalu temukan 2 lagi, kamu punya?', '9', '8', '10', '7', 'a', '10 - 3 + 2 = ?', 7),
(98, 10, 'Andi memiliki 3 tas. Setiap tas berisi 5 buku. Total buku?', '10', '15', '12', '20', 'b', '3 × 5.', 7),
(99, 10, 'Rina membaca 2 buku setiap minggu. Dalam 4 minggu ia membaca?', '6', '7', '8', '10', 'c', '2 × 4.', 7),
(100, 10, 'Jika harga 1 roti adalah 4 ribu, 3 roti harganya?', '10 ribu', '12 ribu', '11 ribu', '13 ribu', 'b', '4 × 3.', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `shop_items`
--

CREATE TABLE `shop_items` (
  `id_item` int NOT NULL,
  `nama_item` varchar(100) NOT NULL,
  `tipe_item` varchar(50) DEFAULT NULL,
  `deskripsi` text,
  `harga_coin` int NOT NULL,
  `file_icon` varchar(100) DEFAULT NULL,
  `tersedia` tinyint(1) DEFAULT '1',
  `level_minimal` int DEFAULT '1',
  `sekali_pakai` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `shop_items`
--

INSERT INTO `shop_items` (`id_item`, `nama_item`, `tipe_item`, `deskripsi`, `harga_coin`, `file_icon`, `tersedia`, `level_minimal`, `sekali_pakai`) VALUES
(1, 'Knowledge Scroll', 'booster', 'Tambah 15 XP', 15, 'icon_686f2b5f26ed06.07590643.png', 1, 1, 1),
(2, 'Insight Orb', 'hint', 'Tampilkan petunjuk di soal', 10, 'magnify.png', 1, 1, 1),
(3, 'Portal Pass', 'skip', 'Lewati satu soal', 15, 'skip.png', 1, 3, 1),
(4, 'Chrono Clock', 'booster', 'Tambahan waktu 30 detik (Challenge)', 10, 'time.png', 1, 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` enum('Ellipse_1.png','Ellipse_2.png','Ellipse_3.png','Ellipse_4.png','Ellipse_5.png') DEFAULT 'Ellipse_1.png',
  `bio` text,
  `level` int DEFAULT '1',
  `xp` int DEFAULT '0',
  `xp_next` int DEFAULT '100',
  `coin` int DEFAULT '0',
  `last_challenge_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `avatar`, `bio`, `level`, `xp`, `xp_next`, `coin`, `last_challenge_date`) VALUES
(1, 'alfan', '$2y$10$eNcym8v.DSFaXEAomZHsreZ7PAoT0H.u91aedYnV5cS5Tb9IFj0V.', 'Ellipse_4.png', 'Ini Alfan', 5, 104, 500, 327, '2025-07-09'),
(2, 'gayuh', '$2y$10$wfBKoyfoWxNp0hDHZ7SdMOQAIszNO7DDX0xtvuL0CFmg/1XwxmH7S', 'Ellipse_2.png', 'dda', 4, 260, 400, 399, NULL),
(4, 'afandi', '$2y$10$6vNvY1gV2BQrg1ndOti1Lu/OkUAAvm4BXUrxy3HY3fWL7HgprzxEO', 'Ellipse_1.png', NULL, 3, 21, 300, 206, NULL),
(5, 'pratama', '$2y$10$DpFGJZzwQMY/nHQ9fmGiZuLunbWQU/xQSoxc5pzOpc3p.b/Pct7zi', 'Ellipse_1.png', NULL, 3, 50, 300, 350, NULL),
(6, 'putra', '$2y$10$K5m/qEeiGY1AcLGYpxXgKOC1Tt6kRw3I9SjyXoDJR7k1SkIeT4.zG', 'Ellipse_1.png', NULL, 4, 85, 400, 278, NULL),
(7, 'hegel', '$2y$10$hjgTf7qJdtceb1PzRqmYfOBEFUtAYZ8nBV1IyijlUfdWoEgzAwxeu', 'Ellipse_1.png', NULL, 1, 0, 100, 0, NULL),
(8, 'hegel123', '$2y$10$cQ7kSuZ1Gb7kLq84V3AtsOM5X5BCKiRBb6E1.IE/g9EdwaHNRm7sW', 'Ellipse_3.png', 'hgel disini', 2, 160, 200, 190, NULL),
(9, 'bang', '$2y$10$lRQ9h1vc98yhcp5Mpq22xupYZXrD2NQho7An3iod9CXDaa98YFEN6', 'Ellipse_5.png', 'Bang disini', 3, 140, 300, 340, NULL),
(10, 'bongong', '$2y$10$rQ1RHJ8rnjhmx1XUeo8EmO/ZMhdRH08wx1EwYio2RcztAJZY55JzK', 'Ellipse_3.png', '', 2, 110, 200, 190, NULL),
(11, 'nana', '$2y$10$vsus94EqAfNm0eLm9PPd3.83CHkGL2Zhaho7ya.W5BWLxwDl217hS', 'Ellipse_1.png', NULL, 1, 30, 100, 50, NULL),
(12, 'koko', '$2y$10$mckJA6MIBFYZsxW4NURJWeD7ewMs5l652wPBzBDS7WJmr4jywF1gG', 'Ellipse_1.png', NULL, 1, 0, 100, 0, NULL),
(13, 'mm', '$2y$10$JL9GEyJ/p7brXtRVzRxtPexO0ubXg7s1qMo5vn69HLwx3zdoeZzk.', 'Ellipse_1.png', NULL, 2, 75, 200, 40, NULL),
(14, 'aa', '$2y$10$kDrGXpSgrTEvuHZheWZFy.KpVy21pDpQVNcFurB9k5CvmoYt8fm9K', 'Ellipse_1.png', NULL, 2, 76, 100, 88, NULL),
(15, 'iqbal', '$2y$10$mBXBhrZMbAtSRbGwZ37I4uPO8pYOsSQjEXuj.RMTB.tMTHN3cWNEq', 'Ellipse_3.png', 'iqbal disini', 1, 78, 100, 15, NULL),
(16, 'culprit', '$2y$10$H0qMwSYohKd7fmcpD9.eSuKjSA3zwySGIH6geLJRAKIaJUgXkkOle', 'Ellipse_1.png', NULL, 1, 140, 100, 130, NULL),
(17, 'jj', '$2y$10$5WnRq6J1dT6vmWClrDUOZe8PkNG0WLOd5XWMzGnrVBVqDbVOVWtB6', 'Ellipse_1.png', NULL, 1, 30, 100, 50, NULL),
(18, 'kk', '$2y$10$dEp4nYRrWDjNvpNH3l18Eeixp5ecsDoo67cj.4STM6EWd32TOO52e', 'Ellipse_1.png', NULL, 1, 30, 100, 50, NULL),
(19, 'v', '$2y$10$mzbEsgL7wtJU8UxrlIPb1O4.B3eOT0jBTtM033Dzlqdg4raHHbV.y', 'Ellipse_1.png', NULL, 1, 0, 100, 0, NULL),
(20, '1', '$2y$10$magoWxjoEdJONPFvhgUGRegqBNP5ggvP.R0zcRBa/wo1U3KxYyC7C', 'Ellipse_1.png', NULL, 1, 0, 100, 0, NULL),
(21, '2', '$2y$10$tARcXoPn/blk0H4uHfJrB.neDYULxGuvOlucuf92qjksWNdmWWSg.', 'Ellipse_1.png', NULL, 1, 0, 100, 0, NULL),
(22, 'fandi', '$2y$10$FbQtRynnqkwCNdLf2ZoMu.FdO5RA02C.El696c42BTbD1S44jW.X2', 'Ellipse_3.png', '', 3, 188, 200, 55, '2025-07-07'),
(23, 'may', '$2y$10$PI6A.R9VL0IRNAqPFyaLju67U.YQ/KCk7CK3xli42EaaCp6H2CUjO', 'Ellipse_2.png', 'jomblo pt mencari cinta sejati', 1, 45, 100, 4, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_achievements`
--

CREATE TABLE `user_achievements` (
  `id_user` int NOT NULL,
  `id_achievement` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user_achievements`
--

INSERT INTO `user_achievements` (`id_user`, `id_achievement`) VALUES
(1, 1),
(2, 1),
(4, 1),
(5, 1),
(6, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(1, 2),
(2, 2),
(8, 2),
(9, 2),
(15, 2),
(23, 2),
(1, 4),
(1, 5),
(2, 5),
(4, 5),
(5, 5),
(6, 5),
(8, 5),
(9, 5),
(10, 5),
(11, 5),
(12, 5),
(13, 5),
(14, 5),
(15, 5),
(16, 5),
(17, 5),
(18, 5),
(19, 5),
(20, 5),
(21, 5),
(22, 5),
(23, 5),
(1, 6),
(2, 6),
(4, 6),
(5, 6),
(6, 6),
(8, 6),
(9, 6),
(10, 6),
(13, 6),
(14, 6),
(15, 6),
(16, 6),
(22, 6),
(23, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_answers`
--

CREATE TABLE `user_answers` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `id_chapter` int NOT NULL,
  `id_question` int NOT NULL,
  `jawaban_user` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user_answers`
--

INSERT INTO `user_answers` (`id`, `id_user`, `id_chapter`, `id_question`, `jawaban_user`, `created_at`) VALUES
(1, 1, 1, 1, 'c', '2025-06-29 17:03:38'),
(2, 1, 1, 2, 'c', '2025-06-29 17:03:38'),
(3, 1, 1, 1, 'c', '2025-06-29 17:05:41'),
(4, 1, 1, 2, 'c', '2025-06-29 17:05:41'),
(5, 1, 4, 5, 'a', '2025-06-29 17:07:41'),
(6, 1, 2, 3, 'a', '2025-06-29 17:10:52'),
(7, 1, 1, 1, 'c', '2025-06-29 17:13:48'),
(8, 1, 1, 2, 'c', '2025-06-29 17:13:48'),
(9, 1, 2, 3, 'a', '2025-06-29 17:15:18'),
(10, 1, 1, 1, 'c', '2025-06-29 17:17:58'),
(11, 1, 1, 2, 'c', '2025-06-29 17:17:58'),
(12, 1, 3, 4, 'c', '2025-06-29 17:18:50'),
(13, 1, 2, 3, 'a', '2025-06-29 17:23:17'),
(14, 1, 1, 1, 'c', '2025-06-29 17:24:18'),
(15, 1, 1, 2, 'b', '2025-06-29 17:24:18'),
(16, 1, 2, 3, 'a', '2025-06-29 17:26:59'),
(17, 1, 1, 1, 'c', '2025-06-29 17:30:45'),
(18, 1, 1, 2, 'b', '2025-06-29 17:30:45'),
(19, 1, 2, 3, 'b', '2025-06-29 17:31:15'),
(20, 1, 1, 1, 'c', '2025-06-29 17:40:43'),
(21, 1, 1, 2, 'b', '2025-06-29 17:40:43'),
(22, 1, 2, 3, 'a', '2025-06-29 17:40:54'),
(23, 1, 1, 1, 'c', '2025-06-29 17:41:08'),
(24, 1, 1, 2, 'd', '2025-06-29 17:41:08'),
(25, 1, 2, 3, 'c', '2025-06-29 17:41:21'),
(26, 1, 1, 1, 'c', '2025-06-29 17:44:23'),
(27, 1, 1, 2, 'b', '2025-06-29 17:44:23'),
(28, 1, 2, 3, 'a', '2025-06-29 17:44:34'),
(29, 1, 1, 1, 'c', '2025-06-29 17:45:00'),
(30, 1, 1, 2, 'b', '2025-06-29 17:45:00'),
(31, 1, 2, 3, 'c', '2025-06-29 17:45:08'),
(32, 1, 1, 1, 'b', '2025-06-29 17:46:00'),
(33, 1, 1, 2, 'b', '2025-06-29 17:46:00'),
(34, 1, 2, 3, 'a', '2025-06-29 17:46:09'),
(35, 1, 1, 1, 'b', '2025-06-29 17:48:20'),
(36, 1, 1, 2, 'c', '2025-06-29 17:48:20'),
(37, 1, 1, 1, 'b', '2025-06-29 17:49:27'),
(38, 1, 1, 2, 'c', '2025-06-29 17:49:27'),
(39, 1, 1, 1, 'c', '2025-06-29 17:49:35'),
(40, 1, 1, 2, 'b', '2025-06-29 17:49:35'),
(41, 1, 1, 1, 'b', '2025-06-29 17:51:07'),
(42, 1, 1, 2, 'b', '2025-06-29 17:51:07'),
(43, 1, 1, 1, 'b', '2025-06-29 17:51:27'),
(44, 1, 1, 2, 'b', '2025-06-29 17:51:27'),
(45, 1, 1, 1, 'c', '2025-06-29 17:52:19'),
(46, 1, 1, 2, 'b', '2025-06-29 17:52:19'),
(47, 1, 1, 1, 'b', '2025-06-29 17:57:23'),
(48, 1, 1, 2, 'b', '2025-06-29 17:57:23'),
(49, 1, 1, 1, 'b', '2025-06-29 17:59:35'),
(50, 1, 1, 2, 'b', '2025-06-29 17:59:35'),
(51, 1, 1, 1, 'c', '2025-06-29 18:02:32'),
(52, 1, 1, 2, 'b', '2025-06-29 18:02:32'),
(53, 1, 1, 1, 'b', '2025-06-29 18:02:55'),
(54, 1, 1, 2, 'c', '2025-06-29 18:02:55'),
(55, 1, 1, 1, 'c', '2025-06-29 18:06:29'),
(56, 1, 1, 2, 'b', '2025-06-29 18:06:29'),
(57, 1, 1, 1, 'b', '2025-06-29 18:08:55'),
(58, 1, 1, 2, 'b', '2025-06-29 18:08:55'),
(59, 2, 1, 1, 'c', '2025-06-30 00:17:32'),
(60, 2, 1, 2, 'b', '2025-06-30 00:17:32'),
(61, 2, 2, 3, 'a', '2025-06-30 00:17:52'),
(62, 2, 3, 4, 'a', '2025-06-30 00:18:45'),
(63, 2, 4, 5, 'b', '2025-06-30 00:27:05'),
(64, 4, 3, 4, 'c', '2025-06-30 00:28:56'),
(65, 4, 4, 5, 'b', '2025-06-30 00:32:36'),
(66, 4, 1, 1, 'c', '2025-06-30 00:33:16'),
(67, 4, 1, 2, 'b', '2025-06-30 00:33:16'),
(68, 4, 2, 3, 'a', '2025-06-30 00:37:32'),
(69, 5, 4, 5, 'b', '2025-06-30 00:47:00'),
(70, 5, 4, 5, 'b', '2025-06-30 00:47:45'),
(71, 5, 4, 5, 'b', '2025-06-30 00:47:50'),
(72, 5, 4, 5, 'b', '2025-06-30 00:47:58'),
(73, 5, 4, 5, 'b', '2025-06-30 00:48:15'),
(74, 6, 4, 5, 'b', '2025-06-30 00:57:42'),
(75, 8, 4, 5, 'b', '2025-06-30 01:53:00'),
(76, 8, 1, 1, 'c', '2025-06-30 01:53:51'),
(77, 8, 1, 2, 'b', '2025-06-30 01:53:51'),
(78, 9, 4, 5, 'b', '2025-06-30 03:48:01'),
(79, 9, 3, 4, 'c', '2025-06-30 03:49:16'),
(80, 9, 1, 1, 'c', '2025-06-30 03:55:00'),
(81, 9, 1, 2, 'b', '2025-06-30 03:55:00'),
(82, 9, 2, 3, 'a', '2025-06-30 04:43:16'),
(83, 10, 1, 1, 'c', '2025-06-30 04:50:34'),
(84, 10, 1, 2, 'b', '2025-06-30 04:50:34'),
(85, 10, 2, 3, 'a', '2025-06-30 04:51:12'),
(86, 10, 3, 4, 'c', '2025-06-30 10:29:49'),
(87, 11, 1, 1, 'c', '2025-07-01 16:07:21'),
(88, 11, 1, 2, 'b', '2025-07-01 16:07:21'),
(89, 12, 4, 5, 'b', '2025-07-01 16:27:21'),
(90, 12, 4, 5, 'b', '2025-07-01 16:27:27'),
(91, 12, 4, 5, 'b', '2025-07-01 16:27:30'),
(92, 12, 4, 5, 'b', '2025-07-01 16:29:55'),
(93, 12, 4, 5, 'b', '2025-07-01 16:29:59'),
(94, 12, 4, 5, 'a', '2025-07-01 16:30:03'),
(95, 12, 4, 5, 'c', '2025-07-01 16:30:04'),
(96, 12, 3, 4, 'd', '2025-07-01 16:30:20'),
(97, 12, 3, 4, 'a', '2025-07-01 16:33:03'),
(98, 12, 3, 4, 'c', '2025-07-01 16:33:07'),
(99, 12, 1, 1, 'c', '2025-07-01 16:33:22'),
(100, 12, 1, 2, 'b', '2025-07-01 16:33:22'),
(101, 12, 1, 1, 'b', '2025-07-01 16:35:06'),
(102, 12, 1, 2, 'b', '2025-07-01 16:35:06'),
(103, 13, 4, 5, 'b', '2025-07-01 16:45:45'),
(104, 13, 1, 1, 'c', '2025-07-01 16:46:17'),
(105, 13, 1, 2, 'b', '2025-07-01 16:46:17'),
(106, 13, 2, 3, 'b', '2025-07-01 16:48:00'),
(107, 13, 3, 4, '', '2025-07-01 17:10:45'),
(108, 13, 3, 4, '', '2025-07-01 17:11:49'),
(109, 13, 3, 4, 'b', '2025-07-01 17:12:19'),
(110, 15, 1, 1, 'c', '2025-07-02 03:33:47'),
(111, 15, 1, 2, 'd', '2025-07-02 03:33:47'),
(112, 15, 2, 3, 'a', '2025-07-02 03:38:15'),
(113, 15, 3, 4, 'd', '2025-07-02 03:38:44'),
(114, 15, 4, 5, 'b', '2025-07-02 11:47:17'),
(115, 16, 1, 1, 'c', '2025-07-02 11:53:48'),
(116, 16, 1, 2, 'b', '2025-07-02 11:53:48'),
(117, 16, 2, 3, 'a', '2025-07-02 11:58:50'),
(118, 17, 1, 1, 'c', '2025-07-02 16:25:16'),
(119, 17, 1, 2, 'b', '2025-07-02 16:25:16'),
(120, 17, 1, 6, 'b', '2025-07-02 16:25:16'),
(121, 17, 1, 7, 'c', '2025-07-02 16:25:16'),
(122, 17, 1, 8, 'b', '2025-07-02 16:25:16'),
(123, 17, 1, 9, 'd', '2025-07-02 16:25:16'),
(124, 17, 1, 10, 'c', '2025-07-02 16:25:16'),
(125, 17, 1, 11, 'c', '2025-07-02 16:25:16'),
(126, 17, 1, 12, 'c', '2025-07-02 16:25:16'),
(127, 17, 1, 13, 'a', '2025-07-02 16:25:16'),
(128, 17, 1, 14, 'b', '2025-07-02 16:25:16'),
(129, 17, 1, 15, 'a', '2025-07-02 16:25:16'),
(130, 18, 1, 1, 'c', '2025-07-02 16:30:54'),
(131, 18, 1, 2, 'b', '2025-07-02 16:30:54'),
(132, 18, 1, 6, 'b', '2025-07-02 16:30:54'),
(133, 18, 1, 7, 'c', '2025-07-02 16:30:54'),
(134, 18, 1, 8, 'b', '2025-07-02 16:30:54'),
(135, 18, 1, 9, 'a', '2025-07-02 16:30:54'),
(136, 18, 1, 10, 'c', '2025-07-02 16:30:54'),
(137, 18, 1, 11, 'c', '2025-07-02 16:30:54'),
(138, 18, 1, 12, 'c', '2025-07-02 16:30:54'),
(139, 18, 1, 13, 'a', '2025-07-02 16:30:54'),
(140, 18, 1, 14, 'b', '2025-07-02 16:30:54'),
(141, 18, 1, 15, 'a', '2025-07-02 16:30:54'),
(142, 14, 1, 1, 'c', '2025-07-02 17:17:47'),
(143, 14, 1, 2, 'b', '2025-07-02 17:17:47'),
(144, 14, 1, 6, 'b', '2025-07-02 17:17:47'),
(145, 14, 1, 7, 'c', '2025-07-02 17:17:47'),
(146, 14, 1, 8, 'b', '2025-07-02 17:17:47'),
(147, 14, 1, 9, 'a', '2025-07-02 17:17:47'),
(148, 14, 1, 10, 'c', '2025-07-02 17:17:47'),
(149, 14, 1, 11, 'c', '2025-07-02 17:17:47'),
(150, 14, 1, 12, 'c', '2025-07-02 17:17:47'),
(151, 14, 1, 13, 'a', '2025-07-02 17:17:47'),
(152, 14, 1, 14, 'b', '2025-07-02 17:17:47'),
(153, 14, 1, 15, 'a', '2025-07-02 17:17:47'),
(154, 14, 2, 3, 'a', '2025-07-02 17:18:15'),
(155, 6, 1, 1, 'c', '2025-07-02 17:31:19'),
(156, 6, 1, 2, 'b', '2025-07-02 17:31:19'),
(157, 6, 1, 6, 'b', '2025-07-02 17:31:19'),
(158, 6, 1, 7, 'c', '2025-07-02 17:31:19'),
(159, 6, 1, 8, 'b', '2025-07-02 17:31:19'),
(160, 6, 1, 9, 'a', '2025-07-02 17:31:19'),
(161, 6, 1, 10, 'c', '2025-07-02 17:31:19'),
(162, 6, 1, 11, 'c', '2025-07-02 17:31:19'),
(163, 6, 1, 12, 'c', '2025-07-02 17:31:19'),
(164, 6, 1, 13, 'a', '2025-07-02 17:31:19'),
(165, 6, 1, 14, 'b', '2025-07-02 17:31:19'),
(166, 6, 1, 15, 'a', '2025-07-02 17:31:19'),
(167, 2, 3, 4, 'c', '2025-07-04 12:21:38'),
(168, 2, 4, 5, 'b', '2025-07-04 12:22:16'),
(169, 4, 3, 4, 'c', '2025-07-05 05:57:40'),
(170, 4, 4, 5, 'b', '2025-07-05 06:02:19'),
(171, 6, 2, 3, 'a', '2025-07-05 06:07:38'),
(172, 6, 3, 4, 'c', '2025-07-05 06:10:23'),
(173, 6, 4, 5, 'b', '2025-07-05 06:13:40'),
(174, 13, 3, 4, 'c', '2025-07-05 06:29:09'),
(175, 1, 3, 4, 'c', '2025-07-07 04:07:35'),
(176, 22, 1, 1, 'c', '2025-07-07 13:04:05'),
(177, 22, 1, 2, 'b', '2025-07-07 13:04:05'),
(178, 22, 1, 3, 'b', '2025-07-07 13:04:05'),
(179, 22, 1, 4, 'a', '2025-07-07 13:04:05'),
(180, 22, 1, 5, 'c', '2025-07-07 13:04:05'),
(181, 22, 1, 6, 'c', '2025-07-07 13:04:05'),
(182, 22, 1, 7, 'c', '2025-07-07 13:04:05'),
(183, 22, 1, 8, 'a', '2025-07-07 13:04:05'),
(184, 22, 1, 9, 'b', '2025-07-07 13:04:05'),
(185, 22, 1, 10, 'a', '2025-07-07 13:04:05'),
(186, 22, 2, 11, 'c', '2025-07-07 13:05:22'),
(187, 22, 2, 12, 'b', '2025-07-07 13:05:22'),
(188, 22, 2, 13, 'b', '2025-07-07 13:05:22'),
(189, 22, 2, 14, 'd', '2025-07-07 13:05:22'),
(190, 22, 2, 15, 'c', '2025-07-07 13:05:22'),
(191, 22, 2, 16, 'a', '2025-07-07 13:05:22'),
(192, 22, 2, 17, 'a', '2025-07-07 13:05:22'),
(193, 22, 2, 18, 'c', '2025-07-07 13:05:22'),
(194, 22, 2, 19, 'b', '2025-07-07 13:05:22'),
(195, 22, 2, 20, 'a', '2025-07-07 13:05:22'),
(196, 22, 3, 21, 'b', '2025-07-07 13:17:30'),
(197, 22, 3, 22, 'c', '2025-07-07 13:17:30'),
(198, 22, 3, 23, 'c', '2025-07-07 13:17:30'),
(199, 22, 3, 24, 'c', '2025-07-07 13:17:30'),
(200, 22, 3, 25, 'd', '2025-07-07 13:17:30'),
(201, 22, 3, 26, 'b', '2025-07-07 13:17:30'),
(202, 22, 3, 27, 'b', '2025-07-07 13:17:30'),
(203, 22, 3, 28, 'a', '2025-07-07 13:17:30'),
(204, 22, 3, 29, 'a', '2025-07-07 13:17:30'),
(205, 22, 3, 30, 'b', '2025-07-07 13:17:30'),
(206, 22, 4, 31, 'b', '2025-07-07 13:22:11'),
(207, 22, 4, 32, 'a', '2025-07-07 13:22:11'),
(208, 22, 4, 33, 'b', '2025-07-07 13:22:11'),
(209, 22, 4, 34, 'a', '2025-07-07 13:22:11'),
(210, 22, 4, 35, 'b', '2025-07-07 13:22:11'),
(211, 22, 4, 36, 'a', '2025-07-07 13:22:11'),
(212, 22, 4, 37, 'a', '2025-07-07 13:22:11'),
(213, 22, 4, 38, 'a', '2025-07-07 13:22:11'),
(214, 22, 4, 39, 'a', '2025-07-07 13:22:11'),
(215, 22, 4, 40, 'a', '2025-07-07 13:22:11'),
(216, 22, 5, 41, 'b', '2025-07-07 13:23:44'),
(217, 22, 5, 42, 'a', '2025-07-07 13:23:44'),
(218, 22, 5, 43, 'a', '2025-07-07 13:23:44'),
(219, 22, 5, 44, 'a', '2025-07-07 13:23:44'),
(220, 22, 5, 45, 'a', '2025-07-07 13:23:44'),
(221, 22, 5, 46, 'b', '2025-07-07 13:23:44'),
(222, 22, 5, 47, 'a', '2025-07-07 13:23:44'),
(223, 22, 5, 48, 'a', '2025-07-07 13:23:44'),
(224, 22, 5, 49, 'a', '2025-07-07 13:23:44'),
(225, 22, 5, 50, 'a', '2025-07-07 13:23:44'),
(226, 22, 6, 51, 'a', '2025-07-07 14:42:33'),
(227, 22, 6, 52, 'a', '2025-07-07 14:42:33'),
(228, 22, 6, 53, 'c', '2025-07-07 14:42:33'),
(229, 22, 6, 54, 'a', '2025-07-07 14:42:33'),
(230, 22, 6, 55, 'c', '2025-07-07 14:42:33'),
(231, 22, 6, 56, 'd', '2025-07-07 14:42:33'),
(232, 22, 6, 57, 'd', '2025-07-07 14:42:33'),
(233, 22, 6, 58, 'a', '2025-07-07 14:42:33'),
(234, 22, 6, 59, 'a', '2025-07-07 14:42:33'),
(235, 22, 6, 60, 'a', '2025-07-07 14:42:33'),
(236, 22, 6, 51, 'a', '2025-07-07 14:43:47'),
(237, 22, 6, 52, 'a', '2025-07-07 14:43:47'),
(238, 22, 6, 53, 'c', '2025-07-07 14:43:47'),
(239, 22, 6, 54, 'b', '2025-07-07 14:43:47'),
(240, 22, 6, 55, 'c', '2025-07-07 14:43:47'),
(241, 22, 6, 56, 'd', '2025-07-07 14:43:47'),
(242, 22, 6, 57, 'c', '2025-07-07 14:43:47'),
(243, 22, 6, 58, 'a', '2025-07-07 14:43:47'),
(244, 22, 6, 59, 'a', '2025-07-07 14:43:47'),
(245, 22, 6, 60, 'a', '2025-07-07 14:43:47'),
(246, 22, 6, 51, 'a', '2025-07-07 14:46:34'),
(247, 22, 6, 52, 'a', '2025-07-07 14:46:34'),
(248, 22, 6, 53, 'a', '2025-07-07 14:46:34'),
(249, 22, 6, 54, 'a', '2025-07-07 14:46:34'),
(250, 22, 6, 55, 'c', '2025-07-07 14:46:34'),
(251, 22, 6, 56, 'd', '2025-07-07 14:46:34'),
(252, 22, 6, 57, 'c', '2025-07-07 14:46:34'),
(253, 22, 6, 58, 'c', '2025-07-07 14:46:34'),
(254, 22, 6, 59, 'b', '2025-07-07 14:46:34'),
(255, 22, 6, 60, 'c', '2025-07-07 14:46:34'),
(256, 22, 6, 51, 'a', '2025-07-07 14:49:39'),
(257, 22, 6, 52, 'a', '2025-07-07 14:49:39'),
(258, 22, 6, 53, 'c', '2025-07-07 14:49:39'),
(259, 22, 6, 54, 'b', '2025-07-07 14:49:39'),
(260, 22, 6, 55, 'c', '2025-07-07 14:49:39'),
(261, 22, 6, 56, 'd', '2025-07-07 14:49:39'),
(262, 22, 6, 57, 'c', '2025-07-07 14:49:39'),
(263, 22, 6, 58, 'a', '2025-07-07 14:49:39'),
(264, 22, 6, 59, 'a', '2025-07-07 14:49:39'),
(265, 22, 6, 60, 'a', '2025-07-07 14:49:39'),
(266, 22, 6, 51, 'a', '2025-07-07 14:52:21'),
(267, 22, 6, 52, 'a', '2025-07-07 14:52:21'),
(268, 22, 6, 53, 'c', '2025-07-07 14:52:21'),
(269, 22, 6, 54, 'a', '2025-07-07 14:52:21'),
(270, 22, 6, 55, 'b', '2025-07-07 14:52:21'),
(271, 22, 6, 56, 'a', '2025-07-07 14:52:21'),
(272, 22, 6, 57, 'c', '2025-07-07 14:52:21'),
(273, 22, 6, 58, 'a', '2025-07-07 14:52:21'),
(274, 22, 6, 59, 'a', '2025-07-07 14:52:21'),
(275, 22, 6, 60, 'a', '2025-07-07 14:52:21'),
(276, 22, 6, 51, 'a', '2025-07-07 14:55:16'),
(277, 22, 6, 52, 'a', '2025-07-07 14:55:16'),
(278, 22, 6, 53, 'c', '2025-07-07 14:55:16'),
(279, 22, 6, 54, 'c', '2025-07-07 14:55:16'),
(280, 22, 6, 55, 'c', '2025-07-07 14:55:16'),
(281, 22, 6, 56, 'd', '2025-07-07 14:55:16'),
(282, 22, 6, 57, 'a', '2025-07-07 14:55:16'),
(283, 22, 6, 58, 'b', '2025-07-07 14:55:16'),
(284, 22, 6, 59, 'a', '2025-07-07 14:55:16'),
(285, 22, 6, 60, 'a', '2025-07-07 14:55:16'),
(286, 22, 6, 51, 'a', '2025-07-07 14:58:16'),
(287, 22, 6, 52, 'a', '2025-07-07 14:58:16'),
(288, 22, 6, 53, 'a', '2025-07-07 14:58:16'),
(289, 22, 6, 54, 'd', '2025-07-07 14:58:16'),
(290, 22, 6, 55, 'd', '2025-07-07 14:58:16'),
(291, 22, 6, 56, 'd', '2025-07-07 14:58:16'),
(292, 22, 6, 57, 'd', '2025-07-07 14:58:16'),
(293, 22, 6, 58, 'a', '2025-07-07 14:58:16'),
(294, 22, 6, 59, 'a', '2025-07-07 14:58:16'),
(295, 22, 6, 60, 'a', '2025-07-07 14:58:16'),
(296, 22, 6, 51, 'a', '2025-07-07 15:03:23'),
(297, 22, 6, 52, 'a', '2025-07-07 15:03:23'),
(298, 22, 6, 53, 'a', '2025-07-07 15:03:23'),
(299, 22, 6, 54, 'a', '2025-07-07 15:03:23'),
(300, 22, 6, 55, 'd', '2025-07-07 15:03:23'),
(301, 22, 6, 56, 'd', '2025-07-07 15:03:23'),
(302, 22, 6, 57, 'c', '2025-07-07 15:03:23'),
(303, 22, 6, 58, 'a', '2025-07-07 15:03:23'),
(304, 22, 6, 59, 'a', '2025-07-07 15:03:23'),
(305, 22, 6, 60, 'a', '2025-07-07 15:03:23'),
(306, 22, 6, 51, 'a', '2025-07-07 15:06:35'),
(307, 22, 6, 52, 'a', '2025-07-07 15:06:35'),
(308, 22, 6, 53, 'c', '2025-07-07 15:06:35'),
(309, 22, 6, 54, 'a', '2025-07-07 15:06:35'),
(310, 22, 6, 55, 'a', '2025-07-07 15:06:35'),
(311, 22, 6, 56, 'd', '2025-07-07 15:06:35'),
(312, 22, 6, 57, 'c', '2025-07-07 15:06:35'),
(313, 22, 6, 58, 'a', '2025-07-07 15:06:35'),
(314, 22, 6, 59, 'a', '2025-07-07 15:06:35'),
(315, 22, 6, 60, 'a', '2025-07-07 15:06:35'),
(316, 22, 6, 51, 'a', '2025-07-07 15:13:03'),
(317, 22, 6, 52, 'a', '2025-07-07 15:13:03'),
(318, 22, 6, 53, 'a', '2025-07-07 15:13:03'),
(319, 22, 6, 54, 'b', '2025-07-07 15:13:03'),
(320, 22, 6, 55, 'c', '2025-07-07 15:13:03'),
(321, 22, 6, 56, 'd', '2025-07-07 15:13:03'),
(322, 22, 6, 57, 'a', '2025-07-07 15:13:03'),
(323, 22, 6, 58, 'd', '2025-07-07 15:13:03'),
(324, 22, 6, 59, 'a', '2025-07-07 15:13:03'),
(325, 22, 6, 60, 'a', '2025-07-07 15:13:03'),
(326, 1, 4, 31, 'b', '2025-07-09 12:44:58'),
(327, 1, 4, 32, 'a', '2025-07-09 12:44:58'),
(328, 1, 4, 33, 'b', '2025-07-09 12:44:58'),
(329, 1, 4, 34, 'd', '2025-07-09 12:44:58'),
(330, 1, 4, 35, 'c', '2025-07-09 12:44:58'),
(331, 1, 4, 36, 'a', '2025-07-09 12:44:58'),
(332, 1, 4, 37, 'a', '2025-07-09 12:44:58'),
(333, 1, 4, 38, 'a', '2025-07-09 12:44:58'),
(334, 1, 4, 39, 'a', '2025-07-09 12:44:58'),
(335, 1, 4, 40, 'b', '2025-07-09 12:44:58'),
(336, 1, 5, 41, 'a', '2025-07-09 12:46:39'),
(337, 1, 5, 42, 'b', '2025-07-09 12:46:39'),
(338, 1, 5, 43, 'a', '2025-07-09 12:46:39'),
(339, 1, 5, 44, 'a', '2025-07-09 12:46:39'),
(340, 1, 5, 45, 'c', '2025-07-09 12:46:39'),
(341, 1, 5, 46, 'a', '2025-07-09 12:46:39'),
(342, 1, 5, 47, 'a', '2025-07-09 12:46:39'),
(343, 1, 5, 48, 'a', '2025-07-09 12:46:39'),
(344, 1, 5, 49, 'b', '2025-07-09 12:46:39'),
(345, 1, 5, 50, 'b', '2025-07-09 12:46:39'),
(346, 1, 6, 51, 'a', '2025-07-09 12:47:30'),
(347, 1, 6, 52, 'a', '2025-07-09 12:47:30'),
(348, 1, 6, 53, 'c', '2025-07-09 12:47:30'),
(349, 1, 6, 54, 'b', '2025-07-09 12:47:30'),
(350, 1, 6, 55, 'b', '2025-07-09 12:47:30'),
(351, 1, 6, 56, 'a', '2025-07-09 12:47:30'),
(352, 1, 6, 57, 'd', '2025-07-09 12:47:30'),
(353, 1, 6, 58, 'a', '2025-07-09 12:47:30'),
(354, 1, 6, 59, 'a', '2025-07-09 12:47:30'),
(355, 1, 6, 60, 'a', '2025-07-09 12:47:30'),
(356, 1, 7, 61, 'd', '2025-07-09 12:50:06'),
(357, 1, 7, 62, 'a', '2025-07-09 12:50:06'),
(358, 1, 7, 63, 'a', '2025-07-09 12:50:06'),
(359, 1, 7, 64, 'b', '2025-07-09 12:50:06'),
(360, 1, 7, 65, 'b', '2025-07-09 12:50:06'),
(361, 1, 7, 66, 'b', '2025-07-09 12:50:06'),
(362, 1, 7, 67, 'a', '2025-07-09 12:50:06'),
(363, 1, 7, 68, 'a', '2025-07-09 12:50:06'),
(364, 1, 7, 69, 'c', '2025-07-09 12:50:06'),
(365, 1, 7, 70, 'a', '2025-07-09 12:50:06'),
(366, 1, 8, 71, 'a', '2025-07-09 12:50:59'),
(367, 1, 8, 72, 'b', '2025-07-09 12:50:59'),
(368, 1, 8, 73, 'a', '2025-07-09 12:50:59'),
(369, 1, 8, 74, 'b', '2025-07-09 12:50:59'),
(370, 1, 8, 75, 'a', '2025-07-09 12:50:59'),
(371, 1, 8, 76, 'b', '2025-07-09 12:50:59'),
(372, 1, 8, 77, 'b', '2025-07-09 12:50:59'),
(373, 1, 8, 78, 'c', '2025-07-09 12:50:59'),
(374, 1, 8, 79, 'c', '2025-07-09 12:50:59'),
(375, 1, 8, 80, 'a', '2025-07-09 12:50:59'),
(376, 1, 9, 81, 'b', '2025-07-09 12:53:15'),
(377, 1, 9, 82, 'a', '2025-07-09 12:53:15'),
(378, 1, 9, 83, 'a', '2025-07-09 12:53:15'),
(379, 1, 9, 84, 'c', '2025-07-09 12:53:15'),
(380, 1, 9, 85, 'a', '2025-07-09 12:53:15'),
(381, 1, 9, 86, 'b', '2025-07-09 12:53:15'),
(382, 1, 9, 87, 'c', '2025-07-09 12:53:15'),
(383, 1, 9, 88, 'a', '2025-07-09 12:53:15'),
(384, 1, 9, 89, 'a', '2025-07-09 12:53:15'),
(385, 1, 9, 90, 'a', '2025-07-09 12:53:15'),
(386, 1, 10, 91, 'b', '2025-07-09 12:53:57'),
(387, 1, 10, 92, 'c', '2025-07-09 12:53:57'),
(388, 1, 10, 93, 'b', '2025-07-09 12:53:57'),
(389, 1, 10, 94, 'a', '2025-07-09 12:53:57'),
(390, 1, 10, 95, 'a', '2025-07-09 12:53:57'),
(391, 1, 10, 96, 'a', '2025-07-09 12:53:57'),
(392, 1, 10, 97, 'a', '2025-07-09 12:53:57'),
(393, 1, 10, 98, 'b', '2025-07-09 12:53:57'),
(394, 1, 10, 99, 'c', '2025-07-09 12:53:57'),
(395, 1, 10, 100, 'b', '2025-07-09 12:53:57'),
(396, 23, 1, 1, 'c', '2025-07-11 06:08:03'),
(397, 23, 1, 2, 'b', '2025-07-11 06:08:03'),
(398, 23, 1, 3, 'b', '2025-07-11 06:08:03'),
(399, 23, 1, 4, 'd', '2025-07-11 06:08:03'),
(400, 23, 1, 5, 'c', '2025-07-11 06:08:03'),
(401, 23, 1, 6, 'c', '2025-07-11 06:08:03'),
(402, 23, 1, 7, 'c', '2025-07-11 06:08:03'),
(403, 23, 1, 8, 'a', '2025-07-11 06:08:03'),
(404, 23, 1, 9, 'b', '2025-07-11 06:08:03'),
(405, 23, 1, 10, 'a', '2025-07-11 06:08:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_chapter_progress`
--

CREATE TABLE `user_chapter_progress` (
  `id_progress` int NOT NULL,
  `id_user` int NOT NULL,
  `id_chapter` int NOT NULL,
  `nilai` int DEFAULT '0',
  `sudah_selesai` tinyint(1) DEFAULT '0',
  `waktu_selesai` datetime DEFAULT CURRENT_TIMESTAMP,
  `xp_didapat` int DEFAULT '0',
  `coin_didapat` int DEFAULT '0',
  `xp_replay_reward` int DEFAULT '0',
  `coin_replay_reward` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user_chapter_progress`
--

INSERT INTO `user_chapter_progress` (`id_progress`, `id_user`, `id_chapter`, `nilai`, `sudah_selesai`, `waktu_selesai`, `xp_didapat`, `coin_didapat`, `xp_replay_reward`, `coin_replay_reward`) VALUES
(1, 1, 1, 50, 1, '2025-06-29 18:08:55', 0, 0, 0, 0),
(1, 1, 2, 100, 1, '2025-06-29 18:06:29', 0, 0, 0, 0),
(1, 1, 3, 100, 1, '2025-07-07 04:07:35', 0, 0, 0, 0),
(1, 1, 4, 70, 1, '2025-07-09 12:44:58', 56, 5, 0, 0),
(1, 1, 5, 90, 1, '2025-07-09 12:46:39', 81, 8, 0, 0),
(1, 1, 6, 70, 1, '2025-07-09 12:47:30', 70, 7, 0, 0),
(1, 1, 7, 100, 1, '2025-07-09 12:50:06', 110, 12, 0, 0),
(1, 1, 8, 100, 1, '2025-07-09 12:50:59', 120, 14, 0, 0),
(1, 1, 9, 100, 1, '2025-07-09 12:53:15', 130, 16, 0, 0),
(1, 1, 10, 100, 1, '2025-07-09 12:53:57', 150, 20, 0, 0),
(1, 2, 1, 100, 1, '2025-06-30 00:17:32', 0, 0, 0, 0),
(1, 2, 2, 100, 1, '2025-06-30 00:17:52', 0, 0, 0, 0),
(1, 2, 3, 100, 1, '2025-07-04 12:21:38', 0, 0, 0, 0),
(1, 2, 4, 100, 1, '2025-07-04 12:22:16', 0, 0, 0, 0),
(1, 4, 1, 100, 1, '2025-06-30 00:33:16', 0, 0, 0, 0),
(1, 4, 2, 100, 1, '2025-06-30 00:37:32', 0, 0, 0, 0),
(1, 4, 3, 100, 1, '2025-07-05 05:57:40', 0, 0, 0, 0),
(1, 4, 4, 100, 1, '2025-07-05 06:02:19', 0, 0, 0, 0),
(1, 6, 1, 100, 1, '2025-07-02 17:31:19', 0, 0, 0, 0),
(1, 6, 2, 100, 1, '2025-07-05 06:07:38', 0, 0, 0, 0),
(1, 6, 3, 100, 1, '2025-07-05 06:10:23', 0, 0, 0, 0),
(1, 6, 4, 100, 1, '2025-07-05 06:13:40', 0, 0, 0, 0),
(1, 8, 1, 100, 1, '2025-06-30 01:53:51', 0, 0, 0, 0),
(1, 9, 1, 100, 1, '2025-06-30 03:55:00', 0, 0, 0, 0),
(1, 9, 2, 100, 1, '2025-06-30 04:43:16', 0, 0, 0, 0),
(1, 10, 1, 100, 1, '2025-06-30 04:50:34', 0, 0, 0, 0),
(1, 10, 2, 100, 1, '2025-06-30 04:51:12', 0, 0, 0, 0),
(1, 11, 1, 100, 1, '2025-07-01 16:07:21', 0, 0, 0, 0),
(1, 13, 1, 100, 1, '2025-07-01 23:46:17', 0, 0, 0, 0),
(1, 13, 2, 0, 1, '2025-07-01 23:48:00', 0, 0, 0, 0),
(1, 13, 3, 100, 1, '2025-07-05 06:29:09', 0, 0, 0, 0),
(1, 14, 1, 100, 1, '2025-07-02 17:17:47', 0, 0, 0, 0),
(1, 14, 2, 100, 1, '2025-07-02 17:18:15', 0, 0, 0, 0),
(1, 15, 1, 50, 1, '2025-07-02 03:33:47', 0, 0, 0, 0),
(1, 15, 2, 100, 1, '2025-07-02 03:38:15', 0, 0, 0, 0),
(1, 16, 1, 100, 1, '2025-07-02 11:53:48', 0, 0, 0, 0),
(1, 16, 2, 100, 1, '2025-07-02 11:58:50', 0, 0, 0, 0),
(1, 17, 1, 92, 1, '2025-07-02 16:25:16', 0, 0, 0, 0),
(1, 18, 1, 100, 1, '2025-07-02 16:30:54', 0, 0, 0, 0),
(1, 22, 1, 100, 1, '2025-07-07 13:04:05', 0, 0, 0, 0),
(1, 22, 2, 70, 1, '2025-07-07 13:05:22', 0, 0, 0, 0),
(1, 22, 3, 70, 1, '2025-07-07 13:17:30', 0, 0, 0, 0),
(1, 22, 4, 60, 1, '2025-07-07 13:22:11', 48, 4, 0, 0),
(1, 22, 5, 40, 1, '2025-07-07 13:23:44', 36, 3, 0, 0),
(1, 22, 6, 80, 1, '2025-07-07 14:42:33', 80, 8, 70, 7),
(1, 23, 1, 90, 1, '2025-07-11 06:08:03', 45, 4, 0, 0),
(2, 1, 3, 100, 1, '2025-06-29 17:18:50', 0, 0, 0, 0),
(2, 2, 3, 0, 1, '2025-06-30 00:18:45', 0, 0, 0, 0),
(2, 4, 3, 100, 1, '2025-06-30 00:28:56', 0, 0, 0, 0),
(2, 9, 3, 100, 1, '2025-06-30 03:49:16', 0, 0, 0, 0),
(2, 10, 3, 100, 1, '2025-06-30 10:29:49', 0, 0, 0, 0),
(2, 13, 3, 0, 1, '2025-07-01 17:12:20', 0, 0, 0, 0),
(2, 15, 3, 0, 1, '2025-07-02 03:38:44', 0, 0, 0, 0),
(3, 1, 4, 0, 1, '2025-06-29 17:07:41', 0, 0, 0, 0),
(3, 2, 4, 100, 1, '2025-06-30 00:27:05', 0, 0, 0, 0),
(3, 4, 4, 100, 1, '2025-06-30 00:32:36', 0, 0, 0, 0),
(3, 5, 4, 100, 1, '2025-06-30 00:48:15', 0, 0, 0, 0),
(3, 6, 4, 100, 1, '2025-06-30 00:57:42', 0, 0, 0, 0),
(3, 8, 4, 100, 1, '2025-06-30 01:53:00', 0, 0, 0, 0),
(3, 9, 4, 100, 1, '2025-06-30 03:48:01', 0, 0, 0, 0),
(3, 13, 4, 100, 1, '2025-07-01 23:45:45', 0, 0, 0, 0),
(3, 15, 4, 100, 1, '2025-07-02 11:47:17', 0, 0, 0, 0),
(4, 12, 4, 0, 1, '2025-07-01 23:27:21', 0, 0, 0, 0),
(5, 12, 3, 100, 1, '2025-07-01 23:30:20', 0, 0, 0, 0),
(6, 12, 1, 50, 1, '2025-07-01 23:33:22', 0, 0, 0, 0),
(7, 13, 3, 0, 1, '2025-07-02 00:10:45', 0, 0, 0, 0),
(8, 13, 3, 0, 1, '2025-07-02 00:11:49', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_items`
--

CREATE TABLE `user_items` (
  `id_user_item` int NOT NULL,
  `id_user` int NOT NULL,
  `id_item` int NOT NULL,
  `jumlah` int DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user_items`
--

INSERT INTO `user_items` (`id_user_item`, `id_user`, `id_item`, `jumlah`) VALUES
(1, 1, 2, 0),
(2, 4, 2, 0),
(3, 4, 1, 0),
(4, 4, 4, 1),
(5, 6, 1, 1),
(6, 6, 2, 1),
(7, 6, 4, 1),
(8, 14, 1, 1),
(9, 14, 2, 1),
(10, 14, 4, 0),
(11, 13, 1, 1),
(12, 13, 2, 1),
(13, 13, 4, 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`id_achievement`);

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `boss_questions`
--
ALTER TABLE `boss_questions`
  ADD PRIMARY KEY (`id_question`);

--
-- Indeks untuk tabel `boss_quests`
--
ALTER TABLE `boss_quests`
  ADD PRIMARY KEY (`id_boss`);

--
-- Indeks untuk tabel `boss_results`
--
ALTER TABLE `boss_results`
  ADD PRIMARY KEY (`id_result`);

--
-- Indeks untuk tabel `challenge_scores`
--
ALTER TABLE `challenge_scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `quests`
--
ALTER TABLE `quests`
  ADD PRIMARY KEY (`id_quest`);

--
-- Indeks untuk tabel `quest_chapters`
--
ALTER TABLE `quest_chapters`
  ADD PRIMARY KEY (`id_chapter`),
  ADD KEY `id_quest` (`id_quest`);

--
-- Indeks untuk tabel `quest_questions`
--
ALTER TABLE `quest_questions`
  ADD PRIMARY KEY (`id_question`),
  ADD KEY `id_chapter` (`id_chapter`);

--
-- Indeks untuk tabel `shop_items`
--
ALTER TABLE `shop_items`
  ADD PRIMARY KEY (`id_item`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `user_achievements`
--
ALTER TABLE `user_achievements`
  ADD PRIMARY KEY (`id_user`,`id_achievement`),
  ADD KEY `id_achievement` (`id_achievement`);

--
-- Indeks untuk tabel `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_chapter_progress`
--
ALTER TABLE `user_chapter_progress`
  ADD PRIMARY KEY (`id_progress`,`id_user`,`id_chapter`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_chapter` (`id_chapter`);

--
-- Indeks untuk tabel `user_items`
--
ALTER TABLE `user_items`
  ADD PRIMARY KEY (`id_user_item`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_item` (`id_item`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `achievements`
--
ALTER TABLE `achievements`
  MODIFY `id_achievement` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `boss_questions`
--
ALTER TABLE `boss_questions`
  MODIFY `id_question` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `boss_quests`
--
ALTER TABLE `boss_quests`
  MODIFY `id_boss` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `boss_results`
--
ALTER TABLE `boss_results`
  MODIFY `id_result` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `challenge_scores`
--
ALTER TABLE `challenge_scores`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `quests`
--
ALTER TABLE `quests`
  MODIFY `id_quest` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `quest_chapters`
--
ALTER TABLE `quest_chapters`
  MODIFY `id_chapter` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `quest_questions`
--
ALTER TABLE `quest_questions`
  MODIFY `id_question` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT untuk tabel `shop_items`
--
ALTER TABLE `shop_items`
  MODIFY `id_item` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=406;

--
-- AUTO_INCREMENT untuk tabel `user_chapter_progress`
--
ALTER TABLE `user_chapter_progress`
  MODIFY `id_progress` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user_items`
--
ALTER TABLE `user_items`
  MODIFY `id_user_item` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `challenge_scores`
--
ALTER TABLE `challenge_scores`
  ADD CONSTRAINT `challenge_scores_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `quest_chapters`
--
ALTER TABLE `quest_chapters`
  ADD CONSTRAINT `quest_chapters_ibfk_1` FOREIGN KEY (`id_quest`) REFERENCES `quests` (`id_quest`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `quest_questions`
--
ALTER TABLE `quest_questions`
  ADD CONSTRAINT `quest_questions_ibfk_1` FOREIGN KEY (`id_chapter`) REFERENCES `quest_chapters` (`id_chapter`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_achievements`
--
ALTER TABLE `user_achievements`
  ADD CONSTRAINT `user_achievements_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_achievements_ibfk_2` FOREIGN KEY (`id_achievement`) REFERENCES `achievements` (`id_achievement`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_chapter_progress`
--
ALTER TABLE `user_chapter_progress`
  ADD CONSTRAINT `user_chapter_progress_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_chapter_progress_ibfk_2` FOREIGN KEY (`id_chapter`) REFERENCES `quest_chapters` (`id_chapter`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_items`
--
ALTER TABLE `user_items`
  ADD CONSTRAINT `user_items_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `user_items_ibfk_2` FOREIGN KEY (`id_item`) REFERENCES `shop_items` (`id_item`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
