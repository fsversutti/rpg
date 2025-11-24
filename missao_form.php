<?php
// ADICIONE ISTO NO TOPO DO ARQUIVO:
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . "/controller/MissaoController.php");
require_once(__DIR__ . "/model/Missao.php");

$controller = new MissaoController();

$missao = null;
$msgErros = array(); // Começa vazia

if(isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $missao = $controller->buscarPorId($id);
}

if(!$missao) {
    $missao = new Missao();
}

include_once(__DIR__ . "/view/form_missao.php");