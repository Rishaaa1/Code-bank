-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 13, 2025 at 06:53 PM
-- Server version: 8.0.34
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bankja214_digital_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `jenis_transaksi` enum('debit','kredit') COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah` decimal(15,2) NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `no_kartu` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `no_rekening` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kartu` enum('Gold','Platinum','Silver') COLLATE utf8mb4_general_ci NOT NULL,
  `pin` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `saldo` decimal(15,2) DEFAULT '1000000.00',
  `tanggal_bergabung` datetime DEFAULT CURRENT_TIMESTAMP,
  `cvv` varchar(3) COLLATE utf8mb4_general_ci NOT NULL,
  `masa_berlaku` varchar(5) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `nama_lengkap`, `no_kartu`, `no_rekening`, `jenis_kartu`, `pin`, `saldo`, `tanggal_bergabung`, `cvv`, `masa_berlaku`) VALUES
(11, 'herman', 'herman', '456790', '567890', 'Silver', '$2y$10$joPkCk8j5yn1pilPmkLc8eI/JpUcp2SIr76RFa3c8yhi6NLbNXhTG', 1000000.00, '2025-06-24 16:25:39', '805', '06/28'),
(16, 'caca', 'caca', '098765', '987456321', 'Platinum', '$2y$10$guNuDMGpd6K37aywULrDEuqZbJyWDCpGsyVAJLXQy81HsObbdX/Ai', 1000000.00, '2025-06-29 23:04:20', '577', '06/28'),
(23, 'joko sudiro', 'joko sudiro', '1234567890123456', '1234567890', 'Gold', '$2y$10$8Yenp69W5/BZ1oeLRFvWQez73z5pYW8M6bGqFuzC6AbNt0QdiAGNi', 1000000.00, '2025-07-13 09:27:38', '151', '07/28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `no_kartu` (`no_kartu`),
  ADD UNIQUE KEY `no_rekening` (`no_rekening`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
