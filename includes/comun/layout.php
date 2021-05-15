<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="<?= RUTA_CSS.'/estilos.css'?>" />
    <title><?= $tituloPagina ?></title>
    <link rel="icon" type="image/png" href="images/recursos/favicon.png"/>
</head>
<body>
<div id="contenedor">
    <?php

    require(__DIR__.'/header.php');

    ?>
    <main>
        <article>
            <?= $contenidoPrincipal ?>
        </article>
    </main>
<!--    --><?php

//    require(__DIR__.'/pie.php');
//
//    ?>
</div>
</body>
</html>