<?php

use es\fdi\ucm\aw\Aplicacion;

function verUnSoloForo($identificador, $respuestas): string{

    $respuestas=$respuestas;
    $id = $identificador;

$app = Aplicacion::getSingleton();
$conn = $app->conexionBd();
$query = "SELECT * FROM  foro WHERE id = '$id' ORDER BY fecha DESC";
$result = $conn->query($query);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $id = $row['id'];
    $titulo = $row['titulo'];
    $autor = $row['autorId'];
    $mensaje = $row['mensaje'];
    $fecha = $row['fecha'];
    $respuestas = $row['respuestas'];

    $nombreAutor=\es\fdi\ucm\aw\Usuario::buscaNombrePorId($autor);
    $html="<tr><td>$titulo</tr></td>";
    $html.= "<table>";
    $html.= "<tr><td>autor:  $nombreAutor</td></tr>";
    $html.= "<tr><td>$mensaje</td></tr>";
    $html.= "</table>";
    $html.= "<br /><br /><a href='foroVista.php?id&respuestas=$respuestas&identificador=$id'>Responder</a><br />";
}

$query2 = "SELECT * FROM  foro WHERE identificador = '$id' ORDER BY fecha DESC";
$result2 = $conn->query($query2);
    $html.= "<br />respuestas:<br /><br />";
while($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
    $id = $row['id'];
    $titulo = $row['titulo'];
    $autor = $row['autorId'];
    $mensaje = $row['mensaje'];
    $fecha = $row['fecha'];
    $respuestas = $row['respuestas'];

    $nombreAutor=\es\fdi\ucm\aw\Usuario::buscaNombrePorId($autor);

    $html.= "<tr><td>$titulo</tr></td>";
    $html.= "<table>";
    $html.= "<tr><td>autor: $nombreAutor</td></tr>";
    $html.= "<tr><td>$mensaje</td></tr>";
    $html.= "</table>";
    $html.= "<br /><br /><a href='foroVista.php?id&respuestas=$respuestas&identificador=$id'>Responder</a><br />";

    }
    return $html;
}

