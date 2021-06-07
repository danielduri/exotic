<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Cursos';

$contenidoPrincipal = <<<EOS

<div class= "busquedaCSS">
<form action="cursos.php" method="post">
	<input type="search" placeholder="Buscar" name="busquedaCurso">
</form>
</div>

<div id= "filtros" class= "busquedaCSS">
<form action="cursos.php" method="post">
<select name="filtro">
<option value="todos">Todos</option>
<option value="precioAscendente">Precio Ascendente</option>
<option value="precioDescendente">Precio Descendente</option>
<option value="duracionDescendente">Duración Ascendente</option>
<option value="duracionAscendente">Duración Descente</option>
</select> 
<button type="submit">Filtrar</button>
</form>
</div>


EOS;

$busqueda = isset($_POST["busquedaCurso"]) ? $_POST["busquedaCurso"] : null;
$filtrar = isset($_POST["filtro"]) ? $_POST["filtro"] : null;


if ($filtrar == null){
    if ($busqueda != null){
        $juegos = \es\fdi\ucm\aw\Curso::mostrarCursosBusqueda($busqueda);
        $contenidoPrincipal.= obtenerCursosParaBusqueda($juegos);
    } else {
        $juegos = \es\fdi\ucm\aw\Juego::obtenerTodosLosJuegos();
        $contenidoPrincipal.= obtenerCursosParaDisplay($juegos);
    }
} else {
    $juegos = \es\fdi\ucm\aw\Curso::mostrarCursosFiltrados($filtrar);
    $contenidoPrincipal.= obtenerCursosParaBusqueda($juegos);
}




require __DIR__.'/includes/comun/layout.php';
