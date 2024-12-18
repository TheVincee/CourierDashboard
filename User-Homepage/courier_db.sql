-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2024 at 05:22 AM
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
-- Database: `courier_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `couriers`
--

CREATE TABLE `couriers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `vehicle_type` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `availability` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `couriers`
--

INSERT INTO `couriers` (`id`, `name`, `vehicle_type`, `address`, `availability`) VALUES
(1, 'Courier 1', 'Car', '123 Main St, City A', 1),
(2, 'Courier 2', 'Bike', '456 Oak St, City B', 0),
(3, 'Courier 3', 'Truck', '789 Elm St, City C', 1);

-- --------------------------------------------------------

--
-- Table structure for table `courier_packages`
--

CREATE TABLE `courier_packages` (
  `id` int(11) NOT NULL,
  `courier_id` int(11) DEFAULT NULL,
  `pickup_location` varchar(255) DEFAULT NULL,
  `delivery_destination` varchar(255) DEFAULT NULL,
  `weight` decimal(10,2) DEFAULT NULL,
  `product_value` decimal(10,2) DEFAULT NULL,
  `pickup_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courier_packages`
--

INSERT INTO `courier_packages` (`id`, `courier_id`, `pickup_location`, `delivery_destination`, `weight`, `product_value`, `pickup_date`, `created_at`) VALUES
(1, 0, 'bogo', 'bogo', 11.00, 1111.00, '2024-01-17', '2024-01-16 03:39:07'),
(2, 0, 'bogo', 'bogo', 11.00, 1111.00, '2024-01-17', '2024-01-16 03:39:12'),
(3, 0, 'bogo', 'bogo', 11.00, 1111.00, '2024-01-17', '2024-01-16 03:42:39'),
(4, 0, 'bogo', 'bogo', 11.00, 1111.00, '2024-01-17', '2024-01-16 03:42:52'),
(5, 0, '1', '1', 1.00, 1.00, '2024-01-17', '2024-01-16 03:43:42'),
(6, 0, '1', '1', 1.00, 1.00, '2024-01-17', '2024-01-16 03:45:57'),
(7, 0, '1', '1', 1.00, 1.00, '2024-01-18', '2024-01-16 03:46:10'),
(8, 0, '1', '1', 1.00, 1.00, '2024-01-17', '2024-01-16 03:48:24'),
(9, 0, '1', '1', 1.00, 1.00, '2024-01-17', '2024-01-16 03:48:38');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `courier_id` int(11) DEFAULT NULL,
  `pickup_location` varchar(255) DEFAULT NULL,
  `delivery_destination` varchar(255) DEFAULT NULL,
  `weight` decimal(10,2) DEFAULT NULL,
  `product_value` decimal(10,2) DEFAULT NULL,
  `pickup_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ride_bookings`
--

CREATE TABLE `ride_bookings` (
  `id` int(11) NOT NULL,
  `courier_id` int(11) DEFAULT NULL,
  `pickup_location` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `pickup_time` time NOT NULL,
  `pickup_date` date NOT NULL,
  `timespan` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ride_bookings`
--

INSERT INTO `ride_bookings` (`id`, `courier_id`, `pickup_location`, `destination`, `pickup_time`, `pickup_date`, `timespan`, `created_at`) VALUES
(1, 0, 'eq', 'qw', '12:00:00', '2024-01-17', 1233, '2024-01-16 04:01:46'),
(2, 0, 'eq', 'qw', '00:04:00', '2024-01-16', 1233, '2024-01-16 04:04:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `couriers`
--
ALTER TABLE `couriers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courier_packages`
--
ALTER TABLE `courier_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courier_id` (`courier_id`);

--
-- Indexes for table `ride_bookings`
--
ALTER TABLE `ride_bookings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `couriers`
--
ALTER TABLE `couriers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courier_packages`
--
ALTER TABLE `courier_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ride_bookings`
--
ALTER TABLE `ride_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`courier_id`) REFERENCES `couriers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
