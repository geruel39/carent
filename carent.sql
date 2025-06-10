-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2025 at 06:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carent`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(11) NOT NULL,
  `image` varchar(255) DEFAULT 'accounts.svg',
  `role` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `username`, `password`, `firstname`, `lastname`, `gender`, `email`, `phone`, `image`, `role`) VALUES
(1, 'largadmin39', 'largadmin93', 'admin', 'admin', '', 'admin@gmail.com', 99999999999, NULL, 'admin'),
(3, 'geruel39', '123123', 'Geruel', 'Alcaraz', 'Male', 'geruel@gmail.com', 9687148824, 'accounts.svg', 'user'),
(4, 'walid', 'walid', 'walid', 'dimao', 'Female', 'walid@gmal.com', 516586551, 'accounts.svg', 'user'),
(5, 'geruel929', '123123', 'Geruel', 'Alcaraz', 'Male', 'geruelalcaraz@gmail.com', 9685415555, 'accounts.svg', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `transmission` varchar(50) NOT NULL,
  `fuel` varchar(50) NOT NULL,
  `passenger` int(2) NOT NULL,
  `doors` int(2) NOT NULL,
  `color` varchar(50) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `type`, `brand`, `model`, `transmission`, `fuel`, `passenger`, `doors`, `color`, `price`, `quantity`, `image`) VALUES
(1, 'Sedan', 'BMW', 'M5', 'Automatic', 'Diesel', 6, 4, 'Gray', 200.00, 5, 'BMW M5.png'),
(2, 'Sedan', 'Honda', 'City', 'Manual', 'Unleaded', 5, 4, 'White', 200.00, 5, 'Honda City.png');

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `rent_id` int(11) NOT NULL,
  `customer` varchar(100) NOT NULL,
  `car` int(11) NOT NULL,
  `pdlocation` varchar(50) NOT NULL,
  `start` datetime NOT NULL,
  `return` datetime NOT NULL,
  `driver` varchar(50) NOT NULL,
  `extras` varchar(50) NOT NULL,
  `total` int(11) NOT NULL,
  `payment` varchar(255) NOT NULL DEFAULT 'Cash',
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`rent_id`, `customer`, `car`, `pdlocation`, `start`, `return`, `driver`, `extras`, `total`, `payment`, `status`) VALUES
(1, 'Geruel', 2, 'On Site', '2025-06-09 15:53:00', '2025-06-10 15:53:00', '', 'extra gas - roof box', 6300, 'Cash', 'Confirmed'),
(4, 'Walid Dimao', 2, 'On Site', '2025-06-09 15:53:00', '2025-06-10 15:53:00', '', 'No extra', 4800, 'Cash', 'Confirmed'),
(6, 'Geruel Alcaraz', 2, 'Cvsu Imus', '2025-06-11 08:20:00', '2025-06-14 08:20:00', 'No', 'extra gas - roof box - child seat', 16200, 'Cash', 'Confirmed'),
(7, 'Geruel Alcaraz', 1, 'Sa may kanto', '2025-06-11 09:16:00', '2025-06-12 09:16:00', 'Yes', 'roof box', 8900, 'proof_20250610_031650_6847878286b407.19276960.jpg', 'Request');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`rent_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `rent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
