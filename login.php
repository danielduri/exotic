                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Exotic Games Academy - Login';
$formulario = new \es\fdi\ucm\aw\FormularioLogin();
$procesamiento = $formulario->gestiona();

$contenidoPrincipal= <<<EOS

<h1>Iniciar sesión:</h1>
$procesamiento
<p><a href="register.php"><button>Regístrate</button></a></p>

EOS;

require __DIR__.'/includes/comun/layout.php';
