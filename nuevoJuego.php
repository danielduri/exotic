<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/Juego.php';

$tituloPagina = 'Exotic Games Academy - Editar Juego';

$formulario = new \es\fdi\ucm\aw\FormularioJuegoNuevo();
$procesamiento = $formulario->gestiona();

if (isset($_SESSION["userID"]) && $_SESSION["admin"]){
    $contenidoPrincipal = <<<EOS
<div class="login">
<h1>Editar juego: </h1>
<h3>Los campos que dejes en blanco no se modificarán</h3>
$procesamiento
</div>
<a href = "adminJuegos.php" class="submitbtn"> <button> Volver </button></a>
EOS;
}


require __DIR__ . '/includes/comun/layout.php';
