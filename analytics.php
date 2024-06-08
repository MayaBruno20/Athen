<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="imagex/png" href="Imagens/1_PR-SEG_preferencial.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="styles/analytics.css">
    <title>Analytics</title>
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
                <a href="historico.php">
                    <span class="material-icons-sharp">
                        receipt_long
                    </span>
                    <h3>Historico</h3>
                </a>
                <a href="analytics.php"  class="active">
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
            <h1>Analytics</h1>
            <!-- Analyses -->
            <div class="analyse">
                <div class="sales">
                    <div class="status">
                        <div class="info">
                            <h3>Editar</h3>
                            <h1>0</h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>0</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="visits">
                    <div class="status">
                        <div class="info">
                            <h3>Visitas</h3>
                            <h1>0</h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>0</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="searches">
                    <div class="status">
                        <div class="info">
                            <h3>Pesquisas</h3>
                            <h1>0</h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>0</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Analyses -->

            <!-- New Users Section -->
            <div class="analyses">
                <h2>Novos Usuários</h2>
                <div class="list-one">

                </div>
            </div>
            <!-- End of New Users Section -->

            <!-- Recent Orders Table -->
            <div class="recent-orders">
                <h2>Ordens Recentes</h2>
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
                        <p>Olá, <b>Bruno</b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="Imagens/361350828_821246702820575_4265328400129953631_n.jpg">
                    </div>
                </div>

            </div>
            <!-- End of Nav -->

            <div class="user-profile">
                <div class="logo">
                    <img src="Imagens/361350828_821246702820575_4265328400129953631_n.jpg">
                    <h2>Bruno Maia</h2>
                    <p>Desenvolvedor FullStack</p>
                </div>
            </div>

            <div class="reminders">
                <div class="header">
                    <h2>Reminders</h2>
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
    </div>
    <script src="scripts/index.js"></script> 
</body>

</html>