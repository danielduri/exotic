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
    }

    public static function getItem($itemID){
        $conn = getConexionBD();
        $query = sprintf("SELECT * FROM `itemscursos` WHERE `idCurso`='%d'", $conn->real_escape_string($courseID));

        $curso = null;

        $rs = $conn->query($query);

        if ($rs && $rs->num_rows == 1) {
            $registro = $rs->fetch_assoc();
            $curso = new Curso($registro['courseID'], $registro['game'], $registro['price'], $registro['courseName'], $registro['level'], $registro['duration'], $registro['description']);
        }

        $rs->free();

        return $curso;
    }


}