<?php

/*
 * funcion que recopila los datos del formulario de registro y comprueba la igualdad de las contraseñas.
 * Procesa la solicitud de registro; si esta es correcta devuelve true, devuelve false en caso contrario.
 */
function registerUser(){
    $username = isset($_POST["Username"]) ? $_POST["Username"] : null;
    $password = isset($_POST["Password"]) ? $_POST["Password"] : null;
    $password2 = isset($_POST["Password2"]) ? $_POST["Password2"] : null;
    $given = isset($_POST["Given"]) ? $_POST["Given"] : null;
    $last = isset($_POST["Last"]) ? $_POST["Last"] : null;
    $email = isset($_POST["E-mail"]) ? $_POST["E-mail"] : null;
    $date = isset($_POST["Date"]) ? $_POST["Date"] : null;
    $gender = isset($_POST["Gender"]) ? $_POST["Gender"] : null;

    if($password==$password2) {
        if (\es\fdi\ucm\aw\Usuario::registrarUsuario($username, $password, $given, $last, $email, $date, $gender)) {
            checkLogin();
            return true;
        }
        return false;
    }
    return false;
}

/*
 * funcion que recopila los datos del formulario de login. Procesa la solicitud de login;
 * si esta es correcta devuelve true y rellena las cookies necesarias, devuelve false en caso contrario.
 */
function checkLogin() {
    $username = isset($_POST["Username"]) ? $_POST["Username"] : null;
    $password = isset($_POST["Password"]) ? $_POST["Password"] : null;

    $usuario = \es\fdi\ucm\aw\Usuario::login($username, $password);

    if ($usuario) {
        $_SESSION["login"] = true;
        $_SESSION["userID"]=$usuario->id();
        $_SESSION["username"] = $usuario->username();
        $_SESSION["given"] = $usuario->given();
        return true;
    }

    return false;
}

/*
 * funcion que destruye la sesion
 */
function logout() {
    //Doble seguridad: unset + destroy
    unset($_SESSION["login"]);
    unset($_SESSION["userID"]);
    unset($_SESSION["username"]);
    unset($_SESSION["given"]);
    unset($_SESSION["course"]);


    session_destroy();
    session_start();
}

/*
 * funcion que muestra al usuario sus datos personales en formato tabla
 */
function datosUsuarioHTML($username): string
{
    $html = '<p><table class="userData">';
    $perfil = \es\fdi\ucm\aw\Usuario::buscaUsuario($username);
    $html .= '<tr><td>';
    $html .= 'Username: ';
    $html .= '</td><td>';
    $html .= $perfil->username();
    $html .= '</td></tr>';

    $html .= '<tr><td>';
    $html .= 'Nombre: ';
    $html .= '</td><td>';
    $html .= $perfil->given();
    $html .= '</td></tr>';

    $html .= '<tr><td>';
    $html .= 'Apellido: ';
    $html .= '</td><td>';
    $html .= $perfil->last();
    $html .= '</td></tr>';

    $html .= '<tr><td>';
    $html .= 'Email: ';
    $html .= '</td><td>';
    $html .= $perfil->email();
    $html .= '</td></tr>';

    $html .= '<tr><td>';
    $html .= 'Fecha de nacimiento: ';
    $html .= '</td><td>';
    $html .= $perfil->dob();
    $html .= '</td></tr>';

    $html .= '<tr><td>';
    $html .= 'Usuario desde: ';
    $html .= '</td><td>';
    $html .= $perfil->dor();
    $html .= '</td></tr>';

    $html .= '<tr><td>';
    $html .= 'Descripción: ';
    $html .= '</td><td>';
    $html .= $perfil->description();
    $html .= '</td></tr>';

    $html .= '<tr><td>';
    $html .= 'Juego favorito: ';
    $html .= '</td><td>';
    $html .= $perfil->favg();
    $html .= '</td></tr>';

    $html .= '</table></p>';

    return $html;
}


function obtenerMisCursosParaDisplay($user){

    $html="<h1 class='mainTitle'>Mis cursos:</h1>";
    $existeCurso = false;
    $html.= '<div class="wrapper">';
    foreach ($user->cursos() as $item) {
        $html.=obtenerMiCursoDisplay($item);
        $existeCurso=true;
    }
    if (!$existeCurso){
        $html.='<h1>No estas suscrito a ningun curso, vaya a <a href="cursos.php"> Cursos disponibles </a> para acceder a uno.</h1>';
    }
    $html.= '</div>';
    return $html;
}
