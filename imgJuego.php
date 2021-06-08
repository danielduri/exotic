<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Editar foto de juego';
$juego = \es\fdi\ucm\aw\Juego::buscarJuegoPorNombre($_GET["juego"]);
$formulario = new \es\fdi\ucm\aw\FormulariosAdmin\FormularioImgJuego();

$procesamiento = $formulario->gestiona();
$contenidoPrincipal= <<<EOS
<div class="login">
$procesamiento
</div>
<a href = "adminJuegos.php" class="submitbtn"> <button> Volver </button></a>
EOS;

require __DIR__.'/includes/comun/layout.php';
