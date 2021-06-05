<?php
require_once __DIR__ . "/includes/config.php";
$item = \es\fdi\ucm\aw\Item::getItemFromID($_GET["id"]);
if(isset($_SESSION["username"])&& $_SESSION["admin"]){
    $item->eliminar();
}
header("Location: contentTable.php?id=".$item->getIdCurso());
