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

    protected function generaCamposFormulario($datosIniciales, $errores = array())
    {
        $html="<h1>Test</h1><ol>";
        $count=0;
        foreach ($this->preguntas as $pregunta){
            $respuestas = $pregunta->getRespuestas();
            $html.=<<<EOF
            <li>
                    <h3>$pregunta->getPregunta()</h3>
                    
                    <div>
                        <input type="radio" name="question-$count-answers" id="question-$count-answers-A" value="$respuestas[0]" />
                        <label for="question-$count-answers-A">A) $respuestas[0] </label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-$count-answers" id="question-$count-answers-B" value="$respuestas[1]" />
                        <label for="question-$count-answers-B">B) $respuestas[1]</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-$count-answers" id="question-$count-answers-C" value="$respuestas[2]" />
                        <label for="question-$count-answers-C">C) $respuestas[2]</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-$count-answers" id="question-$count-answers-D" value="$respuestas[3]" />
                        <label for="question-$count-answers-D">D) $respuestas[3]</label>
                    </div>
                
                </li>
            
            
            EOF;
            $count++;
        }
        $html.="</ol>";
        $html.='<input type="submit" value="Submit" class="submitbtn" />';
        return $html;
    }

    protected function procesaFormulario($datos)
    {
        $count = 0;
        $score = 0;
        $respuestas = [];
        $incorrecta = [];
        foreach ($this->preguntas as $pregunta){
            $respuestas[$count] = $_POST["question-$count-answers"];
            if($pregunta->comprobarRespuesta($respuestas[$count])){
                $score++;
            }else{
                $incorrecta[$count]=true;
            }
            $count++;
        }

        $html = "<h1>$score/$count</h1>";
        return $html;
    }
}