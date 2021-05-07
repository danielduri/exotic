<?php

namespace es\fdi\ucm\aw;


class FormularioLogin extends Form
{
    public function __construct() {
        parent::__construct('formLogin');
    }

    protected function generaCamposFormulario($datos, $errores = array())
    {
        // Se reutiliza el nombre de usuario introducido previamente o se deja en blanco
        $nombreUsuario =$datos['nombreUsuario'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorNombreUsuario = self::createMensajeError($errores, 'nombreUsuario', 'span', array('class' => 'error'));
        $errorPassword = self::createMensajeError($errores, 'password', 'span', array('class' => 'error'));

        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
            <p>
            $htmlErroresGlobales
            <p><label>Nombre de usuario:</label> <input type="text" name="nombreUsuario" value="$nombreUsuario"/>$errorNombreUsuario</p>
            <p><label>Password:</label> <input type="password" name="password" />$errorPassword</p>
            <p><button type="submit" name="login">Entra</button></p>
            </p>
        EOF;
        return $html;
    }


    protected function procesaFormulario($datos)
    {
        $result = array();

        $nombreUsuario =$datos['nombreUsuario'] ?? null;

        if ( empty($nombreUsuario) ) {
            $result['nombreUsuario'] = "El nombre de usuario no puede estar vacío";
        }

        $password = $datos['password'] ?? null;
        if ( empty($password) ) {
            $result['password'] = "El password no puede estar vacío.";
        }

        if (count($result) === 0) { //si no hay errores
            $usuario = Usuario::login($nombreUsuario, $password);
            if ( ! $usuario ) {
                // No se da pistas a un posible atacante
                $result[] = "El usuario o el password no coinciden";
            } else {
                $_SESSION["login"] = true;
                $_SESSION["userID"]=$usuario->id();
                $_SESSION["username"] = $usuario->username();
                $_SESSION["given"] = $usuario->given();
                $result = 'misCursos.php';
            }
        }
        return $result;
    }
}