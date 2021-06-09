<?php
require_once __DIR__ . '/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Nuevo Item';

$formulario = new \es\fdi\ucm\aw\FormulariosAdmin\FormularioItemsNuevo();
$procesamiento = $formulario->gestiona();
$courseID=$_GET["id"];

if (isset($_SESSION["userID"]) && $_SESSION["admin"]){
    $contenidoPrincipal = <<<EOS
    <h1>Nuevo item: </h1>
    $procesamiento
    <a href = "contentTable.php?id=$courseID" class="submitbtn"> <button> Volver </button></a>
    EOS;
}else{
    $contenidoPrincipal="<h1>No tiene permiso para acceder a esta página</h1>";
}


require __DIR__ . '/includes/comun/layoutConEditor.php';
