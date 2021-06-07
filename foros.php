<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Foros';

$juegos = \es\fdi\ucm\aw\Juego::obtenerTodosLosJuegos();
$contenidoPrincipal = obtenerJuegosParaDisplayForo($juegos);

require __DIR__.'/includes/comun/layout.php';
