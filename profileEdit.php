<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__ . '/includes/funcionesUsuarios.php';

$tituloPagina = 'Exotic Games Academy - Mi perfil';
$user = \es\fdi\ucm\aw\Usuario::buscaUsuario($_SESSION["username"]);

$formulario = new \es\fdi\ucm\aw\FormularioPerfil();
$procesamiento = $formulario->gestiona();

$contenidoPrincipal=$user->datosUsuario($_SESSION["username"]);
$contenidoPrincipal.= <<<EOS
<h1>Editar perfil: </h1>
$procesamiento
EOS;

require __DIR__.'/includes/comun/layout.php';
