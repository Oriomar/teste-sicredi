<?php
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

include '../config/database.php';

// Processamento de formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $senha_atual = $_POST['senha_atual'];
    $nova_senha = $_POST['nova_senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    // Buscar a senha atual do usuário
    $stmt = $pdo->prepare("SELECT senha FROM usuarios WHERE usuario = ?");
    $stmt->execute([$_SESSION['usuario']]);
    $usuario = $stmt->fetch();

    // Verificar se a senha atual está correta
    if (!password_verify($senha_atual, $usuario['senha'])) {
        $_SESSION['erro'] = "Senha atual incorreta.";
    } elseif ($nova_senha !== $confirmar_senha) {
        $_SESSION['erro'] = "As novas senhas não coincidem.";
    } else {
        // Atualiza a nova senha
        $nova_senha_hashed = password_hash($nova_senha, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE usuarios SET senha = ? WHERE usuario = ?");
        $stmt->execute([$nova_senha_hashed, $_SESSION['usuario']]);

        $_SESSION['sucesso'] = "Senha alterada com sucesso!";
        header("Location: alterar_senha.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Senha - Sicredi</title>
    <link rel="stylesheet" href="css/alterar_senha.css">
</head>
<body>
    <header>
        <h1>Alterar Senha</h1>
    </header>
    <div class="container">
        <?php if (isset($_SESSION['erro'])): ?>
            <div class="erro"><?php echo $_SESSION['erro']; unset($_SESSION['erro']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['sucesso'])): ?>
            <div class="sucesso"><?php echo $_SESSION['sucesso']; unset($_SESSION['sucesso']); ?></div>
        <?php endif; ?>

        <form action="alterar_senha.php" method="POST">
            <input type="password" name="senha_atual" placeholder="Senha Atual" required>
            <input type="password" name="nova_senha" placeholder="Nova Senha" required>
            <input type="password" name="confirmar_senha" placeholder="Confirmar Nova Senha" required>
            <button type="submit">Alterar Senha</button>
        </form>
    </div>
</body>
</html>
