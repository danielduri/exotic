<?php

/*
 * obtener informacion formateada para mostrar al usuario en el catalogo de cursos
 */
function obtenerInfoDisplay($curso): string
{

    $nombre = $curso->getCourseName();
    $descripcion = $curso->getDescription();
    $precio = $curso->getPrice();
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
<div class="bttn">

$btnInscribirse
                  
                  <a href="contentTable.php?id=$id"><button>Ver contenidos</button></a>
                  </p>
            </div>
        </div>

</div>

EOF;
    return $html;
}

/*
 * obtener informacion formateada para mostrar al usuario en su apartado de cursos comprados
 */
function obtenerMiCursoDisplay($curso): string
{
    $nombre = $curso->getCourseName();
    $descripcion = $curso->getDescription();
    $id = $curso->getID();
	$itemId = $curso->getItemIDforUser($_SESSION["userID"]);

    $html=<<<EOF


        <div class="card">
           <img src="images/cursos/$id.png">
            <div class="descriptions">
                <h1>$nombre</h1>
                <p>$descripcion</p>

            <a href="content.php?id=$itemId"><button>Ir a curso</button></a>
            </div>
        </div>
EOF;

    return $html;
}

/*
 * obtener la lista de contenidos del curso
 */
function getItemListForDisplay($items){
    $html="<ol class='itemList'>";
    foreach ($items as $item){
        $itemName = $item->getNombre();
        $itemID = $item->getID();
        $link = "";
        if(isset($_SESSION["login"]) && $_SESSION["login"]){
            $link = <<<EOS
                <a href="content.php?id=$itemID">$itemName</a>
            EOS;
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

    return $html;

}

function obtenerCursosParaAdmin($juegos){
    $html="";
    foreach ($juegos as $juego){
        $html.="<h1 class='mainTitle'>";
        $html.=$juego->getName();
        $html.="</h1>";
        $html.="<table class='userData'><th>ID</th><th>Nombre</th><th>Precio</th><th>Nivel</th><th>Duración</th><th>Descripción</th><th>Núm. Ítems</th><th>Opciones</th><th>Eliminar</th>";
        foreach ($juego->getCourses() as $curso){
            $html.=obtenerHTMLParaAdmin($curso);
        }
        $html.="</table>";
        $html.='<a href="nuevoCurso.php?juego=';
        $html.=$juego->getName();
        $html.='"><button class="marginbtn">Nuevo Curso</button></a>';
    }
    return $html;
}

function obtenerHTMLParaAdmin($curso){
    $html="<tr>";
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
    $html.="<td>";
    $html.="<a href='editarCurso.php?id=";
    $html.=$curso->getID();
    $html.="'><button>Editar</button></a>";
    $html.="<a href='contentTable.php?id=";
    $html.=$curso->getID();
    $html.="'><button>Contenidos</button></a>";
    $html.="</td>";
    $html.="<td>";
    $html.="<a href='eliminarCurso.php?id=";
    $html.=$curso->getID();
    $html.="'><button>Eliminar</button></a>";
    $html.="</td>";
    $html.="</tr>";
    return $html;
}