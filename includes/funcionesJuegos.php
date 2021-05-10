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
    $html = '<div class="wrapper">';
    foreach ($array as $item) {
        $html.=obtenerJuegoParaDisplay($item);
    }
    $html.= '</div>';
    return $html;
}

/*
* obtener informacion formateada para mostrar al usuario en el catalogo de cursos.
*/
function obtenerCursosParaDisplay($array): string
{
    $html = '<div class="wrapper">';
    foreach ($array as $item) {

        $html.=obtenerCursosJuegoParaDisplay($item);
    }
    $html.= '</div>';
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
    $nombre = $juego->getName();
    $descripcion = $juego->getDescription();

    $html=<<<EOF


        <div class="card">
            <img src="images/$nombre.png">
            <div class="descriptions">
                <h1>$nombre</h1>
                <p>
                  $descripcion
                </p>
                <button>
                    Ver cursos
                </button>
            </div>
        </div>
EOF;

    return $html;
}

function obtenerJuegoParaFormulario($juego): string
{
    $html='<option value="';
    $html.=$juego->getName();
    $html.='">';
    $html.=$juego->getName();
    $html.='</option>';

    return $html;
}
