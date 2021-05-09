<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Exotic Games Academy - ';


$id = $_GET["id"];
$curso = \es\fdi\ucm\aw\Curso::buscarCursoPorID($id);

$tituloPagina .= $curso->getCourseName();

$contenidoPrincipal=$curso->getItemTable();

require __DIR__.'/includes/comun/layout.php';