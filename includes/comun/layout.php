<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="<?= RUTA_CSS.'/estilos.css'?>" />
    <title><?= $tituloPagina ?></title>
    <link rel="icon" type="image/png" href="images/recursos/favicon.png"/>
    <script src="https://cdn.tiny.cloud/1/3u7vohf8qw766n4wn3akgcvojww2l1k01o98bhxdcl6ba79c/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea',
            plugins: ['link'],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link"
        });
    </script>
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