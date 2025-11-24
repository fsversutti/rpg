<?php

include_once(__DIR__ . "/../util/Connection.php");
include_once(__DIR__ . "/../model/Missao.php");
include_once(__DIR__ . "/../model/Local.php");
include_once(__DIR__ . "/../model/TipoMissao.php");

class MissaoDAO {

    private PDO $conn;

    public function __construct() {
        $this->conn = Connection::getConnection();    
    }

    public function list() {
        $sql = "SELECT m.*, 
                       l.nome AS nome_local, 
                       t.nome AS nome_tipo
                FROM missoes m
                JOIN locais l ON (l.id = m.id_local)
                JOIN tipos_missao t ON (t.id = m.id_tipo_missao)
                ORDER BY m.id DESC";

        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->map($result);
    }

    public function findById(int $id) {
        $sql = "SELECT m.*, 
                       l.nome AS nome_local, 
                       t.nome AS nome_tipo
                FROM missoes m
                JOIN locais l ON (l.id = m.id_local)
                JOIN tipos_missao t ON (t.id = m.id_tipo_missao)
                WHERE m.id = ?";

        $stm = $this->conn->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $missoes = $this->map($result);

        if(count($missoes) == 1)
            return $missoes[0];

        return NULL;
    }

    public function insert(Missao $missao) {
        try {
            $sql = "INSERT INTO missoes 
                    (titulo_missao, recompensa_ouro, dificuldade, id_local, id_tipo_missao)
                    VALUES (?, ?, ?, ?, ?)";

            $stm = $this->conn->prepare($sql);
            
            $stm->execute(array(
                $missao->getTitulo(),
                $missao->getRecompensa(),
                $missao->getDificuldade(),
                $missao->getLocal()->getId(),      
                $missao->getTipoMissao()->getId()  
            ));
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    public function update(Missao $missao) {
        try {
            $sql = "UPDATE missoes 
                    SET titulo_missao = ?, recompensa_ouro = ?, 
                        dificuldade = ?, id_local = ?, id_tipo_missao = ? 
                    WHERE id = ?";
            
            $stm = $this->conn->prepare($sql);
            
            $stm->execute(array(
                $missao->getTitulo(),
                $missao->getRecompensa(),
                $missao->getDificuldade(),
                $missao->getLocal()->getId(),
                $missao->getTipoMissao()->getId(),
                $missao->getId() 
            ));
        } catch(PDOException $e) {
            die($e->getMessage());
        }                    
    }

    public function delete(int $id) {
        try {
            $sql = "DELETE FROM missoes WHERE id = ?";

            $stm = $this->conn->prepare($sql);
            $stm->execute(array($id));
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    private function map(array $result) {
        $missoes = array();

        foreach($result as $r) {
            $missao = new Missao();
            $missao->setId($r['id']);
            $missao->setTitulo($r['titulo_missao']);
            $missao->setRecompensa($r['recompensa_ouro']);
            $missao->setDificuldade($r['dificuldade']);
            
            $local = new Local();
            $local->setId($r['id_local']);
            $local->setNome($r['nome_local']); 
            $missao->setLocal($local);

            $tipo = new TipoMissao();
            $tipo->setId($r['id_tipo_missao']);
            $tipo->setNome($r['nome_tipo']); 
            $missao->setTipoMissao($tipo);

            array_push($missoes, $missao);
        }

        return $missoes;
    }
}