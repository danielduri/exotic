<?php

/*
 * obtener informacion formateada para mostrar al usuario en el catalogo de cursos
 */
function obtenerInfoDisplay($curso): string
{

    $nombre = $curso->getCourseName();
    $descripcion = $curso->getDescription();
    $precio = $curso->getPrice()."€";
    $duracion = $curso->getDuration();
    $id = $curso->getID();
    $btnInscribirse = "";

    if(isset($_SESSION['login']) && $_SESSION['login']){
        $btnInscribirse ='<form method = "post" action="procesarCompra.php">';
        $btnInscribirse.='<button value="';
        $btnInscribirse.=$curso->getID();
        $btnInscribirse.='"name="course" type="submit">Inscribirse</button>';
        $btnInscribirse.='</form>';
    }
    $html=<<<EOF

        <div class="card">
            <img src="images/cursos/$id.png">
            <div class="descriptions">
                <h1>$nombre</h1>
                <p>
                $descripcion
                </p>
                <div class="bttn">
                $btnInscribirse
                <a href="contentTable.php?id=$id"><button>Ver contenidos</button></a>
                </div>
                <div>
                 <p> <strong> • Precio: $precio  • Duración: $duracion </strong> </p>
                </div>
            </div>
        </div>

EOF;
    return $html;
}

/*
 * obtener tarjetas de cursos comprados para mostrar al usuario
 */
function obtenerMiCursoDisplay($curso): string
{
    $nombre = $curso->getCourseName();
    $descripcion = $curso->getDescription();
    $id = $curso->getID();
	$itemId = $curso->getItemIDforUser($_SESSION["userID"]);
	$progress = $curso->getProgreso($_SESSION["userID"]);
    $total = $curso->getNumItems();

    $html=<<<EOF

<div class="cardprogress">
        <div class="card">
           <img src="images/cursos/$id.png">
            <div class="descriptions">
                <h1>$nombre</h1>
                <p>$descripcion</p>

            <a href="content.php?id=$itemId"><button>Ir a curso</button></a>
            </div>
        </div>
        <div class="progress"><label>Progreso: $progress de $total   </label><progress value="$progress" max="$total"></progress></div>

</div>
EOF;

    return $html;
}

/*
 * obtener la lista de contenidos del curso, con links si está comprado y opciones de administrador si procede
 */
function getItemListForDisplay($items){
    $html="<ol class='itemList'>";
    $cursoID = $_GET["id"];
    foreach ($items as $item){
        $itemName = $item->getNombre();
        $itemID = $item->getID();
        $link = "";
        if(isset($_SESSION["login"]) && $_SESSION["login"] && (\es\fdi\ucm\aw\Curso::existeCompra($_SESSION["userID"], $cursoID)||$_SESSION["admin"])){
            $link .= <<<EOS
                <a href="content.php?id=$itemID">$itemName</a>
            EOS;
            if ($_SESSION["admin"]){
                $link.="<p><label>ItemID=";
                $link.=$itemID;
                if($item->esTest()){
                    $link.=" - Tipo: test (TestID=";
                    $link.=$item->getIDTest();
                    $link.=")</label>";
                    $link.="</p><p>";
                    $link.='<a href="editarNombreTest.php?id=';
                    $link.=$item->getID();
                    $link.='"><button>Editar nombre</button></a>';
                    $link.='<a href="adminPreguntas.php?id=';
                    $link.=$item->getIDTest();
                    $link.='&backTo=';
                    $link.=$item->getIDCurso();
                    $link.='"><button>Editar preguntas</button></a>';
                }else{
                    $link.=" - Tipo: item</label>";
                    $link.="</p><p>";
                    $link.='<a href="editarItem.php?id=';
                    $link.=$item->getID();
                    $link.='"><button>Editar</button></a>';
                }
                $link.='<a href="eliminarItem.php?id=';
                $link.=$item->getID();
                $link.='"><button>Eliminar</button></a>';
                $link.="</p>";
            }
        }else{
            $link = $itemName;
        }
        $html.=<<<EOS
            <li class="ItemCurso">
            $link
            </li>

EOS;

    }
    $html.="</ol>";

    if(isset($_SESSION["username"]) && $_SESSION["admin"]){
        $html.='<a href="nuevoItem.php?id=';
        $html.=$cursoID;
        $html.='"><button>Nuevo Item</button></a>';
        $html.='<a href="nuevoTest.php?id=';
        $html.=$cursoID;
        $html.='"><button>Nuevo Test</button></a>';
        $html.='<a href="adminCursos.php';
        $html.='"><button>Panel de administración</button></a>';
    }

    return $html;

}

/*
 * muestra al administrador el panel para administrar los cursos
 */
function obtenerCursosParaAdmin($juegos){
    $html="";
    foreach ($juegos as $juego){
        $html.="<h1 class='mainTitle'>";
        $html.=$juego->getName();
        $html.="</h1>";
        $html.="<table class='userData'><th>ID</th><th>Imagen</th><th>Nombre</th><th>Precio</th><th>Nivel</th><th>Duración</th><th>Descripción</th><th>Núm. Ítems</th><th>Editar</th>";
        foreach ($juego->getCourses() as $curso){
            $html.=obtenerHTMLParaAdmin($curso);
        }
        $html.="</table>";
        $html.='<div class="navigationButton"><a href="nuevoCurso.php?juego=';
        $html.=$juego->getName();
        $html.='"><button class="marginbtn">Nuevo Curso</button></a></div>';
    }
    return $html;
}

/*
 * muestra al administrador los datos y opciones de edición de un curso
 */
function obtenerHTMLParaAdmin($curso){
    $html="<tr>";
    $html.="<td>";
    $html.=$curso->getID();
    $html.="</td>";
    $html.="<td>";
    $html.='<img src="images/cursos/';
    $html.=$curso->getID();
    $html.='.png">';
    $html.="</td>";
    $html.="<td>";
    $html.=$curso->getCourseName();
    $html.="</td>";
    $html.="<td>";
    $html.=$curso->getPrice();
    $html.="</td>";
    $html.="<td>";
    $html.=$curso->getLevel();
    $html.="</td>";
    $html.="<td>";
    $html.=$curso->getDuration();
    $html.="</td>";
    $html.="<td>";
    $html.=$curso->getDescription();
    $html.="</td>";
    $html.="<td>";
    $html.=$curso->getNumItems();
    $html.="</td>";
    $html.="<td><div class='column'>";
    $html.="<a href='editarCurso.php?id=";
    $html.=$curso->getID();
    $html.="'><button>Atributos</button></a>";
    $html.="<a href='imgCurso.php?id=";
    $html.=$curso->getID();
    $html.="'><button>Imagen</button></a>";
    $html.="<a href='contentTable.php?id=";
    $html.=$curso->getID();
    $html.="'><button>Contenidos</button></a>";
    $html.="<a href='eliminarCurso.php?id=";
    $html.=$curso->getID();
    $html.="'><button>Eliminar</button></a>";
    $html.="</div></td>";
    $html.="</tr>";
    return $html;
}

/*
 * muestra al usuario los juegos contenidos en $array
 */
function obtenerCursosParaBusqueda($array): string
{

    $html= '<div class="wrapper">';
    foreach ($array as $item) {
        $html.=obtenerInfoDisplay($item);
    }
    $html.= '</div>';
    return $html;
}