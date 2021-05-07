-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2021 at 05:50 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exoticga`
--
CREATE DATABASE IF NOT EXISTS `exoticga` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `exoticga`;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `courseID` int(3) NOT NULL AUTO_INCREMENT,
  `courseName` varchar(30) NOT NULL,
  `price` float NOT NULL,
  `game` varchar(30) NOT NULL,
  `level` int(1) NOT NULL,
  `duration` time NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`courseID`),
  KEY `game_courses` (`game`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
CREATE TABLE IF NOT EXISTS `games` (
  `name` varchar(30) NOT NULL,
  `category` varchar(20) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
CREATE TABLE IF NOT EXISTS `purchases` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `courseID` int(3) NOT NULL,
  `userID` int(4) UNSIGNED NOT NULL,
  `completed` int(3) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `purchases_fk_user` (`userID`),
  KEY `purchases_fk_course` (`courseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `given_name` varchar(15) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `date_of_birth` date NOT NULL,
  `date_of_registration` timestamp NOT NULL DEFAULT current_timestamp(),
  `description` mediumtext NOT NULL,
  `favorite_game` varchar(30) DEFAULT NULL COMMENT 'related to "games" table',
  `gender` int(1) UNSIGNED NOT NULL COMMENT '0 if male, 1 if female, 2 if non-binary',
  `points` int(3) UNSIGNED NOT NULL DEFAULT 0,
  `e-mail` varchar(30) NOT NULL,
  `password` varchar(70) NOT NULL,
  `role` binary(1) NOT NULL DEFAULT '\0',
  PRIMARY KEY (`userID`),
  KEY `user_fk_game` (`favorite_game`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `game_courses` FOREIGN KEY (`game`) REFERENCES `games` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_fk_course` FOREIGN KEY (`courseID`) REFERENCES `courses` (`courseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchases_fk_user` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_fk_game` FOREIGN KEY (`favorite_game`) REFERENCES `games` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
