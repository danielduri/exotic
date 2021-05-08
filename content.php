<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Curso';

$id = isset($_POST["course"]) ? $_POST["course"] : $_SESSION["course"];
$_SESSION["course"]=$id;
$curso = \es\fdi\ucm\aw\Curso::buscarCursoPorID($id);
$usuario = \es\fdi\ucm\aw\Usuario::buscaUsuario($_SESSION["username"]);
$numItem = $curso->getProgreso($usuario->id());

$contenidoPrincipal=$curso->getItem($numItem);

if($numItem>1){
    $contenidoPrincipal.='<form method = "post" action="anteriorItem.php">';
    $contenidoPrincipal.='<button value="';
    $contenidoPrincipal.=$curso->getID();
    $contenidoPrincipal.='"name="course" type="submit">Anterior</button>';
    $contenidoPrincipal.='</form>';
}

if($numItem<$curso->getNumItems()){
    $contenidoPrincipal.='<form method = "post" action="siguienteItem.php">';
    $contenidoPrincipal.='<button value="';
    $contenidoPrincipal.=$curso->getID();
    $contenidoPrincipal.='"name="course" type="submit">Siguiente</button>';
    $contenidoPrincipal.='</form>';
}

require __DIR__.'/includes/comun/layout.php';