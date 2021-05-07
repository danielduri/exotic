<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Cursos';

$juegos = \es\fdi\ucm\aw\Juego::obtenerTodosLosJuegos();
$contenidoPrincipal = obtenerCursosParaDisplay($juegos);

require __DIR__.'/includes/comun/layout.php';
