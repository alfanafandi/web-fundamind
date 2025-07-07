-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 07, 2025 at 04:17 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

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
-- Table structure for table `achievements`
--

CREATE TABLE `achievements` (
  `id_achievement` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `syarat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `achievements`
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$dNrlKR30J5RPxtkC21AtQuVRbPFFJpHo3P4/HOxwLW1lqhg3OI/Wi');

-- --------------------------------------------------------

--
-- Table structure for table `boss_questions`
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
-- Dumping data for table `boss_questions`
--

INSERT INTO `boss_questions` (`id_question`, `id_boss`, `pertanyaan`, `pilihan_a`, `pilihan_b`, `pilihan_c`, `pilihan_d`, `jawaban_benar`, `petunjuk`) VALUES
(1, 1, 'Berapa hasil dari 15 + (6 × 2) – 3?', '30', '24', '15', '12', 'b', 'Kerjakan operasi dalam kurung terlebih dahulu.'),
(2, 1, 'Manakah bentuk yang ekuivalen dengan 3 × (4 + 2)?', '3 × 6', '4 × 3 + 2', '12 + 2', '3 + 4 + 2', 'a', 'Gunakan sifat distributif.'),
(3, 1, 'Jika x = 5, berapakah nilai dari 2x² – x?', '45', '35', '25', '15', 'b', 'Gunakan x² terlebih dahulu lalu kalikan.'),
(4, 2, 'Berapakah nilai biner dari angka 13?', '1101', '1010', '1110', '1001', 'a', 'Ubah ke biner: 8 + 4 + 1 = 13.'),
(5, 2, 'Berapakah 1011 (biner) dalam desimal?', '10', '11', '12', '13', 'b', '1×8 + 0×4 + 1×2 + 1×1 = ?'),
(6, 2, 'Manakah hasil dari operasi AND antara 1101 dan 1011?', '1101', '1001', '1111', '1011', 'b', 'Gunakan tabel kebenaran AND.'),
(7, 3, 'Manakah yang ekuivalen dengan 3/4?', '6/8', '2/3', '9/12', '5/6', 'a', 'Kalikan pembilang dan penyebut.'),
(8, 3, 'Berapa hasil dari 2/5 + 1/10?', '3/10', '1/2', '1/5', '2/10', 'b', 'Samakan penyebut terlebih dahulu.'),
(9, 3, '1/2 dikurangi 1/4 sama dengan?', '1/4', '1/2', '3/4', '2/4', 'a', 'Samakan penyebut: 2/4 – 1/4');

-- --------------------------------------------------------

--
-- Table structure for table `boss_quests`
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
-- Dumping data for table `boss_quests`
--

INSERT INTO `boss_quests` (`id_boss`, `id_quest`, `nama_boss`, `chapter_start`, `chapter_end`, `deskripsi_boss`, `background_image`, `boss_image`, `xp_reward`, `coin_reward`) VALUES
(1, 1, 'Penjaga Gerbang', 1, 3, 'Sang penjaga Aksara yang mengamuk karena matematika dilupakan.', 'boss_background_1.jpg', 'boss_1.jpg', 50, 25),
(2, 1, 'Raja Pecahan', 4, 6, 'Naga yang menjaga pintu menuju dunia digital. Hanya dapat ditaklukkan dengan logika biner.', 'boss_background_2.jpg', 'boss_2.jpg', 70, 35),
(3, 1, 'Dewa Persamaan', 7, 9, 'Penguasa pecahan yang menguji seberapa dalam pemahamanmu terhadap rasionalitas angka.', 'boss_background_3.jpg', 'boss_3.jpg', 100, 50),
(4, 1, 'Makhluk Akar Misteri', 10, 12, 'Makhluk misterius dari akar-akar hitam yang hanya muncul saat kekuatan matematika terganggu.', 'boss_background_4.jpg', 'boss_4.jpg', 120, 60);

-- --------------------------------------------------------

--
-- Table structure for table `boss_results`
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
-- Dumping data for table `boss_results`
--

INSERT INTO `boss_results` (`id_result`, `id_user`, `id_boss`, `jumlah_benar`, `total_soal`, `xp_didapat`, `coin_didapat`, `tanggal`) VALUES
(1, 2, 4, 0, 0, 120, 60, '2025-07-04 22:39:02'),
(2, 1, 1, 3, 3, 50, 25, '2025-07-06 18:00:44');

-- --------------------------------------------------------

--
-- Table structure for table `challenge_scores`
--

CREATE TABLE `challenge_scores` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `score` int NOT NULL,
  `waktu` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `challenge_scores`
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
(9, 13, 50, '2025-07-05 13:30:35');

-- --------------------------------------------------------

--
-- Stand-in structure for view `leaderboard_challenge_today`
-- (See below for the actual view)
--
CREATE TABLE `leaderboard_challenge_today` (
);

-- --------------------------------------------------------

--
-- Table structure for table `quests`
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
-- Dumping data for table `quests`
--

INSERT INTO `quests` (`id_quest`, `judul`, `deskripsi`, `kategori`, `xp_reward`, `coin_reward`, `gambar_icon`, `tersedia`, `mulai_event`, `akhir_event`) VALUES
(1, 'Awal Petualangan', 'Mulai petualanganmu di dunia Fundamind!', 'story', 100, 50, 'Ruin_of_Math 1.png', 1, NULL, NULL),
(2, 'Chalenge Harian', 'Tantang dirimu hari ini', 'challenge', 20, 10, 'The_Shattered_Aksara 1.png', 1, NULL, NULL),
(3, 'Boss Bulanan', 'Kalahkan boss bulan ini!', 'boss_battle', 200, 100, 'The_Five_Crystals_of_Unity 1.png', 1, '2025-06-01', '2025-06-30');

-- --------------------------------------------------------

--
-- Table structure for table `quest_chapters`
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
-- Dumping data for table `quest_chapters`
--

INSERT INTO `quest_chapters` (`id_chapter`, `id_quest`, `nomor_chapter`, `judul_chapter`, `deskripsi`, `coin_reward`, `xp_reward`) VALUES
(1, 1, 1, 'Gerbang Bilangan', 'Chapter awal dari Ruin of Math: mengenal bilangan dan logika dasar.', 50, 30),
(2, 1, 2, 'Rahasia Pecahan', 'Lanjutkan petualangan dengan memahami pecahan dan desimal.', 50, 30),
(3, 1, 3, 'Latihan Harian 1', 'Kumpulan soal logika dasar untuk melatih otak setiap hari.', 50, 30),
(4, 1, 4, 'Kristal Logika', 'Tantangan berat untuk menguji kemampuan berpikir kritis.', 50, 30);

-- --------------------------------------------------------

--
-- Table structure for table `quest_questions`
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
  `min_level` int DEFAULT '1',
  `kategori` enum('story','challenge','boss') NOT NULL DEFAULT 'story'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `quest_questions`
--

INSERT INTO `quest_questions` (`id_question`, `id_chapter`, `pertanyaan`, `pilihan_a`, `pilihan_b`, `pilihan_c`, `pilihan_d`, `jawaban_benar`, `petunjuk`, `min_level`, `kategori`) VALUES
(1, 1, 'Berapakah hasil dari 7 + 5?', '20', '11', '12', '13', 'c', 'Penjumlahan dasar: 7 ditambah 5.', 1, 'story'),
(2, 1, 'Bilangan genap di bawah 10 adalah...', '1,3,5,7,9', '2,4,6,8', '2,3,5,7', '1,2,3,4', 'b', 'Bilangan genap habis dibagi 2.', 1, 'story'),
(3, 2, '1/2 + 1/4 = ?', '3/4', '2/6', '5/8', '1/3', 'a', 'Samakan penyebut dulu, lalu jumlahkan pembilang.', 1, 'story'),
(4, 3, 'Huruf ke-3 dalam kata \"FUNDAMIND\" adalah...', 'F', 'U', 'N', 'D', 'c', 'Ingat indeks huruf dimulai dari 1.', 1, 'story'),
(5, 4, 'Jika x + 3 = 7, maka x adalah...', '3', '4', '5', '6', 'b', 'Kurangkan 3 dari kedua sisi.', 1, 'story'),
(6, 1, 'Berapakah hasil dari 12 + 7 × 2?', '38', '26', '17', '33', 'b', 'Ingat urutan operasi matematika: kerjakan perkalian terlebih dahulu, 7×2=14, lalu 12+14=26.', 1, 'story'),
(7, 1, 'Jika x = 4, maka nilai dari 3x + 5 adalah?', '12', '15', '17', '21', 'c', 'Ganti x dengan 4: 3×4 + 5 = 12 + 5 = 17.', 1, 'story'),
(8, 1, 'Hasil dari 8² adalah?', '16', '64', '32', '48', 'b', '8² artinya 8 × 8 = 64.', 2, 'story'),
(9, 1, 'Berapakah akar kuadrat dari 121?', '11', '12', '13', '10', 'a', '√121 = 11, karena 11×11 = 121.', 2, 'story'),
(10, 1, 'Jika 3a = 18, maka a = ?', '3', '5', '6', '9', 'c', 'Bagi kedua sisi dengan 3: a = 18 ÷ 3 = 6.', 1, 'story'),
(11, 1, 'Sebuah segitiga memiliki alas 10 cm dan tinggi 8 cm. Luasnya adalah?', '80', '45', '40', '60', 'c', 'Luas = ½ × alas × tinggi = ½ × 10 × 8 = 40 cm².', 2, 'story'),
(12, 1, 'Berapakah hasil dari 3³?', '6', '9', '27', '12', 'c', '3³ artinya 3×3×3 = 27.', 2, 'story'),
(13, 1, 'Selesaikan: 2(5 + 3) = ?', '16', '13', '10', '8', 'a', 'Hitung dalam kurung dulu: 5+3=8, lalu 2×8=16.', 1, 'story'),
(14, 1, 'Jika luas persegi adalah 49 cm², panjang sisinya adalah?', '6 cm', '7 cm', '8 cm', '9 cm', 'b', 'Sisi = √49 = 7 cm.', 2, 'story'),
(15, 1, 'Perbandingan umur Ali dan Budi adalah 2:3. Jika umur Budi 15 tahun, umur Ali adalah?', '10', '12', '13', '9', 'a', 'Gunakan perbandingan: (2/3)×15 = 10.', 3, 'story');

-- --------------------------------------------------------

--
-- Table structure for table `shop_items`
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
-- Dumping data for table `shop_items`
--

INSERT INTO `shop_items` (`id_item`, `nama_item`, `tipe_item`, `deskripsi`, `harga_coin`, `file_icon`, `tersedia`, `level_minimal`, `sekali_pakai`) VALUES
(1, 'Knowledge Scroll', 'booster', 'Tambah 15 XP', 15, 'xp.png', 1, 1, 1),
(2, 'Insight Orb', 'hint', 'Tampilkan petunjuk di soal', 10, 'magnify.png', 1, 1, 1),
(3, 'Portal Pass', 'skip', 'Lewati satu soal', 15, 'skip.png', 1, 3, 1),
(4, 'Chrono Clock', 'booster', 'Tambahan waktu 30 detik (Challenge)', 10, 'time.png', 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
  `coin` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `avatar`, `bio`, `level`, `xp`, `xp_next`, `coin`) VALUES
(1, 'alfan', '$2y$10$eNcym8v.DSFaXEAomZHsreZ7PAoT0H.u91aedYnV5cS5Tb9IFj0V.', 'Ellipse_2.png', 'Fundamind is an innovative platform dedicated to revolutionizing digital education through gamified learning experiences. With a team of passionate educators and game developers, we create immersive environments where knowledge meets entertainment. Our mission is to make learning addictive by combining educational rigor with engaging gameplay mechanics. Since our founding in 2022, we\'ve helped over 50,000 users worldwide level up their skills in programming, design, and critical thinking. We believe education should be as compelling as your favorite video game, which is why we\'ve developed proprietary learning algorithms that adapt to each user\'s progress. Join our growing community of lifelong learners and start your knowledge adventure today!', 3, 27, 300, 233),
(2, 'gayuh', '$2y$10$wfBKoyfoWxNp0hDHZ7SdMOQAIszNO7DDX0xtvuL0CFmg/1XwxmH7S', 'Ellipse_2.png', 'dda', 4, 260, 400, 399),
(4, 'afandi', '$2y$10$6vNvY1gV2BQrg1ndOti1Lu/OkUAAvm4BXUrxy3HY3fWL7HgprzxEO', 'Ellipse_1.png', NULL, 3, 21, 300, 206),
(5, 'pratama', '$2y$10$DpFGJZzwQMY/nHQ9fmGiZuLunbWQU/xQSoxc5pzOpc3p.b/Pct7zi', 'Ellipse_1.png', NULL, 3, 50, 300, 350),
(6, 'putra', '$2y$10$K5m/qEeiGY1AcLGYpxXgKOC1Tt6kRw3I9SjyXoDJR7k1SkIeT4.zG', 'Ellipse_1.png', NULL, 4, 85, 400, 278),
(7, 'hegel', '$2y$10$hjgTf7qJdtceb1PzRqmYfOBEFUtAYZ8nBV1IyijlUfdWoEgzAwxeu', 'Ellipse_1.png', NULL, 1, 0, 100, 0),
(8, 'hegel123', '$2y$10$cQ7kSuZ1Gb7kLq84V3AtsOM5X5BCKiRBb6E1.IE/g9EdwaHNRm7sW', 'Ellipse_3.png', 'hgel disini', 2, 160, 200, 190),
(9, 'bang', '$2y$10$lRQ9h1vc98yhcp5Mpq22xupYZXrD2NQho7An3iod9CXDaa98YFEN6', 'Ellipse_5.png', 'Bang disini', 3, 140, 300, 340),
(10, 'bongong', '$2y$10$rQ1RHJ8rnjhmx1XUeo8EmO/ZMhdRH08wx1EwYio2RcztAJZY55JzK', 'Ellipse_3.png', '', 2, 110, 200, 190),
(11, 'nana', '$2y$10$vsus94EqAfNm0eLm9PPd3.83CHkGL2Zhaho7ya.W5BWLxwDl217hS', 'Ellipse_1.png', NULL, 1, 30, 100, 50),
(12, 'koko', '$2y$10$mckJA6MIBFYZsxW4NURJWeD7ewMs5l652wPBzBDS7WJmr4jywF1gG', 'Ellipse_1.png', NULL, 1, 0, 100, 0),
(13, 'mm', '$2y$10$JL9GEyJ/p7brXtRVzRxtPexO0ubXg7s1qMo5vn69HLwx3zdoeZzk.', 'Ellipse_1.png', NULL, 2, 75, 200, 40),
(14, 'aa', '$2y$10$kDrGXpSgrTEvuHZheWZFy.KpVy21pDpQVNcFurB9k5CvmoYt8fm9K', 'Ellipse_1.png', NULL, 2, 76, 100, 88),
(15, 'iqbal', '$2y$10$mBXBhrZMbAtSRbGwZ37I4uPO8pYOsSQjEXuj.RMTB.tMTHN3cWNEq', 'Ellipse_3.png', 'iqbal disini', 1, 78, 100, 15),
(16, 'culprit', '$2y$10$H0qMwSYohKd7fmcpD9.eSuKjSA3zwySGIH6geLJRAKIaJUgXkkOle', 'Ellipse_1.png', NULL, 1, 140, 100, 130),
(17, 'jj', '$2y$10$5WnRq6J1dT6vmWClrDUOZe8PkNG0WLOd5XWMzGnrVBVqDbVOVWtB6', 'Ellipse_1.png', NULL, 1, 30, 100, 50),
(18, 'kk', '$2y$10$dEp4nYRrWDjNvpNH3l18Eeixp5ecsDoo67cj.4STM6EWd32TOO52e', 'Ellipse_1.png', NULL, 1, 30, 100, 50),
(19, 'v', '$2y$10$mzbEsgL7wtJU8UxrlIPb1O4.B3eOT0jBTtM033Dzlqdg4raHHbV.y', 'Ellipse_1.png', NULL, 1, 0, 100, 0),
(20, '1', '$2y$10$magoWxjoEdJONPFvhgUGRegqBNP5ggvP.R0zcRBa/wo1U3KxYyC7C', 'Ellipse_1.png', NULL, 1, 0, 100, 0),
(21, '2', '$2y$10$tARcXoPn/blk0H4uHfJrB.neDYULxGuvOlucuf92qjksWNdmWWSg.', 'Ellipse_1.png', NULL, 1, 0, 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_achievements`
--

CREATE TABLE `user_achievements` (
  `id_user` int NOT NULL,
  `id_achievement` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_achievements`
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
(1, 2),
(2, 2),
(8, 2),
(9, 2),
(15, 2),
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
(16, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user_answers`
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
-- Dumping data for table `user_answers`
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
(175, 1, 3, 4, 'c', '2025-07-07 04:07:35');

-- --------------------------------------------------------

--
-- Table structure for table `user_chapter_progress`
--

CREATE TABLE `user_chapter_progress` (
  `id_progress` int NOT NULL,
  `id_user` int NOT NULL,
  `id_chapter` int NOT NULL,
  `nilai` int DEFAULT '0',
  `sudah_selesai` tinyint(1) DEFAULT '0',
  `waktu_selesai` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_chapter_progress`
--

INSERT INTO `user_chapter_progress` (`id_progress`, `id_user`, `id_chapter`, `nilai`, `sudah_selesai`, `waktu_selesai`) VALUES
(1, 1, 1, 50, 1, '2025-06-29 18:08:55'),
(1, 1, 2, 100, 1, '2025-06-29 18:06:29'),
(1, 1, 3, 100, 1, '2025-07-07 04:07:35'),
(1, 2, 1, 100, 1, '2025-06-30 00:17:32'),
(1, 2, 2, 100, 1, '2025-06-30 00:17:52'),
(1, 2, 3, 100, 1, '2025-07-04 12:21:38'),
(1, 2, 4, 100, 1, '2025-07-04 12:22:16'),
(1, 4, 1, 100, 1, '2025-06-30 00:33:16'),
(1, 4, 2, 100, 1, '2025-06-30 00:37:32'),
(1, 4, 3, 100, 1, '2025-07-05 05:57:40'),
(1, 4, 4, 100, 1, '2025-07-05 06:02:19'),
(1, 6, 1, 100, 1, '2025-07-02 17:31:19'),
(1, 6, 2, 100, 1, '2025-07-05 06:07:38'),
(1, 6, 3, 100, 1, '2025-07-05 06:10:23'),
(1, 6, 4, 100, 1, '2025-07-05 06:13:40'),
(1, 8, 1, 100, 1, '2025-06-30 01:53:51'),
(1, 9, 1, 100, 1, '2025-06-30 03:55:00'),
(1, 9, 2, 100, 1, '2025-06-30 04:43:16'),
(1, 10, 1, 100, 1, '2025-06-30 04:50:34'),
(1, 10, 2, 100, 1, '2025-06-30 04:51:12'),
(1, 11, 1, 100, 1, '2025-07-01 16:07:21'),
(1, 13, 1, 100, 1, '2025-07-01 23:46:17'),
(1, 13, 2, 0, 1, '2025-07-01 23:48:00'),
(1, 13, 3, 100, 1, '2025-07-05 06:29:09'),
(1, 14, 1, 100, 1, '2025-07-02 17:17:47'),
(1, 14, 2, 100, 1, '2025-07-02 17:18:15'),
(1, 15, 1, 50, 1, '2025-07-02 03:33:47'),
(1, 15, 2, 100, 1, '2025-07-02 03:38:15'),
(1, 16, 1, 100, 1, '2025-07-02 11:53:48'),
(1, 16, 2, 100, 1, '2025-07-02 11:58:50'),
(1, 17, 1, 92, 1, '2025-07-02 16:25:16'),
(1, 18, 1, 100, 1, '2025-07-02 16:30:54'),
(2, 1, 3, 100, 1, '2025-06-29 17:18:50'),
(2, 2, 3, 0, 1, '2025-06-30 00:18:45'),
(2, 4, 3, 100, 1, '2025-06-30 00:28:56'),
(2, 9, 3, 100, 1, '2025-06-30 03:49:16'),
(2, 10, 3, 100, 1, '2025-06-30 10:29:49'),
(2, 13, 3, 0, 1, '2025-07-01 17:12:20'),
(2, 15, 3, 0, 1, '2025-07-02 03:38:44'),
(3, 1, 4, 0, 1, '2025-06-29 17:07:41'),
(3, 2, 4, 100, 1, '2025-06-30 00:27:05'),
(3, 4, 4, 100, 1, '2025-06-30 00:32:36'),
(3, 5, 4, 100, 1, '2025-06-30 00:48:15'),
(3, 6, 4, 100, 1, '2025-06-30 00:57:42'),
(3, 8, 4, 100, 1, '2025-06-30 01:53:00'),
(3, 9, 4, 100, 1, '2025-06-30 03:48:01'),
(3, 13, 4, 100, 1, '2025-07-01 23:45:45'),
(3, 15, 4, 100, 1, '2025-07-02 11:47:17'),
(4, 12, 4, 0, 1, '2025-07-01 23:27:21'),
(5, 12, 3, 100, 1, '2025-07-01 23:30:20'),
(6, 12, 1, 50, 1, '2025-07-01 23:33:22'),
(7, 13, 3, 0, 1, '2025-07-02 00:10:45'),
(8, 13, 3, 0, 1, '2025-07-02 00:11:49');

-- --------------------------------------------------------

--
-- Table structure for table `user_items`
--

CREATE TABLE `user_items` (
  `id_user_item` int NOT NULL,
  `id_user` int NOT NULL,
  `id_item` int NOT NULL,
  `jumlah` int DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_items`
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

-- --------------------------------------------------------

--
-- Structure for view `leaderboard_challenge_today`
--
DROP TABLE IF EXISTS `leaderboard_challenge_today`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `leaderboard_challenge_today`  AS SELECT `ca`.`id_user` AS `id_user`, `u`.`username` AS `username`, max(`ca`.`skor`) AS `top_score` FROM (`challenge_attempts` `ca` join `users` `u` on((`u`.`id_user` = `ca`.`id_user`))) WHERE (`ca`.`tanggal` = curdate()) GROUP BY `ca`.`id_user` ORDER BY `top_score` DESC LIMIT 0, 1010  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`id_achievement`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `boss_questions`
--
ALTER TABLE `boss_questions`
  ADD PRIMARY KEY (`id_question`);

--
-- Indexes for table `boss_quests`
--
ALTER TABLE `boss_quests`
  ADD PRIMARY KEY (`id_boss`);

--
-- Indexes for table `boss_results`
--
ALTER TABLE `boss_results`
  ADD PRIMARY KEY (`id_result`);

--
-- Indexes for table `challenge_scores`
--
ALTER TABLE `challenge_scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `quests`
--
ALTER TABLE `quests`
  ADD PRIMARY KEY (`id_quest`);

--
-- Indexes for table `quest_chapters`
--
ALTER TABLE `quest_chapters`
  ADD PRIMARY KEY (`id_chapter`),
  ADD KEY `id_quest` (`id_quest`);

--
-- Indexes for table `quest_questions`
--
ALTER TABLE `quest_questions`
  ADD PRIMARY KEY (`id_question`),
  ADD KEY `id_chapter` (`id_chapter`);

--
-- Indexes for table `shop_items`
--
ALTER TABLE `shop_items`
  ADD PRIMARY KEY (`id_item`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_achievements`
--
ALTER TABLE `user_achievements`
  ADD PRIMARY KEY (`id_user`,`id_achievement`),
  ADD KEY `id_achievement` (`id_achievement`);

--
-- Indexes for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_chapter_progress`
--
ALTER TABLE `user_chapter_progress`
  ADD PRIMARY KEY (`id_progress`,`id_user`,`id_chapter`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_chapter` (`id_chapter`);

--
-- Indexes for table `user_items`
--
ALTER TABLE `user_items`
  ADD PRIMARY KEY (`id_user_item`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_item` (`id_item`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievements`
--
ALTER TABLE `achievements`
  MODIFY `id_achievement` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `boss_questions`
--
ALTER TABLE `boss_questions`
  MODIFY `id_question` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `boss_quests`
--
ALTER TABLE `boss_quests`
  MODIFY `id_boss` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `boss_results`
--
ALTER TABLE `boss_results`
  MODIFY `id_result` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `challenge_scores`
--
ALTER TABLE `challenge_scores`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `quests`
--
ALTER TABLE `quests`
  MODIFY `id_quest` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quest_chapters`
--
ALTER TABLE `quest_chapters`
  MODIFY `id_chapter` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quest_questions`
--
ALTER TABLE `quest_questions`
  MODIFY `id_question` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `shop_items`
--
ALTER TABLE `shop_items`
  MODIFY `id_item` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `user_chapter_progress`
--
ALTER TABLE `user_chapter_progress`
  MODIFY `id_progress` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_items`
--
ALTER TABLE `user_items`
  MODIFY `id_user_item` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `challenge_scores`
--
ALTER TABLE `challenge_scores`
  ADD CONSTRAINT `challenge_scores_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `quest_chapters`
--
ALTER TABLE `quest_chapters`
  ADD CONSTRAINT `quest_chapters_ibfk_1` FOREIGN KEY (`id_quest`) REFERENCES `quests` (`id_quest`) ON DELETE CASCADE;

--
-- Constraints for table `quest_questions`
--
ALTER TABLE `quest_questions`
  ADD CONSTRAINT `quest_questions_ibfk_1` FOREIGN KEY (`id_chapter`) REFERENCES `quest_chapters` (`id_chapter`) ON DELETE CASCADE;

--
-- Constraints for table `user_achievements`
--
ALTER TABLE `user_achievements`
  ADD CONSTRAINT `user_achievements_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_achievements_ibfk_2` FOREIGN KEY (`id_achievement`) REFERENCES `achievements` (`id_achievement`) ON DELETE CASCADE;

--
-- Constraints for table `user_chapter_progress`
--
ALTER TABLE `user_chapter_progress`
  ADD CONSTRAINT `user_chapter_progress_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_chapter_progress_ibfk_2` FOREIGN KEY (`id_chapter`) REFERENCES `quest_chapters` (`id_chapter`) ON DELETE CASCADE;

--
-- Constraints for table `user_items`
--
ALTER TABLE `user_items`
  ADD CONSTRAINT `user_items_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `user_items_ibfk_2` FOREIGN KEY (`id_item`) REFERENCES `shop_items` (`id_item`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
