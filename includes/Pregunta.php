<?php


namespace es\fdi\ucm\aw;


class Pregunta
{
    private $pregunta;
    private $respuestaCorrecta;
    private $respuesta1;
    private $respuesta2;
    private $respuesta3;
    private $idPregunta;

    /**
     * Pregunta constructor.
     * @param $pregunta
     * @param $respuestaCorrecta
     * @param $respuesta1
     * @param $respuesta2
     * @param $respuesta3
     * @param $idPregunta
     */
    public function __construct($pregunta, $respuestaCorrecta, $respuesta1, $respuesta2, $respuesta3, $idPregunta)
    {
        $this->pregunta = $pregunta;
        $this->respuestaCorrecta = $respuestaCorrecta;
        $this->idPregunta = $idPregunta;
        $this->respuesta1=$respuesta1;
        $this->respuesta2=$respuesta2;
        $this->respuesta3=$respuesta3;
        /*
        $this->respuestas=[];
        array_push($this->respuestas, $respuestaCorrecta);
        array_push($this->respuestas, $respuesta1);
        array_push($this->respuestas, $respuesta2);
        array_push($this->respuestas, $respuesta3);
        shuffle($this->respuestas);*/
    }

    /*
     * comprueba si la respuesta pasada por parámetro es la respuesta correcta
     */
    public function comprobarRespuesta($respuesta): bool
    {
        if($respuesta==$this->respuestaCorrecta){
            return true;
        }else{
            return false;
        }
    }

    //GETTERS


    /**
     * @return mixed
     */
    public function getIDPregunta()
    {
        return $this->idPregunta;
    }

    /**
     * @return mixed
     */
    public function getPregunta()
    {
        return $this->pregunta;
    }

    /**
     * @return mixed
     */
    public function getRespuestaCorrecta()
    {
        return $this->respuestaCorrecta;
    }

    /**
     * @return array
     */
    public function getRespuesta1()
    {
        return $this->respuesta1;
    }

    public function getRespuesta2()
    {
        return $this->respuesta2;
    }

    public function getRespuesta3()
    {
        return $this->respuesta3;
    }

    public function cambiaPregunta(string $nuevaPregunta)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();

        $query = sprintf("UPDATE `preguntastest` SET `pregunta` = '%s' WHERE `preguntastest`.`idPregunta` = '%s'", $conn->real_escape_string($nuevaPregunta), $conn->real_escape_string($this->idPregunta));
        if ($conn->query($query) === TRUE) {
            $this->pregunta = $nuevaPregunta;
            return true;
        }

        return false;
    }

    public function cambiaRespuestaCorrecta(string $nuevaRespuestaCorrecta)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();

        $query = sprintf("UPDATE `preguntastest` SET `respuestaCorrecta` = '%s' WHERE `preguntastest`.`idPregunta` = '%s'", $conn->real_escape_string($nuevaRespuestaCorrecta), $conn->real_escape_string($this->idPregunta));
        if ($conn->query($query) === TRUE) {
            $this->respuestaCorrecta = $nuevaRespuestaCorrecta;
            return true;
        }

        return false;
    }

    public function cambiaRespuesta1(string $nuevaRespuesta1)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();

        $query = sprintf("UPDATE `preguntastest` SET `respuestaIncorrecta1` = '%s' WHERE `preguntastest`.`idPregunta` = '%s'", $conn->real_escape_string($nuevaRespuesta1), $conn->real_escape_string($this->idPregunta));

        if ($conn->query($query) === TRUE) {
            $this->respuesta1 = $nuevaRespuesta1;
            return true;
        }

        return false;
    }

    public function cambiaRespuesta2(string $nuevaRespuesta2)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();

        $query = sprintf("UPDATE `preguntastest` SET `respuestaIncorrecta2` = '%s' WHERE `preguntastest`.`idPregunta` = '%s'", $conn->real_escape_string($nuevaRespuesta2), $conn->real_escape_string($this->idPregunta));
        if ($conn->query($query) === TRUE) {
            $this->respuesta2 = $nuevaRespuesta2;
            return true;
        }

        return false;
    }

    public function cambiaRespuesta3(string $nuevaRespuesta3)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();

        $query = sprintf("UPDATE `preguntastest` SET `respuestaIncorrecta3` = '%s' WHERE `preguntastest`.`idPregunta` = '%s'", $conn->real_escape_string($nuevaRespuesta3), $conn->real_escape_string($this->idPregunta));
        if ($conn->query($query) === TRUE) {
            $this->respuesta3 = $nuevaRespuesta3;
            return true;
        }

        return false;
    }

    public function eliminar()
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("DELETE FROM `preguntastest` WHERE `preguntastest`.`idPregunta` = '%s'", $conn->real_escape_string($this->idPregunta));
        if ($conn->query($query) === TRUE) {
            return true;
        }
        return false;
    }

    public static function nuevaPreguntaenBD(?string $idTest, $pregunta, $rC, $r1, $r2, $r3)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("INSERT INTO `preguntastest` (`idTest`, `pregunta`, `respuestaCorrecta`, `respuestaIncorrecta1`, `respuestaIncorrecta2`, `respuestaIncorrecta3`) 
                VALUES ('%s', '%s', '%s', '%s', '%s', '%s')", $conn->real_escape_string($idTest),
            $conn->real_escape_string($pregunta), $conn->real_escape_string($rC), $conn->real_escape_string($r1), $conn->real_escape_string($r2), $conn->real_escape_string($r3));
        if ($conn->query($query) === TRUE) {
            return true;
        }
        return false;
    }

    public static function obtenerPreguntaporID($idPregunta)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM `preguntastest` WHERE `idPregunta`=%s", $conn->real_escape_string($idPregunta));
        $item = null;
        $rs = $conn->query($query);

        if ($rs && $rs->num_rows == 1) {
            $registro = $rs->fetch_assoc();
            $pregunta = new Pregunta($registro['pregunta'], $registro['respuestaCorrecta'], $registro['respuestaIncorrecta1'], $registro['respuestaIncorrecta2'], $registro['respuestaIncorrecta3'], $registro['idPregunta']);
        }

        $rs->free();

        return $pregunta;
    }


}