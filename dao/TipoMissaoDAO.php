<?php

include_once(__DIR__ . "/../util/Connection.php");
include_once(__DIR__ . "/../model/TipoMissao.php");

class TipoMissaoDAO {

    private PDO $conn;

    public function __construct() {
        $this->conn = Connection::getConnection();
    }

    public function list() {
        $sql = "SELECT * FROM tipos_missao ORDER BY nome";
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        
        return $this->map($result);
    }

    private function map(array $result) {
        $tipos = array();
        foreach($result as $r) {
            $tipo = new TipoMissao();
            $tipo->setId($r['id']);
            $tipo->setNome($r['nome']);

            array_push($tipos, $tipo);
        }
        return $tipos;
    }
}