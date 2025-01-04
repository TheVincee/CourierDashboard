-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2025 at 05:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `courier_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_categories`
--

CREATE TABLE `admin_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_by` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_categories`
--

INSERT INTO `admin_categories` (`id`, `category_name`, `description`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'asdas', 'asdsa', 1, '2024-12-15 16:08:16', '2024-12-15 16:08:16'),
(2, 'Lana Mayer', 'Labore fugiat sunt e', 1, '2024-12-15 16:13:16', '2024-12-15 16:13:16'),
(3, 'asds', 'asd', 1, '2024-12-15 16:13:25', '2024-12-15 16:13:25');

-- --------------------------------------------------------

--
-- Table structure for table `admin_items`
--

CREATE TABLE `admin_items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `item_load` decimal(10,2) NOT NULL,
  `distance` decimal(10,2) NOT NULL,
  `fuel_consumption_rate` decimal(10,2) NOT NULL,
  `total_fuel_needed` decimal(10,2) NOT NULL,
  `rider_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `bookingID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `pickupAddress` varchar(255) NOT NULL,
  `dropoffAddress` varchar(255) NOT NULL,
  `pickupDistance` decimal(10,2) NOT NULL,
  `dropoffDistance` decimal(10,2) NOT NULL,
  `totalDistance` decimal(10,2) NOT NULL,
  `totalPayable` decimal(10,2) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Pending',
  `cancellation_reason` text DEFAULT NULL,
  `cancelled_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`bookingID`, `name`, `phone`, `pickupAddress`, `dropoffAddress`, `pickupDistance`, `dropoffDistance`, `totalDistance`, `totalPayable`, `createdAt`, `status`, `cancellation_reason`, `cancelled_at`) VALUES
(3, 'Danielle Boltons', '+1 (564) 881-4904', 'Excepteur et rem vel', 'A quod cumque dolore', 33.00, 69.00, 102.00, 1020.00, '2024-12-24 03:10:12', 'Ready for Pickup', 'asdasdasd', '2024-12-24 13:45:45'),
(4, 'Mollie Hunt', '+1 (697) 452-6457', 'Nostrud et id velit', 'Pariatur Repellendu', 39.00, 5.00, 44.00, 440.00, '2024-12-24 05:49:12', 'cancelled', 'asdasd', '2024-12-24 13:52:17'),
(5, 'Larissa Wagner', '+1 (234) 687-1765', 'In neque anim deleni', 'Fugiat iste consecte', 7.00, 17.00, 24.00, 240.00, '2024-12-31 08:10:57', 'active', NULL, NULL),
(6, 'Perry Davis', '+1 (453) 652-6781', 'Anim eligendi quis p', 'Consequatur Iure im', 19.00, 28.00, 47.00, 470.00, '2024-12-31 08:13:44', 'active', NULL, NULL),
(7, 'Travis Swanson', '+1 (902) 813-7486', 'Veniam nihil vero n', 'Qui tempore ullam e', 83.00, 2.00, 85.00, 850.00, '2024-12-31 08:14:35', 'Pending', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_items`
--

