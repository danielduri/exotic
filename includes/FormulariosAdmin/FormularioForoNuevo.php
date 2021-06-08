<?php

namespace es\fdi\ucm\aw\FormulariosAdmin;


use es\fdi\ucm\aw\Juego;
use es\fdi\ucm\aw\Usuario;
use es\fdi\ucm\aw\Foro;
use es\fdi\ucm\aw\Aplicacion;
use es\fdi\ucm\aw\Form;


class FormularioForoNuevo extends Form
{
    public function __construct() {
        parent::__construct('formPerfil');
    }

    protected function generaCamposFormulario($datos, $errores = array())
    {

        $errorTitulo = self::createMensajeError($errores, 'titulo', 'span', array('class' => 'error'));
        $errorMensaje = self::createMensajeError($errores, 'mensaje', 'span', array('class' => 'error'));

        $tituloForo = "Titulo: ";
        $mensajeForo = "Mensaje: ";

        $html = <<<EOF
                
                <p>
                <input type="text" name="Titulo" placeholder="$tituloForo"> $errorTitulo
                </p>
                
                <p>
                <textarea type="textarea" name="Mensaje" placeholder="$mensajeForo" rows="10" cols="40"></textarea>
                $errorMensaje
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
        $bool = false;

        $titulo = isset($datos["Titulo"]) ? $datos["Titulo"] : null;
        if(empty($titulo)){
            $result['titulo1'] = "Introduce un titulo";
        }else if (!filter_var($titulo, FILTER_SANITIZE_SPECIAL_CHARS)) {
            $result['titulo2'] = "El titulo no puede contener caracteres especiales.";
        }

        $mensaje = isset($datos["Mensaje"]) ? $datos["Mensaje"] : null;
        if(empty($mensaje)){
            $result['mensaje'] = "Introduce un mensaje";
        }


        if(count($result) != 0){

            $bool=false;
        }else{

            $respuestas=0;
            $nombreJuego='Call of Duty-Warzone';
            $autorId=$_SESSION["userID"];
            $identificador=0;

            //$_GET["juego"]
            $bool=Foro::nuevoForoenBD($autorId,$nombreJuego, $titulo, $mensaje, $respuestas, $identificador);
            if(!$bool){
                $result["titulo"]="Ya existe un tema con ese titulo";
            }
        }

        if ($bool){
            $result="verForos.php?juego=$nombreJuego";
        }

        return $result;
    }
}