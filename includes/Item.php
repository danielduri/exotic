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

    /**
     * Item constructor.
     * @param $idItem
     * @param $idCurso
     * @param $orden
     * @param $html
     * @param $esTest
     * @param $numTest
     */
    public function __construct($idItem, $idCurso, $orden, $html, $esTest, $numTest)
    {
        $this->idItem = $idItem;
        $this->idCurso = $idCurso;
        $this->orden = $orden;
        $this->html = $html;
        $this->esTest = $esTest;
        $this->numTest = $numTest;
        if($esTest){
            $test = Test
        }
    }

    public static function getItem($itemID){
        $conn = getConexionBD();
        $query = sprintf("SELECT * FROM `itemscursos` WHERE `idCurso`='%d'", $conn->real_escape_string($courseID));

        $item = null;

        $rs = $conn->query($query);

        if ($rs && $rs->num_rows == 1) {
            $registro = $rs->fetch_assoc();
            $item = new Item($registro['idItem'], $registro['idCurso'], $registro['orden'], $registro['html'], $registro['esTest'], $registro['numTest']);
        }

        $rs->free();

        return $item;
    }


}