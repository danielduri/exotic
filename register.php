<?php

require_once __DIR__.'/includes/config.php';

$formulario = new \es\fdi\ucm\aw\FormularioRegistro();
$procesamiento = $formulario->gestiona();

$tituloPagina = 'Exotic Games Academy - Registro';

$contenidoPrincipal= <<<EOS

<h1 class="mainTitle">¡Bienvenido a Exotic Games Academy!</h1>
<div class="login">
$procesamiento
</div>
EOS;

require __DIR__.'/includes/comun/layout.php';
