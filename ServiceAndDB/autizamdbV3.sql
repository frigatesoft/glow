-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2017 at 02:22 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autizamdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `unique_id` varchar(23) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `encrypted_password` varchar(80) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `age` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `unique_id`, `name`, `email`, `encrypted_password`, `salt`, `created_at`, `updated_at`, `age`) VALUES
(28, '5852e1a3a45109.95504847', 'dddd', 'dddd', 'AJYR91XFHyG59mh+1+hFLNIoCH00MTJmYThlZTM0', '412fa8ee34', '2016-12-15 20:32:03', NULL, ' ffff');

-- --------------------------------------------------------

--
-- Table structure for table `userscore`
--

CREATE TABLE `userscore` (
  `Id` int(11) NOT NULL,
  `Unique_id` varchar(23) NOT NULL,
  `UserId` int(11) NOT NULL,
  `PracticeID` int(11) NOT NULL,
  `Score` float NOT NULL,
  `Timing` float NOT NULL,
  `stage` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userscore`
--

INSERT INTO `userscore` (`Id`, `Unique_id`, `UserId`, `PracticeID`, `Score`, `Timing`, `stage`, `created_at`, `updated_at`) VALUES
(20, '585c1fc1946e52.70137525', 3, 1, 5, 6000, 1, '2016-12-22 20:47:29', NULL),
(21, '585c1fc957d445.87871570', 3, 2, 5, 6000, 1, '2016-12-22 20:47:37', NULL),
(22, '58600b89a0ef57.33439564', 3, 3, 10, 25000, 2, '2016-12-25 20:10:17', NULL),
(23, '58766a84d4e922.34394785', 28, 1, 0, 6000, 1, '2017-01-11 19:25:24', '2017-01-12 15:16:24'),
(24, '58777a3b703195.03360992', 28, 1, 10, 6000, 3, '2017-01-12 14:44:43', NULL),
(25, '58777a4a590018.29110482', 28, 2, 20, 6000, 3, '2017-01-12 14:44:58', NULL),
(26, '58777a5460d014.74318375', 28, 3, 40, 6000, 3, '2017-01-12 14:45:08', '2017-01-12 14:49:56'),
(27, '58777b80d87118.87224240', 28, 5, 50, 6000, 3, '2017-01-12 14:50:08', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `userscore`
--
ALTER TABLE `userscore`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `userscore`
--
ALTER TABLE `userscore`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
