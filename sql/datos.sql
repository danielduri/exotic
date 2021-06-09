-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 09-06-2021 a las 22:43:39
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
-- Volcado de datos para la tabla `foro`
--

INSERT INTO `foro` (`id`, `autorId`, `nombreJuego`, `titulo`, `mensaje`, `fecha`, `respuestas`, `identificador`) VALUES
(12, 16, 'Call of Duty-Warzone', 'Arma preferida?', 'Yo suelo usar el Ak pero se va bastante', '2021-06-08', 0, 1874079444),
(13, 20, 'Call of Duty-Warzone', 'Usa escopeta', 'Mejor jugar en cortas distancias bro, la gallo va bien', '2021-06-08', 0, 1340814115),
(14, 14, 'Animal Crossing-New Horizons', 'Nuevo foro para Animal Crossing', 'Bienvenidos a todos, se inaugura este foro para amantes de la comunidad de AC', '2021-06-08', 0, 969598014),
(16, 18, 'Animal Crossing-New Horizons', 'Duda Importante', 'Alguien sabe cuando Tom Nook deja de hipotecarte?', '2021-06-08', 0, 2118680037),
(66, 16, 'Animal Crossing-New Horizons', 'No te fies de él', 'Te va a seguir pidiendo hasta que se haga un centro comercial', '2021-06-10', 0, 33),
(67, 18, 'League of Legends', 'Dead Game 2021?', 'Recomendáis empezar a jugar al LOL, o le quedan 3 telediarios?', '2021-06-09', 0, 365336740),
(68, 19, 'League of Legends', 'Respeta', 'No se puede hablar así del mejor juego de la historia', '2021-06-09', 0, 818524420),
(69, 19, 'Chess', 'Curso Aperturas', 'Me gustaría apuntarme a este curso pero no sé si está del todo completo. Qué opinan?', '2021-06-09', 0, 660023766),
(70, 14, 'Chess', 'Info Curso Aperturas', 'En nuestra web contamos con las últimas novedades en aperturas modernas de ajedrez, totalmente recomendable apuntarse, no te arrepentirás.', '2021-06-09', 0, 1163728392),
(71, 20, 'Call of Duty-Warzone', 'Otra recomendacion', 'Usa el helicóptero en Security, ya me dirás.', '2021-06-09', 0, 1787765992);

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
('2 TIPS PARA HACERTE RICO!', 3, 4, 1, '<p style=\"text-align: center;\"><em><strong>El &aacute;rbol del dinero</strong></em></p>\r\n<p>Cuando veas una luz salir del suelo coge tu pala y prep&aacute;rate para la acci&oacute;n. Al utilizarla conseguir&aacute;s una bolsa cargada de bayas, pero no la a&ntilde;adas a tu monedero a&uacute;n. Lo que debes hacer es situarte frente al agujero con brillo, ir al inventario y&nbsp;<span style=\"font-weight: bold;\">plantar la bolsa de dinero</span>. En tres d&iacute;as las bayas caer&aacute;n de los &aacute;rboles como si fuese una fruta m&aacute;s.</p>\r\n<p style=\"text-align: center;\"><strong><em>A la rica tar&aacute;ntula</em></strong></p>\r\n<p>Las&nbsp;<span style=\"font-weight: bold;\">tar&aacute;ntulas</span>&nbsp;son uno de los bienes m&aacute;s preciados del juego, pero tambi&eacute;n el m&aacute;s peligroso. De un picotazo te mandar&aacute;n a la lona, as&iacute; que cazarlas no es f&aacute;cil hasta que le coges el truco, y es precisamente por lo que al venderlas en la tienda conseguir&aacute;s un buen pu&ntilde;ado de bayas.</p>\r\n<p>&nbsp;</p>', NULL, 0),
('LOL: Test 1', 4, 8, 1, '', 2, 1),
('WZ: Test 1', 5, 5, 1, '', 3, 1),
('LOL: Entrando en los counterpicks', 6, 9, 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', NULL, 0),
('LOL: Test 2', 7, 9, 2, '', 4, 1),
('VIDEO EXPLICATIVO DEL CONTROL DE OLEADAS POR NUESTRO COLABORADOR: WERLYB', 8, 6, 1, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/zUngFuw2U9g\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', NULL, 0),
('VIDEO EXPLICATIVO DE UNO DE NUESTROS JUGADORES', 9, 9, 3, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/lmUEtS4N3B0\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', NULL, 0),
('CHESS: Test 2', 10, 1, 2, '', 5, 1),
('ENTIENDE TU COMPRA', 11, 3, 1, '', 6, 1),
('ACNH: Conoce a tus vecinos', 23, 4, 2, 'Aquí encontrarás la lista completa de animales que es posible tener como vecinos en Animal Crossing New Horizons en Nintendo Switch, con los hilarantes nombres que tienen los más de 300 posibles habitantes para tu isla en castellano.\r\nEn Animal Crossing New Horizons, llegarás a una isla desierta que luego tendrás que decorar y poblar. Con la posibilidad de dar la bienvenida a 10 vecinos al mismo tiempo, aquí hay tienes una lista que te permitirá ver los animales con los que ya te has cruzado y los que te gustaría tener en tu isla. Hay más de 300 distintos, cada uno con su propio nombre, aspecto y personalidad. Cada página agrupa los mismos tipos de animales.\r\n\r\n<a href=\"https://es.millenium.gg/guias/17112.html\">Descrube a todos</a>\r\n\r\n', NULL, 0),
('ACNH: Test 1', 24, 4, 3, '', 7, 1),
('VIDEO EXPLICATIVO PARA LAS 5 ESTRELLAS', 25, 4, 4, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/PnfZ7pef-6E\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', NULL, 0),
('VIDEO DE LAS MEJORES CLASES EN LOADOUT', 26, 3, 2, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/hRe-1p1SWbw\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', NULL, 0),
('VIDEO PARA SUSTITUIR LA LUPA', 28, 5, 2, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/8IUFQh7B1F4\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', NULL, 0),
('LINK PARA REGISTRARTE GRATIS EN LICHESS', 29, 1, 1, '<a href=\"https://lichess.org/signup\">Crea una cuenta gratis con nuestro link</a>\r\n', NULL, 0),
('MATES BÁSICOS ', 30, 7, 1, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/VqF5uY92ueM\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', NULL, 0),
('DAMA + REY vs REY', 31, 7, 2, '<p style=\"text-align: center;\"><em><strong>Paso uno: encierra al rey enemigo en una caja</strong></em></p>\r\n<p>El primer paso es f&aacute;cil de llevar a cabo: tan solo debemos encerrar al rey de nuestro oponente en una caja situando nuestra dama a salto de caballo. En el siguiente diagrama, la dama y el rey blancos se enfrentan a un rey solitario. Lo &uacute;nico que tenemos que hacer para completar esta fase inicial es ubicar nuestra dama en e4, c4, c8, o f5. En este caso concreto vamos a comenzar con la jugada De4 (con idea de reducir al m&aacute;ximo el tama&ntilde;o de la caja del rey rival).</p>\r\n<p>&nbsp;</p>\r\n<p style=\"text-align: center;\"><em><strong>Paso dos: &iexcl;baila con el rey adversario!&nbsp;</strong></em></p>\r\n<p>En esta segunda fase, basta con copiar los movimientos del rey rival con nuestra dama. Si el oponente avanza una casilla con su rey, nosotros haremos lo propio con nuestra dama; si el adversario desplaza su rey una casilla en diagonal hacia la derecha, nosotros lo imitaremos con nuestra dama&mdash;haga lo que haga el rey enemigo, copiaremos ese movimiento con nuestra dama, situ&aacute;ndola siempre a salto de caballo.</p>\r\n<p>&nbsp;</p>\r\n<p>Este paso podr&iacute;a denominarse \"bailando con el rey adversario.\" En la posici&oacute;n que presentamos a continuaci&oacute;n, el rey negro acaba de desplazarse desde d6 hasta c7, es decir, una casilla en diagonal hacia la izquierda. &iquest;C&oacute;mo jugar&iacute;as en este momento?</p>\r\n<p>&nbsp;</p>\r\n<p style=\"text-align: center;\"><em><strong>Paso tres: &iexcl;deja la dama est&aacute;tica!</strong></em></p>\r\n<p>&iexcl;Lo primero que debemos saber sobre este tercer paso es que es fundamental que lo llevemos a cabo! Son numerosos los casos en los que el jugador con la dama de ventaja ha omitido esta fase y por lo tanto no ha podido dar jaque mate. As&iacute; que recuerda: &iexcl;deja tu dama est&aacute;tica una vez que el rey enemigo se haya desplazado hasta la esquina!&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>Puede que te est&eacute;s preguntando por qu&eacute; es tan importante que dejemos la dama inm&oacute;vil cuando el rey rival si sit&uacute;e en un rinc&oacute;n. La raz&oacute;n es muy simple: mira lo que ocurre si seguimos situando la dama a salto de caballo en ese momento. En el diagrama de debajo, las negras acaban de jugar Ra8 y las blancas han continuado el baile con la jugada Db6.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"text-align: center;\">P<em><strong>aso cuatro: lleva tu rey hasta la dama para dar jaque mate</strong></em></p>\r\n<p>Ahora que la caja del rey enemigo es muy peque&ntilde;a, ha llegado el momento de llevar nuestro rey para acompa&ntilde;ar a la dama a dar jaque mate. Conviene observar que el rey negro dispone &uacute;nicamente de dos casillas, como si fuese un prisionero en una celda dando pasos cortos hacia adelante y hacia atr&aacute;s. &iexcl;Ya conocemos las jugadas de nuestro oponente por lo que resta de partida! Su posici&oacute;n es desesperada y lo &uacute;nico que debemos hacer es acercar nuestro rey para asestar el golpe final. En el siguiente ejemplo, podemos comenzar jugando Rc3 y posteriormente llevarlo hasta c7, donde apoyar&aacute; a la dama para dar jaque mate.</p>\r\n<p>&nbsp;</p>', NULL, 0);

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
(16, 4, '¿Los counterpicks van cambiando con el paso del tiempo?', 'Cambian muy poco o si hay reajustes de campeones.  ', 'No, siempre se mantiene igual', 'Si, cada día. ', 'no existen counterpicks en el LOL.'),
(17, 5, '¿Que tiene mas valor una torre o un alfil?', 'La torre', 'El alfil', 'Tienen el mismo valor', 'El alfil en caso de ser el de suelo blanco'),
(18, 5, '¿Se puede ganar una partida solo con un caballo y el rey?', 'No, la partida terminara en tablas si el rival no tiene suficiente material', 'No, pero ganaras por tener mas material que el rival', 'Si', 'Si, el caballo solo puede hacer jaques mates'),
(19, 5, '¿Que tiene mayor valor generalmente, dos torres o una reina?', 'Las dos torres (10)', 'La reina (11)', 'Valen lo mismo (10)', 'Ns/nc'),
(20, 6, '¿Cuanto vale un LOADOUT en Verdansk?', '10.000 ', '20.000', '15.000', '5.000'),
(21, 6, '¿Sobre cuantas clases puedes elegir al comprar el LOADOUT?', '10', '15', '5', 'Las que tu elijas en el menú'),
(22, 6, '¿Cuanto cuesta un LOADOUT en Resurgimiento?', '7.500', '10.000', '12.500', 'No hay LOADOUT en este modo'),
(23, 7, '¿Cuantos vecinos y tipos de vecinos puede haber en ACNH?', 'Más de 300', 'Entre 100 y 200', 'Entre 200 y 300', 'Menos de 100'),
(24, 7, '¿Cuando es el cumpleaños de Felix, el vago gato?', 'El 11 de abril', 'El 2 de mayo', 'El 29 de febrero', 'El 31 de marzo'),
(25, 7, '¿Que personalidad caracteriza a Menta, la famosa ardilla?', 'Es presumida', 'Es graciosa', 'Es seria', 'Es buena pescadora'),
(26, 7, '¿El juego cuenta con tigres y leones como vecinos?', 'Si', 'No', 'Solo con tigres', 'Solo con leones');

--
-- Volcado de datos para la tabla `purchases`
--

INSERT INTO `purchases` (`id`, `courseID`, `userID`, `completed`) VALUES
(1, 2, 15, 1),
(2, 4, 15, 1),
(3, 3, 15, 1),
(4, 5, 15, 1),
(5, 1, 15, 1),
(6, 7, 15, 2),
(7, 4, 14, 2),
(8, 7, 14, 2),
(9, 5, 20, 2),
(10, 3, 20, 1);

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`userID`, `username`, `given_name`, `last_name`, `date_of_birth`, `date_of_registration`, `description`, `favorite_game`, `gender`, `points`, `e-mail`, `password`, `role`) VALUES
(14, 'admin', 'Administrador', 'Administrativo', '2003-11-12', '2021-04-16 15:46:09', '', NULL, 0, 0, 'admin@exotic.ga', '$2y$10$w/xIHZWiXSvA1z9KhcD0Du05WppKbgGHQhy7uAzSsJasyZkt0S1gu', 1),
(15, 'user', 'Usuario', 'de Ejemplo', '2001-12-13', '2021-04-16 15:46:45', '', 'Animal Crossing-New Horizons', 0, 0, 'user@exotic.ga', '$2y$10$nxVxaNmuaOYB3gfK9Ax.7uLNTdO2BCevII6.5Oi.dlbjw0UbyWvXy', 0),
(16, 'johndoe_33', 'John', 'Doe', '1900-01-01', '2021-04-16 15:48:50', '', NULL, 0, 0, 'doe@exotic.ga', '$2y$10$8IcOd5SmMoa3SxY0EqjGy.AfmvxT/ElbZAd21bhLRqeohKDlqnVT2', 0),
(18, 'AlexMilla99', 'Alejandro', 'Milla', '1999-03-19', '2021-06-08 21:57:39', '', NULL, 0, 0, 'alemilla@ucm.es', '$2y$10$2T3mJ/b8U4LVrePcZmlJEeerw0bNZX6xpPeVX95tcygwiB.fZs5Dy', 0),
(19, 'MariaLuisa2002', 'Maria Luisa', 'Perez', '2002-06-18', '2021-06-08 22:08:26', '', NULL, 1, 0, 'marilu@gmail.com', '$2y$10$oh3ZT9A.pCUmK29neDO9rOTgSszRLmhDQbkLdaayWquCJ/HJu1QjK', 0),
(20, 'Soki77', 'TitoSoki', 'sokito', '1995-04-06', '2021-06-08 22:14:20', '', NULL, 0, 0, 'soki@hotmail.com', '$2y$10$oqKhxpk3H5bVeMQ0QKKciurzjPz6m4.Yf..kCOlXgOZC9RuscjCEy', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
