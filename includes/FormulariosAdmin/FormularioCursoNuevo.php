<?php

namespace es\fdi\ucm\aw\FormulariosAdmin;

use es\fdi\ucm\aw\Curso;
use es\fdi\ucm\aw\Juego;
use es\fdi\ucm\aw\Aplicacion;
use es\fdi\ucm\aw\Form;

class FormularioCursoNuevo extends Form
{
    public function __construct() {
        parent::__construct('formPerfil');
    }

    protected function generaCamposFormulario($datos, $errores = array())
    {
        $errorNombre="";
        if ($errores!=null){
            $errorNombre = $errores["nombre"];
        }

        $errorNombre = self::createMensajeError($errores, 'nombre', 'span', array('class' => 'error'));
        $errorDesc = self::createMensajeError($errores, 'description', 'span', array('class' => 'error'));
        $errorPrecio = self::createMensajeError($errores, 'cat', 'span', array('class' => 'error'));
        $errorNivel = self::createMensajeError($errores, 'nombre', 'span', array('class' => 'error'));
        $errorDuracion = self::createMensajeError($errores, 'description', 'span', array('class' => 'error'));
        $errorCat = self::createMensajeError($errores, 'cat', 'span', array('class' => 'error'));

        $nombreCurso = "Nombre: ";
        $precioCurso = "Precio: ";
        $nivelCurso = "Nivel: ";
        $duracionCurso = "Duración: ";
        $descripcionCurso = "Descripción: ";

        $html = <<<EOF
                
                <p>
                <input type="text" name="Nombre" placeholder="$nombreCurso"> $errorNombre
                </p>
                
                <p>
                <input type="number" step="0.01" min="0" name="Precio" placeholder="$precioCurso"> $errorPrecio
                </p>
                
                <p>
                <input type="number" name="Nivel" placeholder="$nivelCurso"> $errorNivel
                </p>
                
                <p>
                <input type="time" name="Duracion" value="$duracionCurso"> $errorDuracion
                </p>
                
                <p>
                <textarea type="textarea" name="Descripcion" placeholder="$descripcionCurso" rows="10" cols="40"></textarea> $errorDesc
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

        $juego = Juego::buscarJuegoPorNombre($_GET["juego"]);

        $nuevoNombre = isset($datos["Nombre"]) ? $datos["Nombre"] : null;
        if($nuevoNombre!=null){
            if (!filter_var($nuevoNombre, FILTER_SANITIZE_SPECIAL_CHARS)) {
                $result['nombre'] = "El nombre no puede contener caracteres especiales.";
            }else{
                $bool = $juego->cambiaNombre($nuevoNombre);
            }
        }

        $description = isset($datos["Descripcion"]) ? $datos["Descripcion"] : null;
        if($description!=null){
            $bool = $juego->cambiaDescription($description);
        }

        $cat = isset($datos["Categoria"]) ? $datos["Categoria"] : null;
        if($cat!=null){
            $bool = $juego->cambiaCat($cat);
        }

        if(count($result) != 0){
            $bool=false;
        }

        if ($bool){
            $result='adminJuegos.php';
        }

        return $result;
    }
}