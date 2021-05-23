<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Administrar juegos';

if(isset($_SESSION["userID"]) && $_SESSION["admin"]){
    $juegos = \es\fdi\ucm\aw\Juego::obtenerTodosLosJuegos();
    $contenidoPrincipal=obtenerJuegosParaAdmin($juegos);
}else{
    $contenidoPrincipal="<h1>No tiene permiso para acceder a esta página</h1>";
}



require __DIR__.'/includes/comun/layout.php';