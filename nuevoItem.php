<?php
require_once __DIR__ . '/includes/config.php';

use es\fdi\ucm\aw\Juego;

$tituloPagina = 'Exotic Games Academy - Nuevo Item';

if (isset($_SESSION["userID"]) && $_SESSION["admin"]){
    $contenidoPrincipal = <<<EOS
    
      <h1>TinyMCE Quick Start Guide</h1>
      <form method="post">
        <textarea id="mytextarea" name="mytextarea">
          Hello, World!
        </textarea>
      </form>

    EOS;
}else{
    $contenidoPrincipal="<h1>No tiene permiso para acceder a esta página</h1>";
}


require __DIR__ . '/includes/comun/layout.php';
