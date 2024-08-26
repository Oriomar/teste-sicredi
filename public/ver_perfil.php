<?php
session_start();


if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}


include '../config/database.php';

// buscar informações do usuário logado
$stmt = $pdo->prepare("SELECT usuario, tipo_conta, data_criacao FROM usuarios WHERE usuario = ?");
$stmt->execute([$_SESSION['usuario']]);
$usuario = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Perfil - Sicredi</title>
    <link rel="stylesheet" href="css/ver_perfil.css">
    <style>
        .sair {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .sair a {
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
        }

        .sair a:hover {
            background-color: #45a049;
        }

        .container {
            max-width: 600px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        header {
            text-align: center;
        }

        p {
            font-size: 18px;
            margin: 10px 0;
        }

        a {
            text-decoration: none;
            color: #4CAF50;
            display: block;
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Perfil do Usuário</h1>
        <div class="sair">
            <a href="logout.php">Sair</a>
        </div>
    </header>
    <div class="container">
        <p><strong>Usuário:</strong> <?php echo $usuario['usuario']; ?></p>
        <p><strong>Tipo de Conta:</strong> <?php echo $usuario['tipo_conta']; ?></p>
        <p><strong>Data de Criação:</strong> <?php echo $usuario['data_criacao']; ?></p>
        
    </div>
</body>
</html>
