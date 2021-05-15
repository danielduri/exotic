-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 14-05-2021 a las 22:08:05
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `exoticga`
--
CREATE DATABASE IF NOT EXISTS `exoticga` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `exoticga`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `courses`
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
  `numItems` int(3) NOT NULL DEFAULT 0,
  PRIMARY KEY (`courseID`),
  KEY `game_courses` (`game`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `games`
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
-- Estructura de tabla para la tabla `itemscursos`
--

DROP TABLE IF EXISTS `itemscursos`;
CREATE TABLE IF NOT EXISTS `itemscursos` (
  `nombreItem` text NOT NULL,
  `idItem` int(3) NOT NULL AUTO_INCREMENT,
  `idCurso` int(3) NOT NULL,
  `orden` int(3) NOT NULL,
  `codigo` mediumtext NOT NULL,
  `idTest` int(3) DEFAULT NULL,
  `esTest` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idItem`),
  UNIQUE KEY `idCurso` (`idCurso`,`orden`),
  KEY `item_fk_curso` (`idCurso`),
  KEY `item_fk_test` (`idTest`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Disparadores `itemscursos`
--
DROP TRIGGER IF EXISTS `numItems`;
DELIMITER $$
CREATE TRIGGER `numItems` AFTER INSERT ON `itemscursos` FOR EACH ROW UPDATE `courses` SET `numItems` = `numItems` + 1 WHERE courseID=new.idCurso
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntastest`
--

DROP TABLE IF EXISTS `preguntastest`;
CREATE TABLE IF NOT EXISTS `preguntastest` (
  `idPregunta` int(3) NOT NULL AUTO_INCREMENT,
  `idTest` int(3) NOT NULL,
  `pregunta` mediumtext NOT NULL,
  `respuestaCorrecta` mediumtext NOT NULL,
  `respuestaIncorrecta1` mediumtext NOT NULL,
  `respuestaIncorrecta2` mediumtext NOT NULL,
  `respuestaIncorrecta3` mediumtext NOT NULL,
  PRIMARY KEY (`idPregunta`),
  KEY `test_fk_item` (`idTest`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchases`
--

DROP TABLE IF EXISTS `purchases`;
CREATE TABLE IF NOT EXISTS `purchases` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `courseID` int(3) NOT NULL,
  `userID` int(4) UNSIGNED NOT NULL,
  `completed` int(3) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `purchases_fk_user` (`userID`),
  KEY `purchases_fk_course` (`courseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
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
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `game_courses` FOREIGN KEY (`game`) REFERENCES `games` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `itemscursos`
--
ALTER TABLE `itemscursos`
  ADD CONSTRAINT `item_fk_curso` FOREIGN KEY (`idCurso`) REFERENCES `courses` (`courseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `preguntastest`
--
ALTER TABLE `preguntastest`
  ADD CONSTRAINT `test_fk_item` FOREIGN KEY (`idTest`) REFERENCES `itemscursos` (`idTest`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_fk_course` FOREIGN KEY (`courseID`) REFERENCES `courses` (`courseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchases_fk_user` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_fk_game` FOREIGN KEY (`favorite_game`) REFERENCES `games` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
