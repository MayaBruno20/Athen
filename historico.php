<?php
session_start();

if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != true) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="imagex/png" href="Imagens/1_PR-SEG_preferencial.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="styles/historico.css">

    <title>Configurações</title>
</head>

<body>

    <div class="container">
        <!-- Sidebar Section -->
        <aside>
            <div class="toggle">
                <div class="logo">
                    <img src="Imagens/1_PR-SEG_preferencial.png">
                    <h2>PR<span class="danger">Seg</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </div>
            </div>

            <div class="sidebar">
                <a href="dashboard.php">
                    <span class="material-icons-sharp">
                        dashboard
                    </span>
                    <h3>Dashboard</h3>
                </a>
                <a href="usuarios.php">
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <h3>Usuarios</h3>
                </a>
                <a href="historico.php"  class="active">
                    <span class="material-icons-sharp">
                        receipt_long
                    </span>
                    <h3>Historico</h3>
                </a>
                <a href="analitycs.php">
                    <span class="material-icons-sharp">
                        insights
                    </span>
                    <h3>Analytics</h3>
                </a>
                <a href="email.php">
                    <span class="material-icons-sharp">
                        mail_outline
                    </span>
                    <h3>Email</h3>
                    <span class="message-count">0</span>
                </a>
                <a href="vendas.php">
                    <span class="material-icons-sharp">
                        inventory
                    </span>
                    <h3>Vendas</h3>
                </a>
                <a href="relatorios.php">
                    <span class="material-icons-sharp">
                        report_gmailerrorred
                    </span>
                    <h3>Relatórios</h3>
                </a>
                <a href="configuracoes.php">
                    <span class="material-icons-sharp">
                        settings
                    </span>
                    <h3>Configurações</h3>
                </a>
                <a href="interno.php">
                    <span class="material-icons-sharp">
                        contact_support
                    </span>
                    <h3>Interno</h3>
                </a>
                <a href="index.php">
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
            <!-- New Users Section -->
            <div class="recent-orders">
                <h2>Histórico</h2>
                
                <table>
                    <thead>
                        <tr>
                            <th>Nome do Produto</th>
                            <th>Número do Produto</th>
                            <th>Pagamentos</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <a href="#">Mostrar Mais</a>
            </div>
            <!-- End of New Users Section -->
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
 <!-- Adicione este código HTML para a barra de pesquisa -->
 <div class="search-bar">
    <input type="text" id="search-input" placeholder="Pesquisar...">
    <button id="search-button" onclick="performSearch()">
        <span class="material-icons-sharp">search</span>
    </button>
</div>

            <div class="reminders">
                <div class="header">
                    <h2>Filtros</h2>
                    <span class="material-icons-sharp">
                        tune
                    </span>
                </div>

                <div class="notification">
                    <div class="icon">
                        <span class="material-icons-sharp">
                            directions_car
                        </span>
                    </div>
                    <div class="content">
                        <div class="info">
                            <h3>Consórcios</h3>
                            <small class="text_muted">
                                Editar
                            </small>
                        </div>
                        <span class="material-icons-sharp">
                            
                        </span>
                    </div>
                </div>

                <div class="notification deactive">
                    <div class="icon">
                        <span class="material-icons-sharp">
                            account_balance
                        </span>
                    </div>
                    <div class="content">
                        <div class="info">
                            <h3>Financiamentos</h3>
                            <small class="text_muted">
                                Editar
                            </small>
                        </div>
                        <span class="material-icons-sharp">
                            
                        </span>
                    </div>
                </div>
                
                <div class="notification reactive">
                    <div class="icon" id="icone">
                        <span class="material-icons-sharp">
                            shield
                        </span>
                    </div>
                    <div class="content">
                        <div class="info">
                            <h3>Seguros</h3>
                            <small class="text_muted">
                                Editar
                            </small>
                        </div>
                        <span class="material-icons-sharp">
                            
                        </span>
                    </div>
                </div>

                <div class="notification add-reminder">
                    <div>
                        <span class="material-icons-sharp">
                            add
                        </span>
                        <h3>Adicionar Filtros</h3>
                </div>

            </div>
        </div>
    </div>
<!-- Adicione este bloco de código JavaScript ao final do seu arquivo HTML -->
<script>
    // Função para realizar a pesquisa
    function performSearch() {
        // Obtém o valor do campo de pesquisa
        var searchTerm = document.getElementById('search-input').value.toLowerCase();

        // Obtém todas as linhas da tabela de histórico
        var rows = document.querySelectorAll('.recent-orders table tbody tr');

        // Itera sobre as linhas e exibe ou oculta com base no conteúdo da pesquisa
        rows.forEach(function (row) {
            var cells = row.getElementsByTagName('td');
            var found = false;

            // Itera sobre as células da linha e verifica se alguma contém o termo de pesquisa
            for (var i = 0; i < cells.length; i++) {
                var cellText = cells[i].textContent.toLowerCase();
                if (cellText.includes(searchTerm)) {
                    found = true;
                    break;
                }
            }

            // Exibe ou oculta a linha com base no resultado da pesquisa
            row.style.display = found ? '' : 'none';
        });
    }
</script>

    <script src="scripts/historico.js"></script>
    <script src="scripts/index.js"></script>
    
</body>

</html>