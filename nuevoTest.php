<?php
require_once __DIR__ . '/includes/config.php';

use es\fdi\ucm\aw\Juego;

$tituloPagina = 'Exotic Games Academy - Nuevo Test';

$formulario = new \es\fdi\ucm\aw\FormulariosAdmin\FormularioTestNuevo();
$procesamiento = $formulario->gestiona();
$courseID=$_GET["id"];

if (isset($_SESSION["userID"]) && $_SESSION["admin"]){
    $contenidoPrincipal = <<<EOS
    <h1>Nuevo test: </h1>
    $procesamiento
    <a href = "contentTable.php?id=$courseID" class="submitbtn"> <button> Volver </button></a>
    EOS;
}else{
    $contenidoPrincipal="<h1>No tiene permiso para acceder a esta página</h1>";
}


require __DIR__ . '/includes/comun/layout.php';
