<?php

namespace es\fdi\ucm\aw;

class Test extends \es\fdi\ucm\aw\Form
{
    private $itemID;
    private $preguntas;
    private $respuestas;
    private $puntuacion;

    /**
     * Test constructor.
     * @param $itemID
     * @param $preguntas
     */
    public function __construct($itemID, $preguntas)
    {
        $this->itemID = $itemID;
        $this->preguntas = $preguntas;
        parent::__construct("test");
    }

    public static function getTestFromID($itemID, $testID){
        $conn = getConexionBD();
        $query = sprintf("SELECT * FROM `preguntastest` WHERE `idTest`='%d'", $conn->real_escape_string($testID));

        $test = null;
        $preguntas=[];

        $rs = $conn->query($query);

        if ($rs && $rs->num_rows >= 1) {
            while ($registro = $rs->fetch_assoc()) {
                $pregunta = new Pregunta($registro['pregunta'], $registro['respuestaCorrecta'], $registro['respuestaIncorrecta1'], $registro['respuestaIncorrecta2'], $registro['respuestaIncorrecta3']);
                array_push($preguntas, $pregunta);
            }
            $test = new Test($itemID, $preguntas);
        }

        $rs->free();

        return $test;
    }

    protected function generaCamposFormulario($datosIniciales, $errores = array())
    {
        $html = "<p>";
        $count = 0;

        if ($this->respuestas != null) {
            $numQuestions= count($this->preguntas);
            $html .= "<h2 class='score'>Puntuación: $this->puntuacion/$numQuestions</h2>";

            foreach ($this->preguntas as $pregunta) {

                $classTestA = "testQ";
                $classTestB = "testQ";
                $classTestC = "testQ";
                $classTestD = "testQ";

                $respuestas = $pregunta->getRespuestas();
                $tituloPregunta = $pregunta->getPregunta();
                $checkedA = "";
                $checkedB = "";
                $checkedC = "";
                $checkedD = "";

                switch ($this->respuestas[$count]) {
                    case $respuestas[0]:
                        $checkedA = "checked";
                        $classTestA = "testWrong";
                        break;
                    case $respuestas[1]:
                        $checkedB = "checked";
                        $classTestB = "testWrong";
                        break;
                    case $respuestas[2]:
                        $checkedC = "checked";
                        $classTestC = "testWrong";
                        break;
                    case $respuestas[3]:
                        $checkedD = "checked";
                        $classTestD = "testWrong";
                        break;
                }

                switch ($this->preguntas[$count]->getRespuestaCorrecta()) {
                    case $respuestas[0]:
                        $classTestA = "testCorrect";
                        break;
                    case $respuestas[1]:
                        $classTestB = "testCorrect";
                        break;
                    case $respuestas[2]:
                        $classTestC = "testCorrect";
                        break;
                    case $respuestas[3]:
                        $classTestD = "testCorrect";
                        break;
                }

                $html .= <<<EOF
                    <h3>$tituloPregunta</h3>
                    
                    <div class ="$classTestA">
                        <input type="radio" name="question-$count-answers" id="question-$count-answers-A" value="$respuestas[0]" $checkedA disabled/>
                        <label for="question-$count-answers-A">A) $respuestas[0] </label>
                    </div>
                    
                    <div class ="$classTestB">
                        <input type="radio" name="question-$count-answers" id="question-$count-answers-B" value="$respuestas[1]" $checkedB disabled/>
                        <label for="question-$count-answers-B">B) $respuestas[1]</label>
                    </div>
                    
                    <div class ="$classTestC">
                        <input type="radio" name="question-$count-answers" id="question-$count-answers-C" value="$respuestas[2]" $checkedC disabled/>
                        <label for="question-$count-answers-C">C) $respuestas[2]</label>
                    </div>
                    
                    <div class ="$classTestD">
                        <input type="radio" name="question-$count-answers" id="question-$count-answers-D" value="$respuestas[3]" $checkedD disabled/>
                        <label for="question-$count-answers-D">D) $respuestas[3]</label>
                    </div>
                
                </p>
            
            EOF;
                $count++;
            }
        }else{
            $classTestA = "testQ";
            $classTestB = "testQ";
            $classTestC = "testQ";
            $classTestD = "testQ";
                foreach ($this->preguntas as $pregunta) {
                    $respuestas = $pregunta->getRespuestas();
                    $tituloPregunta = $pregunta->getPregunta();
                    $html .= <<<EOF
                    <h3>$tituloPregunta</h3>
                    
                    <div class ="$classTestA">
                        <input type="radio" name="question-$count-answers" id="question-$count-answers-A" value="$respuestas[0]"/>
                        <label for="question-$count-answers-A">A) $respuestas[0] </label>
                    </div>
                    
                    <div class ="$classTestB">
                        <input type="radio" name="question-$count-answers" id="question-$count-answers-B" value="$respuestas[1]" />
                        <label for="question-$count-answers-B">B) $respuestas[1]</label>
                    </div>
                    
                    <div class ="$classTestC">
                        <input type="radio" name="question-$count-answers" id="question-$count-answers-C" value="$respuestas[2]" />
                        <label for="question-$count-answers-C"">C) $respuestas[2]</label>
                    </div>
                    
                    <div class ="$classTestD">
                        <input type="radio" name="question-$count-answers" id="question-$count-answers-D" value="$respuestas[3]" />
                        <label for="question-$count-answers-D">D) $respuestas[3]</label>
                    </div>    
            
            EOF;
                    $count++;
                }
                $html .= "</ol>";
                $html .= '<button type="submit" name= "id" value="';
                $html .=$this->itemID;
                $html .='" class="submitbtn"/>Enviar</button></p>';
        }

        return $html;
    }

    protected function procesaFormulario($datos)
    {
        $count = 0;
        $score = 0;
        $respuestas = array();
        foreach ($this->preguntas as $pregunta){
            $respuestas[$count] = $_POST["question-$count-answers"];
            if($pregunta->comprobarRespuesta($respuestas[$count])){
                $score++;
            }
            $count++;
        }

        $this->respuestas=$respuestas;
        $this->puntuacion=$score;

        return $respuestas;
    }
}