<?php

namespace es\fdi\ucm\aw;


class FormularioPerfil extends Form
{
    public function __construct() {
        parent::__construct('formPerfil');
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

            $perfil = \es\fdi\ucm\aw\Usuario::buscaUsuario($_SESSION["username"]);
            $nombreUsuario = $perfil->username();
            $nombre = $perfil->given();
            $apellido = $perfil->last();
            $email = $perfil->email();
            $fecha = $perfil->dob();
            $descripcion = $perfil->description();
            if($descripcion==""){
                $descripcion="Escribe aquí tu descripción";
            }

            $juegos = \es\fdi\ucm\aw\Juego::obtenerTodosLosJuegos();
            $juegosForm = obtenerJuegosParaFormulario($juegos);

            $html = <<<EOF
                $htmlErroresGlobales
                
                <p>
                <input type="text" name="Username" placeholder=$nombreUsuario> $errorNombreUsuario
                </p>
                
                <p>
                <input type="text" name="Given" placeholder=$nombre> $errorNombre
                </p>
                
                <p>
                <input type="text" name="Last" placeholder=$apellido> $errorApellido
                </p>
                
                <p>
                <input type="password" name="Password" placeholder="Nueva contraseña"> $errorPassword
                </p>
                
                <p>
                <input type="password" name="Password2" placeholder="Vuelva a escribir la nueva contraseña"> $errorPassword2
                </p>
                
                <p>
                <input type="text" name="E-mail" placeholder=$email> $errorEmail
                </p>
                
                <p>
                <textarea name="Description" rows="10" cols="40" placeholder="$descripcion"></textarea>
                </p>
                
                <p>
                <label>Juego favorito:</label>
                <select name="Favg">
                    $juegosForm;		
                </select>
                </p>
                    
                <p>
                <input type="submit" name="enviar" value= "Enviar" />
                <input type="reset" name="borrar" value="Borrar" />		
                </p>
            EOF;
            return $html;
        }


    protected function procesaFormulario($datos)
    {
        $result = array();
        $bool = false;

        $perfil = \es\fdi\ucm\aw\Usuario::buscaUsuario($_SESSION["username"]);

        $username = isset($datos["Username"]) ? $datos["Username"] : null;
        if($username!=null){
            if ( empty($username) || mb_strlen($username) < 5 ) {
                $result['Username'] = "El nombre de usuario tiene que tener una longitud de al menos 5 caracteres.";
            }else{
                $bool = $perfil->cambiaUsername($username);
                if(!$bool){
                    $result['Username'] = "El usuario ya existe";
                }
            }
        }


        $password = isset($datos["Password"]) ? $datos["Password"] : null;
        if($password!=null){
            if ( empty($password) || mb_strlen($password) < 4 ) {
                $result['Password'] = "El password tiene que tener una longitud de al menos 4 caracteres.";
            }else{
                $password2 = isset($datos["Password2"]) ? $datos["Password2"] : null;
                    if(strcmp($password, $password2) !== 0){
                        $result["Password2"] = "Los passwords no coinciden";
                    }else{
                        $bool = $perfil->cambiaPassword($password);
                    }
                }
        }


        $given = isset($datos["Given"]) ? $datos["Given"] : null;
        if($given!=null){
            if ( empty($given) || mb_strlen($given) < 5 ) {
                $result['Given'] = "El nombre tiene que tener una longitud de al menos 5 caracteres.";
            }else{
                $bool = $perfil->cambiaGiven($given);
            }
        }

        $last = isset($datos["Last"]) ? $datos["Last"] : null;
        if($last!=null){
            if ( empty($last) || mb_strlen($last) < 5 ) {
                $result['Last'] = "El apellido tiene que tener una longitud de al menos 5 caracteres.";
            }else{
                $bool = $perfil->cambiaLast($last);
            }
        }

        $email = isset($datos["E-mail"]) ? $datos["E-mail"] : null;
        if($email!=null){
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $result['E-mail'] = "E-mail inválido";
            }else{
                $bool = $perfil->cambiaEmail($email);
            }
        }

        $description = isset($datos["Description"]) ? $datos["Description"] : null;
        if($description!=null){
            $bool = $perfil->cambiaDescription($description);
        }

        $favg = isset($datos["Favg"]) ? $datos["Favg"] : null;
        if($favg!=null){
            $bool = $perfil->cambiaFavg($favg);
        }

        if(count($result) != 0){
            $bool=false;
        }

        if ($bool){
            $result='profile.php';
        }

        return $result;
    }
}