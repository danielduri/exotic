-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 14-05-2021 a las 22:22:25
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

--
-- Volcado de datos para la tabla `courses`
--

INSERT INTO `courses` (`courseID`, `courseName`, `price`, `game`, `level`, `duration`, `description`, `numItems`) VALUES
(1, 'CHESS: Problemas', 4.99, 'Chess', 2, '01:30:00', 'Si quieres progresar y ser un buen jugador de ajedrez los problemas serán una gran ayuda en tu proceso, aquí te dejamos unos tips para aprender a hacer problemas, pues:\r\nEn primer lugar deberás fijarte si hay una captura con jaque, esta es la mejor manera de buscar el fin de la partida.', 0),
(2, 'CHESS: Aperturas', 19.99, 'Chess', 1, '02:00:00', 'En ajedrez se denomina apertura a la fase inicial del juego, en la que se procede a desarrollar las piezas desde sus posiciones iniciales. Las secuencias de movimientos iniciales reconocidas se conocen como aperturas o defensas y se le han dado nombres como: la Apertura española, la Defensa siciliana y el Gambito de Dama. ', 0),
(3, 'WZ: Comprar Loadout', 4.99, 'Call of Duty-Warzone', 1, '01:30:00', 'Los loadout se pueden comprar en cualquier estación de compras por $ 10,000. Una vez que haya gastado el dinero, recibirá una bengala. Lanza el cohete como si estuvieras usando una mejora en el campo (presionando L1 y R1 al mismo tiempo), y la caída de carga aterrizará donde caerá.\r\n Y por último... ten cuidad con la cabeza al solicitarlo!', 0),
(4, 'ACNH: 5 estrellas en 5 semanas', 29.99, 'Animal Crossing-New Horizons', 1, '05:00:00', 'Como en la vida real, si queremos incentivar el turismo en nuestra isla de Animal Crossing: New Horizons y que esta se convierta en un destino popular tendremos que hacer que luzca lo más atractiva posible. Es aquí donde entra en juego su nivel de popularidad.¡ Entra en el curso y enterate de más!\r\n\r\n', 0),
(5, 'WZ: Contrato de lupa', 1.99, 'Call of Duty-Warzone', 1, '00:30:00', 'A la hora de saltar en paracaídas del avión, el contrato más codiciado en Verdansk sin duda es la Lupa, y por lo tanto, el más difícil de coger para remediar esto te enseñaremos una serie de trucos para que puedas salir del principio de la partida con dinero suficiente para comprarte tu Loadout.', 0),
(6, 'LOL: Control de oleadas', 9.99, 'League of Legends', 2, '01:30:00', 'El control de oleadas es lo mas importante  para sacar ventaja a tu oponente, pues gracias a ello conseguirás mas nivel y mas oro en la fase de lineas, con nuestra guias del control de oleadas conseguirás que tu enemigo pierda muchos minions y tu no, paso fundamental en la subida de rangos como oro o platino. ', 0),
(7, 'CHESS: Mates', 1.99, 'Chess', 1, '01:30:00', 'Los mates es el punto más importante del final de las partidas, pues con este ganarás a tu adversario.El primer mate que os enseñaremos es el mate del pasillo, ocurre cuando una torre o dama amenaza al rey enemigo en la octava fila. El rey no puede escapar de la amenaza porque se encuentra bloqueado por sus propias piezas, que suelen ser, peones.', 0),
(8, 'LOL: Campeones', 1.99, 'League of Legends', 1, '01:30:00', 'A la hora de empezar a jugar al League of Legends lo más importante que debes saber es la funcionalidad de los campeones del juego y su \"rol\", puesto que, cada campeón suele tener una posición adecuada y si lo pones en una calle que no es la suya, perderá su potencial. Ejemplos:\r\nDarius -> Calle superior. \r\nSejuani -> Jungla.', 0),
(9, 'LOL: Counter picks', 14.99, 'League of Legends', 3, '06:00:00', 'Te traemos la tabla definitiva con todos los personajes y sus counters, con esto, sabrás que elección es la correcta y partirás con ventaja en la partida frente a tu adversario. Aquí os traemos una serie de ejemplos de \"counterpicks\".\r\n-> Si tu rival escoge a Garen tu debes usar rango, como Teemo o Vayne. \r\n-> Si tu rival escoge Maestro Yi debes usar a alguien con Stun, como Amumu.', 0);

--
-- Volcado de datos para la tabla `games`
--

