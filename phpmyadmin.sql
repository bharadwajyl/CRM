-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 22, 2022 at 05:28 PM
-- Server version: 8.0.29-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmyadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `companydb`
--

CREATE TABLE `companydb` (
  `id` int NOT NULL,
  `company` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `logo` varchar(200) DEFAULT NULL,
  `website` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `companydb`
--

INSERT INTO `companydb` (`id`, `company`, `email`, `logo`, `website`) VALUES
(1, 'Agriforetell', 'support@agriforetell.com', '', 'www.agriforetell.com'),
(2, 'PrabhupadaWorld', 'support@prabhupadaworld.com', '', 'prabhupadaworld.com'),
(3, 'Magniflex', 'magniflex.co.in', '', 'magniflexindia.com');

-- --------------------------------------------------------

--
-- Table structure for table `employeedb`
--

CREATE TABLE `employeedb` (
  `id` int NOT NULL,
  `companyid` varchar(100) DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employeedb`
--

INSERT INTO `employeedb` (`id`, `companyid`, `fname`, `lname`, `email`, `contact`) VALUES
(13, '1', 'mahesh', 'Bharadwaj', 'bharadwajyl@mail.com', '7892731203');

-- --------------------------------------------------------

--
-- Table structure for table `QuntumCredentials`
--

CREATE TABLE `QuntumCredentials` (
  `id` int NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `pssd` varchar(50) DEFAULT NULL,
  `auth` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `QuntumCredentials`
--

INSERT INTO `QuntumCredentials` (`id`, `email`, `pssd`, `auth`) VALUES
(1, 'admin@admin.com', 'password', NULL),
(2, 'host', 'root', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companydb`
--
ALTER TABLE `companydb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employeedb`
--
ALTER TABLE `employeedb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `QuntumCredentials`
--
ALTER TABLE `QuntumCredentials`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companydb`
--
ALTER TABLE `companydb`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employeedb`
--
ALTER TABLE `employeedb`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `QuntumCredentials`
--
ALTER TABLE `QuntumCredentials`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
