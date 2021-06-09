<?php

namespace es\fdi\ucm\aw\FormulariosAdmin;

use es\fdi\ucm\aw\Curso;
use es\fdi\ucm\aw\Item;
use es\fdi\ucm\aw\Form;


class FormularioItemsNuevo extends Form
{
    public function __construct() {
        parent::__construct('formPerfil');
    }

    protected function generaCamposFormulario($datos, $errores = array())
    {

        $errorNombre = self::createMensajeError($errores, 'nombre', 'span', array('class' => 'error'));
        $errorDesc = self::createMensajeError($errores, 'description', 'span', array('class' => 'error'));

        $nombreItem = "Nombre del ítem: ";
        $contenido=$datos["Contenido"];

        $html = <<<EOF
                
                <p>
                <input type="text" name="Nombre" placeholder="$nombreItem"> $errorNombre
                </p>
                
                <p>
                <textarea id="mytextarea" name="Contenido">$contenido</textarea>
                $errorDesc
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
        $curso=Curso::buscarCursoPorID($_GET["id"]);
        $orden=$curso->getNumItems();
        $orden=$orden+1;

        $nombre = isset($datos["Nombre"]) ? $datos["Nombre"] : null;
        if(empty($nombre)){
            $result['nombre'] = "Introduce un nombre";
        }

        $contenido = isset($datos["Contenido"]) ? $datos["Contenido"] : null;
        if(empty($contenido)){
            $result['contenido'] = "Introduce el contenido";
        }


        if(count($result) != 0){
            $bool=false;
        }else{
            $bool=Item::nuevoItemenBD($nombre, $contenido, $_GET["id"], $orden);
        }

        if ($bool){
            $result='contentTable.php?id=';
            $result.=$_GET["id"];
        }

        return $result;
    }
}