<?php

/*
* Obtener el nombre de los juegos formateados como opciones en un formulario
*/
function obtenerJuegosParaFormulario($juegos): string
{
    $html='<option value=""></option>';

    foreach ($juegos as $item) {
        $html.=obtenerJuegoParaFormulario($item);
    }

    return $html;
}

/*
* obtener informacion formateada para mostrar al usuario en el catalogo de juegos.
*/
function obtenerJuegosParaDisplay($array): string
{
    $html="";
    foreach ($array as $item) {
        $html.=obtenerJuegoParaDisplay($item);
    }
    return $html;
}

/*
* obtener informacion formateada para mostrar al usuario en el catalogo de cursos.
*/
function obtenerCursosParaDisplay($array): string
{
    $html="";
    foreach ($array as $item) {
        $html.=obtenerCursosJuegoParaDisplay($item);
    }
    return $html;
}

/*
 * obtener informacion de los cursos correspondientes al juego,
 * formateada para mostrar al usuario en el catalogo de cursos.
 */
function obtenerCursosJuegoParaDisplay($juego): string
{
    $html="";
    foreach ($juego->getCourses() as $item) {
        $html.=obtenerInfoDisplay($item);
    }
    return $html;
}

/*
 * obtener informacion formateada para mostrar al usuario en el catalogo de juegos.
 */
function obtenerJuegoParaDisplay($juego): string
{

    $html = "<h1>";
    $html.=$juego->getName();
    $html.="</h1>";

    $html.="<p>";
    $html.=$juego->getDescription();
    $html.="</p>";

    $html.='<form method = "post" action="verCursos.php';
        $html.='"><button value="';
        $html.=$juego->getName();
        $html.='"name="explore" type="submit">Explorar cursos</button>';
    $html.='</form>';
    return $html;
}

/*
 * Obtener el nombre del juego formateado como opcion en un formulario
 */
function obtenerJuegoParaFormulario($juego): string
{
    $html='<option value="';
    $html.=$juego->getName();
    $html.='">';
    $html.=$juego->getName();
    $html.='</option>';

    return $html;
}
