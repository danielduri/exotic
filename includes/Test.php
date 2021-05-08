<?php

namespace es\fdi\ucm\aw;

class Test extends \es\fdi\ucm\aw\Form
{
    private $testID;
    private $preguntas;

    /**
     * Test constructor.
     * @param $testID
     * @param $preguntas
     */
    public function __construct($testID, $preguntas)
    {
        $this->testID = $testID;
        $this->preguntas = $preguntas;
        parent::__construct("test");
    }


    public static function getTestFromID($testID){
        $conn = getConexionBD();
        $query = sprintf("SELECT * FROM `preguntastest` WHERE `idPregunta`='%d'", $conn->real_escape_string($testID));

        $test = null;

        $rs = $conn->query($query);

        if ($rs && $rs->num_rows >= 1) {
            while ($registro = $rs->fetch_assoc()) {
                $pregunta = new Pregunta($registro['pregunta'], $registro['respuestaCorrecta'], $registro['respuestaIncorrecta1'], $registro['respuestaIncorrecta2'], $registro['respuestaIncorrecta3']);
                array_push($preguntas, $pregunta);
            }
            $test = new Test($testID, $preguntas);
        }

        $rs->free();

        return $test;
    }
}