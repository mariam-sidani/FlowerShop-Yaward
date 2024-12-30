-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2024 at 12:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flowers`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` varchar(10) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `discount`, `image_url`, `description`, `created_at`) VALUES
(1, 'Flower Pot', 12.99, '-15%', 'b2.jpg', 'A beautiful flower pot perfect for your home decor.', '2024-12-29 15:22:24'),
(3, 'flower bouquet', 12.99, '10', 'b1.jpg', 'A beautiful flower bouquet.', '2024-12-29 15:58:27'),
(4, 'Pink pot', 12.99, '15', 'images.jpeg', 'A decorative flower pot.', '2024-12-29 15:58:27'),
(5, 'Monstera pot', 12.99, '15', 'green.avif', 'A decorative flower pot with yellow chrysanthemums.', '2024-12-29 15:58:27'),
(12, 'Green moss', 10.00, '10%', '6771795d6a0b8.jpg', 'for walls', '2024-12-29 16:31:25'),
(13, 'Heart bouquet', 20.00, '3', '6771863a6235f.jpg', 'hearted plant', '2024-12-29 17:26:18'),
(14, 'Flower Cake', 25.00, '3', '6771872aa7f94.jpeg', 'for birthdays', '2024-12-29 17:30:18'),
(15, 'White Flower Cake', 30.00, '10', '677187a35e877.jpeg', 'for wedding', '2024-12-29 17:32:19'),
(16, 'Graduation Cake', 25.00, '5', '677187f50faa0.jpg', 'for graduation', '2024-12-29 17:33:41'),
(17, 'Spring Wall', 40.00, '10', '677188448bcf9.jpeg', 'for restaurant', '2024-12-29 17:35:00'),
(18, 'Engagement Wall', 50.00, '2', '6771887ca56c6.jpg', 'for engament', '2024-12-29 17:35:56'),
(19, 'Green Wall', 45.00, '10', 'gree.avif', 'for restaura', '2024-12-29 17:36:54'),
(20, 'Hedera Plant', 15.00, '0', '677193557b514.jpg', 'non', '2024-12-29 18:22:13'),
(21, 'Cactus', 12.00, '2', '677193d282c93.jpeg', 'new', '2024-12-29 18:24:18'),
(23, 'Aloe vera', 15.00, '0', '67719a2d7c3d3.jpeg', 'non', '2024-12-29 18:51:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Salt` varchar(255) NOT NULL,
  `RoleId` int(11) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Username`, `Password`, `Salt`, `RoleId`, `CreatedAt`) VALUES
(1, 'admin', '73658b18a51bcdc0719c4c5049928b748ce3b58e7be6f049b1dbff970a95a988', 'cca', 1, '2024-12-29 14:17:20'),
(2, 'mariam', '1ee9c9a4fc8ec41cfdfb865d2506bf64d1a7453faf7102ac28801bd6680605c3', 'fb0', 2, '2024-12-29 14:26:26'),
(3, 'Rana', 'd8f15ad95bcb3a7cf77db2ad1e1296a9957f1a833185439de9d1f2d06c3015ce', '493', 2, '2024-12-29 14:56:12'),
(4, 'mohamad', '2dc1ddddef69d24f1e6db88b6a3be6d7abde8f9e3a31795edb32a0597a42b0ff', 'ec2', 2, '2024-12-30 09:11:36'),
(5, 'omar', '25a9ca3db6bbd077e960bea80a5a5d66ba5c6fcd688cfe12708687652aed39fa', 'be7', 2, '2024-12-30 09:42:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Username_2` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
