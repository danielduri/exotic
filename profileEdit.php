<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__ . '/includes/funcionesUsuarios.php';

$tituloPagina = 'Exotic Games Academy - Mi perfil';
$user = \es\fdi\ucm\aw\Usuario::buscaUsuario($_SESSION["username"]);

$formulario = new \es\fdi\ucm\aw\FormularioPerfil();
$procesamiento = $formulario->gestiona();

$contenidoPrincipal= <<<EOS
<div class="login">
<h1>Editar perfil: </h1>
<h3>Los campos que dejes en blanco no se modificarán</h3>
$procesamiento
</div>
<a href = "profile.php" class="submitbtn"> <button> Volver </button></a>
EOS;

require __DIR__.'/includes/comun/layout.php';
