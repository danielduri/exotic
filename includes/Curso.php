<?php

namespace es\fdi\ucm\aw;

require_once __DIR__.'/funcionesCursos.php';

class Curso
{
    private $id;
    private $game;
    private $price;
    private $courseName;
    private $level;
    private $duration;
    private $description;
    private $numItems;

    public function __construct($id, $game, $price, $courseName, $level, $duration, $description, $numItems)
    {
        $this->id = $id;
        $this->game = $game;
        $this->price = $price;
        $this->courseName = $courseName;
        $this->level = $level;
        $this->duration = $duration;
        $this->description = $description;
        $this->numItems = $numItems;
    }

    //Getters

    public function getPrice()
    {
        return $this->price;
    }


    public function getCourseName()
    {
        return $this->courseName;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getGame()
    {
        return $this->game;
    }

    public function getNumItems()
    {
        return $this->numItems;
    }

    /*
     * funcion que accede a la base de datos para realizar la compra de un curso
     * por parte de un usuario a traves de su identificador, previa comprobación de que
     * el curso no se ha comprado anteriormente
     */
    public function comprarCurso($userID): bool
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        if(!self::existeCompra($userID, $this->id)){
            $query = sprintf("INSERT INTO `purchases` (`courseID`, `userID`) VALUES ('%d', '%d')", $conn->real_escape_string($this->id), $conn->real_escape_string($userID));
            if ($conn->query($query) === TRUE) {
                return true;
            }
        }
        return false;
    }

