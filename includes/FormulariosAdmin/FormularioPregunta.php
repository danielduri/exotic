<?php

namespace es\fdi\ucm\aw\FormulariosAdmin;

use es\fdi\ucm\aw\Form;
use es\fdi\ucm\aw\Pregunta;


class FormularioPregunta extends Form
{
    public function __construct() {
        parent::__construct('formPerfil');
    }

    protected function generaCamposFormulario($datos, $errores = array())
    {

        $item=Pregunta::obtenerPreguntaporID($_GET["id"]);

        $pregunta = "Pregunta: ";
        $pregunta .= $item->getPregunta();
        $rC = "Respuesta correcta: ";
        $rC .= $item->getRespuestaCorrecta();
        $r1 = "Respuesta incorrecta 1: ";
        $r1 .= $item->getRespuesta1();
        $r2 = "Respuesta incorrecta 2: ";
        $r2 .= $item->getRespuesta2();
        $r3 = "Respuesta incorrecta 3: ";
        $r3 .= $item->getRespuesta3();

        $html = <<<EOF
                
                <p>
                <input type="text" name="Pregunta" placeholder="$pregunta">
                </p>
                
                <p>
                <input type="text" name="rC" placeholder="$rC"> 
                </p>
                
                <p>
                <input type="text" name="r1" placeholder="$r1"> 
                </p>
                
                <p>
                <input type="text" name="r2" placeholder="$r2"> 
                </p>
                
                <p>
                <input type="text" name="r3" placeholder="$r3">
                </p>
                     
                <p>
                <input type="submit" name="enviar" value= "Enviar" />
                <input type="reset" name="borrar" value="Borrar" />		
                </p>
            EOF;
        return $html;
    }


    protected function procesaFormulario($datos)
    {
        $result = array();
        $bool = true;

        $item = Pregunta::obtenerPreguntaporID($_GET["id"]);

        $p = isset($datos["Pregunta"]) ? htmlspecialchars(trim(strip_tags($datos['Pregunta']))) : null;
        if(!empty($p)){
            $bool = $item->cambiaPregunta($p);
        }

        $rC = isset($datos["rC"]) ? htmlspecialchars(trim(strip_tags($datos['rC']))) : null;
        if(!empty($rC)){
            $bool = $item->cambiaRespuestaCorrecta($rC);
        }

        $r1 = isset($datos["r1"]) ? htmlspecialchars(trim(strip_tags($datos['r1']))) : null;
        if(!empty($r1)){
            $bool = $item->cambiaRespuesta1($r1);
        }

        $r2 = isset($datos["r2"]) ? htmlspecialchars(trim(strip_tags($datos['r2']))) : null;
        if(!empty($r2)){
            $bool = $item->cambiaRespuesta2($r2);
        }

        $r3 = isset($datos["r3"]) ? htmlspecialchars(trim(strip_tags($datos['r3']))) : null;
        if(!empty($r3)){
            $bool = $item->cambiaRespuesta3($r3);
        }

        if ($bool){
            $result='adminPreguntas.php?id=';
            $result.=$_GET["idTest"];
        }

        return $result;
    }
}