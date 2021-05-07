<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Juegos';

$juegos = \es\fdi\ucm\aw\Juego::obtenerTodosLosJuegos();
$contenidoPrincipal = obtenerJuegosParaDisplay($juegos);


require __DIR__.'/includes/comun/layout.php';