INSERT INTO `games` (`name`, `category`, `description`) VALUES
('Animal Crossing-New Horizons', 'Simulación', '¡El popular simulador de Nintendo llega a Exotic Games Academy! En forma de su novena entrega de la saga Animal Crossing.'),
('Call of Duty-Warzone', 'Shooter', 'El juego presenta dos modos principales: Botín y Battle Royale. Warzone introduce un nuevo sistema de moneda en el juego que se puede utilizar en \"Estaciones de compra\". \r\nPrepárate para la lucha en el nuevo mapa de en Verdansk y sus alrededores con hasta 150 jugadores. '),
('Chess', 'Strategy', 'El ajedrez es un juego entre dos contrincantes en el que cada uno dispone al inicio de 16 piezas móviles que se colocan sobre el tablero.\r\nSe trata de un juego de estrategia en el que el objetivo es «derrocar» al rey del oponente, a través de un jaque mate con lo que se consigue el fin de la partida.'),
('League of Legends', 'Strategy', 'El juego consta de 3 modos actuales de juego en ejecución: La Grieta del Invocador, El Abismo de los Lamentos y Teamfight Tactics.​ Los jugadores compiten en partidas, que duran entre 15 y 50 minutos en promedio. En cada modo de juego, los equipos trabajan juntos para lograr una condición de victoria, destruyendo el Nexo en la base del equipo enemigo.');

--
-- Volcado de datos para la tabla `itemscursos`
--

