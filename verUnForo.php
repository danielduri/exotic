<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/foroVista.php';
use es\fdi\ucm\aw\Foro;

$tituloPagina = 'Exotic Games Academy - Foros';

$identificador = isset($_GET["identificador"]) ? $_GET["identificador"] : null;
$respuestas = isset($_GET["respuestas"]) ? $_GET["respuestas"] : null;


if($identificador!=null && $respuestas!=null){
    //$contenidoPrincipal = obtenerForosParaAdmin($juego);
    $contenido2 = verUnSoloForo($identificador, $respuestas);
    $contenidoPrincipal=<<<EOS
<p>$contenido2</p>
EOS;
}else{
    $contenidoPrincipal="<p class='contenido'>No respuestas o identificador</p>";
}

require __DIR__ . '/includes/comun/layout.php';
