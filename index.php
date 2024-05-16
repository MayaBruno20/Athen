<?php
// Redireciona para HTTPS se não estiver usando
if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off"){
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
}

session_start();

$max_users = 9;
$max_login_attempts = 5; // Definindo o número máximo de tentativas de login permitidas
$reset_time = 60 * 5; // Tempo em segundos para redefinir o contador de tentativas (aqui, 5 minutos)

// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica erros na conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    header("Location: index.php");
    exit;
}

// Função para criar hash seguro da senha
function criarHashSenha($senha) {
    return password_hash($senha, PASSWORD_DEFAULT);
}

// Função para verificar se o usuário existe e a senha está correta
function verificarLogin($conn, $username, $password) {
    // Consulta preparada para buscar usuário no banco de dados
    $stmt = $conn->prepare("SELECT username, password FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    if($row && password_verify($password, $row['password'])) {
        return true; // Usuário e senha corretos
    } else {
        return false; // Usuário ou senha incorretos
    }
}

// Validação e processamento do formulário de login
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Validação e Sanitização das entradas de usuário
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Verifica se o usuário e a senha estão corretos
    if(verificarLogin($conn, $username, $password)) {
        // Define a sessão como logada
        $_SESSION['logged_in'] = true;
        header("Location: interno.php"); // Redireciona para a página principal após o login
        exit;
    } else {
        $error = "Usuário ou senha inválidos.";

        // Incrementa o contador de tentativas de login (pode ser usado para limitar o número de tentativas)
        $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;
        
    }
}

// Validação e processamento do formulário de cadastro
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING);

    // Verifica se a senha e a confirmação de senha coincidem
    if($password !== $confirm_password) {
        $error = "As senhas não coincidem.";
    } else {
        // Consulta preparada para verificar se o nome de usuário ou email já estão em uso
        $stmt_check_user = $conn->prepare("SELECT username, email FROM usuarios WHERE username = ? OR email = ?");
        $stmt_check_user->bind_param("ss", $username, $email);
        $stmt_check_user->execute();
        $result_check_user = $stmt_check_user->get_result();
        $existing_user = $result_check_user->fetch_assoc();
        if($existing_user) {
            $error = "Nome de usuário ou email já estão em uso.";
        } else {
            // Insira o novo usuário no banco de dados
            $hashed_password = criarHashSenha($password);
            $stmt_insert_user = $conn->prepare("INSERT INTO usuarios (username, email, password) VALUES (?, ?, ?)");
            $stmt_insert_user->bind_param("sss", $username, $email, $hashed_password);
            if($stmt_insert_user->execute()) {
                $success = "Usuário cadastrado com sucesso!";
            } else {
                $error = "Erro ao cadastrar usuário. Por favor, tente novamente.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="shortcut icon" href="Imagens/1_PR-SEG_preferencial.png">
    <link rel="stylesheet" href="styles/login.css">
    <title>Login</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h1>Criar</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>ou use seu e-mail para se registrar</span>
                <input type="text" name="username" placeholder="Nome de Usuário" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Senha" required>
                <input type="password" name="confirm_password" placeholder="Confirmar Senha" required>
                <?php if(isset($error)) { ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php } ?>
                <?php if(isset($success)) { ?>
                    <p class="success"><?php echo $success; ?></p>
                <?php } ?>
                <button type="submit" name="signup">Registrar</button>
                <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">Já possui uma conta? Faça login aqui</a>
            </form>
        </div>

        <div class="form-container sign-in">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h1>Entrar</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>ou use seu email e senha</span>
                <?php if(isset($error)) { ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php } ?>
                <input type="text" name="username" placeholder="Nome de Usuário" required>
                <input type="password" name="password" placeholder="Senha" required>
                <a class="a" href="senha.html">Esqueceu sua senha?</a>
                <button type="submit" name="login">Login</button>
            </form>
        </div>

        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Bem Vindo!</h1>
                    <p>Entre com seus dados para ter acesso à plataforma!</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Central do Colaborador</h1>
                    <p>Não tem uma conta? Registre seus dados para ter acesso!</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
        
    </div>

    <script>
        // Seleciona o elemento HTML com o id 'container' e os botões de registro e login
        const container = document.getElementById('container');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');

        // Adiciona um ouvinte de evento para o botão de registro
        registerBtn.addEventListener('click', () => {
            // Adiciona a classe 'active' ao elemento 'container' para exibir o formulário de registro
            container.classList.add("active");
        });

        // Adiciona um ouvinte de evento para o botão de login
        loginBtn.addEventListener('click', () => {
            // Remove a classe 'active' do elemento 'container' para exibir o formulário de login
            container.classList.remove("active");
        });
    </script>
    
</body>

</html>
