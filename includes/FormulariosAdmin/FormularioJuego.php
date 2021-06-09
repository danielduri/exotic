<?php

namespace es\fdi\ucm\aw\FormulariosAdmin;

use es\fdi\ucm\aw\Juego;
use es\fdi\ucm\aw\Form;

class FormularioJuego extends Form
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

        $juego = Juego::buscarJuegoPorNombre($_GET["juego"]);
        $nombre = $juego->getName();
        $descripcion = $juego->getDescription();
        $categoria = $juego->getCategory();

        $nombreJuego = "Nombre: ";
        $nombreJuego .= $nombre;
        $descripcionJuego = "Descripción: ";
        $descripcionJuego .= $descripcion;
        $categoriaJuego = "Categoria: ";
        $categoriaJuego .= $categoria;

        $html = <<<EOF
                
                <p>
                <input type="text" name="Nombre" placeholder="$nombreJuego"> $errorNombre
                </p>
                
                <p>
                <textarea type="textarea" name="Descripcion" placeholder="$descripcionJuego" rows="10" cols="40"></textarea>
                </p>
                
                <p>
                <input type="text" name="Categoria" placeholder="$categoriaJuego"> 
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

        $nuevoNombre = isset($datos["Nombre"]) ? htmlspecialchars(trim(strip_tags($datos['Nombre']))) : null;
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