<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Cursos';

$contenidoPrincipal = <<<EOS

<div class= "busquedaCSS">
<form action="cursos.php" method="post">
	<input type="search" placeholder="Buscar" name="busquedaCurso">
</form>
</div>

EOS;

$busqueda = isset($_POST["busquedaCurso"]) ? $_POST["busquedaCurso"] : null;

if ($busqueda != null){
    $juegos = \es\fdi\ucm\aw\Juego::mostrarJuegosBusqueda($busqueda);
} else {
    $juegos = \es\fdi\ucm\aw\Juego::obtenerTodosLosJuegos();
}

$contenidoPrincipal.= obtenerCursosParaDisplay($juegos);

require __DIR__.'/includes/comun/layout.php';
