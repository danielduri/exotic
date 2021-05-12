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
        $conn = getConexionBD();
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
        $conn = getConexionBD();
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
}