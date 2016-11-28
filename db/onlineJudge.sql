-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 17, 2016 at 10:46 PM
-- Server version: 5.6.33
-- PHP Version: 7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `onlineJudge`
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
  `verdict` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `language` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`SID`, `PID`, `UID`, `verdict`, `language`) VALUES
('1', '1A', '', '', NULL),
('2', '1A', '', '', NULL),
('agdhruv0', '1A', 'agdhruv', 'CE', NULL),
('agdhruv3', 'adf', 'agdhruv', '', NULL),
('agdhruv4', '', 'agdhruv', '', NULL),
('agdhruv5', '', 'agdhruv', '', NULL),
('agdhruv6', 'kkkbkbk', 'agdhruv', '', NULL),
('agdhruv7', '', 'agdhruv', '', NULL),
('agdhruv8', '', 'agdhruv', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UID` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Password field',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Name',
  `score` int(255) UNSIGNED NOT NULL,
  `accuracy` decimal(65,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UID`, `password`, `name`, `score`, `accuracy`) VALUES
('agdhruv', 'xyz', 'Dhruv Agarwal', 1, '50'),
('barun511', 'qwerty', 'Barun Parruck', 0, '0'),
('pravi', 'haha', 'Piyush Ravi', 0, '0'),
('thor', '12345', 'admin', 4294967295, '100'),
('vreddy', 'haha', 'Vineet Reddy', 2, '0');

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
