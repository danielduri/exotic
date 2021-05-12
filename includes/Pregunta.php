<?php


namespace es\fdi\ucm\aw;


class Pregunta
{
    private $pregunta;
    private $respuestaCorrecta;
    private $respuestas;

    /**
     * Pregunta constructor.
     * @param $pregunta
     * @param $respuestaCorrecta
     * @param $respuesta1
     * @param $respuesta2
     * @param $respuesta3
     */
    public function __construct($pregunta, $respuestaCorrecta, $respuesta1, $respuesta2, $respuesta3)
    {
        $this->pregunta = $pregunta;
        $this->respuestaCorrecta = $respuestaCorrecta;
        $this->respuestas=[];
        array_push($this->respuestas, $respuestaCorrecta);
        array_push($this->respuestas, $respuesta1);
        array_push($this->respuestas, $respuesta2);
        array_push($this->respuestas, $respuesta3);
        shuffle($this->respuestas);
    }

    public function comprobarRespuesta($respuesta){
        if($respuesta==$this->respuestaCorrecta){
            return true;
        }else{
            return false;
        }
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
    public function getRespuestas()
    {
        return $this->respuestas;
    }



}