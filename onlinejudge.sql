-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Nov 13, 2016 at 11:02 AM
-- Server version: 5.6.34
-- PHP Version: 5.6.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinejudge`
--

-- --------------------------------------------------------

--
-- Table structure for table `problems`
--

CREATE TABLE `problems` (
  `PID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timeout` int(10) NOT NULL,
  `points` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table to store Problems';

--
-- Dumping data for table `problems`
--

INSERT INTO `problems` (`PID`, `timeout`, `points`) VALUES
('1A', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `SID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `verdict` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`SID`, `PID`, `UID`, `verdict`) VALUES
('agdhruv0', '1A', 'agdhruv', 'CE'),
('barun5111', '1A', 'barun511', 'CE'),
('barun51110', '1A', 'barun511', 'AC'),
('barun51111', '1A', 'barun511', 'WA'),
('barun51112', '1A', 'barun511', 'CE'),
('barun51113', '1A', 'barun511', 'TLE'),
('barun51114', '1A', 'barun511', 'TLE'),
('barun51115', '1A', 'barun511', 'AC'),
('barun51116', '1A', 'barun511', 'WA'),
('barun51117', '1A', 'barun511', 'CE'),
('barun51118', '1A', 'barun511', 'TLE'),
('barun5112', '1A', 'barun511', 'CE'),
('barun5113', '1A', 'barun511', 'AC'),
('barun5114', '1A', 'barun511', ''),
('barun5115', '1A', 'barun511', ''),
('barun5116', '1A', 'barun511', 'CE'),
('barun5117', '1A', 'barun511', 'WA'),
('barun5118', '1A', 'barun511', 'AC'),
('barun5119', '1A', 'barun511', 'AC');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UID` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Password field',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Name',
  `score` int(255) DEFAULT NULL,
  `accuracy` decimal(65,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UID`, `password`, `name`, `score`, `accuracy`) VALUES
('ASD', 'asd', 'barun511', 0, '0'),
('barun511', 'qwerty', 'Barun Parruck', 0, '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`SID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UID`(32));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
