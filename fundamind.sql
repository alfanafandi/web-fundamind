-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 27, 2025 at 06:45 PM
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
  `xp_next` int DEFAULT '100'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `avatar`, `bio`, `level`, `xp`, `xp_next`) VALUES
(1, 'alfan', '$2y$10$eNcym8v.DSFaXEAomZHsreZ7PAoT0H.u91aedYnV5cS5Tb9IFj0V.', 'Ellipse_2.png', 'Fundamind is an innovative platform dedicated to revolutionizing digital education through gamified learning experiences. With a team of passionate educators and game developers, we create immersive environments where knowledge meets entertainment. Our mission is to make learning addictive by combining educational rigor with engaging gameplay mechanics. Since our founding in 2022, we\'ve helped over 50,000 users worldwide level up their skills in programming, design, and critical thinking. We believe education should be as compelling as your favorite video game, which is why we\'ve developed proprietary learning algorithms that adapt to each user\'s progress. Join our growing community of lifelong learners and start your knowledge adventure today!', 1, 0, 100),
(2, 'gayuh', '$2y$10$wfBKoyfoWxNp0hDHZ7SdMOQAIszNO7DDX0xtvuL0CFmg/1XwxmH7S', 'Ellipse_2.png', 'dda', 1, 0, 100);

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`id_achievement`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievements`
--
ALTER TABLE `achievements`
  MODIFY `id_achievement` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_achievements`
--
ALTER TABLE `user_achievements`
  ADD CONSTRAINT `user_achievements_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_achievements_ibfk_2` FOREIGN KEY (`id_achievement`) REFERENCES `achievements` (`id_achievement`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
