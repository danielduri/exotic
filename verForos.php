<?php

require_once __DIR__ . '/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Foros';

$nombre = isset($_GET["juego"]) ? $_GET["juego"] : null;
$juego=\es\fdi\ucm\aw\Juego::buscarJuegoPorNombre($nombre);

if($nombre!=null && $juego!=null){
    $contenidoPrincipal = obtenerForosParaAdmin($juego);
}else{
    $contenidoPrincipal="<p class='contenido'>No se ha encontrado este juego</p>";
}

require __DIR__ . '/includes/comun/layout.php';
