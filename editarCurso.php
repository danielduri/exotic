<?php
require_once __DIR__ . '/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Editar Curso';

$formulario = new \es\fdi\ucm\aw\FormulariosAdmin\FormularioCurso();
$procesamiento = $formulario->gestiona();

if (isset($_SESSION["userID"]) && $_SESSION["admin"]){
    $contenidoPrincipal = <<<EOS
    <div class="login">
    <h1>Editar curso: </h1>
    <h3>Los campos que dejes en blanco no se modificarán</h3>
    $procesamiento
    </div>
    <a href = "adminCursos.php" class="submitbtn"> <button> Volver </button></a>
    EOS;
}else{
    $contenidoPrincipal="<h1>No tiene permiso para acceder a esta página</h1>";
}


require __DIR__ . '/includes/comun/layout.php';
