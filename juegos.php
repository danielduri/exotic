<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Juegos';


$contenidoPrincipal =<<<EOS

<div class= "busquedaCSS">
<form action="juegos.php" method="post">
	<input type="search" placeholder="Buscar" name="busquedaJuego">
</form>
</div>

EOS;

$busqueda = isset($_POST["busquedaJuego"]) ? $_POST["busquedaJuego"] : null;

if ($busqueda != null){
    $juegos = \es\fdi\ucm\aw\Juego::mostrarJuegos($busqueda);
} else {
    $juegos = \es\fdi\ucm\aw\Juego::obtenerTodosLosJuegos();
}

$contenidoPrincipal.= obtenerJuegosParaDisplay($juegos);


require __DIR__.'/includes/comun/layout.php';


