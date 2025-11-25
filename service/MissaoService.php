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

    // --- FUNÇÃO VALIDAR CORRIGIDA ---
    public function validar(Missao $missao) {
        $erros = array();

        // 1. Validação do Título
        if(!$missao->getTitulo()) {
            $erros[] = "O título da missão é obrigatório.";
        }

        // 2. Validação da Recompensa
        if(!$missao->getRecompensa()) {
            $erros[] = "Informe o valor da recompensa.";
        } else if($missao->getRecompensa() <= 0) { 
            // Corrigido: Removi o "!" antes da variavel na comparação matemática
            $erros[] = "A recompensa deve ser maior que zero.";
        }

        // 3. Validação da Dificuldade
        if(!$missao->getDificuldade()) {
            $erros[] = "Selecione a dificuldade da missão.";
        }

        // 4. Validação do Local (Objeto)
        // Verifica se o objeto Local existe E se o ID dele não é vazio
        if(!$missao->getLocal() || !$missao->getLocal()->getId()) {
            $erros[] = "Você deve escolher um Local para a missão.";
        }

        // 5. Validação do Tipo (Objeto)
        if(!$missao->getTipoMissao() || !$missao->getTipoMissao()->getId()) {
            $erros[] = "Você deve escolher um Tipo de Missão.";
        }

        return $erros;
    }
}