    /*
     * funcion que accede a la base de datos para comprobar si el curso con id $courseID ha sido
     * comprado anteriormente por el usuario con id $userID.
     */
    public static function existeCompra($userID, $courseID): bool
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT `id` FROM `purchases` WHERE `userID`='%d' AND `courseID`='%d'", $conn->real_escape_string($userID), $conn->real_escape_string($courseID));
        $rs = $conn->query($query);
        if ($rs && $rs->num_rows >= 1) {
            $rs->free();
            return true;
        }
        $rs->free();
        return false;
    }



    /*
    * crear un nuevo curso dentro de la base de datos con los parámetros dados
    */
    public static function nuevoCursoenBD($juego, ?string $nombre, ?string $description, ?string $precio, ?string $nivel, ?string $duracion)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("INSERT INTO `courses` (`courseName`, `price`, `game`,`level`,`duration`, `description`) 
                VALUES ('%s', '%s', '%s','%s', '%s','%s')", $conn->real_escape_string($nombre),
            $conn->real_escape_string($precio), $conn->real_escape_string($juego), $conn->real_escape_string($nivel), $conn->real_escape_string($duracion), $conn->real_escape_string($description));
        if ($conn->query($query) === TRUE) {
            return true;
        }
        return false;
    }

    /*
     * funcion que retorna el objeto de tipo Curso correspondiente al identificador dado por parametro, null si no existiese
     */
    public static function buscarCursoPorID($courseID): Curso
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM `courses` WHERE `courseID`='%d'", $conn->real_escape_string($courseID));
        $curso = null;

        $rs = $conn->query($query);

        if ($rs && $rs->num_rows == 1) {
            $registro = $rs->fetch_assoc();
            $curso = new Curso($registro['courseID'], $registro['game'], $registro['price'], $registro['courseName'], $registro['level'], $registro['duration'], $registro['description'], $registro['numItems']);
        }

        $rs->free();

        return $curso;
    }

    /*
    * funcion que retorna el objeto de tipo Curso correspondiente al nombre dado por parametro, null si no existiese
    */
    public static function buscarCursoPorNombre($courseName): Curso
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM `courses` WHERE `courseName`='%d'", $conn->real_escape_string($courseName));

        $curso = null;

        $rs = $conn->query($query);

        if ($rs && $rs->num_rows == 1) {
            $registro = $rs->fetch_assoc();
            $curso = new Curso($registro['courseID'], $registro['game'], $registro['price'], $registro['courseName'], $registro['level'], $registro['duration'], $registro['description'], $registro['numItems']);
        }

        $rs->free();

        return $curso;
    }

    /*
     * retorna el numero de item por el que va el usuario del que se pasa su idendificador
     * si existe la compra, false en caso contrario
     */
    public function getProgreso($userID){
        if (self::existeCompra($userID, self::getID())){
            $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
            $courseID = self::getID();
            $query = sprintf("SELECT `completed` FROM `purchases` WHERE `userID`='%d' AND `courseID`='$courseID'", $conn->real_escape_string($userID));
            $rs = $conn->query($query);
            if ($rs && $rs->num_rows == 1) {
                $registro = $rs->fetch_assoc();
                $rs->free();
                $numero = $registro['completed'];
                if($numero < 0 || $numero > $this->numItems){
                    $query= sprintf("UPDATE `purchases` SET `completed` = 1 WHERE `courseID` = $this->id AND `userID` = %d", $conn->real_escape_string($userID));
                    $rs = $conn->query($query);
                    $numero = 1;
                }
                return $numero;
            }
            $rs->free();
            return false;
        }
        return false;
    }

    /*
     * retorna el html del item del curso cuyo orden dentro del curso se ha pasado por parámetro
     */
    public function getItem($orden): string
    {
        $item = Item::getItem($this->getID(), $orden);
        return $item->getItemForDisplay();
    }

    /*
     * actualiza el progreso del usuario
     */
    public function avanzar($usuario): bool
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query= sprintf("UPDATE `purchases` SET `completed` = `completed` + 1 WHERE `courseID` = $this->id AND `userID` = %d", $conn->real_escape_string($usuario));
        $rs = $conn->query($query);
        if ($rs){
            return true;
        }else{
            return false;
        }
    }

    /*
    * actualiza el progreso del usuario
    */
    public function retroceder($usuario): bool
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query= sprintf("UPDATE `purchases` SET `completed` = `completed` - 1 WHERE `courseID` = $this->id AND `userID` = %d", $conn->real_escape_string($usuario));
        $rs = $conn->query($query);
        if ($rs){
            return true;
        }else{
            return false;
        }
    }

    /*
     * retorna el html de la tabla de contenidos del curso para mostrar al usuario
     */
    public function getItemList(): string
    {
        $items = [];
        for ($i = 1; $i <= $this->numItems; $i++){
            $item = Item::getItem($this->id, $i);
            array_push($items, $item);
        }
        return getItemListForDisplay($items);
    }

    /*
     * retorna el item que el usuario cuyo identificador se pasa tiene como "progreso"
     */
    public function getItemIDforUser($id)
    {
        return $this->getItemIDfromOrder($this->getProgreso($id));
    }

    /*
     * retorna el ID del item cuyo orden dentro del curso se ha pasado
     */
    public function getItemIDfromOrder($order){
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $courseID = self::getID();
        $query = sprintf("SELECT `idItem` FROM `itemscursos` WHERE `orden`='%d' AND `idCurso`='%d'", $conn->real_escape_string($order), $conn->real_escape_string($this->getID()));
        $rs = $conn->query($query);
        if ($rs && $rs->num_rows == 1) {
            $registro = $rs->fetch_assoc();
            $rs->free();
            return $registro['idItem'];
        }
        $rs->free();
        return false;
    }

    public function cambiaNombre(string $nuevoNombre)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();

            $query = sprintf("UPDATE `courses` SET `courseName` = '%s' WHERE `courses`.`courseID` = '%s'", $conn->real_escape_string($nuevoNombre), $conn->real_escape_string($this->id));
            if ($conn->query($query) === TRUE) {
                $this->courseName = $nuevoNombre;
                return true;
            }

        return false;
    }

    public function cambiaPrecio(string $nuevoPrecio)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();

        $query = sprintf("UPDATE `courses` SET `price` = '%s' WHERE `courses`.`courseID` = '%s'", $conn->real_escape_string($nuevoPrecio), $conn->real_escape_string($this->id));
        if ($conn->query($query) === TRUE) {
            $this->price = $nuevoPrecio;
            return true;
        }

        return false;
    }

    public function cambiaNivel(string $nuevoNivel)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();

        $query = sprintf("UPDATE `courses` SET `level` = '%s' WHERE `courses`.`courseID` = '%s'", $conn->real_escape_string($nuevoNivel), $conn->real_escape_string($this->id));
        if ($conn->query($query) === TRUE) {
            $this->level = $nuevoNivel;
            return true;
        }

        return false;
    }

    public function cambiaDuracion(string $nuevoDuration)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();

        $query = sprintf("UPDATE `courses` SET `duration` = '%s' WHERE `courses`.`courseID` = '%s'", $conn->real_escape_string($nuevoDuration), $conn->real_escape_string($this->id));
        if ($conn->query($query) === TRUE) {
            $this->duration = $nuevoDuration;
            return true;
        }

        return false;
    }


    public function cambiaDescription(string $nuevaDescripcion)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();

        $query = sprintf("UPDATE `courses` SET `description` = '%s' WHERE `courses`.`courseID` = '%s'", $conn->real_escape_string($nuevaDescripcion), $conn->real_escape_string($this->id));
        if ($conn->query($query) === TRUE) {
            $this->description = $nuevaDescripcion;
            return true;
        }

        return false;
    }


    /*
    * elimina el curso seleccionado
    */
    public function eliminar()
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("DELETE FROM `courses` WHERE `courses`.`courseID` = '%s'", $conn->real_escape_string($this->id));
        if ($conn->query($query) === TRUE) {
            $nombreImagen=$this->id.".png";
            unlink(DIR_CURSOS_PROTEGIDOS. "/{$nombreImagen}");
            return true;
        }
        return false;
    }

    public static function mostrarCursosBusqueda($busqueda) {
         $array = [];
         $app = Aplicacion::getSingleton();
         $conn = $app->conexionBd();
         // DEBO PREPARAR LOS TEXTOS QUE VOY A BUSCAR si la cadena existe

         if ($busqueda <> '') {
             //CUENTA EL NUMERO DE PALABRAS
             $trozos = explode(" ", $busqueda);
             $numero = count($trozos);
             if ($numero > 0) {
                 $busquedaString = "%$busqueda%";
                 $curso = sprintf( "SELECT * FROM `courses` WHERE `courseName` LIKE '%s'", $conn->real_escape_string($busquedaString));
             }

             $rs = $conn->query($curso);

             while ($registro = $rs->fetch_assoc()) {
                 $course = new Curso($registro['courseID'], $registro['game'], $registro['price'], $registro['courseName'],
                     $registro['level'], $registro['duration'], $registro['description'], $registro['numItems']);
                 array_push($array, $course);
             }
             $rs->free();

             return $array;
         }


     }

     public static function mostrarCursosFiltrados($filtro){
         $array = [];
         $app = Aplicacion::getSingleton();
         $conn = $app->conexionBd();

         switch($filtro){
             case "todos":
                 $curso = "SELECT * FROM `courses`";
                break;
             case "precioAscendente":
                 $curso = "SELECT * FROM `courses` order by `price` asc";
                 break;
             case "precioDescendente":
                 $curso = "SELECT * FROM `courses` order by `price` desc";
                 break;
             case "duracionAscendente":
                 $curso = "SELECT * FROM `courses` order by `duration` asc";
                 break;
             case "duracionDescendente":
                 $curso = "SELECT * FROM `courses` order by `duration` desc";
                 break;
         }

         $rs = $conn->query($curso);

         while ($registro = $rs->fetch_assoc()) {
             $course = new Curso($registro['courseID'], $registro['game'], $registro['price'], $registro['courseName'],
                 $registro['level'], $registro['duration'], $registro['description'], $registro['numItems']);
             array_push($array, $course);
         }
         $rs->free();

         return $array;
     }
}