<?php
session_start();
include '../config/database.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Verifica se o usuário existe no banco de dados
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->execute([$usuario]);
    $usuario_data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario_data && password_verify($senha, $usuario_data['senha'])) {
       
        $_SESSION['usuario'] = $usuario_data['usuario'];
        $_SESSION['tipo_conta'] = $usuario_data['tipo_conta'];

        // Redireciona com base no tipo de conta
        if ($usuario_data['tipo_conta'] === 'Administrador') {
            header("Location: dashboard.php");
        } else {
            header("Location: ver_perfil.php");
        }
        exit;
    } else {
        $_SESSION['erro'] = "Usuário ou senha incorretos.";
        header("Location: login.php");
        exit;
    }
}
?>
