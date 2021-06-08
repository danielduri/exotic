<?php

namespace es\fdi\ucm\aw;

class FormularioFotoPerfil extends Form {

    const EXTENSIONES_PERMITIDAS = array('gif','jpg','jpe','jpeg','png');

    public function __construct() {
        $opciones = array('enctype' => 'multipart/form-data');
        parent::__construct('subir',1, $opciones);
    }

    protected function generaCamposFormulario($datos, $errores = array()) {
        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorArchivo = self::createMensajeError($errores, 'archivo', 'span', array('class' => 'error'));

        $camposFormulario=<<<EOS
      <legend>Nueva foto de perfil</legend>
      $htmlErroresGlobales
      <p><label for="archivo">Archivo:</label><input type="file" name="archivo" id="archivo" />$errorArchivo</p>
      <button type="submit">Subir</button>
    EOS;

        return $camposFormulario;
    }


    protected function procesaFormulario($datos) {
        $result = array();
        $ok = count($_FILES) == 1 && $_FILES['archivo']['error'] == UPLOAD_ERR_OK;

        if ( $ok ) {
            $archivo = $_FILES['archivo'];
            $nombre = $_FILES['archivo']['name'];
            /* 1.a) Valida el nombre del archivo */
            $ok = $this->check_file_uploaded_name($nombre) && $this->check_file_uploaded_length($nombre) ;

            /* 1.b) Sanitiza el nombre del archivo
            $ok = $this->sanitize_file_uploaded_name($nombre);
            */

            /* 1.c) Utilizar un id de la base de datos como nombre de archivo */

            /* 2. comprueba si la extensión está permitida*/
            $ok = $ok && in_array(pathinfo($nombre, PATHINFO_EXTENSION), self::EXTENSIONES_PERMITIDAS);

            /* 3. comprueba el tipo mime del archivo correspode a una imagen image/* */
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->file($_FILES['archivo']['tmp_name']);
            $ok = preg_match('/image\/*./', $mimeType);

            if ( $ok ) {
                $tmp_name = $_FILES['archivo']['tmp_name'];

                if (!is_writable(DIR_ALMACEN)) {
                    echo 'Upload directory is not writable';
                }

                if (!is_dir(DIR_AVATARS_PROTEGIDOS)) {
                    echo DIR_AVATARS_PROTEGIDOS;
                    echo 'Avatar directory is not writable';
                }

                if ( !move_uploaded_file($tmp_name, DIR_ALMACEN. "/{$nombre}") ) {
                    $result[] = 'Error al mover el archivo';
                }else{
                    if ( !copy(DIR_ALMACEN. "/{$nombre}", DIR_AVATARS_PROTEGIDOS. "/{$_SESSION["userID"]}") ) {
                        $result[] = 'Error al mover el archivo';
                    }
                    unlink(DIR_ALMACEN. "/{$nombre}");
                }


                // 4. Si fuese necesario guardar en la base de datos la ruta relativa $nombre del archivo

                return "profile.php";
            }else {
                $result[] = 'El archivo tiene un nombre o tipo no soportado';
            }
        } else {
            $result[] = 'Error al subir el archivo.';
        }
        return $result;
    }


    /**
     * Check $_FILES[][name]
     *
     * @param (string) $filename - Uploaded file name.
     * @author Yousef Ismaeil Cliprz
     * @See http://php.net/manual/es/function.move-uploaded-file.php#111412
     */
    private function check_file_uploaded_name ($filename) {
        return (bool) ((mb_ereg_match('/^[0-9A-Z-_\.]+$/i',$filename) === 1) ? true : false );
    }

    /**
     * Sanitize $_FILES[][name]. Remove anything which isn't a word, whitespace, number
     * or any of the following caracters -_~,;[]().
     *
     * If you don't need to handle multi-byte characters you can use preg_replace
     * rather than mb_ereg_replace.
     *
     * @param (string) $filename - Uploaded file name.
     * @author Sean Vieira
     * @see http://stackoverflow.com/a/2021729
     */
    private function sanitize_file_uploaded_name($filename) {
        /* Remove anything which isn't a word, whitespace, number
         * or any of the following caracters -_~,;[]().
         * If you don't need to handle multi-byte characters
         * you can use preg_replace rather than mb_ereg_replace
         * Thanks @Łukasz Rysiak!
         */
        $newName = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $filename);
        // Remove any runs of periods (thanks falstro!)
        $newName = mb_ereg_replace("([\.]{2,})", '', $newName);

        return $newName;
    }

    /**
     * Check $_FILES[][name] length.
     *
     * @param (string) $filename - Uploaded file name.
     * @author Yousef Ismaeil Cliprz.
     * @See http://php.net/manual/es/function.move-uploaded-file.php#111412
     */
    private function check_file_uploaded_length ($filename) {
        return (bool) ((mb_strlen($filename,'UTF-8') < 250) ? true : false);
    }
}