INSERT INTO `itemscursos` (`nombreItem`, `idItem`, `idCurso`, `orden`, `codigo`, `idTest`, `esTest`) VALUES
('Bienvenido a CHESS: Aperturas', 1, 2, 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', NULL, 0),
('CHESS test 1', 2, 2, 2, '', 1, 1),
('Welcome', 3, 4, 1, '<h3>Welcome!!</h3>', NULL, 0),
('LOL: Test 1', 4, 8, 1, '', 2, 1),
('WZ: Test 1', 5, 5, 1, '', 3, 1),
('LOL: Entrando en los counterpicks', 6, 9, 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', NULL, 0),
('LOL: Test 2', 7, 9, 2, '', 4, 1),
('VIDEO EXPLICATIVO DEL CONTROL DE OLEADAS POR NUESTRO COLABORADOR: WERLYB', 8, 6, 1, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/zUngFuw2U9g\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', NULL, 0),
('VIDEO EXPLICATIVO DE UNO DE NUESTROS JUGADORES', 9, 9, 3, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/lmUEtS4N3B0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', NULL, 0),
('Placeholder Item', 19, 1, 1, ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer elementum pulvinar euismod. Sed nec mollis lectus, quis porta lacus. Morbi vitae ultricies ipsum. Praesent blandit egestas ex at euismod. Curabitur pulvinar erat ligula, nec pulvinar ex viverra porta. Cras posuere sagittis purus, non efficitur est mattis quis. Integer pulvinar neque purus, vel lacinia nibh volutpat id. Donec nec turpis turpis. Morbi mattis nisi ut turpis pellentesque, sed vulputate metus accumsan. Ut cursus quis sapien sit amet rutrum. Nulla suscipit, velit in pharetra porta, lectus magna fringilla mauris, ut aliquam libero ligula et tortor. Praesent vitae augue aliquet, ullamcorper enim id, dapibus metus. Fusce eu neque in mi malesuada ultricies laoreet ac turpis. Donec et molestie erat. Mauris ut ex velit.\r\n\r\nQuisque est eros, luctus at eleifend at, pellentesque id mi. Duis massa libero, sodales eu sollicitudin aliquet, dignissim a odio. Vivamus volutpat sed est at lobortis. Phasellus tortor arcu, iaculis vitae nulla id, tempus auctor tellus. Phasellus commodo ante in leo tincidunt, a sollicitudin lorem lobortis. Phasellus nibh purus, mollis vel lectus eu, molestie tempor dui. Aenean pellentesque, libero ac mattis iaculis, augue lacus tempor turpis, eu porttitor ante dui at orci. Ut pellentesque at leo eget vulputate. Vestibulum aliquet ultrices egestas. Pellentesque lectus sapien, viverra id diam vel, commodo semper augue. Ut euismod, libero vitae dapibus vehicula, elit justo aliquet orci, ac interdum felis dolor non libero. Donec venenatis magna in tellus porta, in placerat diam scelerisque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In vel accumsan mauris. Sed ut viverra libero. ', NULL, 0),
('Placeholder Item', 20, 3, 1, ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer elementum pulvinar euismod. Sed nec mollis lectus, quis porta lacus. Morbi vitae ultricies ipsum. Praesent blandit egestas ex at euismod. Curabitur pulvinar erat ligula, nec pulvinar ex viverra porta. Cras posuere sagittis purus, non efficitur est mattis quis. Integer pulvinar neque purus, vel lacinia nibh volutpat id. Donec nec turpis turpis. Morbi mattis nisi ut turpis pellentesque, sed vulputate metus accumsan. Ut cursus quis sapien sit amet rutrum. Nulla suscipit, velit in pharetra porta, lectus magna fringilla mauris, ut aliquam libero ligula et tortor. Praesent vitae augue aliquet, ullamcorper enim id, dapibus metus. Fusce eu neque in mi malesuada ultricies laoreet ac turpis. Donec et molestie erat. Mauris ut ex velit.\r\n\r\nQuisque est eros, luctus at eleifend at, pellentesque id mi. Duis massa libero, sodales eu sollicitudin aliquet, dignissim a odio. Vivamus volutpat sed est at lobortis. Phasellus tortor arcu, iaculis vitae nulla id, tempus auctor tellus. Phasellus commodo ante in leo tincidunt, a sollicitudin lorem lobortis. Phasellus nibh purus, mollis vel lectus eu, molestie tempor dui. Aenean pellentesque, libero ac mattis iaculis, augue lacus tempor turpis, eu porttitor ante dui at orci. Ut pellentesque at leo eget vulputate. Vestibulum aliquet ultrices egestas. Pellentesque lectus sapien, viverra id diam vel, commodo semper augue. Ut euismod, libero vitae dapibus vehicula, elit justo aliquet orci, ac interdum felis dolor non libero. Donec venenatis magna in tellus porta, in placerat diam scelerisque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In vel accumsan mauris. Sed ut viverra libero. ', NULL, 0),
('Placeholder Item', 21, 7, 1, ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer elementum pulvinar euismod. Sed nec mollis lectus, quis porta lacus. Morbi vitae ultricies ipsum. Praesent blandit egestas ex at euismod. Curabitur pulvinar erat ligula, nec pulvinar ex viverra porta. Cras posuere sagittis purus, non efficitur est mattis quis. Integer pulvinar neque purus, vel lacinia nibh volutpat id. Donec nec turpis turpis. Morbi mattis nisi ut turpis pellentesque, sed vulputate metus accumsan. Ut cursus quis sapien sit amet rutrum. Nulla suscipit, velit in pharetra porta, lectus magna fringilla mauris, ut aliquam libero ligula et tortor. Praesent vitae augue aliquet, ullamcorper enim id, dapibus metus. Fusce eu neque in mi malesuada ultricies laoreet ac turpis. Donec et molestie erat. Mauris ut ex velit.\r\n\r\nQuisque est eros, luctus at eleifend at, pellentesque id mi. Duis massa libero, sodales eu sollicitudin aliquet, dignissim a odio. Vivamus volutpat sed est at lobortis. Phasellus tortor arcu, iaculis vitae nulla id, tempus auctor tellus. Phasellus commodo ante in leo tincidunt, a sollicitudin lorem lobortis. Phasellus nibh purus, mollis vel lectus eu, molestie tempor dui. Aenean pellentesque, libero ac mattis iaculis, augue lacus tempor turpis, eu porttitor ante dui at orci. Ut pellentesque at leo eget vulputate. Vestibulum aliquet ultrices egestas. Pellentesque lectus sapien, viverra id diam vel, commodo semper augue. Ut euismod, libero vitae dapibus vehicula, elit justo aliquet orci, ac interdum felis dolor non libero. Donec venenatis magna in tellus porta, in placerat diam scelerisque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In vel accumsan mauris. Sed ut viverra libero. ', NULL, 0);

--
-- Volcado de datos para la tabla `preguntastest`
--

INSERT INTO `preguntastest` (`idPregunta`, `idTest`, `pregunta`, `respuestaCorrecta`, `respuestaIncorrecta1`, `respuestaIncorrecta2`, `respuestaIncorrecta3`) VALUES
(1, 1, '¿Cómo se llama este juego?', 'CHESS', 'ACNH', 'Warzone', 'League of Legends'),
(2, 1, 'Con cuantos peones cuentas en la apertura', '8', '10', '6', 'Los que puedas meter en el tablero'),
(3, 1, '¿Quien realiza la apertura?', 'Blancas', 'Negras', 'Ambas', 'El árbitro lo decide'),
(4, 1, '¿Quien es el actual campeón del mundo, revolucionario de las aperturas?', 'Magnus Carlsen', 'Hikaru Nakamura', 'Niepómniachi', 'Rey Dama alias \"Juanjo\"'),
(5, 2, '¿Donde mencionamos que Darius era mas efectivo?', 'Calle superior', 'Calle inferior (ADC).', 'Jungla', 'Calle Mayor'),
(6, 2, '¿Quien suele tener más puntos de salud (vida)?, los personajes de la calle superior o los de la calle inferior (ADC).', 'Calle superior', 'Calle inferior', 'Ambos suelen tener la misma vida o puntos de salud', 'En este juego no hay puntos de salud/vida. '),
(7, 2, '¿Donde suele jugar Sejuani?', 'Jungla', 'ADC', 'Soporte', 'No existe tal campeón. '),
(8, 2, 'Como funciona la \"ultimate\" de Janna', 'Crea un tornado alrededor suya que evita que personajes entren en esa zona', 'Crea una ola de agua que desplaza a los enemigos', 'Lanza 4 misiles ', 'Revive a un aliado muerto'),
(9, 3, '¿Conviene caer al principio en una lupa?', 'No', 'No, pero podria llegar a serlo si esta en Downtown', 'Si', 'No existe ese contrato'),
(10, 3, '¿que te dan al completar el contrato?', 'Una mochila con 8 escudos', 'Una mascara de gas', 'Una Scar legendaria y madera', 'Una M.O.A.B'),
(11, 3, '¿Cuantas cajas debes abrir para completar el contrato?', '3', '8', '4', '10'),
(12, 3, '¿Al completar la \"lupa\" reanimas a tus compañeros?', 'No, solo te dan dinero y lo que caiga del cofre. ', 'Si, y caen con sus respectivas armas', 'Si', 'No, pero te dan un loadout gratis. '),
(13, 4, '¿Que es un counter pick?', 'Elegir un campeón que tenga condiciones favorables contra el campeón rival.', 'Elegir un campeón de una calle que no le corresponde a la zona en la que esta jugando.', 'Jugar todos con el mismo campeón.', 'Ns/nc'),
(14, 4, '¿Quien es el counter de maestro Yi?', 'Amumu', 'Rumble', 'Su hermano el maestro Yo', 'El propio Maestro Yi '),
(15, 4, '¿Quien es el counter de Garen?', 'Ambos', 'Teemo', 'Vayne', 'Ninguno de ellos'),
(16, 4, '¿Los counterpicks van cambiando con el paso del tiempo?', 'Cambian muy poco o si hay reajustes de campeones.  ', 'No, siempre se mantiene igual', 'Si, cada día. ', 'no existen counterpicks en el LOL.');

--
-- Volcado de datos para la tabla `purchases`
--

INSERT INTO `purchases` (`id`, `courseID`, `userID`, `completed`) VALUES
(1, 2, 15, 2),
(2, 4, 15, 1),
(3, 9, 15, 1),
(4, 6, 15, 1),
(5, 1, 15, 1),
(6, 3, 15, 1),
(7, 5, 15, 1),
(8, 7, 15, 1),
(9, 8, 15, 1);

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`userID`, `username`, `given_name`, `last_name`, `date_of_birth`, `date_of_registration`, `description`, `favorite_game`, `gender`, `points`, `e-mail`, `password`, `role`) VALUES
(14, 'admin', 'Administrador', 'Administrativo', '2003-11-12', '2021-04-16 15:46:09', '', NULL, 0, 0, 'admin@exotic.ga', '$2y$10$w/xIHZWiXSvA1z9KhcD0Du05WppKbgGHQhy7uAzSsJasyZkt0S1gu', 0x00),
(15, 'user', 'User', 'Last', '2001-12-13', '2021-04-16 15:46:45', '', NULL, 0, 0, 'user@exotic.ga', '$2y$10$nxVxaNmuaOYB3gfK9Ax.7uLNTdO2BCevII6.5Oi.dlbjw0UbyWvXy', 0x00),
(16, 'johndoe_33', 'John', 'Doe', '1900-01-01', '2021-04-16 15:48:50', '', NULL, 0, 0, 'doe@exotic.ga', '$2y$10$8IcOd5SmMoa3SxY0EqjGy.AfmvxT/ElbZAd21bhLRqeohKDlqnVT2', 0x00);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
