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

function obtenerJuegosParaDisplayForo($array): string
{
    $html = '<div class="wrapper">';
    foreach ($array as $item) {
        $html.=obtenerJuegoParaDisplayForo($item);
    }
    $html.= '</div>';
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
    $html="<h1 class='mainTitle'>";
    $html.=$juego->getName();
    $html.="</h1>";
    $html.= '<div class="wrapper">';
    foreach ($juego->getCourses() as $item) {
        $html.=obtenerInfoDisplay($item);
    }
    $html.= '</div>';
    return $html;
}



function obtenerForosJuegoParaDisplay($juego): string
{
    $html="<h1 class='mainTitle'>";
    $html.=$juego->getName();
    $html.="</h1>";
    $html.= '<div class="wrapper">';
    foreach ($juego->getForos() as $item) {
        //$html.=obtenerInfoDisplayForo($item);
       $html.=obtenerForosParaAdmin($item);
    }
    $html.= '</div>';
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
            <img src="images/juegos/$nombre.png">
            <div class="descriptions">
                <h1>$nombre</h1>
                <p>$descripcion</p>
                
                <a href="verCursos.php?juego=$nombre">
                <button>
                Explorar cursos
                </button></a>
                </form>
                </div>
        </div>
EOF;

    return $html;
}

function obtenerJuegoParaDisplayForo($juego): string
{
    $nombre = $juego->getName();
    $descripcion = $juego->getDescription();

    $html=<<<EOF


        <div class="card">
            <img src="images/juegos/$nombre.png">
            <div class="descriptions">
                <h1>$nombre</h1>
                <p>$descripcion</p>
                
                <a href="verForos.php?juego=$nombre">
                <button>
                Ver Foros
                </button>
                </a>

                </form>
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

function obtenerJuegosParaAdmin($juegos){
    $html="<table class='userData'><th>Imagen</th><th>Nombre</th><th>Descripción</th><th>Categoría</th><th>Editar</th><th>Eliminar</th>";
    foreach ($juegos as $juego){
        $html.="<tr>";
        $html.=obtenerJuegoParaAdmin($juego);
        $html.="</tr>";
    }
    $html.="</table>";
    return $html;
}

function obtenerForos($juego){

    $html="<table class='forumData'><th>Usuario</th><th></th><th>Fecha</th><th>Titulo</th><th>Mensaje</th>";
    foreach ($juego->getForos() as $foro){
        $html.="<tr>";
        $html.=obtenerForo($foro);
        $html.="</tr>";
    }
    $html.="</table>";
    return $html;
}

function obtenerForo($foro){
    $html="<td>";
    $html.=$foro->getAutor();
    $html.="</td>";
    $html.="<td>";
    if(is_file(DIR_AVATARS_PROTEGIDOS. "/{$foro->getAutorId()}")){
        $html.='<img src="'.DIR_AVATARS_PROTEGIDOS. "/{$foro->getAutorId()}". "?m=".filemtime(DIR_AVATARS_PROTEGIDOS. "/{$foro->getAutorId()}").'">';
    }
    $html.="</td>";
    $html.="<td>";
    $html.=$foro->getFecha();
    $html.="</td>";
    $html.="<td>";
    $html.=$foro->getTitulo();
    $html.="</td>";
    $html.="<td>";
    $html.=$foro->getMensaje();
    $html.="</td>";
    if(isset($_SESSION["login"]) && $_SESSION["admin"]){
        $html.="<td>";
        $html.="<a href='eliminarForo.php?id=";
        $html.=$foro->getId();
        $html.="&backTo=";
        $html.=$foro->getNombreJuego();
        $html.="'><button>Eliminar</button></td>";
    }

    return $html;
}

function obtenerJuegoParaAdmin($juego){
    $html="<td>";
    $html.='<img src="images/juegos/';
    $html.=$juego->getName();
    $html.='.png">';
    $html.="</td>";
    $html.="<td>";
    $html.=$juego->getName();
    $html.="</td>";
    $html.="<td>";
    $html.=$juego->getDescription();
    $html.="</td>";
    $html.="<td>";
    $html.=$juego->getCategory();
    $html.="</td>";
    $html.="<td><div>";
    $html.="<a href='editarJuego.php?juego=";
    $html.=$juego->getName();
    $html.="'><button>Atributos</button></a>";
    $html.="<a href='imgJuego.php?juego=";
    $html.=$juego->getName();
    $html.="'><button>Imagen</button></a>";
    $html.="</div></td>";
    $html.="<td>";
    $html.="<a href='eliminarJuego.php?juego=";
    $html.=$juego->getName();
    $html.="'><button>Eliminar</button></a>";
    $html.="</td>";
    return $html;
}
