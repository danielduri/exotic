<?php

/*
 * obtener informacion formateada para mostrar al usuario en el catalogo de cursos
 */
function obtenerInfoDisplay($curso): string
{
    $html="<h1>";
    $html.=$curso->getCourseName();
    $html.="</h1>";

    $html.="<p>";
    $html.=$curso->getDescription();
    $html.="</p>";

    $html.="<p> Precio: ";
    $html.=$curso->getPrice();
    $html.="€ </p>";

    $html.="<p> Duración: ";
    $html.=$curso->getDuration();
    $html.="</p>";

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

    $html.='<form method = "post" action="content.php">';
    $html.='<button value="';
    $html.=$curso->getID();
    $html.='"name="course" type="submit">Ir a curso</button>';
    $html.='</form>';
    return $html;
}