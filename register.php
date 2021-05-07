<?php

require_once __DIR__.'/includes/config.php';

$formulario = new \es\fdi\ucm\aw\FormularioRegistro();
$procesamiento = $formulario->gestiona();

$tituloPagina = 'Exotic Games Academy - Registro';

$contenidoPrincipal= <<<EOS

<h1>¡Bienvenido a Exotic Games Academy! Crea una cuenta gratuita</h1>
$procesamiento
EOS;

require __DIR__.'/includes/comun/layout.php';
