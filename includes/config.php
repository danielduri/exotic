<?php

// Varios defines para los parámetros de configuración de acceso a la BD y la URL desde la que se sirve la aplicación
define('BD_HOST', 'localhost');
define('BD_NAME', 'exoticga');
define('BD_USER', 'web_user');
define('BD_PASS', 'web_user');
define('RUTA_APP', '/exotic');
define('RUTA_IMGS', RUTA_APP . '/images');
define('RUTA_CSS', RUTA_APP . '/css');
define('RUTA_JS', RUTA_APP . '/js');
define('INSTALADA', true);

if (!INSTALADA) {
    echo "La aplicación no está configurada";
    exit();
}

/* */
/* Configuración de Codificación */
/* */

ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');

/* */
/* Funciones de gestión de la conexión a la BD */
/* */

$BD = null;

function getConexionBD()
{
    global $BD;
    if (!$BD) {
        $BD = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);
        if ($BD->connect_errno) {
            echo "Error de conexión a la BD: (" . $BD->connect_errno . ") " . $BD->connect_error;
            exit();
        }
        if (!$BD->set_charset("utf8mb4")) {
            echo "Error al configurar la codificación de la BD: (" . $BD->errno . ") " . $BD->error;
            exit();
        }
    }
    return $BD;
}

spl_autoload_register(function ($class){
    $prefix = 'es\\fdi\\ucm\\aw';
    $base_dir = __DIR__;

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = str_replace('\\', '/', $base_dir . $relative_class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

function cierraConexion()
{
    // Sólo hacer uso de global para cerrar la conexion !!
    global $BD;
    if (isset($BD) && !$BD->connect_errno) {
        $BD->close();
    }
}

register_shutdown_function('cierraConexion');

require_once __DIR__.'/Usuario.php';

session_start();