<?php

include_once(__DIR__ . "/../dao/TipoMissaoDAO.php");

class TipoMissaoController {

    private TipoMissaoDAO $tipoDao;

    public function __construct() {
        $this->tipoDao = new TipoMissaoDAO();
    }

    public function listar() {
        return $this->tipoDao->list();
    }
}