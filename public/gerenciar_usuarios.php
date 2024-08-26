<?php
session_start();
include '../config/database.php';

// verifica se o usuário está logado e se é um administrador
if (!isset($_SESSION['usuario']) || $_SESSION['tipo_conta'] !== 'Administrador') {
    header("Location: login.php");
    exit;
}

// busca todos os usuários (exceto o master)
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario != 'master'");
$stmt->execute();
$usuarios = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuários - Sicredi</title>
    <link rel="stylesheet" href="css/gerenciar_usuarios.css">
    <style>
        .voltar {
            margin-top: 20px;
            text-align: center;
        }

        .voltar a {
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
        }

        .voltar a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>Gerenciar Usuários</h1>
    </header>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuário</th>
                <th>Tipo de Conta</th>
                <th>Data de Criação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?php echo $usuario['id']; ?></td>
                <td><?php echo $usuario['usuario']; ?></td>
                <td><?php echo $usuario['tipo_conta']; ?></td>
                <td><?php echo $usuario['data_criacao']; ?></td>
                <td>
                    <a href="editar_usuario.php?id=<?php echo $usuario['id']; ?>">Editar</a> |
                    <a href="excluir_usuario.php?id=<?php echo $usuario['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este usuário?');">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="voltar">
        <a href="dashboard.php">Voltar ao Dashboard</a>
    </div>
</body>
</html>
