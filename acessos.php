<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pr";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $site = filter_input(INPUT_POST, 'site', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $link = filter_input(INPUT_POST, 'link', FILTER_SANITIZE_STRING);

    // Verificar se os valores não são nulos
    if ($site === null || $username === null || $password === null || $link === null) {
        die("Erro: Todos os campos do formulário são obrigatórios.");
    }

    // Usar prepared statements para evitar SQL Injection
    $stmt = $conn->prepare("INSERT INTO senhas (site, username, password, link) VALUES (?, ?, ?, ?)");
    
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ssss", $site, $username, $password, $link);

    if ($stmt->execute()) {
        echo "Password saved successfully!";
    } else {
        echo "Error executing statement: " . $stmt->error;
    }

    $stmt->close();

    // Redirecionar para a mesma página para evitar duplicação
    header("Location: acessos.php");
        exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="imagex/png" href="Imagens/logos/favicon.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="styles/acessos.css">


    <title>Cofre de Senhas</title>
</head>

<body>

    <div class="container">
        <!-- Sidebar Section -->
        <aside>
            <div class="toggle">
                <div class="logo">
                    <img src="Imagens/logos/favicon.png">
                    <h2>PR<span class="danger">Seg</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </div>
            </div>
            <div class="sidebar">
                <a href="dashboard.php" class="active">
                    <span class="material-icons-sharp">
                        dashboard
                    </span>
                    <h3>Acessos</h3>
                </a>
                <a href="interno.php">
                    <span class="material-icons-sharp">
                        contact_support
                    </span>
                    <h3>Interno</h3>
                </a>
                <a href="logout.php">
                    <span class="material-icons-sharp">
                        logout
                    </span>
                    <h3>Sair</h3>
                </a>
            </div>
        </aside>
        <!-- End of Sidebar Section -->

        <!-- Main Content -->
        <main>
            <h1>Acessos Publicos</h1>
            <!-- Analyses -->
            <form id="platformForm" method="post" action="acessos.php">
                <label for="site">Plataforma:</label>
                <input type="text" id="site" name="site" required>
    
                <label for="username">Usuário:</label>
                <input type="text" id="username" name="username" required>
    
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>
    
                <label for="Link">Link:</label>
                <input type="url" id="link" name="link" required>
    
                <button type="submit">Adicionar Plataforma</button>
                
            </form>
            <button id="openModalBtn">Show Passwords</button>
            <!-- End of Analyses -->

            <!-- Botão para abrir o modal -->
            

            <!-- Modal -->
            <div id="modal">
                <div class="modal-content">
                <span class="close">&times;</span>
                    <h2>Acessos</h2>
                    <div id="passwordList"></div>
                </div>
            </div>

            <script>
                // Abrir e fechar modal
                const modal = document.getElementById("modal");
                const btn = document.getElementById("openModalBtn");
                const span = document.getElementsByClassName("close")[0];

                btn.onclick = function() {
                    modal.style.display = "block";
                    fetchPasswords();
                }

                span.onclick = function() {
                    modal.style.display = "none";
                }

                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }

                // Função para buscar senhas
                function fetchPasswords() {
                    fetch('fetch_passwords.php')
                        .then(response => response.json())
                        .then(data => {
                            const passwordList = document.getElementById('passwordList');
                            passwordList.innerHTML = '';
                            data.forEach(password => {
                                const div = document.createElement('div');
                                div.innerHTML = `<p><b>Site:</b> ${password.site} | <b>Username:</b> ${password.username} | <b>Password:</b> ${password.password}</p>`;
                                passwordList.appendChild(div);
                            });
                        });
                }
            </script>
        </main>
        <!-- End of Main Content -->

        <!-- Right Section -->
        <div class="right-section">
            <div class="nav">
                <button id="menu-btn">
                    <span class="material-icons-sharp">
                        menu
                    </span>
                </button>
                <div class="dark-mode">
                    <span class="material-icons-sharp active">
                        light_mode
                    </span>
                    <span class="material-icons-sharp">
                        dark_mode
                    </span>
                </div>

                <div class="profile">
                    <div class="info">
                        <p>Olá, <b>Usuário</b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="Imagens/Captura de tela 2023-10-06 131926.png">
                    </div>
                </div>
            </div>
            <!-- End of Nav -->

            <div class="user-profile">
                <div class="logo">
                    <img src="Imagens/Captura de tela 2023-10-06 131926.png">
                    <h2>Usuário</h2>
                    <p>Beta Tester</p>
                </div>
            </div>
            
            <div class="reminders">
                <div class="header">
                    <h2>Lembretes</h2>
                    <span class="material-icons-sharp">
                        notifications_none
                    </span>
                </div>

                <div class="notification">
                    
                </div>

                <div class="notification deactive">

                </div>

                <div id="addReminderModal" class="additional-box">

                </div>

                <div class="notification add-reminder" id="addReminderButton" onclick="showReminderModal()">
   
                </div>
            </div>
    </div>

    <script src="acessos.js"></script>
    <script src="scripts/index.js"></script>    
</body>

</html>