-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2025 at 06:34 AM
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
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`) VALUES
('largapinas159632145698753', 'largapinas', 'largapinas12');

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
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `type`, `brand`, `model`, `transmission`, `fuel`, `passenger`, `doors`, `color`, `price`, `image`) VALUES
(1, 'Sedan', 'BMW', 'M5', 'Automatic', 'Diesel', 6, 4, 'Gray', 200.00, 'BMW M5.png'),
(2, 'Sedan', 'Honda', 'City', 'Manual', 'Unleaded', 5, 4, 'White', 200.00, 'Honda City.png'),
(4, 'AUV', 'Yeah', 'Sad', 'sad', 'sad', 5, 5, 'sad', 150.00, 'Cadillac CT6 V.png'),
(5, 'Sedan', 'Nissan', 'Almera', 'Manual', 'Diesel', 5, 4, 'Black', 180.00, 'nissan almera.png'),
(9, 'Sedan', 'Roll Royce', 'Phantom', 'Manual', 'Diesel', 5, 4, 'Black', 250.00, 'Rolls Royce Phantom.png');

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `rent_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(11) NOT NULL,
  `car` int(11) NOT NULL,
  `pickup` datetime NOT NULL,
  `return` datetime NOT NULL,
  `extras` varchar(50) NOT NULL,
  `total` int(11) NOT NULL,
  `proof` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`rent_id`, `fullname`, `email`, `phone`, `car`, `pickup`, `return`, `extras`, `total`, `proof`, `status`) VALUES
(8, 'asdsa', 'asdsad', 155, 1, '2025-07-01 00:00:00', '2025-07-01 09:00:00', 'No extra', 2700, 'proof_20250614_052116_684ceaac858502.18722430.png', 'Request'),
(9, 'Geruel Alcaraz', 'geruel@gmail.com', 2147483647, 1, '2025-09-01 06:00:00', '2025-09-05 12:00:00', 'No extra', 30600, 'proof_20250614_053133_684ced15707306.12010788.png', 'Confirmed'),
(10, 'Robbie Noob', 'robbie@gmail.com', 968955665, 1, '2025-06-17 00:00:00', '2025-06-19 09:00:00', 'extra gas - roof box - child seat', 18900, 'proof_20250614_053341_684ced95ec4235.77515942.png', 'Rejected'),
(11, 'yeah', 'yeah', 1515, 1, '2025-07-01 00:00:00', '2025-07-04 00:00:00', 'No extra', 21600, 'proof_20250614_053438_684cedcea145b8.74211026.png', 'Request'),
(12, 'asdsad', 'asdsad', 6556156, 1, '2025-07-05 00:00:00', '2025-07-07 00:00:00', 'extra gas - child seat', 15700, 'proof_20250614_053528_684cee009d8a11.28775398.png', 'Request');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `rent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
