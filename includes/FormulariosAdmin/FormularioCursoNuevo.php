<?php

namespace es\fdi\ucm\aw\FormulariosAdmin;

use es\fdi\ucm\aw\Curso;

use es\fdi\ucm\aw\Form;

class FormularioCursoNuevo extends Form
{
    public function __construct() {
        parent::__construct('formPerfil');
    }

    protected function generaCamposFormulario($datos, $errores = array())
    {


        $errorNombre1 = self::createMensajeError($errores, 'nombre1', 'span', array('class' => 'error'));
        $errorNombre2 = self::createMensajeError($errores, 'nombre2', 'span', array('class' => 'error'));
        $errorDesc = self::createMensajeError($errores, 'description', 'span', array('class' => 'error'));
        $errorPrecio = self::createMensajeError($errores, 'precio', 'span', array('class' => 'error'));
        $errorNivel = self::createMensajeError($errores, 'nivel', 'span', array('class' => 'error'));
        $errorDuracion = self::createMensajeError($errores, 'duracion', 'span', array('class' => 'error'));

        $nombreCurso = "Nombre: ";
        $precioCurso = "Precio: ";
        $nivelCurso = "Nivel: ";
        $duracionCurso = "Duración: ";
        $descripcionCurso = "Descripción: ";

        $html = <<<EOF
                
                <p>
                <input type="text" name="Nombre" placeholder="$nombreCurso"> $errorNombre1 $errorNombre2
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

        $nombre = isset($datos["Nombre"]) ? htmlspecialchars(trim(strip_tags($datos['Nombre']))) : null;
        if(empty($nombre)){
            $result['nombre1'] = "Introduce un nombre";
        }else if (!filter_var($nombre, FILTER_SANITIZE_SPECIAL_CHARS)) {
                $result['nombre2'] = "El nombre no puede contener caracteres especiales.";
        }

        $description = isset($datos["Descripcion"]) ? htmlspecialchars(trim(strip_tags($datos['Descripcion']))) : null;
        if(empty($description)){
            $result['description'] = "Introduce una descripcion";
        }

        $precio = isset($datos["Precio"]) ? htmlspecialchars(trim(strip_tags($datos['Precio']))) : null;
        if(empty($precio)){
            $result['precio'] = "Introduce un precio";
        }

        $nivel = isset($datos["Nivel"]) ? htmlspecialchars(trim(strip_tags($datos['Nivel']))) : null;
        if(empty($nivel)){
            $result['nivel'] = "Introduce un nivel";
        }

        $duracion = isset($datos["Duracion"]) ? htmlspecialchars(trim(strip_tags($datos['Duracion']))) : null;
        if(empty($precio)){
            $result['duracion'] = "Introduce una duracion";
        }

        if(count($result) != 0){
            $bool=false;
        }else{
            $bool=Curso::nuevoCursoenBD($_GET["juego"], $nombre, $description, $precio, $nivel, $duracion);
            if(!$bool){
                $result["nombre"]="Ya existe un curso con ese nombre";
            }
        }

        if ($bool){
            $result='adminCursos.php';
        }

        return $result;
    }
}