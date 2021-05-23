<?php
require_once "../includes/config.php";
$juego=\es\fdi\ucm\aw\Juego::buscarJuegoPorNombre($_GET["juego"]);
echo $juego->getName();