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

    // exclui o usuário do banco de dados
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);

    // redireciona de volta para a página de gerenciamento de usuários
    header("Location: gerenciar_usuarios.php");
    exit;
}
?>
