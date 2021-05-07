<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Curso';

$id = isset($_POST["course"]) ? $_POST["course"] : null;
$curso = \es\fdi\ucm\aw\Curso::buscarCursoPorID($id);
$usuario = \es\fdi\ucm\aw\Usuario::buscaUsuario($_SESSION["username"]);

$contenidoPrincipal=$curso->getItem($curso->getProgreso($usuario->id()));

require __DIR__.'/includes/comun/layout.php';
