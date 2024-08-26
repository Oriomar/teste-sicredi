<?php
session_start();
include '../config/database.php';

// verifica se o usuário está logado e se é um administrador
if (!isset($_SESSION['usuario']) || $_SESSION['tipo_conta'] !== 'Administrador') {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // obtém os dados do usuário para preencher o formulário
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);
    $usuario = $stmt->fetch();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuario_atualizado = $_POST['usuario'];
        $tipo_conta = $_POST['tipo_conta'];

        // atualiza os dados do usuário no banco de dados
        $stmt = $pdo->prepare("UPDATE usuarios SET usuario = ?, tipo_conta = ? WHERE id = ?");
        $stmt->execute([$usuario_atualizado, $tipo_conta, $id]);

        // redireciona de volta para a página de gerenciamento de usuários
        header("Location: gerenciar_usuarios.php");
        exit;
    }
} else {
    header("Location: gerenciar_usuarios.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário - Sicredi</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .container {
            max-width: 600px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        .footer-link {
            text-align: center;
            margin-top: 20px;
        }

        .footer-link a {
            text-decoration: none;
            color: #4CAF50;
        }

        .footer-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Usuário</h1>
        <form method="POST">
            <label for="usuario">Usuário:</label>
            <input type="text" name="usuario" value="<?php echo $usuario['usuario']; ?>" required>

            <label for="tipo_conta">Tipo de Conta:</label>
            <select name="tipo_conta" required>
                <option value="Comum" <?php echo ($usuario['tipo_conta'] == 'Comum') ? 'selected' : ''; ?>>Comum</option>
                <option value="Administrador" <?php echo ($usuario['tipo_conta'] == 'Administrador') ? 'selected' : ''; ?>>Administrador</option>
            </select>

            <label for="data_criacao">Data de Criação:</label>
            <input type="text" name="data_criacao" value="<?php echo $usuario['data_criacao']; ?>" readonly>

            <button type="submit">Salvar Alterações</button>
        </form>
        <div class="footer-link">
            <a href="gerenciar_usuarios.php">Voltar</a>
        </div>
    </div>
</body>
</html>
