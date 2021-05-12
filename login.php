                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Login';
$formulario = new \es\fdi\ucm\aw\FormularioLogin();
$procesamiento = $formulario->gestiona();

$contenidoPrincipal= <<<EOS

<div class="login">
$procesamiento
<p><a href="register.php">¿Sin cuenta? ¡Regístrate aquí!</a></p>
</div>

EOS;

require __DIR__.'/includes/comun/layout.php';
