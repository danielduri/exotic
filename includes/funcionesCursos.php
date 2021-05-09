<?php

/*
 * obtener informacion formateada para mostrar al usuario en el catalogo de cursos
 */
function obtenerInfoDisplay($curso): string
{

    $html="<div class=cards>";
    $html.="<article class=card>";
    $html.=    "<header>";
    $html.=       " <h2>";
    $html.=$curso->getCourseName();
    $html.="</h2>";
    $html.=    "</header>";
    $html.="<img src=images/cursos/";
    $html.=$curso->getID();
    $html.=".png>";

    $html.=   "<div class=mainTitle>";
    $html.=      "<p>";
    $html.=		$curso->getDescription();
    $html.=		"</p>";
    $html.=      "<p>";
    $html.=		$curso->getPrice();
    $html.=		"</p>";
    $html.=      "<p>";
    $html.=		$curso->getDuration();
    $html.=		"</p>";
    $html.=    "</div>";

    $html.= "</article>";
    $html.="</div>";

    $html.='<form method = "post" action="contentTable.php?id=';
    $html.=$curso->getID();
    $html.='"><button value="';
    $html.=$curso->getID();
    $html.='"name="course" type="submit">Ver contenidos</button>';
    $html.='</form>';


    if(isset($_SESSION['login']) && $_SESSION['login']){
        $html.='<form method = "post" action="procesarCompra.php">';
        $html.='<button value="';
        $html.=$curso->getID();
        $html.='"name="course" type="submit">Inscribirse</button>';
        $html.='</form>';
    }


    return $html;
}

/*
 * obtener informacion formateada para mostrar al usuario en su apartado de cursos comprados
 */
function obtenerMiCursoDisplay($curso): string
{
    $html="<h1>";
    $html.=$curso->getCourseName();
    $html.="</h1>";

    $html.="<p>";
    $html.=$curso->getDescription();
    $html.="</p>";

    $idItem=$curso->getItemIDforUser($_SESSION["userID"]);

    $html.='<form method = "post" action="content.php?id=';
    $html.=$idItem;
    $html.='"><button value="';
    $html.=$curso->getID();
    $html.='"name="course" type="submit">Ir a curso</button>';
    $html.='</form>';
    return $html;
}

function getItemTableForDisplay($items){
    $html="<ol>";
    foreach ($items as $item){
        $itemName = $item->getNombre();
        $itemID = $item->getID();
        $html.=<<<EOS
<li>
<a href="content.php?id=$itemID">$itemName</a>
</li>

EOS;

    }
    $html.="</ol>";

    return $html;

}