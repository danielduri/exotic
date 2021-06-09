<?php

namespace es\fdi\ucm\aw\FormulariosAdmin;

use es\fdi\ucm\aw\Form;
use es\fdi\ucm\aw\Pregunta;


class FormularioPreguntaNueva extends Form
{
    public function __construct() {
        parent::__construct('formPerfil');
    }

    protected function generaCamposFormulario($datos, $errores = array())
    {

        $errorPregunta = self::createMensajeError($errores, 'pregunta', 'span', array('class' => 'error'));
        $errorRespuestas = self::createMensajeError($errores, 'respuesta', 'span', array('class' => 'error'));

        $pregunta = "Pregunta: ";
        $rC = "Respuesta correcta: ";
        $r1 = "Respuesta incorrecta 1: ";
        $r2 = "Respuesta incorrecta 2: ";
        $r3 = "Respuesta incorrecta 3: ";

        $html = <<<EOF
                
                <p>
                <input type="text" name="Pregunta" placeholder="$pregunta" required> $errorPregunta
                </p>
                
                <p>
                <input type="text" name="rC" placeholder="$rC" required> 
                </p>
                
                <p>
                <input type="text" name="r1" placeholder="$r1" required> 
                </p>
                
                <p>
                <input type="text" name="r2" placeholder="$r2" required> 
                </p>
                
                <p>
                <input type="text" name="r3" placeholder="$r3" required>
                </p>
                    
                $errorRespuestas
                    
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
        $bool = false;

        $p = isset($datos["Pregunta"]) ? htmlspecialchars(trim(strip_tags($datos['Pregunta']))) : null;
        if(empty($p)){
            $result['nombre'] = "Introduce una pregunta";
        }

        $rC = isset($datos["rC"]) ? htmlspecialchars(trim(strip_tags($datos['rC']))) : null;
        if(empty($rC)){
            $result['respuesta'] = "Rellena todas las opciones de respuesta";
        }

        $r1 = isset($datos["r1"]) ? htmlspecialchars(trim(strip_tags($datos['r1']))) : null;
        if(empty($r1)){
            $result['respuesta'] = "Rellena todas las opciones de respuesta";
        }

        $r2 = isset($datos["r2"]) ? htmlspecialchars(trim(strip_tags($datos['r2']))) : null;
        if(empty($r2)){
            $result['respuesta'] = "Rellena todas las opciones de respuesta";
        }

        $r3 = isset($datos["r3"]) ? htmlspecialchars(trim(strip_tags($datos['r3']))) : null;
        if(empty($r3)){
            $result['respuesta'] = "Rellena todas las opciones de respuesta";
        }

        if(count($result) != 0){
            $bool=false;
        }else{
            $bool=Pregunta::nuevaPreguntaenBD($_GET["id"], $p, $rC, $r1, $r2, $r3);
        }

        if ($bool){
            $result='adminPreguntas.php?id=';
            $result.=$_GET["id"];
        }

        return $result;
    }
}