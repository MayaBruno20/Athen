<?php
session_start();

$max_users = 9;

// Lista de usuários e senhas (neste exemplo, as senhas estão armazenadas com hash)
$users = array(
    "Bruno Maia" => password_hash("M3uV10l@0123", PASSWORD_DEFAULT),
    "Igor Pinheiro" => password_hash("Igor2024$", PASSWORD_DEFAULT),
    "Gabrielle Dupim" => password_hash("Gabi2024$", PASSWORD_DEFAULT),
    // Adicione outros usuários aqui...
);

// Verifica o número de sessões ativas
$current_users = count($_SESSION['logged_users'] ?? []);

// Verifica se o número de usuários excede o limite
if ($current_users >= $max_users) {
    echo "Limite de usuários atingido. Por favor, tente novamente mais tarde.";
    exit;
}

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    header("Location: index.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validação e Sanitização das entradas de usuário
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if(isset($users[$username]) && password_verify($password, $users[$username])) {
        // Adiciona o usuário à lista de usuários logados
        $_SESSION['logged_users'][$username] = true;
        $_SESSION['logged_in'] = true;
        header("Location: interno.php");
        exit;
    } else {
        $error = "Usuário ou senha inválidos.";
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
            <form>
                <h1>Criar</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>ou use seu e-mail para se registrar</span>
                <input type="text" placeholder="Nome">
                <input type="email" placeholder="Email">
                <input type="password" placeholder="Senha">
                <button>Sign Up</button>
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
                <button type="submit">Login</button>
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