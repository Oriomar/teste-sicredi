<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'login':
        include 'login.php';
        break;
    case 'home':
        include 'home.php';
        break;
    default:
        echo "Página não encontrada";
        break;
}
?>
