-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 13, 2016 at 11:39 PM
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
  `verdict` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`SID`, `PID`, `UID`, `verdict`) VALUES
('agdhruv0', '1A', 'agdhruv', 'CE');

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
('thor', '12345', 'admin', 4294967295, '100');

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
