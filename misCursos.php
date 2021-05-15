<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Mis cursos';

$usuario = \es\fdi\ucm\aw\Usuario::buscaUsuario($_SESSION["username"]);
$contenidoPrincipal=$usuario->obtenerMisCursos();

require __DIR__.'/includes/comun/layout.php';
