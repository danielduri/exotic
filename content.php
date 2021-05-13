<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Exotic Games Academy - ';

$id = isset($_GET["id"]) ? $_GET["id"] : $_POST["id"];
$item = \es\fdi\ucm\aw\Item::getItemFromID($id);

$tituloPagina .= $item->getNombre();

if(isset($_SESSION["userID"]) && \es\fdi\ucm\aw\Curso::existeCompra($_SESSION["userID"], $item->getIdCurso())){
    $contenidoPrincipal="<div class='contenido'>";
    $contenidoPrincipal.="<h1 class='mainTitle'>";
    $contenidoPrincipal.=$item->getOrden();
    $contenidoPrincipal.=". ";
    $contenidoPrincipal.=$item->getNombre();
    $contenidoPrincipal.="</h1>";
    $contenidoPrincipal.=$item->getItemForDisplay();
    $contenidoPrincipal.="</div>";
    $numItem=$item->getOrden();

    $contenidoPrincipal.='<div class="navigationButton">';
    if($numItem>1){
        $contenidoPrincipal.='<form method = "post" action="anteriorItem.php">';
        $contenidoPrincipal.='<button value="';
        $contenidoPrincipal.=$item->getIdCurso();
        $contenidoPrincipal.='"name="course" type="submit"> < Anterior</button>';
        $contenidoPrincipal.='</form>';
    }

    if($numItem<(\es\fdi\ucm\aw\Curso::buscarCursoPorID($item->getIdCurso())->getNumItems())){
        $contenidoPrincipal.='<form method = "post" action="siguienteItem.php">';
        $contenidoPrincipal.='<button value="';
        $contenidoPrincipal.=$item->getIdCurso();
        $contenidoPrincipal.='"name="course" type="submit">Siguiente > </button>';
        $contenidoPrincipal.='</form>';
    }
    $contenidoPrincipal.='</div>';
    $contenidoPrincipal.='<div class="navigationButton"><a href=contentTable.php?id=';
    $contenidoPrincipal.=$item->getIdCurso();
    $contenidoPrincipal.='><button>Volver a contenidos</button></a></div>';

}else{
    $contenidoPrincipal="<h1>No tienes permiso para acceder a este curso</h1>";
}


require __DIR__.'/includes/comun/layout.php';