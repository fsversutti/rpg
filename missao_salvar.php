<?php

require_once(__DIR__ . "/controller/MissaoController.php");
require_once(__DIR__ . "/model/Missao.php");
require_once(__DIR__ . "/model/Local.php");
require_once(__DIR__ . "/model/TipoMissao.php");

$controller = new MissaoController();
$missao = new Missao();

$missao->setTitulo($_POST['titulo']);
$missao->setRecompensa((float) $_POST['recompensa']);
$missao->setDificuldade($_POST['dificuldade']);

$local = new Local();
$local->setId($_POST['id_local']); 
$missao->setLocal($local);

$tipo = new TipoMissao();
$tipo->setId($_POST['id_tipo']);
$missao->setTipoMissao($tipo);

$id = $_POST['id'];
$erros = array();

if(empty($id)) {
    $erros = $controller->inserir($missao);
} else {
    $missao->setId($id);
    $erros = $controller->editar($missao);
}

if(!empty($erros)) {
    $msgErros = $erros;
    include_once(__DIR__ . "/view/form_missao.php");
} else {
    header("location: missao_listar.php");
    exit;
}