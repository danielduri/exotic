<?php

namespace es\fdi\ucm\aw;
require_once __DIR__.'/funcionesJuegos.php';

class Juego
{
    private $name;
    private $courses; //array que contiene los cursos correspondientes al juego
    private $description;
    private $category;

    public function __construct($name, $description, $category)
    {
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
        $this->courses = [];

        $this->getCoursesFromDB();

    }

    /*
     * funcion que retorna un objeto de tipo juego dado su nombre
     */
    public static function buscarJuegoPorNombre($nombre): Juego
    {
        $conn = getConexionBD();
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

    /*
     * funcion que entra en la base de datos para obtener todos los cursos asociados a ese juego
     * e incluirlos en el array de cursos
     */
    public function getCoursesFromDB()
    {
        $conn = getConexionBD();
        $query = sprintf("SELECT * FROM `courses` WHERE `game`='%s'", $conn->real_escape_string($this->name));

        $rs = $conn->query($query);
        while ($registro = $rs->fetch_assoc()) {
            $curso = new Curso($registro['courseID'], $registro['game'], $registro['price'], $registro['courseName'], $registro['level'], $registro['duration'], $registro['description'], $registro['numItems']);
            array_push($this->courses, $curso);
        }
        $rs->free();
    }

    /*
     * funcion que devuelve un array con todos los juegos de la base de datos.
     */
    public static function obtenerTodosLosJuegos(){
        $array = [];
        $conn = getConexionBD();
        $query = "SELECT * FROM `games`";

        $rs = $conn->query($query);

        while ($registro = $rs->fetch_assoc()) {
            $juego = new Juego($registro['name'], $registro['description'], $registro['category']);
            array_push($array, $juego);
        }
        $rs->free();
        return $array;
    }

}