<?php

namespace es\fdi\ucm\aw\FormulariosAdmin;

use es\fdi\ucm\aw\Item;
use es\fdi\ucm\aw\Form;

class FormularioTest extends Form
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

        $item = Item::getItemFromID($_GET["id"]);
        $nombre = $item->getNombre();
        $contenido = $item->html();

        $nombreJuego = "Nombre: ";
        $nombreJuego .= $nombre;

        $html = <<<EOF
                
                <p>
                <input type="text" name="Nombre" placeholder="$nombreJuego"> $errorNombre
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



        /*PROCESAR
        */

        $item = Item::getItemFromID($_GET["id"]);

        $nuevoNombre = isset($datos["Nombre"]) ? $datos["Nombre"] : null;
        if($nuevoNombre!=null){
            if (!filter_var($nuevoNombre, FILTER_SANITIZE_SPECIAL_CHARS)) {
                $result['nombre'] = "El nombre no puede contener caracteres especiales.";
            }else{
                $bool = $item->cambiaNombre($nuevoNombre);
            }
        }

        if(count($result) != 0){
            $bool=false;
        }

        if ($bool){
            $result='contentTable.php?id=';
            $result.=$item->getIdCurso();
        }

        return $result;
    }
}