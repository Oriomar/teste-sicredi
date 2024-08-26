from flask import Flask
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.chrome.options import Options
from webdriver_manager.chrome import ChromeDriverManager
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time

app = Flask(__name__)

@app.route('/login_automation')
def login_automation():
    # Configurações do ChromeDriver
    chrome_options = Options()
    chrome_options.add_argument("--disable-gpu")
    
    # Inicializa o WebDriver
    driver = webdriver.Chrome(service=Service(ChromeDriverManager().install()), options=chrome_options)
    
    # Acessa a página de login
    driver.get("http://localhost/Projeto%20Sicredi/public/login.php")

    try:
        # Espera até que os campos de login estejam visíveis
        WebDriverWait(driver, 10).until(EC.visibility_of_element_located((By.NAME, "usuario")))
        
        # Preenche o formulário de login de forma lenta
        print("Preenchendo o formulário de login")
        usuario = driver.find_element(By.NAME, "usuario")
        senha = driver.find_element(By.NAME, "senha")
        
        # Simulação de digitação lenta
        for char in "master":
            usuario.send_keys(char)
            time.sleep(0.3)
        
        for char in "@Master123":
            senha.send_keys(char)
            time.sleep(0.3)
        
        # Submete o formulário
        senha.send_keys(Keys.RETURN)
        
        # Verifica se o login foi bem-sucedido
        WebDriverWait(driver, 10).until(EC.visibility_of_element_located((By.TAG_NAME, "h1")))
        print("Login automatizado com sucesso!")
        
    except Exception as e:
        print("Erro durante a automação:", str(e))
    finally:
        # Fechar o navegador
        driver.quit()
    
    return "Automação de login concluída"

if __name__ == '__main__':
    app.run(debug=True)
