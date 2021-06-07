<?php

use es\fdi\ucm\aw\Aplicacion;

/*
 * obtener informacion formateada para mostrar al usuario en el catalogo de cursos
 */
function obtenerInfoDisplayForo($foro): string
{

    if(isset($_GET["id"]))
        $id = $_GET['id'];
    $query = "SELECT * FROM  foro WHERE ID = '$id' ORDER BY fecha DESC";
    $app = Aplicacion::getSingleton();
    $conn = $app->conexionBd();
    $result = $conn->query($query);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $id = $row['ID'];
        $titulo = $row['titulo'];
        $autor = $row['autor'];
        $mensaje = $row['mensaje'];
        $fecha = $row['fecha'];
        $respuestas = $row['respuestas'];

        echo "<tr><td>$titulo</tr></td>";
        echo "<table>";
        echo "<tr><td>autor: $autor</td></tr>";
        echo "<tr><td>$mensaje</td></tr>";
        echo "</table>";
        echo "<br /><br /><a href='formulario.php?id&respuestas=$respuestas&identificador=$id'>Responder</a><br />";
    }

    $query2 = "SELECT * FROM  foro WHERE identificador = '$id' ORDER BY fecha DESC";
    $result2 = $conn->query($query2);
    echo "<br />respuestas:<br /><br />";
    while($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
        $id = $row['ID'];
        $titulo = $row['titulo'];
        $autor = $row['autor'];
        $mensaje = $row['mensaje'];
        $fecha = $row['fecha'];
        $respuestas = $row['respuestas'];

        echo "<tr><td>$titulo</tr></td>";
        echo "<table>";
        echo "<tr><td>autor: $autor</td></tr>";
        echo "<tr><td>$mensaje</td></tr>";
        echo "</table>";
        echo "<br /><br /><a href='formulario.php?id&respuestas=$respuestas&identificador=$id'>Responder</a><br />";
    }
}

/*
 * obtener informacion formateada para mostrar al usuario en su apartado de cursos comprados
 */
function obtenerMiForoDisplay($foro): string
{
    $nombre = $foro->getNombreJuego();
    $descripcion = $foro->getMensaje();
    $id = $foro->getID();
	$itemId = $foro->getItemIDforUser($_SESSION["userID"]);

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
    $cursoID = null;
    foreach ($items as $item){
        $cursoID = $item->getIdCurso();
        $itemName = $item->getNombre();
        $itemID = $item->getID();
        $link = "";
        if(isset($_SESSION["login"]) && $_SESSION["login"]){
            $link = <<<EOS
                <a href="content.php?id=$itemID">$itemName</a>
            EOS;
            if ($_SESSION["admin"]){
                if($item->esTest()){
                    $link.="<p><label>Item ID: ";
                    $link.=$itemID;
                    $link.=" - Tipo: test</label>";
                    $link.="</p><p>";
                    $link.='<a href="editarNombreTest.php?id=';
                    $link.=$item->getID();
                    $link.='"><button>Editar nombre</button></a>';
                    $link.='<a href="eliminarItem.php?id=';
                    $link.=$item->getID();
                    $link.='"><button>Eliminar</button></a>';
                    $link.='<a href="editarPreguntas.php?id=';
                    $link.=$item->getID();
                    $link.='"><button>Editar preguntas</button></a>';
                    $link.="</p>";
                }else{
                    $link.="<p><label>Item ID: ";
                    $link.=$itemID;
                    $link.=" - Tipo: item</label>";
                    $link.="</p><p>";
                    $link.='<a href="editarItem.php?id=';
                    $link.=$item->getID();
                    $link.='"><button>Editar</button></a>';
                    $link.='<a href="eliminarItem.php?id=';
                    $link.=$item->getID();
                    $link.='"><button>Eliminar</button></a>';
                    $link.="</p>";
                }
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
    }

    return $html;

}

function obtenerCursosParaAdmin($juegos){
    $html="";
    foreach ($juegos as $juego){
        $html.="<h1 class='mainTitle'>";
        $html.=$juego->getName();
        $html.="</h1>";
        $html.="<table class='userData'><th>ID</th><th>Imagen</th><th>Nombre</th><th>Precio</th><th>Nivel</th><th>Duración</th><th>Descripción</th><th>Núm. Ítems</th><th>Opciones</th><th>Eliminar</th>";
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