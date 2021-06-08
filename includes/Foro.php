<?php

namespace es\fdi\ucm\aw;
require_once __DIR__.'/foroVista.php';


class Foro
{
    private $id;
    private $autorId; //array que contiene los cursos correspondientes al juego
    private $nombreJuego;
    private $titulo;
	private $mensaje;
    private $fecha;
    private $respuestas;
    private $identificador;


    public function __construct($id, $autorId, $nombreJuego, $titulo, $mensaje, $fecha, $respuestas, $identificador)
    {
        $this->id = $id;
        $this->autorId = $autorId;
        $this->nombreJuego = $nombreJuego;
        $this->titulo = $titulo;
        $this->mensaje = $mensaje;
        $this->fecha = $fecha;
        $this->respuestas = $respuestas;
        $this->identificador = $identificador;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getAutorId()
    {
        return $this->autorId;
    }

    public function getAutor()
    {
        return Usuario::buscaNombrePorId($this->autorId);
    }

    /**
     * @param mixed $autorId
     */
    public function setAutorId($autorId): void
    {
        $this->autorId = $autorId;
    }

    /**
     * @return mixed
     */
    public function getNombreJuego()
    {
        return $this->nombreJuego;
    }

    /**
     * @param mixed $nombreJuego
     */
    public function setNombreJuego($nombreJuego): void
    {
        $this->nombreJuego = $nombreJuego;
    }

    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo): void
    {
        $this->titulo = $titulo;
    }

    /**
     * @return mixed
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * @param mixed $mensaje
     */
    public function setMensaje($mensaje): void
    {
        $this->mensaje = $mensaje;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * @return mixed
     */
    public function getRespuestas()
    {
        return $this->respuestas;
    }

    /**
     * @param mixed $respuestas
     */
    public function setRespuestas($respuestas): void
    {
        $this->respuestas = $respuestas;
    }

    /**
     * @return mixed
     */
    public function getIdentificador()
    {
        return $this->identificador;
    }

    /**
     * @param mixed $identificador
     */
    public function setIdentificador($identificador): void
    {
        $this->identificador = $identificador;
    }

        //$this->getForosFromDB();


    public static function nuevoForoenBD($autorId, $nombreJuego, $titulo, $mensaje, $respuestas,  $identificador)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("INSERT INTO `foro` (`autorId`, `nombreJuego`,`titulo`,`mensaje`,`respuestas`,`identificador`) 
                VALUES ('%s', '%s', '%s', '%s', '%s', '%s')",
            $conn->real_escape_string($autorId), $conn->real_escape_string($nombreJuego), $conn->real_escape_string($titulo), $conn->real_escape_string($mensaje), $conn->real_escape_string($respuestas), $conn->real_escape_string($identificador));
       // echo $query;
        if ($conn->query($query) === TRUE) {
            //echo "biennn";
            return true;
        }
        //echo "malllllll";
        return false;
    }


    /*
     * funcion que entra en la base de datos para obtener todos los cursos asociados a ese juego
     * e incluirlos en el array de cursos
     */

	
	    public function getForosFromDB()
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM `courses` WHERE `game`='%s'", $conn->real_escape_string($this->name));

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

}