<?php
require_once __DIR__ . '/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Editar Juego';

$juego=\es\fdi\ucm\aw\Juego::buscarJuegoPorNombre($_GET["juego"]);
$formulario = new \es\fdi\ucm\aw\FormularioJuego();
$procesamiento = $formulario->gestiona();

if (isset($_SESSION["userID"]) && $_SESSION["admin"]){
    $contenidoPrincipal = <<<EOS
<div class="login">
<h1>Editar juego: </h1>
<h3>Los campos que dejes en blanco no se modificarán</h3>
$procesamiento
</div>
<a href = "profile.php" class="submitbtn"> <button> Volver </button></a>
EOS;
}


require __DIR__ . '/includes/comun/layout.php';
