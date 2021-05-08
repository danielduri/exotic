<?php

namespace es\fdi\ucm\aw;
¡

class Test extends \es\fdi\ucm\aw\Form
{
    private $testID;
    private $pregunta;
    private $respuestaCorrecta;
    private $respuestas;

    /**
     * Test constructor.
     * @param $testID
     * @param $pregunta
     * @param $respuestaCorrecta
     * @param $respuestas
     */
    public function __construct($testID, $pregunta, $respuestaCorrecta, $respuestas)
    {
        $this->testID = $testID;
        $this->pregunta = $pregunta;
        $this->respuestaCorrecta = $respuestaCorrecta;
        $this->respuestas = $respuestas;
    }


    public static function getTestFromID($testID){
        $conn = getConexionBD();
        $query = sprintf("SELECT * FROM `test` WHERE `idTest`='%d'", $conn->real_escape_string($testID));

        $test = null;

        $rs = $conn->query($query);

        if ($rs && $rs->num_rows == 1) {
            $registro = $rs->fetch_assoc();
            $test = new Test($registro['idTest'], $registro['pregunta'], $registro['orden'], $registro['html'], $registro['esTest'], $registro['numTest']);
        }

        $rs->free();

        return $test;
    }
}