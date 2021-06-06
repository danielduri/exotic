<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Administrar juegos';

if(isset($_SESSION["userID"]) && $_SESSION["admin"]){
    $test=\es\fdi\ucm\aw\Test::getTestFromID(null, $_GET["id"]);
    $contenidoPrincipal=obtenerPreguntasTestParaAdmin($test->getPreguntas());
    $contenidoPrincipal.="<a href='nuevaPregunta?id=";
    $contenidoPrincipal.=$_GET["id"];
    $contenidoPrincipal.="><button>Nueva pregunta</button></a>";

}else{
    $contenidoPrincipal="<h1>No tiene permiso para acceder a esta página</h1>";
}

require __DIR__.'/includes/comun/layout.php';