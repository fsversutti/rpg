<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Mural de Missões</title>
</head>
<body>

    <h1>Mural de Missões (RPG)</h1>

    <a href="missao_form.php">
        <button>+ Nova Missão</button>
    </a>
    <br><br>

    <table border="1" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Recompensa (Ouro)</th>
                <th>Dificuldade</th>
                <th>Local</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($missoes)): ?>
                <tr>
                    <td colspan="7" align="center">Nenhuma missão encontrada no mural.</td>
                </tr>
            <?php else: ?>
                <?php foreach($missoes as $missao): ?>
                    <tr>
                        <td><?= $missao->getId() ?></td>
                        <td><?= $missao->getTitulo() ?></td>
                        <td><?= number_format($missao->getRecompensa(), 2, ',', '.') ?></td>
                        
                        <td><?= $missao->getDificuldadeDesc() ?></td>
                        
                        <td><?= $missao->getLocal()->getNome() ?></td>
                        
                        <td><?= $missao->getTipoMissao()->getNome() ?></td>
                        
                        <td align="center">
                            <a href="missao_form.php?id=<?= $missao->getId() ?>">
                                [Editar]
                            </a>
                            
                            &nbsp; | &nbsp;

                            <a href="missao_excluir.php?id=<?= $missao->getId() ?>" 
                               onclick="return confirm('Tem certeza que deseja apagar esta missão?');">
                                [Excluir]
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>