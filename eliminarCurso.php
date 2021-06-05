<?php
require_once __DIR__ . "/includes/config.php";
$curso=\es\fdi\ucm\aw\Curso::buscarCursoPorID($_GET["id"]);
if(isset($_SESSION["username"])&& $_SESSION["admin"]){
    $curso->eliminar();
}
header("Location: adminCursos.php");