<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}


$tipo_conta = $_SESSION['tipo_conta'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sicredi</title>
    <link rel="stylesheet" href="css/dashboard.css">
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
    </style>
</head>
<body>
    <header>
        <h1>Bem-vindo ao Dashboard, <?php echo $_SESSION['usuario']; ?>!</h1>
        <div class="sair">
            <a href="logout.php">Sair</a>
        </div>
    </header>

    <div class="container">
        <?php if ($tipo_conta === 'Administrador'): ?>
            <h2>Opções de Administrador</h2>
            <ul>
                <li><a href="gerenciar_usuarios.php">Gerenciar Usuários</a></li>
                
            </ul>
        <?php else: ?>
            <h2>Opções de Usuário Comum</h2>
            <ul>
                <li><a href="ver_perfil.php">Ver Perfil</a></li>
                <li><a href="alterar_senha.php">Alterar Senha</a></li>
            </ul>
        <?php endif; ?>
    </div>

    <footer>
      
    </footer>
</body>
</html>
