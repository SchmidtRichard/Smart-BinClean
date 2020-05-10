-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2020 at 06:06 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bin`
--

-- --------------------------------------------------------

--
-- Table structure for table `realtime`
--

CREATE TABLE `realtime` (
  `id` int(6) UNSIGNED NOT NULL,
  `type` varchar(20) NOT NULL,
  `image` varchar(10) NOT NULL,
  `location` varchar(255) NOT NULL,
  `issue` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `realtime`
--

INSERT INTO `realtime` (`id`, `type`, `image`, `location`, `issue`, `date`) VALUES
(1, 'Mixed Recycling', 'half', 'First floor, Room 1.0.5', 'The lid is broken', '2020-05-10 14:23:05'),
(2, 'Organic Waste', 'half', 'First floor, Room 1.0.9', '', '2020-05-10 12:16:45'),
(3, 'General Waste', 'full', 'Second floor, Room 2.0.3', '', '2020-05-10 12:17:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `admin_rights` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `admin_rights`) VALUES
(2, 'Administrator', 'admin', 'admin', 'admin@yahoo.com', 'yes'),
(10, 'User', 'user', 'User12345', 'user@ncirl.ie', 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `realtime`
--
ALTER TABLE `realtime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
