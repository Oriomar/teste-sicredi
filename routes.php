<?php
require 'app/Controllers/UserController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/');

switch ($uri) {
    case '':
    case '/':
        $controller = new UserController();
        echo $controller->home();
        break;
    case '/login':
        $controller = new UserController();
        echo $controller->login();
        break;
    case '/register':
        $controller = new UserController();
        echo $controller->register();
        break;
    case '/dashboard':
        $controller = new UserController();
        echo $controller->dashboard();
        break;
    default:
        echo 'Página não encontrada';
        break;
}
?>
