-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 28, 2025 at 02:48 PM
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
-- Table structure for table `shop_items`
--

CREATE TABLE `shop_items` (
  `id_item` int NOT NULL,
  `nama_item` varchar(100) NOT NULL,
  `tipe_item` enum('avatar','badge','booster','custom','hint','skip') NOT NULL,
  `deskripsi` text,
  `harga_coin` int DEFAULT '0',
  `file_icon` varchar(255) DEFAULT NULL,
  `efek` text,
  `tersedia` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `shop_items`
--

INSERT INTO `shop_items` (`id_item`, `nama_item`, `tipe_item`, `deskripsi`, `harga_coin`, `file_icon`, `efek`, `tersedia`) VALUES
(1, 'XP', 'booster', 'Menambah 15 XP', 15, 'xp.png', NULL, 1),
(2, 'Magnifying Glass', 'hint', 'Menampilkan clue', 10, 'magnify.png', NULL, 1),
(3, 'Skip Level Pass', 'skip', 'Lewati soal', 15, 'skip.png', NULL, 1),
(4, 'Time Extension', 'booster', 'Tambahan waktu 30s', 10, 'time.png', NULL, 1),
(5, 'Skin', 'avatar', 'Ubah avatar', 10, 'skin.png', NULL, 1),
(6, 'Clue', 'hint', 'Petunjuk jawaban', 15, 'clue.png', NULL, 1);

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
(1, 'alfan', '$2y$10$eNcym8v.DSFaXEAomZHsreZ7PAoT0H.u91aedYnV5cS5Tb9IFj0V.', 'Ellipse_4.png', 'Fundamind is an innovative platform dedicated to revolutionizing digital education through gamified learning experiences. With a team of passionate educators and game developers, we create immersive environments where knowledge meets entertainment. Our mission is to make learning addictive by combining educational rigor with engaging gameplay mechanics. Since our founding in 2022, we\'ve helped over 50,000 users worldwide level up their skills in programming, design, and critical thinking. We believe education should be as compelling as your favorite video game, which is why we\'ve developed proprietary learning algorithms that adapt to each user\'s progress. Join our growing community of lifelong learners and start your knowledge adventure today!', 1, 0, 100, 85),
(2, 'gayuh', '$2y$10$wfBKoyfoWxNp0hDHZ7SdMOQAIszNO7DDX0xtvuL0CFmg/1XwxmH7S', 'Ellipse_2.png', 'dda', 2, 0, 100, 0);

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
(1, 2),
(2, 2),
(1, 4),
(1, 5),
(1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user_items`
--

CREATE TABLE `user_items` (
  `id_user` int NOT NULL,
  `nama_item` varchar(100) NOT NULL,
  `jumlah` int DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_items`
--

INSERT INTO `user_items` (`id_user`, `nama_item`, `jumlah`) VALUES
(1, 'XP Boost', 1);

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
-- Indexes for table `user_items`
--
ALTER TABLE `user_items`
  ADD PRIMARY KEY (`id_user`,`nama_item`);

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
-- AUTO_INCREMENT for table `shop_items`
--
ALTER TABLE `shop_items`
  MODIFY `id_item` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_achievements`
--
ALTER TABLE `user_achievements`
  ADD CONSTRAINT `user_achievements_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_achievements_ibfk_2` FOREIGN KEY (`id_achievement`) REFERENCES `achievements` (`id_achievement`) ON DELETE CASCADE;

--
-- Constraints for table `user_items`
--
ALTER TABLE `user_items`
  ADD CONSTRAINT `user_items_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
