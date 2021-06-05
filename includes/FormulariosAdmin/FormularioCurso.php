<?php

namespace es\fdi\ucm\aw\FormulariosAdmin;

use es\fdi\ucm\aw\Curso;
use es\fdi\ucm\aw\Juego;
use es\fdi\ucm\aw\Aplicacion;
use es\fdi\ucm\aw\Form;

class FormularioCurso extends Form
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

        $curso = Curso::buscarCursoPorID($_GET["id"]);
        $nombre = $curso->getCourseName();
        $precio = $curso->getPrice();
        $nivel = $curso->getLevel();
        $duracion = $curso->getDuration();
        $descripcion = $curso->getDescription();
        $juego = $curso->getGame();

        $nombreCurso = "Nombre: ";
        $nombreCurso .= $nombre;
        $precioCurso = "Precio: ";
        $precioCurso .= $precio;
        $nivelCurso = "Nivel: ";
        $nivelCurso .= $nivel;
        $duracionCurso = "Duración: ";
        $duracionCurso .= $duracion;
        $descripcionCurso = "Descripción: ";
        $descripcionCurso .= $descripcion;
        $juegoCurso = "Juego: ";
        $juegoCurso .= $juego;

        $juegos = Juego::obtenerTodosLosJuegos();
        $juegosForm = obtenerJuegosParaFormulario($juegos);

        $html = <<<EOF
                
                <p>
                <input type="text" name="Nombre" placeholder="$nombreCurso"> $errorNombre
                </p>
                
                <p>
                <input type="number" step="0.01" min="0" name="Precio" placeholder="$precioCurso">
                </p>
                
                <p>
                <input type="number" name="Nivel" placeholder="$nivelCurso">
                </p>
                
                <p>
                <input type="time" name="Duracion" value="$duracion">
                </p>
                
                <p>
                <textarea type="textarea" name="Descripcion" placeholder="$descripcionCurso" rows="10" cols="40"></textarea>
                </p>
                
                <p>
                <label>Juego:</label>
                <select name="Juego">
                    $juegosForm;		
                </select>
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

        $nivel = isset($datos["Nivel"]) ? $datos["Nivel"] : null;
        if($nivel!=null){
            $bool = $curso->cambiaNivel($nivel);
        }

        $duracion = isset($datos["Duracion"]) ? $datos["Duracion"] : null;
        if($duracion!=null){
            $bool = $curso->cambiaDuracion($duracion);
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