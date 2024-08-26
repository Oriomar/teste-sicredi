<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sicredi</title>
    <link rel="stylesheet" href="css/login.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #ffffff;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header img {
            height: 40px;
        }

        header nav a {
            margin-left: 20px;
            text-decoration: none;
            color: #5ea52b;
            font-weight: bold;
        }

        .container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container h1 {
            color: #5ea52b;
            margin-bottom: 20px;
        }

        .container form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
        }

        .container form input {
            display: block;
            width: 90%;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .container form button {
            width: 100%;
            padding: 10px;
            background-color: #5ea52b;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .container form button:hover {
            background-color: #4c8c21;
        }

        .create-account {
            margin-top: 10px;
        }

        .create-account a {
            font-size: 12px;
            color: #5ea52b;
            text-decoration: none;
        }

        .create-account a:hover {
            text-decoration: underline;
        }

        footer {
            background-color: #f0f0f0;
            padding: 10px;
            text-align: center;
            font-size: 12px;
            width: 100%;
        }
        
        .automated-login {
            margin-top: 10px;
        }

        .automated-login button {
            width: 100%;
            padding: 10px;
            background-color: #ff9800;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .automated-login button:hover {
            background-color: #e68a00;
        }

    </style>
</head>
<body>
    <header>
    </header>

    <div class="container">
        <h1>Teste Sicredi</h1>
        <h3>Login</h3>
        <form id="loginForm" action="autenticar.php" method="POST">
            <input type="text" name="usuario" placeholder="Usuário" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar</button>
        </form>
        
        <div class="automated-login">
            <button onclick="loginAutomatizado()">Login Automatizado</button>
        </div>

        <div class="create-account">
            <a href="register.php" class="criar-conta">Criar Conta</a>
        </div>
    </div>
    
    <footer>
    </footer>

    <script>
        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        async function loginAutomatizado() {
            const usuarioInput = document.querySelector('input[name="usuario"]');
            const senhaInput = document.querySelector('input[name="senha"]');
            const form = document.getElementById('loginForm');

            usuarioInput.value = '';
            senhaInput.value = '';

            // Preencher o campo de usuário lentamente
            const usuario = 'master';
            for (let i = 0; i < usuario.length; i++) {
                usuarioInput.value += usuario[i];
                await sleep(300);  // Tempo entre cada caractere
            }

            // Preencher o campo de senha lentamente
            const senha = '@Master123';
            for (let i = 0; i < senha.length; i++) {
                senhaInput.value += senha[i];
                await sleep(300);  // Tempo entre cada caractere
            }

            // Submeter o formulário após preencher os campos
            form.submit();
        }
    </script>
</body>
</html>
