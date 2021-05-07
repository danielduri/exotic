<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Mi perfil';

$user = \es\fdi\ucm\aw\Usuario::buscaUsuario($_SESSION["username"]);


$contenidoPrincipal=$user->datosUsuario($_SESSION["username"]);
$contenidoPrincipal.=<<<EOS

<a href = "profileEdit.php"> <button> Modifica tus datos </button></a>

EOS;

require __DIR__.'/includes/comun/layout.php';
