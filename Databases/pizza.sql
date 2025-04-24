-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2025 at 11:00 AM
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
-- Database: `pizza`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_totals`
--

CREATE TABLE `customer_totals` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `contact_no` varchar(15) DEFAULT NULL,
  `total_price` decimal(8,2) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_totals`
--

INSERT INTO `customer_totals` (`id`, `customer_name`, `contact_no`, `total_price`, `address`) VALUES
(16, 'shahwaiz ', '03134574191', 38.00, 'faisalabad'),
(17, 'shahwaiz ', '03134574191', 68.00, 'faisalabad'),
(18, 'Liza', '03134574190', 45.00, 'America');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `contact_no` varchar(15) DEFAULT NULL,
  `pizza_name` varchar(50) DEFAULT NULL,
  `unit_price` decimal(6,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` decimal(8,2) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `contact_no`, `pizza_name`, `unit_price`, `quantity`, `total_price`, `address`) VALUES
(48, 'shahwaiz ', '03134574191', 'Big Italy', 10.00, 2, 20.00, 'faisalabad'),
(49, 'shahwaiz ', '03134574191', 'Veggy Lover', 9.00, 2, 18.00, 'faisalabad'),
(50, 'shahwaiz ', '03134574191', 'Big Italy', 10.00, 2, 20.00, 'faisalabad'),
(51, 'shahwaiz ', '03134574191', 'Meat Lover', 12.00, 4, 48.00, 'faisalabad'),
(52, 'Liza', '03134574190', 'Meat Lover', 12.00, 3, 36.00, 'America'),
(53, 'Liza', '03134574190', 'Veggy Lover', 9.00, 1, 9.00, 'America');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(2, 'tiger', 'shahwaiztiger12@gmail.com', '$2y$10$m4VloILU1X9xYe19umz37.lJEYdxa//q0lXmpkdjpMGXwcCaSzpM6', '2025-04-19 08:32:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_totals`
--
ALTER TABLE `customer_totals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_totals`
--
ALTER TABLE `customer_totals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
