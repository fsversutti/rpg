<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo à Taverna</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=MedievalSharp&display=swap');

        body {
            background-color: #1a1a1a;
            font-family: 'MedievalSharp', cursive;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        .placa-madeira {
            background-color: #5d4037;
            border: 5px solid #3e2723;
            border-radius: 15px;
            padding: 50px;
            text-align: center;
            box-shadow: 0 0 50px rgba(0,0,0, 0.8);
            max-width: 600px;
            width: 90%;
            position: relative;
        }

        .placa-madeira::before, .placa-madeira::after {
            content: '';
            position: absolute;
            top: 15px;
            width: 15px;
            height: 15px;
            background-color: #212121;
            border-radius: 50%;
            box-shadow: 0 1px 0 rgba(255,255,255,0.2);
        }
        .placa-madeira::before { left: 15px; }
        .placa-madeira::after { right: 15px; }

        h1 {
            color: #f4e4bc;
            font-size: 3rem;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px #000;
        }

        p {
            color: #d7ccc8;
            font-size: 1.2rem;
            margin-bottom: 40px;
        }

        .botao-entrar {
            display: inline-block;
            background-color: #bf360c;
            color: #fff;
            padding: 20px 40px;
            font-size: 1.5rem;
            text-decoration: none;
            border: 2px solid #870000;
            border-radius: 8px;
            transition: transform 0.2s, background-color 0.2s;
            box-shadow: 0 5px 15px rgba(0,0,0,0.5);
        }

        .botao-entrar:hover {
            background-color: #d84315;
            transform: scale(1.05);
        }

        .botao-entrar:active {
            transform: scale(0.95);
        }
    </style>
</head>
<body>

    <div class="placa-madeira">
        <h1>🍺 Taverna</h1>
        <p>Saudações, viajante! O quadro de missões e <br>recompensas espera por você.</p>
        
        <a href="view/modulos/missao_listar.php" class="botao-entrar">
            Entrar na Taverna
        </a>
    </div>

</body>
</html>