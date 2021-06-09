<?php
require_once __DIR__ . '/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Nuevo Tema';

$nombre = isset($_GET["juego"]) ? $_GET["juego"] : null;
$juego=\es\fdi\ucm\aw\Juego::buscarJuegoPorNombre($nombre);

$formulario = new \es\fdi\ucm\aw\FormulariosAdmin\FormularioForoNuevo($juego);
$procesamiento = $formulario->gestiona();
//$nombre = $juego->getName();
if (isset($_SESSION["userID"]) && $_SESSION["login"]){
    $contenidoPrincipal = <<<EOS
    <div class="login">
    <h1>Nuevo Mensaje: </h1>
    $procesamiento
    </div>
    
    <a href = "verForos.php?juego=$nombre" class="submitbtn"> <button> Volver </button></a>
    EOS;
}else{
    $contenidoPrincipal="<h1>No tiene permiso para acceder a esta página</h1>";
}


require __DIR__ . '/includes/comun/layout.php';
