<?php

// Importa os modelos e os DAOs
require_once(__DIR__ . "/../model/Missao.php");
require_once(__DIR__ . "/../dao/MissaoDAO.php");
require_once(__DIR__ . "/../dao/LocalDAO.php");
require_once(__DIR__ . "/../dao/TipoMissaoDAO.php");

class MissaoService {

    private $missaoDao;
    private $localDao;
    private $tipoDao;

    public function __construct() {
        $this->missaoDao = new MissaoDAO();
        $this->localDao = new LocalDAO();
        $this->tipoDao = new TipoMissaoDAO();
    }

    public function listar() {
        return $this->missaoDao->list();
    }

    public function buscarPorId($id) {
        return $this->missaoDao->findById($id);
    }

    public function listarLocais() {
        return $this->localDao->list();
    }

    public function listarTipos() {
        return $this->tipoDao->list();
    }


    public function validar(Missao $missao) {
        $erros = array();

        if(empty($missao->getTitulo())) {
            $erros[] = "O título da missão é obrigatório.";
        }

        if(empty($missao->getRecompensa())) {
            $erros[] = "Informe o valor da recompensa.";
        } else if($missao->getRecompensa() <= 0) {
            $erros[] = "A recompensa deve ser maior que zero (ninguém trabalha de graça!).";
        }

        if(empty($missao->getDificuldade())) {
            $erros[] = "Selecione a dificuldade da missão.";
        }
        if($missao->getLocal() == null || empty($missao->getLocal()->getId())) {
            $erros[] = "Você deve escolher um Local para a missão.";
        }

        if($missao->getTipoMissao() == null || empty($missao->getTipoMissao()->getId())) {
            $erros[] = "Você deve escolher um Tipo de Missão.";
        }

        return $erros;
    }
}