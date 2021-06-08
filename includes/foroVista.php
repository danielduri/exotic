<?php

use es\fdi\ucm\aw\Aplicacion;

if(isset($_GET["id"]))
    $id = $_GET['id'];

$app = Aplicacion::getSingleton();
$conn = $app->conexionBd();
$query = "SELECT * FROM  foro WHERE id = '$id' ORDER BY fecha DESC";
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
    echo "<br /><br /><a href='foroVista.php?id&respuestas=$respuestas&identificador=$id'>Responder</a><br />";
}

$query2 = "SELECT * FROM  foro WHERE identificador = '$id' ORDER BY fecha DESC";
$result2 = $conn->query($query2);
echo "<br />respuestas:<br /><br />";
while($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
    $id = $row['id'];
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
    echo "<br /><br /><a href='foroVista.php?id&respuestas=$respuestas&identificador=$id'>Responder</a><br />";
}
