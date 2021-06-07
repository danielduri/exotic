<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Mi perfil';
$user = \es\fdi\ucm\aw\Usuario::buscaUsuario($_SESSION["username"]);

$formulario = new \es\fdi\ucm\aw\FormularioFotoPerfil();

$procesamiento = $formulario->gestiona();
$contenidoPrincipal= <<<EOS
<div class="login">
$procesamiento
</div>
<a href = "profile.php" class="submitbtn"> <button> Volver </button></a>
EOS;

require __DIR__.'/includes/comun/layout.php';
