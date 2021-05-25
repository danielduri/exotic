<?php
require_once __DIR__ . "/includes/config.php";
$juego=\es\fdi\ucm\aw\Juego::buscarJuegoPorNombre($_GET["juego"]);
if(isset($_SESSION["username"])&& $_SESSION["admin"]){
    $juego->eliminar();
}
header("Location: adminJuegos.php");