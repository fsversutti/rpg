<?php
// Mantendo a lógica original
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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=MedievalSharp&display=swap');

        body {
            background-color: #2b2b2b; /* Fundo escuro */
            font-family: 'MedievalSharp', cursive;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Centraliza verticalmente */
            margin: 0;
            color: #3e2723;
        }

        /* O estilo do papel/contrato */
        .contrato {
            background-color: #f4e4bc;
            border: 8px solid #5d4037;
            padding: 40px;
            width: 500px;
            max-width: 90%;
            box-shadow: 10px 10px 30px rgba(0,0,0,0.6);
            border-radius: 5px;
            position: relative;
        }

        /* "Pregos" decorativos nos cantos */
        .contrato::before, .contrato::after {
            content: '';
            position: absolute;
            top: 15px;
            width: 10px;
            height: 10px;
            background-color: #3e2723;
            border-radius: 50%;
        }
        .contrato::before { left: 15px; }
        .contrato::after { right: 15px; }

        h2 {
            text-align: center;
            border-bottom: 2px solid #8d6e63;
            padding-bottom: 10px;
            margin-top: 0;
            color: #5d4037;
        }

        label {
            font-size: 18px;
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }

        /* Estilo dos inputs e selects */
        input[type="text"], 
        input[type="number"], 
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            background: #fff8e1;
            border: 2px solid #8d6e63;
            font-family: 'MedievalSharp', cursive;
            font-size: 16px;
            box-sizing: border-box; /* Garante que o padding não estoure a largura */
            outline: none;
        }

        input:focus, select:focus {
            border-color: #bf360c;
            background-color: #fff;
        }

        /* Estilo do botão Salvar */
        button {
            width: 100%;
            margin-top: 25px;
            padding: 15px;
            background-color: #bf360c; /* Vermelho Lacre */
            color: white;
            border: 2px solid #870000;
            font-family: 'MedievalSharp', cursive;
            font-size: 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: 0.3s;
        }
        button:hover { background-color: #d84315; }

        /* Link de Cancelar */
        .link-cancelar {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #5d4037;
            text-decoration: none;
            font-weight: bold;
        }
        .link-cancelar:hover { text-decoration: underline; color: #bf360c; }

        /* Caixa de Erro */
        .caixa-erro {
            background-color: #ffcdd2;
            color: #b71c1c;
            border: 2px solid #b71c1c;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        .caixa-erro ul { margin: 0; padding-left: 20px; }
    </style>
</head>
<body>

<div class="contrato">

    <h2>⚔️ Novo Contrato</h2>

    <?php if(!empty($msgErros)): ?>
        <div class="caixa-erro">
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
            <label>📜 Título da Missão:</label>
            <input type="text" name="titulo" 
                   value="<?= ($missao ? $missao->getTitulo() : '') ?>">
        </div>

        <div>
            <label>💰 Recompensa (Ouro):</label>
            <input type="number" name="recompensa" step="0.01"
                   value="<?= ($missao ? $missao->getRecompensa() : '') ?>">
        </div>

        <div>
            <label>💀 Dificuldade:</label>
            <select name="dificuldade">
                <option value="">Selecione a dificuldade...</option>
                <option value="E" <?= ($missao && $missao->getDificuldade() == 'E' ? 'selected' : '') ?>>Easy (Fácil)</option>
                <option value="N" <?= ($missao && $missao->getDificuldade() == 'N' ? 'selected' : '') ?>>Normal</option>
                <option value="H" <?= ($missao && $missao->getDificuldade() == 'H' ? 'selected' : '') ?>>Hard (Difícil)</option>
                <option value="S" <?= ($missao && $missao->getDificuldade() == 'S' ? 'selected' : '') ?>>Super (Lendário)</option>
            </select>
        </div>

        <div>
            <label>🏰 Local:</label>
            <select name="id_local">
                <option value="">Selecione o local...</option>
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

        <div>
            <label>🛡️ Tipo de Missão:</label>
            <select name="id_tipo">
                <option value="">Selecione o tipo...</option>
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

        <button type="submit">Assinar Contrato (Salvar)</button>
        
        <a href="missao_listar.php" class="link-cancelar">Rasgar Contrato (Cancelar)</a>

    </form>

</div> </body>
</html>