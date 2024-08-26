<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Sicredi</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    <div class="container">
        <h1>Criar Conta</h1>
        <?php
        session_start();
        if (isset($_SESSION['sucesso'])) {
            echo '<div id="modalSucesso" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <p>Conta criada com sucesso!</p>
                    </div>
                  </div>';
            unset($_SESSION['sucesso']);
        }
        ?>
        <form action="process_register.php" method="POST" onsubmit="return validarFormulario()">
            <label for="tipo_conta">Tipo de Conta:</label>
            <select name="tipo_conta" id="tipo_conta" required>
                <option value="comum">Comum</option>
                <option value="administrador">Administrador</option>
            </select>
            <input type="text" name="usuario" placeholder="Usuário" required>
            <input type="password" name="senha" placeholder="Senha" id="senha" required oninput="avaliarSenha()">
            <input type="password" name="confirmar_senha" placeholder="Confirmar Senha" id="confirmar_senha" required>
            
            <div class="progress-container">
                <div class="progress-bar">
                    <div class="progress-fill" id="progress-fill"></div>
                </div>
                <div class="strength-label" id="strength-label">Muito fácil</div>
                <span class="strength-icon" id="strength-icon">&#x2714;</span> <!-- Ícone de verificação -->
            </div>
            
            <button type="submit">Registrar</button>
        </form>
        <p><a href="login.php">Voltar</a></p>
    </div>

    <footer>
        
    </footer>

    <script>
        // Func para avaliar a força da senha
        function avaliarSenha() {
            var senha = document.getElementById("senha").value;
            var progressContainer = document.querySelector('.progress-container');
            var progressFill = document.getElementById("progress-fill");
            var strengthLabel = document.getElementById("strength-label");
            var strengthIcon = document.getElementById("strength-icon");

            // exibe a barra de progresso 
            if (senha.length > 0) {
                progressContainer.style.display = 'block';
            } else {
                progressContainer.style.display = 'none';
            }

            // verificação de força de senha
            var forca = 0;

            // critérios de verificação de senha
            if (senha.length >= 8) forca++; 
            if (/[A-Z]/.test(senha)) forca++; 
            if (/[a-z]/.test(senha)) forca++; 
            if (/[0-9]/.test(senha)) forca++; 
            if (/[^A-Za-z0-9]/.test(senha)) forca++; 

            // verificar repetição de caracteres
            var caracteresRepetidos = /(.)\1{2,}/.test(senha); 
            if (caracteresRepetidos) forca = 0;

            // atualização visual da barra de progresso e label
            switch (forca) {
                case 0:
                    progressFill.style.width = "0";
                    progressFill.style.backgroundColor = "red";
                    strengthLabel.textContent = "Muito fácil";
                    strengthIcon.classList.remove("visible");
                    break;
                case 1:
                    progressFill.style.width = "25%";
                    progressFill.style.backgroundColor = "orange";
                    strengthLabel.textContent = "Fácil";
                    strengthIcon.classList.remove("visible");
                    break;
                case 2:
                    progressFill.style.width = "50%";
                    progressFill.style.backgroundColor = "yellow";
                    strengthLabel.textContent = "Média";
                    strengthIcon.classList.remove("visible");
                    break;
                case 3:
                    progressFill.style.width = "75%";
                    progressFill.style.backgroundColor = "lightgreen";
                    strengthLabel.textContent = "Boa";
                    strengthIcon.classList.remove("visible");
                    break;
                case 4:
                case 5:
                    progressFill.style.width = "100%";
                    progressFill.style.backgroundColor = "green";
                    strengthLabel.textContent = "Difícil";
                    strengthIcon.classList.add("visible");
                    break;
            }
        }

        // func para validar o formulário
        function validarFormulario() {
            var senha = document.getElementById("senha").value;
            var confirmarSenha = document.getElementById("confirmar_senha").value;

            if (senha.length < 8) {
                alert("A senha deve ter pelo menos 8 caracteres.");
                return false;
            }

            var caracteresRepetidos = /(.)\1{2,}/.test(senha); 
            if (caracteresRepetidos) {
                alert("A senha não pode conter 3 ou mais caracteres repetidos consecutivos.");
                return false;
            }

            if (senha !== confirmarSenha) {
                alert("As senhas não coincidem.");
                return false;
            }

            return true; 
        }

        // Modal de sucesso
        var modal = document.getElementById("modalSucesso");
        if (modal) {
            modal.style.display = "block"; 

            var closeModal = document.querySelector(".close");
            closeModal.onclick = function() {
                modal.style.display = "none";
                window.location.href = 'login.php'; 
            };
        }
    </script>
</body>
</html>
