<?php

namespace es\fdi\ucm\aw;


class FormularioRegistro extends Form
{
    public function __construct() {
        parent::__construct('formRegistro');
    }

    protected function generaCamposFormulario($datos, $errores = array())
    {
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorNombreUsuario = self::createMensajeError($errores, 'Username', 'span', array('class' => 'error'));
        $errorNombre = self::createMensajeError($errores, 'Given', 'span', array('class' => 'error'));
        $errorPassword = self::createMensajeError($errores, 'Password', 'span', array('class' => 'error'));
        $errorPassword2 = self::createMensajeError($errores, 'Password2', 'span', array('class' => 'error'));
        $errorApellido = self::createMensajeError($errores, 'Last', 'span', array('class' => 'error'));
        $errorEmail = self::createMensajeError($errores, 'E-mail', 'span', array('class' => 'error'));
        $errorFecha = self::createMensajeError($errores, 'Date', 'span', array('class' => 'error'));

        $html = <<<EOF
        
                <h1>Crea una cuenta gratuita</h1>
                
                $htmlErroresGlobales
                
                <p><input type="text" name="Username" placeholder="Nombre de usuario" required/></p> $errorNombreUsuario
                <p><input type="password" name="Password" placeholder="Contraseña" required/></p> $errorPassword
                <p><input type="password" name="Password2" placeholder="Repite tu contraseña:" required/></p> $errorPassword2
                <p><input type="text" name="Given" placeholder="Nombre" required/></p> $errorNombre
                <p><input type="text" name="Last" placeholder="Apellido(s)" required/></p> $errorApellido
                <p><input type="text" name="E-mail" placeholder="Correo electrónico" required/></p> $errorEmail
                
                <p><label>Fecha de nacimiento  </label><input type="date" name="Date"  placeholder="Fecha de nacimiento" required/></p> $errorFecha

                <p><label>Género</label>
                <select id="Gender" name="Gender">
                    <option value=0>Masculino</option>
                    <option value=1>Femenino</option>
                    <option value=2>No-binario/Prefiero no decir</option>
                </select></p>

                <p class="submit"><input type="submit" name="Registro" value="¡Todo listo!"/></p>
        EOF;
        return $html;
    }


    protected function procesaFormulario($datos)
    {
        $result = array();

        $nombreUsuario = $datos['Username'] ?? null;

        if ( empty($nombreUsuario) || mb_strlen($nombreUsuario) < 5 ) {
            $result['Username'] = "El nombre de usuario tiene que tener una longitud de al menos 5 caracteres.";
        }

        $nombre = $datos['Given'] ?? null;
        if ( empty($nombre) || mb_strlen($nombre) < 5 ) {
            $result['Given'] = "El nombre tiene que tener una longitud de al menos 5 caracteres.";
        }

        $apellido = $datos['Last'] ?? null;
        if ( empty($nombre) || mb_strlen($nombre) < 5 ) {
            $result['Last'] = "El apellido tiene que tener una longitud de al menos 5 caracteres.";
        }

        $password = $datos['Password'] ?? null;
        if ( empty($password) || mb_strlen($password) < 4 ) {
            $result['Password'] = "El password tiene que tener una longitud de al menos 4 caracteres.";
        }
        $password2 = $datos['Password2'] ?? null;
        if ( empty($password2) || strcmp($password, $password2) !== 0 ) {
            $result['Password2'] = "Los passwords deben coincidir";
        }

        $email = $datos['E-mail'] ?? null;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result['E-mail'] = "E-mail inválido";
        }

        $dob = $datos['Date'] ?? null;
        if ( empty($dob) ) {
            $result['Date'] = "Especifique una fecha de nacimiento válida";
        }

        $genero = $datos['Gender'] ?? 2;

        if (count($result) === 0) {
            $user = Usuario::registrarUsuario($nombreUsuario, $password, $nombre, $apellido, $email, $dob, $genero);
            if ( ! $user ) {
                $result['Username'] = "El usuario ya existe";
            } else {
                $_SESSION["login"] = true;
                $_SESSION["username"] = $nombreUsuario;
                $_SESSION["given"] = $nombre;
                $result = 'index.php';
            }
        }
        return $result;
    }
}