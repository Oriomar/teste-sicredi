Projeto Sicredi
Descrição
Este projeto é um sistema de login com níveis de acesso (Administrador e Comum) e automação de login utilizando Selenium. Foi desenvolvido para demonstrar habilidades em PHP, MySQL, Python e automação de testes.

Requisitos de Sistema
XAMPP (ou outro servidor local PHP/MySQL)
Python 3.11+
Google Chrome
Configuração Inicial
Configuração do Servidor

Coloque o projeto na pasta htdocs do XAMPP.
Inicie o Apache e o MySQL no XAMPP.
Crie um banco de dados chamado sicredi.
Importe o arquivo sicredi.sql no seu banco de dados MySQL.
Configuração do Ambiente Virtual Python

Navegue até o diretório do projeto.
Crie e ative um ambiente virtual:
bash
Copiar código
python -m venv venv
source venv/Scripts/activate  # No Windows
Instale as dependências:
bash
Copiar código
pip install -r requirements.txt
Configuração do Flask

Para iniciar o servidor Flask que gerencia a automação de login:
bash
Copiar código
python app.py
Uso do Sistema
Acesso ao Sistema

Abra o navegador e acesse http://localhost/Projeto%20Sicredi/public/login.php.
Utilize as credenciais de administrador ou crie uma nova conta.
Automação de Login

Na página de login, clique no botão "Login Automatizado" para preencher automaticamente as credenciais e efetuar o login.
Estrutura do Projeto
public/: Contém os arquivos de front-end e back-end do sistema.
scripts/: Contém o código Python para automação de login.
sicredi.sql: Arquivo SQL para a configuração inicial do banco de dados.
