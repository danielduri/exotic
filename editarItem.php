<?php
require_once __DIR__ . '/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Editar Curso';

$formulario = new \es\fdi\ucm\aw\FormulariosAdmin\FormularioItems();
$procesamiento = $formulario->gestiona();
$id=$_GET["id"];
$item=\es\fdi\ucm\aw\Item::getItemFromID($id);
$idCurso=$item->getIdCurso();

if (isset($_SESSION["userID"]) && $_SESSION["admin"]){
    $contenidoPrincipal = <<<EOS
    <h1>Editar item: </h1>
    <h3>Los campos que dejes en blanco no se modificarán</h3>
    $procesamiento
    <a href = "contentTable.php?id=$idCurso" class="submitbtn"> <button> Volver </button></a>
    EOS;
}else{
    $contenidoPrincipal="<h1>No tiene permiso para acceder a esta página</h1>";
}


require __DIR__ . '/includes/comun/layout.php';
