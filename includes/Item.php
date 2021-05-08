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
            $this->test = Test::getTestFromID($numTest);
        }
    }

    public static function getItem($courseID, $orden){
        $conn = getConexionBD();
        $query = sprintf("SELECT * FROM `itemscursos` WHERE `idCurso`='%d' AND `orden`='%d'", $conn->real_escape_string($courseID), $conn->real_escape_string($orden));

        $item = null;

        $rs = $conn->query($query);

        if ($rs && $rs->num_rows == 1) {
            $registro = $rs->fetch_assoc();
            $item = new Item($registro['idItem'], $registro['idCurso'], $registro['orden'], $registro['codigo'], $registro['esTest'], $registro['idTest']);
        }

        $rs->free();

        return $item;
    }

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


}