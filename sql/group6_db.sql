-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2022 at 07:16 PM
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
(14, 'Biff\'sClub', 'hobby', 'This is Biff\'s great club!', 'BiffsClub@email.com', 'clubphoto12.jpg'),
(25, 'Biff\'s Second Club', 'other', 'This is Biff\'s secondary club', 'Biff\'sClub@email.com', 'clubphoto25.jpg'),
(26, 'Kyle\'s Test Club', 'charity', 'This is a test For my very good club', 'KylesClub@email.com', 'clubphoto26.png');

-- --------------------------------------------------------

--
-- Table structure for table `event_table`
--

CREATE TABLE `event_table` (
  `eventID` int(11) NOT NULL,
  `clubID` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_table`
--

INSERT INTO `event_table` (`eventID`, `clubID`, `title`, `description`, `date`, `time`) VALUES
(1, 14, 'Biff\'s first event!', 'This is Biff\'s first glorious event', '2022-11-26', '05:00:00'),
(3, 26, 'Second Event', 'This is the second event for my club', '2022-12-01', '20:00:00'),
(4, 26, 'Third event', 'You know What\'s happenin', '2022-12-08', '09:30'),
(5, 26, 'Fourth event', 'I sure hope this works', '2022-11-16', '20:36');

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
(12, 14, 1, 3),
(12, 25, 1, 7),
(13, 14, 0, 9),
(13, 26, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `posts_table`
--

CREATE TABLE `posts_table` (
  `postID` int(11) NOT NULL,
  `clubID` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts_table`
--

INSERT INTO `posts_table` (`postID`, `clubID`, `title`, `content`) VALUES
(1, 14, 'First post!', 'This is Biff\'s Club\'s glorious first post!'),
(11, 26, 'Another post', 'Bleh'),
(12, 26, 'Test post 1000', 'This is a test post'),
(13, 26, ' ', ' ');

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
  `bio` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `siteAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`userID`, `username`, `password`, `realname`, `email`, `userPhoto`, `bio`, `siteAdmin`) VALUES
(10, 'TestUser1', '$2y$10$rCvsg3qS2yUhXjHj/qhcRurZUUkwtI8FZC17vPFONOoLx3wcQ.x1C', '', 'Test@email.com', 'Photo.jpg', 'Test Bio', 0),
(11, 'TestUser2', '$2y$10$vsW88N4uAhYcLCshMQdLYOK/.XW4ly1EtTZVTpY0PxO7XPczY9Ch.', '', 'Test@email.com', '', '', 0),
(12, 'TestUser5', '$2y$10$XqeaZwoiJug2R1GeL3VEE.u9ADskKOn.tdCFPZJFMLXBSxDm/lsjW', 'Biff Steel', 'test@emaicl.com', 'userphoto12.png', 'This is Biff\'s glorious bio', 0),
(13, 'KDriver', '$2y$10$rD7HeVOZpZ/k9qJztSfG1uk1kk5cK45LRGuB78rDPRLxg5pUp0JXG', 'Kyle Driver', 'kdriver@umich.edu', 'userphoto13.png', 'This is My Bio', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `club_table`
--
ALTER TABLE `club_table`
  ADD PRIMARY KEY (`clubID`);

--
-- Indexes for table `event_table`
--
ALTER TABLE `event_table`
  ADD PRIMARY KEY (`eventID`),
  ADD KEY `clubEvent_foreignKey` (`clubID`);

--
-- Indexes for table `membership_table`
--
ALTER TABLE `membership_table`
  ADD PRIMARY KEY (`memberID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `clubID` (`clubID`);

--
-- Indexes for table `posts_table`
--
ALTER TABLE `posts_table`
  ADD PRIMARY KEY (`postID`),
  ADD KEY `clubPosts_foreignKey` (`clubID`);

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
  MODIFY `clubID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `event_table`
--
ALTER TABLE `event_table`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `membership_table`
--
ALTER TABLE `membership_table`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `posts_table`
--
ALTER TABLE `posts_table`
  MODIFY `postID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event_table`
--
ALTER TABLE `event_table`
  ADD CONSTRAINT `clubEvent_foreignKey` FOREIGN KEY (`clubID`) REFERENCES `club_table` (`clubID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `membership_table`
--
ALTER TABLE `membership_table`
  ADD CONSTRAINT `club_foreignkey` FOREIGN KEY (`clubID`) REFERENCES `club_table` (`clubID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_foreignkey` FOREIGN KEY (`userID`) REFERENCES `user_table` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts_table`
--
ALTER TABLE `posts_table`
  ADD CONSTRAINT `clubPosts_foreignKey` FOREIGN KEY (`clubID`) REFERENCES `club_table` (`clubID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
