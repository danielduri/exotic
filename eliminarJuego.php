<?php
require_once __DIR__ . "/includes/config.php";
$juego=\es\fdi\ucm\aw\Juego::buscarJuegoPorNombre($_GET["juego"]);
$juego->eliminar();
header("Location: adminJuegos.php");