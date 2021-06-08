<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Mi perfil';

$user = \es\fdi\ucm\aw\Usuario::buscaUsuario($_SESSION["username"]);


$contenidoPrincipal=$user->datosUsuario($_SESSION["username"]);
$contenidoPrincipal.=<<<EOS
<div class="navigationButton">
<a href = "profileEdit.php" class="submitbtn"> <button> Modifica tus datos </button></a>
<a href = "fotoPerfil.php" class="submitbtn"> <button> Modifica tu foto de perfil </button></a>
</div>

EOS;

require __DIR__.'/includes/comun/layout.php';
