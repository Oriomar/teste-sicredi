<?php
session_start();
require 'config/database.php';

// recebe os dados do formulário
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

// verifica se o usuário existe no banco de dados
$query = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
$query->execute([$usuario]);

if ($query->rowCount() === 0) {
    die("Usuário não encontrado!");
}

$usuario_db = $query->fetch(PDO::FETCH_ASSOC);

// verifica a senha
if (!password_verify($senha, $usuario_db['senha'])) {
    die("Senha incorreta!");
}

// armazena o tipo de conta na sessão
$_SESSION['usuario'] = $usuario_db['usuario'];
$_SESSION['tipo_conta'] = $usuario_db['tipo_conta'];

echo "Login realizado com sucesso!";
?>
