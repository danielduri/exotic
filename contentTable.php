<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Exotic Games Academy - ';


$id = $_GET["id"];
$curso = \es\fdi\ucm\aw\Curso::buscarCursoPorID($id);

$tituloPagina .= $curso->getCourseName();

$contenidoPrincipal="<h1 class='mainTitle'>";
$contenidoPrincipal.=$curso->getCourseName();
$contenidoPrincipal.="</h1>";
$contenidoPrincipal.=$curso->getItemList();

require __DIR__.'/includes/comun/layout.php';