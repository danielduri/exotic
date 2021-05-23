<?php

require_once __DIR__.'/includes/config.php';

$id = $_GET["curso"] ?? null;
$curso = \es\fdi\ucm\aw\Curso::buscarCursoPorID($id);
$usuario = \es\fdi\ucm\aw\Usuario::buscaUsuario($_SESSION["username"]);

if ($curso->retroceder($usuario->id())){
    $idItem=$curso->getItemIDforUser($usuario->id());
    header('Location: content.php?id='.$idItem);
}