<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Mural de Missões</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=MedievalSharp&display=swap');

        body {
            background-color: #2b2b2b;
            font-family: 'MedievalSharp', cursive;
            color: #3e2723;
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .pergaminho {
            background-color: #f4e4bc;
            width: 80%;
            max-width: 900px;
            padding: 40px;
            box-shadow: 0 0 20px #000;
            border: 1px solid #d7c496;
            border-radius: 5px;
        }

        h1 {
            text-align: center;
            border-bottom: 2px solid #8d6e63;
            padding-bottom: 10px;
            color: #5d4037;
        }

        button {
            background-color: #8d6e63;
            color: #fff;
            border: 2px solid #5d4037;
            padding: 10px 20px;
            font-family: 'MedievalSharp', cursive;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover { background-color: #6d4c41; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #5d4037;
            color: #f4e4bc;
            padding: 10px;
            border: 1px solid #3e2723;
        }
        td {
            border: 1px solid #a1887f;
            padding: 8px;
            text-align: center;
            background-color: #fff8e1;
        }
        tr:nth-child(even) td { background-color: #ffe0b2; }

        a { color: #bf360c; text-decoration: none; font-weight: bold; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <div class="pergaminho">

        <h1>📜 Mural de Missões (RPG)</h1>

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

    </div>

</body>
</html>