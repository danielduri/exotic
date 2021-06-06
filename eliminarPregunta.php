<?php
require_once __DIR__ . "/includes/config.php";
$item = \es\fdi\ucm\aw\Pregunta::obtenerPreguntaporID($_GET["id"]);
if(isset($_SESSION["username"])&& $_SESSION["admin"]){
    $item->eliminar();
}
header("Location: adminPreguntas.php?id=".$_GET["idTest"]);