CREATE TABLE `delivery_items` (
  `id` int(11) NOT NULL,
  `senderName` varchar(100) NOT NULL,
  `receiverName` varchar(100) NOT NULL,
  `senderEmail` varchar(100) NOT NULL,
  `senderPhone` varchar(15) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `pickupTime` datetime NOT NULL,
  `paymentType` enum('Cash','Card') NOT NULL,
  `description` text NOT NULL,
  `specificationDescription` text NOT NULL,
  `status` enum('Pending','In Progress','Completed','Cancelled') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `trackingID` varchar(50) DEFAULT NULL,
  `cancellationReason` varchar(255) DEFAULT NULL,
  `assigned` varchar(10) DEFAULT NULL,
  `riders_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_items`
--

INSERT INTO `delivery_items` (`id`, `senderName`, `receiverName`, `senderEmail`, `senderPhone`, `destination`, `pickupTime`, `paymentType`, `description`, `specificationDescription`, `status`, `created_at`, `updated_at`, `trackingID`, `cancellationReason`, `assigned`, `riders_id`) VALUES
(28, 'Inga Stuarts', 'Demetrius Steina', 'cusokafu@mailinator.com', '+1 (485) 438-36', 'Dolor perferendis qu', '1972-11-23 20:54:00', 'Cash', 'Electronics', 'Maiores velit aute', '', '2024-12-30 09:27:27', '2025-01-03 13:54:33', 'TRK-6772677feeb074.17252438', NULL, 'Yes', 4),
(29, 'Jerome Hendrix', 'Savannah Mcneil', 'socegiteny@mailinator.com', '+1 (484) 836-34', 'Quae totam odio non', '2023-06-20 14:45:00', 'Card', 'Standard', 'Irure alias quidem d', 'Pending', '2024-12-30 09:31:51', '2024-12-30 09:31:51', 'TRK-67726887b00784.20782939', NULL, 'No', NULL),
(30, 'Gray Yang', 'Cathleen Le', 'felog@mailinator.com', '+1 (107) 515-39', 'Aliquam dolor invent', '2021-10-04 22:27:00', 'Cash', 'Fragile', 'Fuga Eos ad est ill', 'Cancelled', '2024-12-30 09:33:06', '2024-12-30 12:04:28', 'TRK-677268d22d6bb2.22393218', NULL, 'No', NULL),
(31, 'Nissim Tanner', 'Sierra George', 'valo@mailinator.com', '+1 (598) 195-79', 'Sint quam odio vita', '1971-03-25 16:41:00', 'Cash', 'Heavy', 'Sunt voluptates sint', '', '2024-12-30 09:34:29', '2025-01-02 23:59:41', 'TRK-67726925b0f823.33033368', NULL, 'No', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `riders`
--

CREATE TABLE `riders` (
  `riders_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('rider') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_name` varchar(11) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `vehicle_type` varchar(255) NOT NULL,
  `assigned` varchar(10) DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riders`
--

INSERT INTO `riders` (`riders_id`, `first_name`, `email`, `password`, `role`, `created_at`, `last_name`, `contact`, `username`, `vehicle_type`, `assigned`) VALUES
(1, 'Adele', 'rivi@mailinator.com', '$2y$10$lw8nMhDSQyalsrGdBaYPjuTSh6rsc7LO/w7HyYxfpTcdKvAodAQGq', 'rider', '2024-12-15 16:45:43', 'Alexander', 'Qui est exercitation', 'divitiba', 'Motorcycle', 'No'),
(3, 'Gage', 'busu@mailinator.com', '$2y$10$F9mWKsXt6wmYFl/rSufPwOh1krRFmhx1UUG09diAuCF6irX89T0TS', 'rider', '2024-12-23 05:10:39', 'Chavez', 'Dolore quia assumend', 'tukezax', 'Bicycle', 'No'),
(4, 'Melinda', 'ryhe@mailinator.com', '$2y$10$BJmZzkdKQnpAKk9g6rbPOeOs09kC8I4uzOwX5XKnHOf1lyhu3D5Gu', 'rider', '2024-12-23 05:11:39', 'Howell', 'Eaque autem dolor ex', 'manopoveku', 'Bicycle', 'No'),
(5, 'Aubrey', 'cipycero@mailinator.com', '$2y$10$YFzmOJfPGE4KMR1KlyN3kOHPzYRoaGf7DihnZaZ/WYaDe/RDlMDhW', 'rider', '2024-12-23 05:16:37', 'Barlow', 'Perspiciatis sapien', 'dyzig', 'Bicycle', 'No'),
(6, 'Sonya', 'kutyvy@mailinator.com', '$2y$10$yxmVjkHmE47W05UxViaO6OOLKmfWsK7wn60IeCYZ.Txo26H6V6bO6', 'rider', '2024-12-23 05:25:06', 'Decker', 'Saepe qui ad sed et', 'munit', 'Bicycle', 'No'),
(7, 'Samantha', 'civuju@mailinator.com', '$2y$10$QAs.0Z4.pDiD7QeKTBowp.ncYL7VzCoIMrgh7de2/LoLj33XbfAxe', 'rider', '2024-12-23 05:34:57', 'Burns', 'Expedita ad doloribu', 'hopuv', 'Motorcycle', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `salaries_tb`
--

CREATE TABLE `salaries_tb` (
  `salarie_id` int(11) NOT NULL,
  `riders_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `items_delivered` int(11) NOT NULL,
  `distance_traveled` float NOT NULL,
  `extra_miles` float NOT NULL,
  `total_salary` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salaries_tb`
--

INSERT INTO `salaries_tb` (`salarie_id`, `riders_id`, `first_name`, `last_name`, `items_delivered`, `distance_traveled`, `extra_miles`, `total_salary`, `created_at`) VALUES
(1, 3, 'Gage', 'Chavez', 0, 0, 0, 5000, '2024-12-27 04:11:00'),
(2, 7, 'Samantha', 'Burns', 1200, 200, 1200, 73000, '2024-12-27 04:12:07'),
(3, 1, 'Adele', 'Alexander', 12, 34, 34, 6110, '2024-12-27 04:15:26');

-- --------------------------------------------------------

--
-- Table structure for table `users_tb`
--

CREATE TABLE `users_tb` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_categories`
--
ALTER TABLE `admin_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_items`
--
ALTER TABLE `admin_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`bookingID`);

--
-- Indexes for table `delivery_items`
--
ALTER TABLE `delivery_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riders`
--
ALTER TABLE `riders`
  ADD PRIMARY KEY (`riders_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `salaries_tb`
--
ALTER TABLE `salaries_tb`
  ADD PRIMARY KEY (`salarie_id`),
  ADD KEY `riders_id` (`riders_id`);

--
-- Indexes for table `users_tb`
--
ALTER TABLE `users_tb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_categories`
--
ALTER TABLE `admin_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `bookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `delivery_items`
--
ALTER TABLE `delivery_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `riders`
--
ALTER TABLE `riders`
  MODIFY `riders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `salaries_tb`
--
ALTER TABLE `salaries_tb`
  MODIFY `salarie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_tb`
--
ALTER TABLE `users_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `salaries_tb`
--
ALTER TABLE `salaries_tb`
  ADD CONSTRAINT `salaries_tb_ibfk_1` FOREIGN KEY (`riders_id`) REFERENCES `riders` (`riders_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
