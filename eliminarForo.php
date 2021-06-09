<?php
require_once __DIR__ . "/includes/config.php";
if(isset($_SESSION["username"])&& $_SESSION["admin"]){
    \es\fdi\ucm\aw\Foro::eliminar($_GET["id"]);
}
header("Location: verForos.php?juego=".$_GET["backTo"]);
