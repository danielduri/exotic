<?php
require_once __DIR__ . '/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Nueva Pregunta';

$formulario = new \es\fdi\ucm\aw\FormulariosAdmin\FormularioPreguntaNueva();
$procesamiento = $formulario->gestiona();
$id=$_GET["id"];

if (isset($_SESSION["userID"]) && $_SESSION["admin"]){
    $contenidoPrincipal = <<<EOS
    <div class="login">
    <h1>Nueva pregunta: </h1>
    $procesamiento
    </div>
    <a href = "adminPreguntas.php?id=$id" class="submitbtn"> <button> Volver </button></a>
    EOS;
}else{
    $contenidoPrincipal="<h1>No tiene permiso para acceder a esta página</h1>";
}


require __DIR__ . '/includes/comun/layout.php';
