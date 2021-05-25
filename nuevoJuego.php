<?php
require_once __DIR__ . '/includes/config.php';

use es\fdi\ucm\aw\Juego;

$tituloPagina = 'Exotic Games Academy - Editar Juego';

$formulario = new \es\fdi\ucm\aw\FormulariosAdmin\FormularioJuegoNuevo();
$procesamiento = $formulario->gestiona();

if (isset($_SESSION["userID"]) && $_SESSION["admin"]){
    $contenidoPrincipal = <<<EOS
    <div class="login">
    <h1>Nuevo juego: </h1>
    $procesamiento
    </div>
    <a href = "adminJuegos.php" class="submitbtn"> <button> Volver </button></a>
    EOS;
}else{
    $contenidoPrincipal="<h1>No tiene permiso para acceder a esta página</h1>";
}


require __DIR__ . '/includes/comun/layout.php';
