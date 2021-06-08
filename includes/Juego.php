<?php

namespace es\fdi\ucm\aw;
require_once __DIR__.'/funcionesJuegos.php';

class Juego
{
    private $name;
    private $courses; //array que contiene los cursos correspondientes al juego
    private $description;
    private $category;
	private $foros;

    public function __construct($name, $description, $category)
    {
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
        $this->courses = [];
		$this-> foros = [];
        $this->getCoursesFromDB();
		$this->getForosFromDB();
    }

    /*
     * funcion que retorna un objeto de tipo juego dado su nombre
     */
    public static function nuevoJuegoenBD(?string $nombre, $description, $cat)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("INSERT INTO `games` (`name`, `description`, `category`) 
                VALUES ('%s', '%s', '%s')", $conn->real_escape_string($nombre),
            $conn->real_escape_string($description), $conn->real_escape_string($cat));
        if ($conn->query($query) === TRUE) {
            return true;
        }
        return false;
    }

    public static function buscarJuegoPorNombre($nombre)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM `games` WHERE `name`='%s'", $conn->real_escape_string($nombre));

        $juego = null;

        $rs = $conn->query($query);

        if ($rs && $rs->num_rows == 1) {
            $registro = $rs->fetch_assoc();
            $juego = new Juego($registro['name'], $registro['description'], $registro['category']);
        }

        $rs->free();

        return $juego;
    }

    //GETTERS

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getCourses()
    {
        return $this->courses;
    }
	public function getForos()
    {
        return $this->foros;
    }

    /*
     * funcion que entra en la base de datos para obtener todos los cursos asociados a ese juego
     * e incluirlos en el array de cursos
     */
    public function getCoursesFromDB()
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM `courses` WHERE `game`='%s'", $conn->real_escape_string($this->name));

        $rs = $conn->query($query);
        while ($registro = $rs->fetch_assoc()) {
            $curso = new Curso($registro['courseID'], $registro['game'], $registro['price'], $registro['courseName'], $registro['level'], $registro['duration'], $registro['description'], $registro['numItems']);
            array_push($this->courses, $curso);
        }
        $rs->free();
    }
	
	public function getForosFromDB()
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM `foro` WHERE `nombreJuego`='%s' ORDER BY fecha ASC", $conn->real_escape_string($this->name));
        $rs = $conn->query($query);
        while ($registro = $rs->fetch_assoc()) {
            $foro = new Foro($registro['id'], $registro['autorId'], $registro['nombreJuego'], $registro['titulo'], $registro['mensaje'], $registro['fecha'], $registro['respuestas'], $registro['identificador']);
            array_push($this->foros, $foro);
        }
        $rs->free();
    }

    /*
     * funcion que devuelve un array con todos los juegos de la base de datos.
     */
    public static function obtenerTodosLosJuegos(){
        $array = [];
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = "SELECT * FROM `games`";

        $rs = $conn->query($query);

        while ($registro = $rs->fetch_assoc()) {
            $juego = new Juego($registro['name'], $registro['description'], $registro['category']);
            array_push($array, $juego);
        }
        $rs->free();
        return $array;
    }

    public function cambiaNombre(string $nuevoNombre)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        if(self::buscarJuegoPorNombre($nuevoNombre)==null){
            $query = sprintf("UPDATE `games` SET `name` = '%s' WHERE `games`.`name` = '%s'", $conn->real_escape_string($nuevoNombre), $conn->real_escape_string($this->name));
            if ($conn->query($query) === TRUE) {
                $this->name = $nuevoNombre;
                return true;
            }
        }
        return false;
    }

    public function cambiaDescription(string $description)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("UPDATE `games` SET `description` = '%s' WHERE `games`.`name` = '%s'", $conn->real_escape_string($description), $conn->real_escape_string($this->name));
        if ($conn->query($query) === TRUE) {
            $this->description = $description;
            return true;
        }
        return false;
    }

    public function cambiaCat(string $cat)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("UPDATE `games` SET `category` = '%s' WHERE `games`.`name` = '%s'", $conn->real_escape_string($cat), $conn->real_escape_string($this->name));
        if ($conn->query($query) === TRUE) {
            $this->category= $cat;
            return true;
        }
        return false;
    }

    public function eliminar()
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("DELETE FROM `games` WHERE `games`.`name` = '%s'", $conn->real_escape_string($this->name));
        if ($conn->query($query) === TRUE) {
            return true;
        }
        return false;
    }

    public static function mostrarJuegosBusqueda($busqueda) {
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
                $juego = sprintf( "SELECT * FROM `games` WHERE `name` LIKE '%s'", $conn->real_escape_string($busquedaString));
            }

            $rs = $conn->query($juego);

            while ($registro = $rs->fetch_assoc()) {
                $game = new Juego($registro['name'], $registro['description'], $registro['category']);
                array_push($array, $game);
            }
            $rs->free();

            return $array;
        }


    }



}