<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Exotic Games Academy - ';

$id = $_GET["id"] ?? null;
$item = \es\fdi\ucm\aw\Item::getItemFromID($id);

if($item==null){
    $contenidoPrincipal="<p class='contenido'>No se ha encontrado este item</p>";
}else{
    if(!isset($_GET["id"]) || $_GET["id"]==""){
        header('Location: cursos.php');
    }else if((isset($_SESSION["userID"]) && (\es\fdi\ucm\aw\Curso::existeCompra($_SESSION["userID"], $item->getIdCurso())||$_SESSION["admin"]))){
        $tituloPagina .= $item->getNombre();
        $contenidoPrincipal="<div class='contenido'>";
        $contenidoPrincipal.="<h1 class='mainTitle'>";
        $contenidoPrincipal.=$item->getOrden();
        $contenidoPrincipal.=". ";
        $contenidoPrincipal.=$item->getNombre();
        if($_SESSION["admin"]){
            $contenidoPrincipal.=" (ID=".$item->getID().")";
        }
        $contenidoPrincipal.="</h1>";
        $contenidoPrincipal.=$item->getItemForDisplay();
        $contenidoPrincipal.="</div>";
        $numItem=$item->getOrden();
        $idCurso=$item->getIdCurso();

        $contenidoPrincipal.='<div class="navigationButton">';
        if(\es\fdi\ucm\aw\Curso::existeCompra($_SESSION["userID"], $item->getIdCurso())){
            if($numItem>1){
                $contenidoPrincipal.=<<<EOS

            <a href="anteriorItem.php?curso=$idCurso"><button>< Anterior</button></a>

EOS;
            }

            if($numItem<(\es\fdi\ucm\aw\Curso::buscarCursoPorID($item->getIdCurso())->getNumItems())){

                $contenidoPrincipal.=<<<EOS

            <a href="siguienteItem.php?curso=$idCurso"><button>Siguiente ></button></a>

EOS;
            }
        }

        $contenidoPrincipal.='</div>';
        $contenidoPrincipal.='<div class="navigationButton"><a href=contentTable.php?id=';
        $contenidoPrincipal.=$item->getIdCurso();
        $contenidoPrincipal.='><button>Volver a contenidos</button></a></div>';

    }else{
        $contenidoPrincipal="<h1>No tienes permiso para acceder a este curso</h1>";
    }
}




require __DIR__.'/includes/comun/layout.php';