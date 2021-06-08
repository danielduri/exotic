<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Administrar juegos';

if(isset($_SESSION["userID"]) && $_SESSION["admin"]){
    $test=\es\fdi\ucm\aw\Test::getTestFromID(null, $_GET["id"]);
    $contenidoPrincipal=obtenerPreguntasTestParaAdmin($test->getPreguntas());
    $contenidoPrincipal.="<div class='navigationButton'><a href='nuevaPregunta.php?id=";
    $contenidoPrincipal.=$_GET["id"];
    $contenidoPrincipal.="'><button>Nueva pregunta</button></a>";
    if(isset($_GET["backTo"])){
        $contenidoPrincipal.="<a href='contentTable.php?id=";
        $contenidoPrincipal.=$_GET["backTo"];
    }else{
        $contenidoPrincipal.="<a href='adminCursos.php";
    }
    $contenidoPrincipal.="'><button>Volver</button></a></div>";


}else{
    $contenidoPrincipal="<h1>No tiene permiso para acceder a esta página</h1>";
}

require __DIR__.'/includes/comun/layout.php';