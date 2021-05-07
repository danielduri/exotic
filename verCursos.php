<?php

require_once __DIR__ . '/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Cursos';

$nombre = isset($_POST["explore"]) ? $_POST["explore"] : null;
$juego=\es\fdi\ucm\aw\Juego::buscarJuegoPorNombre($nombre);

$contenidoPrincipal = obtenerCursosJuegoParaDisplay($juego);

require __DIR__ . '/includes/comun/layout.php';
