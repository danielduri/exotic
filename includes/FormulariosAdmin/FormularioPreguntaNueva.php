<?php

namespace es\fdi\ucm\aw\FormulariosAdmin;

use es\fdi\ucm\aw\Juego;
use es\fdi\ucm\aw\Aplicacion;
use es\fdi\ucm\aw\Form;


class FormularioJuegoNuevo extends Form
{
    public function __construct() {
        parent::__construct('formPerfil');
    }

    protected function generaCamposFormulario($datos, $errores = array())
    {

        $errorNombre = self::createMensajeError($errores, 'nombre', 'span', array('class' => 'error'));
        $errorDesc = self::createMensajeError($errores, 'description', 'span', array('class' => 'error'));
        $errorCat = self::createMensajeError($errores, 'cat', 'span', array('class' => 'error'));

        $nombreJuego = "Nombre: ";
        $descripcionJuego = "Descripción: ";
        $categoriaJuego = "Categoria: ";

        $html = <<<EOF
                
                <p>
                <input type="text" name="Nombre" placeholder="$nombreJuego"> $errorNombre
                </p>
                
                <p>
                <textarea type="textarea" name="Descripcion" placeholder="$descripcionJuego" rows="10" cols="40"></textarea>
                $errorDesc
                </p>
                
                <p>
                <input type="text" name="Categoria" placeholder="$categoriaJuego"> $errorCat
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

        $nuevoNombre = isset($datos["Nombre"]) ? $datos["Nombre"] : null;
        if(empty($nuevoNombre)){
            $result['nombre'] = "Introduce un nombre";
        }

        $description = isset($datos["Descripcion"]) ? $datos["Descripcion"] : null;
        if(empty($description)){
            $result['description'] = "Introduce una descripcion";
        }

        $cat = isset($datos["Categoria"]) ? $datos["Categoria"] : null;
        if(empty($cat)){
            $result['cat'] = "Introduce una categoria";
        }

        if(count($result) != 0){
            $bool=false;
        }else{
            $bool=Juego::nuevoJuegoenBD($nuevoNombre, $description, $cat);
            if(!$bool){
                $result["nombre"]="Ya existe un juego con ese nombre";

            }
        }

        if ($bool){
            $result='adminJuegos.php';
        }

        return $result;
    }
}