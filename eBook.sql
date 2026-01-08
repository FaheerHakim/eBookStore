-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 08, 2026 at 08:45 PM
-- Server version: 8.0.40
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eBook`
--

-- --------------------------------------------------------

--
-- Table structure for table `ebooks`
--

CREATE TABLE `ebooks` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `price` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `category` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pdf_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ebooks`
--

INSERT INTO `ebooks` (`id`, `title`, `description`, `price`, `created_at`, `category`, `cover_image`, `pdf_path`) VALUES
(18, 'Don\'t forget to breathe', '', 400, '2026-01-08 13:48:23', 'Stress tolerance', 'covers/WhatsApp Image 2026-01-03 at 15.50.27.jpeg', 'ebooks/Dont forget to breathe 1st version.pdf'),
(19, 'Can panic make you work harder?', '', 230, '2026-01-08 14:24:35', 'Panic & Anxiety', 'covers/WhatsApp Image 2026-01-02 at 16.13.34.jpeg', 'ebooks/can panic make you work harder 1st version.pdf'),
(20, 'Small steps matter', '', 500, '2026-01-08 14:25:42', 'Productivity', 'covers/WhatsApp Image 2026-01-03 at 15.49.49.jpeg', 'ebooks/small steps matter 1st version.pdf'),
(21, 'What\'s your most repeated thought?', '', 310, '2026-01-08 14:26:39', 'Productivity', 'covers/WhatsApp Image 2026-01-03 at 15.49.48.jpeg', 'ebooks/what is your most repeated thought 1st version.pdf'),
(22, 'Why do we panic?', '', 230, '2026-01-08 14:27:58', 'Panic & Anxiety', 'covers/WhatsApp Image 2026-01-01 at 10.41.48 (1).jpeg', 'ebooks/Why do people panic 25 sep 1st copy.pdf'),
(23, 'What are panic attacks? ', '', 120, '2026-01-08 14:28:35', 'Panic & Anxiety', 'covers/WhatsApp Image 2026-01-01 at 10.41.48.jpeg', 'ebooks/What are panic attacks 1st version 8 oct 25.pdf'),
(24, 'Start Now', '', 130, '2026-01-08 14:29:39', 'Productivity', 'covers/WhatsApp Image 2026-01-03 at 00.11.43.jpeg', 'ebooks/Start Now 1st version.pdf'),
(25, 'What is OCD?', '', 335, '2026-01-08 14:30:23', 'OCD', 'covers/WhatsApp Image 2026-01-02 at 16.13.55.jpeg', 'ebooks/what is OCD 1st version.pdf'),
(26, 'What is going on inside', '', 520, '2026-01-08 14:32:05', 'Stress tolerance', 'covers/WhatsApp Image 2026-01-02 at 23.27.28.jpeg', 'ebooks/what is going on inside 1st version.pdf'),
(27, 'Is obsessive always bad?', 'People call you obsessive and that annoys you. But have you ever thought that this might be your mightiest weapon?\r\n\r\nIs having an obsession always bad or can we transform this energy into something good?\r\n\r\nEnjoy! one word a page!', 440, '2026-01-08 14:34:16', 'OCD', 'covers/WhatsApp Image 2026-01-02 at 16.22.26.jpeg', 'ebooks/is obsessive always bad 1st version.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `ebook_pages`
--

CREATE TABLE `ebook_pages` (
  `id` int NOT NULL,
  `ebook_id` int NOT NULL,
  `page_number` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `total` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `created_at`) VALUES
(1, 37, 120, '2026-01-08 18:51:47'),
(2, 37, 130, '2026-01-08 18:52:05'),
(3, 37, 335, '2026-01-08 19:01:29');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `ebook_id` int NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `ebook_id`, `price`) VALUES
(1, 1, 23, 120),
(2, 2, 24, 130),
(3, 3, 25, 335);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `password` text COLLATE utf8mb4_general_ci NOT NULL,
  `currency_units` int NOT NULL DEFAULT '1000',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `currency_units`, `is_admin`) VALUES
(24, 'admin', 'admin@admin.com', '$2y$10$kuhg4.ECFH6V9EnaQKm.fOxZgrz4d7LK4b6MjeAnHpZcwYluIpRkK', 1000, 1),
(25, 'user', 'user@user.com', '$2y$10$49wu88tWZTfai4iJD.euheA67jju8rTAsTZMXqy2UjV0ZkP3dkRPm', 1000, 0),
(28, 'Fa', 'faheerhakim@gmail.com', '$2y$12$mOkcstOgZ0Olcb25d7hPq.Lmgl8FfRUW6g34NUXcAtkIdFmusgvju', 120, 0),
(29, 'Fa', 'faheerhakim@gmail.com', '$2y$12$mOkcstOgZ0Olcb25d7hPq.Lmgl8FfRUW6g34NUXcAtkIdFmusgvju', 120, 0),
(30, 'Fa', 'faheerhakim@gmail.com', '$2y$12$mOkcstOgZ0Olcb25d7hPq.Lmgl8FfRUW6g34NUXcAtkIdFmusgvju', 120, 0),
(31, 'Fa', 'faheerhakim@gmail.com', '$2y$12$mOkcstOgZ0Olcb25d7hPq.Lmgl8FfRUW6g34NUXcAtkIdFmusgvju', 120, 0),
(32, 'Fa', 'faheerhakim@gmail.com', '$2y$12$mOkcstOgZ0Olcb25d7hPq.Lmgl8FfRUW6g34NUXcAtkIdFmusgvju', 120, 0),
(33, 'Fa', 'faheerhakim@gmail.com', '$2y$12$mOkcstOgZ0Olcb25d7hPq.Lmgl8FfRUW6g34NUXcAtkIdFmusgvju', 120, 0),
(34, 'Fa', 'faheerhakim@gmail.com', '$2y$12$mOkcstOgZ0Olcb25d7hPq.Lmgl8FfRUW6g34NUXcAtkIdFmusgvju', 120, 0),
(35, 'Fa', 'faheerhakim@gmail.com', '$2y$12$mOkcstOgZ0Olcb25d7hPq.Lmgl8FfRUW6g34NUXcAtkIdFmusgvju', 120, 0),
(36, 'test', 'test@test.be', '$2y$12$flXQQe6xpfIjkayj4./bx..HBuQKlVLHx4Lyl5ThhX9PTaD.cNjMC', 1000, 0),
(37, 'Faheer Hakim', 'test@faheer.be', '$2y$12$5w/2SiqFrf9z8Gx.btKRD.ehODYD.eynQx1piSiC/ZxSYyarOz0sC', 285, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ebooks`
--
ALTER TABLE `ebooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebook_pages`
--
ALTER TABLE `ebook_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ebook_id` (`ebook_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `ebook_id` (`ebook_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ebooks`
--
ALTER TABLE `ebooks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `ebook_pages`
--
ALTER TABLE `ebook_pages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ebook_pages`
--
ALTER TABLE `ebook_pages`
  ADD CONSTRAINT `ebook_pages_ibfk_1` FOREIGN KEY (`ebook_id`) REFERENCES `ebooks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`ebook_id`) REFERENCES `ebooks` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
