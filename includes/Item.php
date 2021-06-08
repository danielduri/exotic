<?php


namespace es\fdi\ucm\aw;


class Item
{
    private $idItem;
    private $idCurso;
    private $orden;
    private $html;
    private $esTest;
    private $numTest;
    private $test;
    private $nombre;

    /**
     * Item constructor.
     * @param $idItem
     * @param $idCurso
     * @param $orden
     * @param $html
     * @param $esTest
     * @param $numTest
     * @param $nombre
     */
    public function __construct($idItem, $idCurso, $orden, $html, $esTest, $numTest, $nombre)
    {
        $this->idItem = $idItem;
        $this->idCurso = $idCurso;
        $this->orden = $orden;
        $this->html = $html;
        $this->esTest = $esTest;
        $this->numTest = $numTest;
        $this->nombre = $nombre;

        if($esTest){
            $this->test = Test::getTestFromID($idItem, $numTest);
        }
    }

    /*
     * retorna el objeto item cuyo curso y orden dentro del mismo se pasan por parámetro
     */
    public static function getItem($courseID, $orden){
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM `itemscursos` WHERE `idCurso`='%d' AND `orden`='%d'", $conn->real_escape_string($courseID), $conn->real_escape_string($orden));

        $item = null;

        $rs = $conn->query($query);

        if ($rs && $rs->num_rows == 1) {
            $registro = $rs->fetch_assoc();
            $item = new Item($registro['idItem'], $registro['idCurso'], $registro['orden'], $registro['codigo'], $registro['esTest'], $registro['idTest'], $registro["nombreItem"]);
        }

        $rs->free();

        return $item;
    }

    /*
     * retorna el codigo html del item
     */
    public function getItemForDisplay(){
        if($this->esTest()){
            return $this->getTest()->gestiona();
        }else{
            return $this->html();
        }
    }

    /*
     * retorna el objeto item cuyo identificador se pasa por parámetro
     */
    public static function getItemFromID($id){
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM `itemscursos` WHERE `idItem`='%d'", $conn->real_escape_string($id));

        $item = null;

        $rs = $conn->query($query);

        if ($rs && $rs->num_rows == 1) {
            $registro = $rs->fetch_assoc();
            $item = new Item($registro['idItem'], $registro['idCurso'], $registro['orden'], $registro['codigo'], $registro['esTest'], $registro['idTest'], $registro["nombreItem"]);
        }

        $rs->free();

        return $item;
    }

    //GETTERS

    public function html()
    {
        return $this->html;
    }

    public function esTest()
    {
        return $this->esTest;
    }

    /**
     * @return Test|null
     */
    public function getTest(): ?Test
    {
        return $this->test;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->idItem;
    }

    /**
     * @return mixed
     */
    public function getIdCurso()
    {
        return $this->idCurso;
    }

    /**
     * @return mixed
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * @return mixed
     */
    public function getIDTest()
    {
        return $this->numTest;
    }

    public function eliminar(){
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("DELETE FROM `itemscursos` WHERE `itemscursos`.`idItem` = '%s'", $conn->real_escape_string($this->idItem));
        if ($conn->query($query) === TRUE) {
            $query = sprintf("UPDATE `itemscursos` SET `itemscursos`.`orden`=`itemscursos`.`orden`-1 
                WHERE `itemscursos`.`idCurso` = '%s' AND `itemscursos`.`orden` > %s", $conn->real_escape_string($this->idCurso), $conn->real_escape_string($this->orden));
            if ($conn->query($query) === TRUE) {
                return true;
            }
        }
        return false;
    }


    public static function nuevoItemenBD(?string $nombre, $contenido, $curso, $ordenCurso)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("INSERT INTO `itemscursos` (`nombreitem`, `codigo`, `idCurso`, `orden`, `esTest`) 
                VALUES ('%s', '%s', '%s', '%s', '%s')", $conn->real_escape_string($nombre),
            $conn->real_escape_string($contenido) ,$conn->real_escape_string($curso) ,$conn->real_escape_string($ordenCurso),0);

        if ($conn->query($query) === TRUE) {
            return true;
        }
        return false;
    }

    public function cambiaNombre(string $nuevoNombre)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();

        $query = sprintf("UPDATE `itemscursos` SET `nombreItem` = '%s' WHERE `itemscursos`.`idItem` = '%s'", $conn->real_escape_string($nuevoNombre), $conn->real_escape_string($this->idItem));
        echo $query;
        if ($conn->query($query) === TRUE) {
            $this->nombre = $nuevoNombre;
            return true;
        }

        return false;
    }

    public function cambiaContenido(string $nuevoCodigo)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();

        $query = sprintf("UPDATE `itemscursos` SET `codigo` = '%s' WHERE `itemscursos`.`iDItem` = '%s'", $conn->real_escape_string($nuevoCodigo), $conn->real_escape_string($this->idItem));
        if ($conn->query($query) === TRUE) {
            $this->html = $nuevoCodigo;
            return true;
        }

        return false;
    }
}