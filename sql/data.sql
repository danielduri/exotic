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

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseID`, `courseName`, `price`, `game`, `level`, `duration`, `description`) VALUES
(2, 'CHESS: Aperturas', 19.99, 'Chess ', 1, '02:00:00', 'En ajedrez se denomina apertura a la fase inicial del juego, en la que se procede a desarrollar las piezas desde sus posiciones iniciales. Las tres fases de una partida de ajedrez son: apertura, medio juego y final. Las secuencias de movimientos iniciales reconocidas se conocen como aperturas o defensas y se le han dado nombres como: la Apertura española, la Defensa siciliana y el Gambito de Dama. Hay docenas de aperturas diferentes que pueden variar ampliamente desde el punto de vista del carácter, desde el juego posicional (p.ej. la Apertura Reti y algunas líneas del Gambito de Dama) hasta líneas de táctica salvaje (como el Gambito Letón y la Defensa de los dos caballos).\r\n\r\nLa apertura es un elemento fundamental en el ajedrez. Una apertura sólida permitirá consolidar posiciones ventajosas; por el contrario, la debilidad en la apertura difícilmente podrá ser compensada en el posterior transcurso del juego.'),
(3, 'WZ: Comprar Loadout', 4.99, 'Call of Duty: Warzone', 1, '01:30:00', 'Los loadout se pueden comprar en cualquier estación de compras por $ 10,000. Una vez que haya gastado el dinero, recibirá una bengala. Lanza el cohete como si estuvieras usando una mejora en el campo (presionando L1 y R1 al mismo tiempo), y la caída de carga aterrizará donde caerá.\r\n Y por último... ten cuidad con la cabeza al solicitarlo!'),
(4, 'ACNH: 5 estrellas en 5 semanas', 29.99, 'Animal Crossing: New Horizons', 1, '05:00:00', 'Como en la vida real, si queremos incentivar el turismo en nuestra isla de Animal Crossing: New Horizons y que esta se convierta en un destino popular tendremos que hacer que luzca lo más atractiva posible. Es aquí donde entra en juego su nivel de popularidad, algo que podremos incrementar realizando diversas tareas, aunque se trata de una mecánica que podría no resultar demasiado intuitiva. Por ello, en este curso os explicamos todo lo que necesitáis saber para hacer de vuestra isla el lugar más popular y famoso.\r\n\r\n');

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`name`, `category`, `description`) VALUES
('Animal Crossing: New Horizons', 'Simulación', '¡El popular simulador de Nintendo llega a Exotic Games Academy!'),
('Call of Duty: Warzone', 'Shooter', 'El juego presenta dos modos principales: Botín y Battle Royale. Warzone introduce un nuevo sistema de moneda en el juego que se puede utilizar en \"Estaciones de compra\" en Verdansk y sus alrededores. Las entregas de \"armamento\" son un ejemplo de dónde se puede intercambiar efectivo por acceso limitado a las clases de armas personalizadas de los jugadores (antes las clases se compartían con las del modo multijugador de Modern Warfare, pero en el parche v1.29 de la temporada 6 las separaron, y ahora son diferentes los de Warzone con los de Modern Warfare Y Cold War por la comodidad de los jugadores). Los jugadores también pueden usar dinero para comprar artículos como \"Rachas de bajas\" y máscaras Anti gas. Se puede encontrar dinero en efectivo saqueando edificios y matando a jugadores que tienen dinero en efectivo. En el lanzamiento, Warzone solo ofreció el modo Trios, una capacidad de escuadrón de tres jugadores. Sin embargo, en las actualizaciones de contenido gratuitas posteriores al lanzamiento, se han agregado al juego Solos, Duos y Escuadrones (4).'),
('Chess ', 'Strategy', 'El ajedrez es un juego entre dos contrincantes en el que cada uno dispone al inicio de 16 piezas móviles que se colocan sobre un tablero,​ dividido en 64 casillas. En su versión de competición,​ está considerado como un deporte aunque en la actualidad tiene claramente una dimensión social,​ educativa y terapéutica, también.\r\n\r\nSe juega sobre un tablero cuadriculado de 8×8 casillas (llamadas escaques),​ alternadas en colores blanco y negro, que constituyen las 64 posibles posiciones de las piezas para el desarrollo del juego. Al principio del juego cada jugador tiene dieciséis piezas: un rey, una dama, dos alfiles, dos caballos, dos torres y ocho peones. Se trata de un juego de estrategia en el que el objetivo es «derrocar» al rey del oponente. Esto se hace amenazando la casilla que ocupa el rey con alguna de las piezas propias sin que el otro jugador pueda proteger a su rey interponiendo una pieza entre su rey y la pieza que lo amenaza, mover su rey a un escaque libre o capturar a la pieza que lo está amenazando, lo que trae como resultado el jaque mate y el fin de la partida.'),
('League of Legends ', 'Strategy', 'El juego consta de 3 modos actuales de juego en ejecución: La Grieta del Invocador, El Abismo de los Lamentos y Teamfight Tactics.​ Los jugadores compiten en partidas, que duran entre 15 y 50 minutos en promedio. En cada modo de juego, los equipos trabajan juntos para lograr una condición de victoria, normalmente destruyendo la estructura central (llamado Nexo) en la base del equipo enemigo después de pasar por alto una línea de estructuras defensivas llamadas Torretas. En todos los modos de juego, los jugadores controlan personajes llamados «campeones», elegidos o asignados en cada partida, que tienen un conjunto de habilidades únicas, con los cuales jugarán toda la partida hasta su conclusión. Desde enero de 2021, hay 154 campeones disponibles, siendo el último añadido Viego, el Rey Arruinado.\r\n\r\nLos campeones comienzan cada partida con un bajo nivel, y luego ganan experiencia en el transcurso de la partida para alcanzar un nivel máximo de 18. Ganar niveles de experiencia en las partidas permite a los jugadores desbloquear las habilidades especiales de su campeón y aumentarlas de varias maneras únicas para cada personaje. Si un campeón pierde toda su salud, es derrotado, pero es revivido automáticamente en su base una vez que pase el tiempo suficiente. Los campeones también comienzan cada partida con una cantidad baja de oro, y pueden ganar oro adicional durante todo la partida de varias maneras: matando a personajes no jugadores conocidos como súbditos y monstruos; matando o ayudando a matar campeones enemigos; destruyendo las estructuras enemigas; pasivamente a través del tiempo; y a través de interacciones con artículos únicos o habilidades de campeón. Este oro se puede gastar a lo largo de la partida para comprar artículos del juego que aumentan aún más las estadísticas de cada campeón (ataque, defensa, vida, etc.) y la jugabilidad en una variedad de formas. La experiencia del campeón, el oro ganado y los artículos comprados son específicos de cada partida y no se transfieren a partidas posteriores. Por lo tanto, todos los jugadores comienzan cada partida en relativa igualdad de condiciones con respecto a su equipo contrario.');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `given_name`, `last_name`, `date_of_birth`, `date_of_registration`, `description`, `favorite_game`, `gender`, `points`, `e-mail`, `password`, `role`) VALUES
(14, 'admin', 'Administrador', 'Administrativo', '2003-11-12', '2021-04-16 15:46:09', '', NULL, 0, 0, 'admin@exotic.ga', '$2y$10$w/xIHZWiXSvA1z9KhcD0Du05WppKbgGHQhy7uAzSsJasyZkt0S1gu', 0x00),
(15, 'user', 'Usuario', 'de Ejemplo', '2001-12-13', '2021-04-16 15:46:45', '', NULL, 0, 0, 'user@exotic.ga', '$2y$10$nxVxaNmuaOYB3gfK9Ax.7uLNTdO2BCevII6.5Oi.dlbjw0UbyWvXy', 0x00),
(16, 'johndoe_33', 'John', 'Doe', '1900-01-01', '2021-04-16 15:48:50', '', NULL, 0, 0, 'doe@exotic.ga', '$2y$10$8IcOd5SmMoa3SxY0EqjGy.AfmvxT/ElbZAd21bhLRqeohKDlqnVT2', 0x00);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
