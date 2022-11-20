-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2022 at 07:16 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `group6_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `club_table`
--

CREATE TABLE `club_table` (
  `clubID` int(11) NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `clubPhoto` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `club_table`
--

INSERT INTO `club_table` (`clubID`, `name`, `category`, `bio`, `contact`, `clubPhoto`) VALUES
(14, 'Biff\'sClub', 'hobby', 'This is Biff\'s great club!', 'BiffsClub@email.com', 'clubphoto12.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `membership_table`
--

CREATE TABLE `membership_table` (
  `userID` int(11) NOT NULL,
  `clubID` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `memberID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `membership_table`
--

INSERT INTO `membership_table` (`userID`, `clubID`, `admin`, `memberID`) VALUES
(12, 14, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `userID` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `realname` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userPhoto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`userID`, `username`, `password`, `realname`, `email`, `userPhoto`, `bio`) VALUES
(10, 'TestUser1', '$2y$10$rCvsg3qS2yUhXjHj/qhcRurZUUkwtI8FZC17vPFONOoLx3wcQ.x1C', '', 'Test@email.com', 'Photo.jpg', 'Test Bio'),
(11, 'TestUser2', '$2y$10$vsW88N4uAhYcLCshMQdLYOK/.XW4ly1EtTZVTpY0PxO7XPczY9Ch.', '', 'Test@email.com', '', ''),
(12, 'TestUser5', '$2y$10$XqeaZwoiJug2R1GeL3VEE.u9ADskKOn.tdCFPZJFMLXBSxDm/lsjW', 'Biff Steel', 'test@emaicl.com', 'userphoto12.png', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `club_table`
--
ALTER TABLE `club_table`
  ADD PRIMARY KEY (`clubID`);

--
-- Indexes for table `membership_table`
--
ALTER TABLE `membership_table`
  ADD PRIMARY KEY (`memberID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `clubID` (`clubID`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `club_table`
--
ALTER TABLE `club_table`
  MODIFY `clubID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `membership_table`
--
ALTER TABLE `membership_table`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `membership_table`
--
ALTER TABLE `membership_table`
  ADD CONSTRAINT `club_foreignkey` FOREIGN KEY (`clubID`) REFERENCES `club_table` (`clubID`),
  ADD CONSTRAINT `user_foreignkey` FOREIGN KEY (`userID`) REFERENCES `user_table` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
