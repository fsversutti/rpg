<?php

require_once(__DIR__ . "/../../controller/MissaoController.php");

$controller = new MissaoController();
$missoes = $controller->listar();

include_once(__DIR__ . "/../lista_missoes.php");
