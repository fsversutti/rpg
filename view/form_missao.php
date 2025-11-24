<?php
if(!isset($locais) || !isset($tipos)) {
    include_once(__DIR__ . "/../controller/LocalController.php");
    include_once(__DIR__ . "/../controller/TipoMissaoController.php");

    $localCont = new LocalController();
    $tipoCont = new TipoMissaoController();
    $locais = $localCont->listar();
    $tipos = $tipoCont->listar();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Missão</title>
</head>
<body>

<h2>Cadastro de Missão</h2>

<?php if(!empty($msgErros)): ?>
    <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 10px;">
        <ul>
            <?php foreach($msgErros as $erro): ?>
                <li><?= $erro ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="missao_salvar.php" method="POST">

    <input type="hidden" name="id" value="<?= ($missao ? $missao->getId() : '') ?>">

    <div>
        <label>Título da Missão:</label><br>
        <input type="text" name="titulo" 
               value="<?= ($missao ? $missao->getTitulo() : '') ?>">
    </div>
    <br>

    <div>
        <label>Recompensa (Ouro):</label><br>
        <input type="number" name="recompensa" step="0.01"
               value="<?= ($missao ? $missao->getRecompensa() : '') ?>">
    </div>
    <br>

    <div>
        <label>Dificuldade:</label><br>
        <select name="dificuldade">
            <option value="">Selecione...</option>
            <option value="E" <?= ($missao && $missao->getDificuldade() == 'E' ? 'selected' : '') ?>>Easy (Fácil)</option>
            <option value="N" <?= ($missao && $missao->getDificuldade() == 'N' ? 'selected' : '') ?>>Normal</option>
            <option value="H" <?= ($missao && $missao->getDificuldade() == 'H' ? 'selected' : '') ?>>Hard (Difícil)</option>
            <option value="S" <?= ($missao && $missao->getDificuldade() == 'S' ? 'selected' : '') ?>>Super (Lendário)</option>
        </select>
    </div>
    <br>

    <div>
        <label>Local:</label><br>
        <select name="id_local">
            <option value="">Selecione um local...</option>
            <?php foreach($locais as $local): ?>
                <option value="<?= $local->getId() ?>"
                    <?php 
                        if($missao && $missao->getLocal() && $missao->getLocal()->getId() == $local->getId()) 
                            echo "selected"; 
                    ?>
                >
                    <?= $local->getNome() ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <br>

    <div>
        <label>Tipo de Missão:</label><br>
        <select name="id_tipo">
            <option value="">Selecione um tipo...</option>
            <?php foreach($tipos as $tipo): ?>
                <option value="<?= $tipo->getId() ?>"
                    <?php 
                        if($missao && $missao->getTipoMissao() && $missao->getTipoMissao()->getId() == $tipo->getId()) 
                            echo "selected"; 
                    ?>
                >
                    <?= $tipo->getNome() ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <br>

    <button type="submit">Salvar Missão</button>
    <a href="missao_listar.php">Cancelar</a>

</form>

</body>
</html>