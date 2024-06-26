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
    <link rel="stylesheet" href="Styles/dashboard.css">


    <title>Dashboard</title>
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
                <a href="dashboard.php" class="active">
                    <span class="material-icons-sharp">
                        dashboard
                    </span>
                    <h3>Dashboard</h3>
                </a>
                <a href="#">
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
                <a href="#">
                    <span class="material-icons-sharp">
                        insights
                    </span>
                    <h3>Analytics</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        mail_outline
                    </span>
                    <h3>Email</h3>
                    <span class="message-count">0</span>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        inventory
                    </span>
                    <h3>Vendas</h3>
                </a>
                <a href="#">
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
            <h1>Metas</h1>
            <!-- Analyses -->
            <div class="analyse">
                <div class="mouth">
                    <div class="status">
                        <div class="info">
                            <h3>Meta Mensal</h3>
                            <h1>R$</h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>0%</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sales">
                    <div class="status">
                        <div class="info">
                            <h3>Receita</h3>
                            <h1>R$</h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>0%</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="visits">
                    <div class="status">
                        <div class="info">
                            <h3>Despesas</h3>
                            <h1>R$</h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>0%</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="searches">
                    <div class="status">
                        <div class="info">
                            <h3>% Lucro</h3>
                            <h1>%</h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>+11%</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="addGraphModal" class="sales">
                    <div class="status">
                        <div class="info">
                            <h3>Adicionar Gráfico</h3>
                            <h1></h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <span class="material-icons-sharp">
                                    add
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Analyses -->

            <!-- Recent Orders Table -->
            <div class="recent-orders">
                <h2>Ponto</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nome do Funcionário</th>
                            <th>Local</th>
                            <th>Entrada</th>
                            <th>Saída</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <a href="#">Mostrar Mais</a>
            </div>
            <!-- End of Recent Orders -->

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
                    <div class="icon">
                        <span class="material-icons-sharp">
                            volume_up
                        </span>
                    </div>
                    <div class="content">
                        <div class="info">
                            <h3>Reunião</h3>
                            <small class="text_muted">
                                08:00 AM - 12:00 PM
                            </small>
                        </div>
                        <span class="material-icons-sharp">
                            more_vert
                        </span>
                    </div>
                </div>

                <div class="notification deactive">
                    <div class="icon">
                        <span class="material-icons-sharp">
                            edit
                        </span>
                    </div>
                    <div class="content">
                        <div class="info">
                            <h3>Workshop</h3>
                            <small class="text_muted">
                                13:00 PM - 15:00 PM
                            </small>
                        </div>
                        <span class="material-icons-sharp">
                            more_vert
                        </span>
                    </div>
                </div>

                <div id="addReminderModal" class="additional-box">
                    <p>Adicionar Lembrete</p>
                    <form>
                        <label for="reminderText">Texto do Lembrete:</label>
                        <input type="text" id="reminderText" required>
                
                        <label for="reminderTime">Horário do Lembrete:</label>
                        <input type="text" id="reminderTime"  required>
                
                        <button type="button" onclick="addReminder()">Adicionar</button>
                        <button class="close-box" type="button" onclick="closeReminderModal()">Fechar</button>
                    </form>
                </div>

                <div class="notification add-reminder" id="addReminderButton" onclick="showReminderModal()">
                    <div>
                        <span class="material-icons-sharp">
                            add
                        </span>
                        <h3>Adicionar Lembrete</h3>
                    </div>
                </div>
            </div>
    </div>
    <script src="scripts/funci.js"></script>
    <script src="scripts/index.js"></script>
    <script>
        // Função para exibir a caixa de adição de lembretes
        function showReminderModal() {
            const modal = document.getElementById('addReminderModal');
            modal.style.display = 'block';
        }
    
        // Função para fechar a caixa de adição de lembretes
        function closeReminderModal() {
            const modal = document.getElementById('addReminderModal');
            modal.style.display = 'none';
        }
    
        // Função para adicionar lembrete
        function addReminder() {
            // Obter o texto e o horário do lembrete
            const reminderText = document.getElementById('reminderText').value;
            const reminderTime = document.getElementById('reminderTime').value;
    
            // Verificar se ambos os campos foram preenchidos
            if (reminderText && reminderTime) {
                // Crie um novo elemento de lembrete
                const newReminder = document.createElement('div');
                newReminder.classList.add('notification');
    
                // Adicione o conteúdo do lembrete com texto e horário
                newReminder.innerHTML = `
                    <div class="icon">
                        <span class="material-icons-sharp">
                            alarm
                        </span>
                    </div>
                    <div class="content">
                        <div class="info">
                            <h3>${reminderText}</h3>
                            <small class="text-muted">
                                ${reminderTime}
                            </small>
                        </div>
                        <span class="material-icons-sharp">
                            more_vert
                        </span>
                    </div>
                `;
    
                // Adicione o novo lembrete à lista de lembretes
                const remindersContainer = document.querySelector('.right-section .reminders');
                remindersContainer.insertBefore(newReminder, document.getElementById('addReminderButton'));
    
                // Feche a caixa de adição de lembretes
                closeReminderModal();
            } else {
                alert('Por favor, preencha ambos os campos.');
            }
        }

    </script>
    
</body>

</html>