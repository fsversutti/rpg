<?php

require_once(__DIR__ . "/controller/MissaoController.php");

if(isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    
    $controller = new MissaoController();
    $controller->excluir($id);
}

header("location: missao_listar.php");
exit;