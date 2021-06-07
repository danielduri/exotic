<?php

function obtenerPreguntasTestParaAdmin($preguntas){

    $html="<table class='userData'><th>ID Pregunta</th><th>Pregunta</th><th>Respuesta Correcta</th><th>Respuesta 1</th><th>Respuesta 2</th><th>Respuesta 3</th><th>Opciones</th>";
    foreach ($preguntas as $pregunta){
        $html.="<tr>";
        $html.=obtenerPreguntaParaAdmin($pregunta);
        $html.="</tr>";
    }
    $html.="</table>";
    return $html;
}

function obtenerPreguntaParaAdmin($pregunta){
    $html="";
    if ($pregunta->getIDPregunta()!=null){
        $html.="<td>";
        $html.=$pregunta->getIDPregunta();
        $html.="</td>";
        $html.="<td>";
        $html.=$pregunta->getPregunta();
        $html.="</td>";
        $html.="<td>";
        $html.=$pregunta->getRespuestaCorrecta();
        $html.="</td>";
        $html.="<td>";
        $html.=$pregunta->getRespuesta1();
        $html.="</td>";
        $html.="<td>";
        $html.=$pregunta->getRespuesta2();
        $html.="</td>";
        $html.="<td>";
        $html.=$pregunta->getRespuesta3();
        $html.="</td>";
        $html.="<td>";
        $html.="<a href='editarPregunta.php?id=";
        $html.=$pregunta->getIDPregunta();
        $html.="&idTest=";
        $html.=$_GET["id"];
        $html.="'><button>Editar</button></a>";
        $html.="<a href='eliminarPregunta.php?id=";
        $html.=$pregunta->getIDPregunta();
        $html.="&idTest=";
        $html.=$_GET["id"];
        $html.="'><button>Eliminar</button></a>";
        $html.="</td>";
    }

    return $html;
}