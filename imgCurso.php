<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Editar foto de curso';
$juego = \es\fdi\ucm\aw\Juego::buscarJuegoPorNombre($_GET["juego"]);
$formulario = new \es\fdi\ucm\aw\FormulariosAdmin\FormularioImgCurso();



if(isset($_SESSION["userID"]) && $_SESSION["admin"]){
    $procesamiento = $formulario->gestiona();
    $contenidoPrincipal= <<<EOS
    <div class="login">
    $procesamiento
    </div>
    <a href = "adminCursos.php" class="submitbtn"> <button> Volver </button></a>
EOS;
}else{
    $contenidoPrincipal="<h1>No tiene permiso para acceder a esta página</h1>";
}

require __DIR__.'/includes/comun/layout.php';
