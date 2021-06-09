<?php

require_once __DIR__ . '/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Foros';

$nombre = isset($_GET["juego"]) ? $_GET["juego"] : null;
$juego=\es\fdi\ucm\aw\Juego::buscarJuegoPorNombre($nombre);


if($nombre!=null && $juego!=null){
    //$contenidoPrincipal = obtenerForosParaAdmin($juego);
    $contenido2 = obtenerForos($juego);
    $contenidoPrincipal="";
    if(isset($_SESSION['login']) && $_SESSION['login']){

            $contenidoPrincipal.=<<<EOS
            <div class='navigationButton'><a href="nuevoForo.php?juego=$nombre"><button class="boton_personalizado">Escribir mensaje</button></a></div>
            <div class='navigationButton'><a href='foros.php'><button>Volver</button></a></div>
            <p>$contenido2</p>
            
            
            EOS;}
    else{
        $contenidoPrincipal=<<<EOS
        <h1>Inicia sesion para acceder</h1>
        EOS;
    }

}else{
    $contenidoPrincipal="<p class='contenido'>No se ha encontrado este juego</p>";
}

require __DIR__ . '/includes/comun/layout.php';
