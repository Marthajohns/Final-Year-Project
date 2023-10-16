-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2023 at 08:14 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beeline`
--
CREATE DATABASE IF NOT EXISTS `beeline` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `beeline`;

-- --------------------------------------------------------

--
-- Table structure for table `alerts`
--

CREATE TABLE `alerts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `alert` text NOT NULL,
  `route` varchar(100) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `data` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `data`, `date`) VALUES
(0, 'Kisumu,Nairobi,Kisumu-Nairobi,2023-04-12,Ease Coach,Ease Coach,minibus,10:11:00,1300,1500,1,714643,A1,G3,2600,2', '2023-04-12 18:09:43');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `idno` varchar(10) NOT NULL,
  `seats_no` int(11) NOT NULL,
  `class` varchar(20) NOT NULL,
  `place_from` varchar(50) NOT NULL,
  `place_to` varchar(50) NOT NULL,
  `route_no` varchar(255) DEFAULT NULL,
  `unit_cost` varchar(20) NOT NULL,
  `total_price` varchar(20) NOT NULL,
  `mpesa` varchar(255) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `seat` text NOT NULL,
  `travel_date` date NOT NULL,
  `dated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `county` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `id` int(11) NOT NULL,
  `destination` varchar(20) NOT NULL,
  `dest_code` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`id`, `destination`, `dest_code`) VALUES
(1, 'Nairobi', 1),
(2, 'Nakuru', 2),
(3, 'Kisumu', 3),
(4, 'Voi', 4),
(5, 'Emali', 5),
(6, 'Eldoret', 6),
(7, 'Kendu Bay', 7),
(8, 'Mombasa', 8);

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` int(3) NOT NULL,
  `departure` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `Economy` decimal(8,2) NOT NULL,
  `VIP` decimal(8,2) NOT NULL,
  `route_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `departure`, `destination`, `Economy`, `VIP`, `route_code`) VALUES
(5, 'Nairobi', 'Athi River', '250.00', '350.00', 'rt001'),
(6, 'Nairobi', 'Miasenyi', '350.00', '450.00', 'rt002'),
(7, 'Nairobi', 'Voi', '450.00', '550.00', 'rt003'),
(8, 'Nairobi', 'Emali', '550.00', '650.00', 'rt004'),
(9, 'Nairobi', 'Mariakani', '650.00', '750.00', 'rt005'),
(10, 'Nairobi', 'Mtito Andei', '750.00', '850.00', 'rt006'),
(11, 'Nairobi', 'Mombasa', '850.00', '950.00', 'rt007'),
(12, 'Mombasa', 'Nairobi', '850.00', '950.00', 'rt008'),
(13, 'Mombasa', 'Mtito Andei', '250.00', '350.00', 'rt009'),
(14, 'Mombasa', 'Mariakami', '350.00', '450.00', 'rt010'),
(15, 'Mombasa', 'Emali', '450.00', '550.00', 'rt011'),
(16, 'Mombasa', 'Voi', '1350.00', '550.00', '650'),
(17, 'Mombasa', 'Maiseni', '650.00', '750.00', 'rt013'),
(18, 'Mombasa', 'Athi River', '750.00', '850.00', 'rt014');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `review_rating` int(11) NOT NULL,
  `review_comment` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `route_price`
--

CREATE TABLE `route_price` (
  `id` int(11) NOT NULL,
  `destination1` varchar(50) NOT NULL,
  `destination2` varchar(50) NOT NULL,
  `cash` int(11) NOT NULL,
  `vip_cash` int(11) NOT NULL,
  `company_code` varchar(50) NOT NULL,
  `vehicle_type` varchar(50) NOT NULL,
  `vip_seats_available` int(11) NOT NULL DEFAULT '0',
  `deptime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `route_price`
--

INSERT INTO `route_price` (`id`, `destination1`, `destination2`, `cash`, `vip_cash`, `company_code`, `vehicle_type`, `vip_seats_available`, `deptime`) VALUES
(1, 'Kisumu', 'Nairobi', 1300, 1500, 'Ease Coach', 'minibus', 0, '10:11:00'),
(2, 'Kisumu', 'Nairobi', 1200, 1400, 'Gaadian', 'shuttle', 2, '09:11:00');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `id` int(3) NOT NULL,
  `seatno` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'reserved',
  `date` date DEFAULT NULL,
  `ticket` varchar(30) NOT NULL,
  `class` varchar(20) NOT NULL,
  `route` varchar(30) NOT NULL,
  `busid` varchar(50) NOT NULL,
  `vehicle_type` varchar(50) NOT NULL,
  `deptime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id`, `seatno`, `status`, `date`, `ticket`, `class`, `route`, `busid`, `vehicle_type`, `deptime`) VALUES
(21, 'C1', 'reserved', '2023-04-12', 'nhgbgbf', 'economy', 'Kisumu-Nairobi', '1', 'minibus', '09:11:00'),
(22, 'A3', 'reserved', '2023-04-12', 'mtyr', 'economy', 'Kisumu-Nairobi', '1', 'minibus', '10:11:00'),
(29, 'A1', 'reserved', '2023-04-12', '714643', 'Economy', 'Kisumu-Nairobi', '1', 'minibus', '00:00:00'),
(30, 'G3', 'reserved', '2023-04-12', '714643', 'Economy', 'Kisumu-Nairobi', '1', 'minibus', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `travels`
--

CREATE TABLE `travels` (
  `Id` int(5) NOT NULL,
  `traintype` varchar(50) NOT NULL,
  `trainclass` varchar(50) NOT NULL,
  `origin` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `idnumber` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(250) NOT NULL DEFAULT '',
  `password` varchar(200) NOT NULL DEFAULT '',
  `name` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL DEFAULT 'user',
  `photo` varchar(255) NOT NULL DEFAULT 'avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `type`, `photo`) VALUES
(3, 'brian@admin.com', '$2y$10$U30PkRHfNq32cTB2QjsTJeRTW/5xn0rhou5tpTM3Ul98U4B5OAqE6', 'Brian Otedo', 'super_admin', 'a40480d6685eb9a02398d6c.png'),
(4, 'uonsda@adventistpocket.org', '$2y$10$/DNZjoJBE/0VqudDRMFfROyY2kVQ8bs3HcsyMOkdGqIhNOlgZxYd6', 'James', 'user', 'avatar.png');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `reg_type` varchar(30) NOT NULL,
  `vehicle_type` varchar(30) NOT NULL,
  `company_code` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `info` text NOT NULL,
  `image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_type`
--

CREATE TABLE `vehicle_type` (
  `id` int(11) NOT NULL,
  `vehicle_type` varchar(50) NOT NULL,
  `no_of_seats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `route_price`
--
ALTER TABLE `route_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `travels`
--
ALTER TABLE `travels`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alerts`
--
ALTER TABLE `alerts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `route_price`
--
ALTER TABLE `route_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `travels`
--
ALTER TABLE `travels`
  MODIFY `Id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
