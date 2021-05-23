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

              <h1>Login</h1>
              $htmlErroresGlobales
                <p><input type="text" name="nombreUsuario" value="$nombreUsuario" placeholder="Nombre de usuario">$errorNombreUsuario</p>
                <p><input type="password" name="password" value="" placeholder="Contraseña">$errorPassword</p>
                <p class="submit"><input type="submit" name="login" value="Login"></p>


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
                $_SESSION["admin"] = $usuario->esAdmin();
                $result = 'misCursos.php';
            }
        }
        return $result;
    }
}