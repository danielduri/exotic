<?php
require_once __DIR__ . '/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Editar Pregunta';

$formulario = new \es\fdi\ucm\aw\FormulariosAdmin\FormularioPregunta();
$procesamiento = $formulario->gestiona();
$idTest=$_GET["idTest"];

if (isset($_SESSION["userID"]) && $_SESSION["admin"]){
    $contenidoPrincipal = <<<EOS
    <div class="login">
    <h1>Editar pregunta: </h1>
    <h3>Los campos que dejes en blanco no se modificarán</h3>
    $procesamiento
    </div>
    <a href = "adminPreguntas.php?id=$idTest" class="submitbtn"> <button> Volver </button></a>
    EOS;
}else{
    $contenidoPrincipal="<h1>No tiene permiso para acceder a esta página</h1>";
}


require __DIR__ . '/includes/comun/layout.php';
