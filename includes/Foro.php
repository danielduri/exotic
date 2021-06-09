<?php

namespace es\fdi\ucm\aw;



class Foro
{
    private $id;
    private $autorId;
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
        return false;
    }


    public static function eliminar($id)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("DELETE FROM `foro` WHERE `foro`.`id` = '%s'", $conn->real_escape_string($id));
        if ($conn->query($query) === TRUE) {
            return true;
        }
        return false;
    }

}