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
                  
                  <form method = "post" action="contentTable.php?id=$id">
                  <button value="$id" name="course" type="submit">Ver contenidos </button>
                  </form>
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