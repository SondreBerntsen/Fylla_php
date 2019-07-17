-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2019 at 03:04 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fylla`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `card_id` int(20) NOT NULL,
  `card_name` varchar(20) COLLATE utf8_bin NOT NULL,
  `quote` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_bin NOT NULL,
  `img` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`card_id`, `card_name`, `quote`, `description`, `img`, `user_id`) VALUES
(0, 'Test kortet', '\"Det e viktig Ã¥ teste\"', 'HÃ¥pe det her faktisk funke, drekk en mill penga om det funke.', '500x500.jpg', 1),
(10, 'Vegard e full', 'full', 'drekk', '500x500.jpg', 1),
(11, 'awdadad', 'awdawdawd', 'awdawdawd', '500x500.jpg', 1),
(12, '4', '5', '6', '500x500.jpg', 1),
(13, '5', '5', '5', '500x500.jpg', 1),
(14, 'Omegafylla', '\"Du e pÃ¥ omegafylla\"', 'Drekk alt bla bla bla 100 sluirka vÃ¦re drekk bÃ¦re drekk nmasse alt drekk mase altr n21 dfull Full, drekka.', '500x500.jpg', 1),
(15, 'pepper0nny', 'du mÃ¥ ha han pepperonny', 'Du mÃ¥ ha pizza me pepperonny, fettbra kort', '500x500.jpg', 1),
(16, 'Bakfylleburger', '\"e du me pÃ¥ burger eller?\"', 'Du er bakfull, reparer med 2 slurker.', 'fylla_0000_bakfylla.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(20) NOT NULL,
  `username` varchar(20) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `user_type` enum('player','administrator') COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `user_type`) VALUES
(1, 'sodda', '$2y$10$YvYlDKv.TN5qIBb4jsT2WepMRzu7nwSpI//W6DFhyGRNPzrivBWAu', 'Sondre_berntsen94@hotmail.com', 'administrator'),
(2, 'testplayer', '$2y$10$3mAgF1T7msKPPru6sCQC3eBsaNjVZSNNb5uloriC51cMggUuPzxhO', 'test@test.no', 'player'),
(3, 'jonsok', '$2y$10$gFhjryW0txh4OpRkOrQJWu9t2u9YuD.lxEzTkwbQA1fPAYtICNrtG', 'jonsok@kuk.no', 'administrator'),
(4, 'jonsokko', '$2y$10$aTMBEV3hM6Qzuk28O243yuCawv88RTY9Ao5cw0KetT0nHpnq7.q9q', 'jobbis@jobb.jobb', 'administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`card_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `card_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `cards_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
