<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Inicio';
$contenidoPrincipal=<<<EOS


<body>
<div class="inicio">
<div class="centerBanner2"><img src="images/recursos/favicon.png"></div>
<h1 class="mainTitlePortada"> Mejora tu juego. Intensifica tu experiencia.</h1>
<a href="cursos.php"> <button class="largeButton">Explora nuestros programas</button></a>

</div>
</body>





EOS;

require __DIR__.'/includes/comun/layout.php';
