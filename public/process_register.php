<?php
session_start();
include '../config/database.php';
echo "Conexão com o banco de dados estabelecida.";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];
    $tipo_conta = $_POST['tipo_conta'];

    // verifica se as senhas coincidem
    if ($senha !== $confirmar_senha) {
        $_SESSION['erro'] = "As senhas não coincidem.";
        header("Location: register.php");
        exit;
    }

    // verifica força da senha 
    if (strlen($senha) < 8) {
        $_SESSION['erro'] = "A senha deve ter pelo menos 8 caracteres.";
        header("Location: register.php");
        exit;
    }

    // verifica se o usuário já existe
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->execute([$usuario]);
    if ($stmt->rowCount() > 0) {
        $_SESSION['erro'] = "Usuário já existe.";
        header("Location: register.php");
        exit;
    }

    
    $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);

    // insere o novo usuário no banco de dados
    $stmt = $pdo->prepare("INSERT INTO usuarios (usuario, senha, tipo_conta) VALUES (?, ?, ?)");
    $stmt->execute([$usuario, $senha_hashed, $tipo_conta]);

    
$_SESSION['sucesso'] = "Conta criada com sucesso!";
header("Location: register.php?status=success");
exit;
}
?>
