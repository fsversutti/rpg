<?php

include_once(__DIR__ . "/../dao/LocalDAO.php");

class LocalController {

    private LocalDAO $localDao;

    public function __construct() {
        $this->localDao = new LocalDAO();
    }

    public function listar() {
        return $this->localDao->list();
    }
}