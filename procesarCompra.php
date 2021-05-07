<?php

require_once __DIR__ . '/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Comprar curso';

$contenidoPrincipal='';

$id = isset($_POST["course"]) ? $_POST["course"] : null;
$curso = \es\fdi\ucm\aw\Curso::buscarCursoPorID($id);

if($curso!=null && isset($_SESSION['login']) && $_SESSION['login']){
    if($curso->comprarCurso($_SESSION["userID"])){
        $contenidoPrincipal.='<h1>Gracias por su compra. Puede encontrar su curso en <a href="misCursos.php"> Mis cursos.</a></h1>';
    }else{
        $contenidoPrincipal.='<h1>Ya ha comprado este curso. Lo tiene disponible en <a href="misCursos.php"> Mis cursos.</a></h1>';
    }
}else{
    $contenidoPrincipal.='<h1>Por favor, <a href="login.php">inicie sesión</a> o <a href="register.php">cree una cuenta.</a></h1>';
}

require __DIR__ . '/includes/comun/layout.php';