<?php

include_once(__DIR__ . "/../util/Connection.php");
include_once(__DIR__ . "/../model/Local.php");

class LocalDAO {

    private PDO $conn;

    public function __construct() {
        $this->conn = Connection::getConnection();
    }

    public function list() {
        $sql = "SELECT * FROM locais ORDER BY nome";
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        
        return $this->map($result);
    }

    private function map(array $result) {
        $locais = array();
        foreach($result as $r) {
            $local = new Local();
            $local->setId($r['id']);
            $local->setNome($r['nome']);

            array_push($locais, $local);
        }
        return $locais;
    }
}