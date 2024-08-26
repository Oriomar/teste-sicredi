from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from webdriver_manager.chrome import ChromeDriverManager

# Configurações do ChromeDriver
chrome_options = Options()
chrome_options.add_argument("--disable-gpu")

# Inicializa o WebDriver, mas sem navegar para uma nova URL
driver = webdriver.Chrome(service=Service(ChromeDriverManager().install()), options=chrome_options)

# Aguardar até que o elemento de login esteja disponível
try:
    # Espera explícita até que o campo de usuário esteja presente no DOM
    print("Aguardando o carregamento da página...")
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.NAME, "usuario")))
    
    # Acessar a aba já existente e preencher o formulário de login
    print("Preenchendo o formulário de login")
    usuario = driver.find_element(By.NAME, "usuario")
    senha = driver.find_element(By.NAME, "senha")

    usuario.send_keys("master")  # Preencha com o nome de usuário
    senha.send_keys("@Master123")  # Preencha com a senha

    # Submeter o formulário
    print("Submetendo o formulário")
    senha.send_keys(Keys.RETURN)

    # Verificar se o login foi bem-sucedido
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.TAG_NAME, "h1")))
    dashboard_text = driver.find_element(By.TAG_NAME, "h1").text
    if "Dashboard" in dashboard_text:
        print("Login automatizado com sucesso!")
    else:
        print("Falha no login.")
except Exception as e:
    print("Erro durante a automação:", str(e))
finally:
    # Não fechar o navegador
    pass  # Remova o driver.quit() para manter o navegador aberto
