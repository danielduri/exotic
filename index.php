<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Inicio';

$contenidoPrincipal=<<<EOS


<body>
<div class="inicio">
<h1 class="mainTitle"> <img class="centerBanner" src="images/recursos/banner_logo.png"></h1>
<h1 class="mainTitle">Mejora tu juego. Intensifica tu experiencia.</h1>
<a href="cursos.php"><button class="largeButton">Explora nuestros programas</button></a>

</div>
</body>





EOS;

require __DIR__.'/includes/comun/layout.php';
