<?php

require_once(__DIR__ . "/controller/MissaoController.php");
require_once(__DIR__ . "/model/Missao.php");
require_once(__DIR__ . "/model/Local.php");
require_once(__DIR__ . "/model/TipoMissao.php");

$msgErros = array();
$missao = NULL;

if(isset($_POST['titulo'])) {

    $titulo      = trim($_POST['titulo']) ? trim($_POST['titulo']) : NULL;
    $recompensa  = is_numeric($_POST['recompensa']) ? $_POST['recompensa'] : NULL;
    $dificuldade = trim($_POST['dificuldade']) ? trim($_POST['dificuldade']) : NULL;
    $idLocal     = is_numeric($_POST['id_local']) ? $_POST['id_local'] : NULL;
    $idTipo      = is_numeric($_POST['id_tipo']) ? $_POST['id_tipo'] : NULL;
    $id          = is_numeric($_POST['id']) ? $_POST['id'] : 0;

    $missao = new Missao();
    $missao->setId($id);
    $missao->setTitulo($titulo);
    $missao->setRecompensa($recompensa);
    $missao->setDificuldade($dificuldade);

    if($idLocal) {
        $local = new Local();
        $local->setId($idLocal);
        $missao->setLocal($local);
    } else {
        $missao->setLocal(NULL);
    }

    if($idTipo) {
        $tipo = new TipoMissao();
        $tipo->setId($idTipo);
        $missao->setTipoMissao($tipo);
    } else {
        $missao->setTipoMissao(NULL);
    }

    $controller = new MissaoController();
    $erros = array();

    if($missao->getId() == 0) {
        $erros = $controller->inserir($missao);
    } else {
        $erros = $controller->editar($missao);
    }

    if(!$erros) {
        header("location: missao_listar.php");
        exit;
    } else {
        $msgErros = $erros;
        include_once(__DIR__ . "/view/form_missao.php");
    }
}
?>