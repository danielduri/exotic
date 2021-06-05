<?php

namespace es\fdi\ucm\aw;
require_once __DIR__.'/funcionesUsuarios.php';

class Usuario
{


    /*
     * funcion que permite al usuario logarse en la pagina
     */
    public static function login($username, $password)
    {
        $user = self::buscaUsuario($username);
        if ($user && $user->compruebaPassword($password)) {
            return $user;
        }
        return false;
    }

    /*
     * funcion que entra en la base de datos para dar de alta un nuevo usuario, dados todos los campos necesarios
     */
    public static function registrarUsuario($username, $password, $given, $last, $email, $date, $gender, $admin): bool
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        if(!self::buscaUsuario($username)){
            $passwordhash = password_hash($password, PASSWORD_DEFAULT);
            $role=0;
            if($admin){
                $role=1;
            }
            $query = sprintf("INSERT INTO `users` (`username`, `given_name`, `last_name`, `date_of_birth`, `gender`, `e-mail`, `password`, `role`) 
                VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', $role)", $conn->real_escape_string($username),
                $conn->real_escape_string($given), $conn->real_escape_string($last), $conn->real_escape_string($date), $conn->real_escape_string($gender),
                $conn->real_escape_string($email), $conn->real_escape_string($passwordhash));
            if ($conn->query($query) === TRUE) {
                return true;
            }
        }
        return false;
    }

    /*
     * funcion que retorna un objeto de tipo Usuario si existe usuario con el $username dado, false en caso contrario
     */
    public static function buscaUsuario($username)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM users WHERE username='%s'", $conn->real_escape_string($username));

        $rs = $conn->query($query);
        if ($rs && $rs->num_rows == 1) {
            $fila = $rs->fetch_assoc();
            $admin = ($fila['role']==1);
            $user = new Usuario($fila['userID'], $fila['username'], $fila['password'], $fila['given_name'], $fila['last_name'], $fila['date_of_birth'], $fila['date_of_registration'],$fila['favorite_game'], $fila['e-mail'], $fila['description'], $admin);

            $rs->free();
            $user->obtenerCompras();
            return $user;
        }
        $rs->free();
        return false;
    }

    /*
     * funcion que retorna un objeto de tipo Usuario si existe usuario con el $userID dado, false en caso contrario
     */
    public static function buscaPorId($userID)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM users WHERE userID=%d", $conn->real_escape_string($userID));
        $rs = $conn->query($query);
        if ($rs && $rs->num_rows == 1) {
            $fila = $rs->fetch_assoc();
            $user = new Usuario($fila['userID'], $fila['username'], $fila['password'], $fila['given_name'], $fila['last_name'], $fila['date_of_birth'], $fila['date_of_registration'],$fila['favorite_game'], $fila['e-mail'], $fila['description'], $fila['role']);

            $rs->free();
            $user->obtenerCompras();
            return $user;
        }
        return false;
    }

    private $id;
    private $username;
    private $password;
    private $given; //Given name, o nombre de pila
    private $last; //Last name, o apellido
    private $dob; //Date of birth, o fecha de nacimiento
    private $dor; //Date of registration, o fecha de alta
    private $favg; //Favorite game, o juego favorito
    private $email;
    private $description;
    private $admin;

    private $cursos; //array con los cursos que el usuario ha comprado


    public function __construct($id, $username, $password, $given, $last, $dob, $dor, $favg, $email, $description, $admin)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->given = $given;
        $this->last = $last;
        $this->dob = $dob;
        $this->dor = $dor;
        $this->favg = $favg;
        $this->email = $email;
        $this->description = $description;
        $this->admin = $admin;
    }


    //GETTERS, SETTERS (que mantienen la BD actualizada) y METODOS AUXILIARES

    public function id()
    {
        return $this->id;
    }

    public function esAdmin(){
        return $this->admin;
    }

    public function username()
    {
        return $this->username;
    }

    public function cambiaUsername($nuevoUsername): bool
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        if(!self::buscaUsuario($nuevoUsername)){
            $query = sprintf("UPDATE `users` SET `username` = '%s' WHERE `users`.`userID` = '%s'", $conn->real_escape_string($nuevoUsername), $conn->real_escape_string($this->id));
            if ($conn->query($query) === TRUE) {
                $this->username = $nuevoUsername;
                $_SESSION["username"]=$nuevoUsername;
                return true;
            }
        }
        return false;
    }

    public function compruebaPassword($password): bool
    {
        return password_verify($password, $this->password);
    }

    public function cambiaPassword($nuevoPassword): bool
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $passwordhash = password_hash($nuevoPassword, PASSWORD_DEFAULT);
        $query = sprintf("UPDATE `users` SET `password` = '%s' WHERE `users`.`userID` = '%s'", $conn->real_escape_string($passwordhash), $conn->real_escape_string($this->id));
        if ($conn->query($query) === TRUE) {
            $this->password = $passwordhash;
            return true;
        }
        return false;
    }

    public function given(){
        return $this->given;
    }

    public function cambiaGiven($nuevoGiven): bool
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("UPDATE `users` SET `given_name` = '%s' WHERE `users`.`userID` = '%s'", $conn->real_escape_string($nuevoGiven), $conn->real_escape_string($this->id));
        if ($conn->query($query) === TRUE) {
            $this->given = $nuevoGiven;
            $_SESSION["given"]=$nuevoGiven;
            return true;
        }
        return false;
    }

    public function description(){
        return $this->description;
    }

    public function cambiaDescription($nuevoDescription): bool
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("UPDATE `users` SET `description` = '%s' WHERE `users`.`userID` = '%s'", $conn->real_escape_string($nuevoDescription), $conn->real_escape_string($this->id));
        if ($conn->query($query) === TRUE) {
            $this->description = $nuevoDescription;

            return true;
        }
        return false;
    }

    public function last()
    {
        return $this->last;
    }

    public function cambiaLast($nuevoLast): bool
    {

        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("UPDATE `users` SET `last_name` = '%s' WHERE `users`.`userID` = '%s'", $conn->real_escape_string($nuevoLast), $conn->real_escape_string($this->id));
        if ($conn->query($query) === TRUE) {
            $this->last = $nuevoLast;

            return true;
        }
        return false;
    }

    public function dob()
    {
        return $this->dob;
    }

    public function cambiaDate($nuevoDob): bool
    {

        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("UPDATE `users` SET `date_of_birth` = '%s' WHERE `users`.`userID` = '%s'", $conn->real_escape_string($nuevoDob), $conn->real_escape_string($this->id));
        if ($conn->query($query) === TRUE) {
            $this->dob = $nuevoDob;

            return true;
        }
        return false;
    }

    public function dor()
    {
        return $this->dor;
    }

    public function favg()
    {
        return $this->favg;
    }

    public function cambiaFavg($nuevoFavg): bool
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("UPDATE `users` SET `favorite_game` = '%s' WHERE `users`.`userID` = '%s'", $conn->real_escape_string($nuevoFavg), $conn->real_escape_string($this->id));
        if ($conn->query($query) === TRUE) {
            $this->favg = $nuevoFavg;

            return true;
        }
        return false;
    }

    public function email()
    {
        return $this->email;
    }

    public function cambiaEmail($nuevoEmail): bool
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("UPDATE `users` SET `e-mail` = '%s' WHERE `users`.`userID` = '%s'", $conn->real_escape_string($nuevoEmail), $conn->real_escape_string($this->id));
        if ($conn->query($query) === TRUE) {
            $this->email = $nuevoEmail;

            return true;
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function cursos()
    {
        return $this->cursos;
    }

    /*
     * funcion que entra en la base de datos para obtener las compras que el usuario ha realizado
     * y rellena el array de cursos que pertenecen al usuario
     */
    public function obtenerCompras(){
        $this->cursos = [];
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT `courseID` FROM `purchases` WHERE `userID` = '%s'", $conn->real_escape_string($this->id));

        $rs = $conn->query($query);

        while ($registro = $rs->fetch_assoc()) {
            $id = $registro['courseID'];
            array_push($this->cursos, Curso::buscarCursoPorID($id));
        }

        $rs->free();
    }

    /*
     * funcion que mustra informacion acerca de los cursos que el usuario dispone, para mostrar en la seccion del perfil correspondiente
     */
    public function obtenerMisCursos(){
        return obtenerMisCursosParaDisplay($this);
    }

    public function datosUsuario($username)
    {
        return datosUsuarioHTML($username);
    }


}
