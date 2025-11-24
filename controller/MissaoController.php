<?php

include_once(__DIR__ . "/../dao/MissaoDAO.php");
include_once(__DIR__ . "/../service/MissaoService.php");
include_once(__DIR__ . "/../model/Missao.php");

class MissaoController {

    private MissaoDAO $missaoDao;
    private MissaoService $missaoService;

    public function __construct() {
        $this->missaoDao = new MissaoDAO();
        $this->missaoService = new MissaoService();
    }

    public function listar() {
        return $this->missaoDao->list();
    }

    public function buscarPorId(int $id) {
        return $this->missaoDao->findById($id);
    }

    public function inserir(Missao $missao) {
        // 1. Chama o Service para validar as regras de negócio
        $erros = $this->missaoService->validar($missao);

        // 2. Se não houver erros, chama o DAO para salvar
        if(! $erros) {
            $this->missaoDao->insert($missao);
        }

        return $erros;
    }

    public function editar(Missao $missao) {
        // 1. Valida novamente antes de atualizar
        $erros = $this->missaoService->validar($missao);

        // 2. Se ok, chama o update do DAO
        if(! $erros) {
            $this->missaoDao->update($missao);
        }

        return $erros;
    }

    public function excluir(int $id) {
        $this->missaoDao->delete($id);
    }
}