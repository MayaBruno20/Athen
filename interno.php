<?php
session_start();

if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != true) {
    header("Location: index.php");
    exit;
}

$user_name = $_SESSION['user_name']
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="imagex/png" href="Imagens/logos/favicon.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="styles/interno.css">

    <title>Interno</title>
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
                <a href="historico.php">
                    <span class="material-icons-sharp">
                        receipt_long
                    </span>
                    <h3>Historico</h3>
                </a>
                <a href="analytics.php">
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
                <a href="interno.php"  class="active">
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
            <h1>Interno</h1>
            <div class="folders">
                <div class="creatives">
                    <div class="status">
                        <div class="info">
                            <h3>Meta Mensal</h3>
                            <h2 id="custo" onClick="makeEditable(this)">R$0</h2>
                        </div>

                        <div class="circleBtn">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                                </svg>
                            <div class="addBtn">
                                <h1 id="porcentagem" onClick="makeEditablePorcentagem(this)">0%</h1>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="backup">
                    <div class="status">
                        <div class="info">
                            <h3>Comissão</h3>
                            <h2>R$22.000</h2>
                        </div>
                        <div class="circleBtn">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="addBtn">
                                <h1>0%</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="requests">
                    <div class="status">
                        <div class="info">
                            <h3>Athen</h3>
                            <h2></h2>
                        </div>

                        <div class="circleBtn">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="addBtn">
                                <h1>60%</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="one-half column">
                    <div class="links-list">
                        <h1>Ponto Digital</h1>
                        <div id="registerForm">
                            <label for="employeeName">Nome do Funcionário:</label>
                            <input type="text" id="employeeName" value="<?php echo $user_name; ?>" disabled>
                                
                            <label for="delayReason">Motivo do Atraso:</label>
                            <input type="text" id="delayReason" placeholder="Informe o motivo do atraso (opcional)">
                                
                            <button onclick="registerAttendance()" aria-label="Registrar Ponto">Registrar Ponto</button>
                            <button class="btn" onclick="registerLunchBreak()" aria-label="Registrar Ponto de Almoço">Registrar Ponto de Almoço</button>
                        </div>
                    </div>    

                    <div class="early-out">
                        <h2>Solicitar Saída Antecipada</h2>
                        <label for="earlyOutReason">Motivo:</label>
                        <input type="text" id="earlyOutReason" placeholder="Informe o motivo da saída antecipada">
                        <button onclick="requestEarlyOut()" aria-label="Solicitar Saída">Solicitar Saída</button>
                        <button id="historyBtn">Ver Histórico Completo</button>
                    </div>
                </div>

                <div class="one-half column">
                    <div class="links-list">
                        <h2>Registros</h2>
                        <ul id="logList"></ul>  

                    </div>
                </div>
                
            </div>
        </main>
        <!-- End of Main Content -->

        <div id="historyModal" class="modal">
            <div class="modal-content">
                <span class="close"></span>
                <h2>Histórico Completo de Registros</h2>
                <ul id="fullLogList"></ul>
            </div>
        </div>

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

            <div class="options">
                <div class="header">
                    <h1>Disco Virtual (Bloqueado)</h1>
                    <span class="material-icons-sharp toggle-btn" onclick="toggleSettings()">
                        tune
                    </span>
                </div>
                
                <div class="settings-content" style="display: none;">
                    <div class="notification">
                        <div class="icon">
                            <span  id="manageProfile"  class="material-icons-sharp">
                                backup
                            </span>
                        </div>

                        <div class="content">
                            <div class="info">
                                <h3>Backup</h3>
                            </div>
                            <span id="manageProfile" class="material-icons-sharp">
                                cloud_download
                            </span>
                        </div>
                    </div>
                
                    <div class="notification deactive">
                        <div class="icon" id="langua">
                            <span id="languages" class="material-icons-sharp">
                                design_services
                            </span>
                        </div>

                        <div class="content">
                            <div class="info">
                                <h3>Criativos</h3>
                                <small class="text_muted">
                                    Editar
                                </small>
                            </div>

                            <span class="material-icons-sharp">
                                <a href="https://drive.google.com/drive/folders/1_yyjXr8pCBFlGvIN9oxxXupLAbGjVcE4?usp=sharing" target="_blank">
                                cloud_download
                                </a>
                            </span>
                        </div>

                    </div>
                
                    <div class="notification deactive">
                        <div class="icon" id="vol">
                            <span id="notification" class="material-icons-sharp">
                                support_agent
                            </span>
                        </div>

                        <div class="content">
                            <div class="info">
                                <h3>Suporte</h3>
                                <small class="text_muted">
                                    Editar
                                </small>
                            </div>
                            <span id="notification" class="material-icons-sharp">
                                forward_to_inbox
                            </span>
                        </div>
                    </div>

                    <div class="notification deactive">
                        <div class="icon">
                            <span class="material-icons-sharp">
                                lock
                            </span>
                        </div>

                        <div class="content">
                            <div class="info">
                                <h3>Acessos</h3>
                            </div>
                            <span class="material-icons-sharp">
                                <a href="acessos.php">
                                    key
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Define o nome do funcionário logado
        const loggedInEmployeeName = "<?php echo $user_name; ?>";

        // Modal functionality
document.addEventListener('DOMContentLoaded', (event) => {
    const modal = document.getElementById("historyModal");
    const btn = document.getElementById("historyBtn");
    const span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
        modal.style.display = "block";
        loadFullAttendanceLog();
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});

// Função para carregar o histórico completo de registros na caixa flutuante
function loadFullAttendanceLog() {
    console.log('Chamando loadFullAttendanceLog'); // Log de depuração
    const fullLogList = document.getElementById('fullLogList');
    if (!fullLogList) {
        console.error('Elemento fullLogList não encontrado');
        return;
    }
    fullLogList.innerHTML = '';

    // Requisição AJAX para buscar todos os registros do backend
    fetch('backend.php?action=getFullAttendanceRecords')
        .then(response => {
            console.log(response); // Log da resposta
            return response.json();
        })
        .then(records => {
            console.log(records); // Log dos registros
            records.forEach(record => {
                const listItem = document.createElement('li');
                let recordText = `${record.employee_name} - ${record.timestamp}`;

                if (record.delay_reason) {
                    recordText += ` - Motivo: ${record.delay_reason}`;
                }

                listItem.textContent = recordText;
                fullLogList.appendChild(listItem);
            });
        })
        .catch(error => {
            console.error('Erro ao recuperar registros:', error);
        });
}
    </script>
    
    <script>
        function toggleSettings() {
            var settingsContent = document.querySelector('.settings-content');
                settingsContent.style.display = (settingsContent.style.display === 'none' || settingsContent.style.display === '') ? 'block' : 'none';
        }        
    </script>
    
    <script src="scripts/index.js"></script>
    <script src="scripts/main.js"></script>
    
</body>

</html>