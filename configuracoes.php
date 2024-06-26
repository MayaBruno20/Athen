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
    <meta name="google-site-verification" content="KhjEOl3uyftknX8r3vDAjFb7_2mt2_VXSZfZyhtyJd4" />
    <link rel="shortcut icon" type="imagex/png" href="Imagens/1_PR-SEG_preferencial.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="styles/configuracoes.css">

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
                <a href="configuracoes.php" class="active">
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
            <h1>Configurações</h1>
            
            <div id="manageProfile-box" class="additional-box" style="display: none;">
                <!-- Content for "Manage Profile" box -->
                    <form id="profile-form">
                        <label for="username">Nome de usuário:</label>
                        <input type="text" id="username" name="username" required>
                
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email" required>
                
                        <label for="bio">Biografia:</label>
                        <textarea id="bio" name="bio" rows="4"></textarea>
                
                        <label for="profile-picture">Trocar Foto de Perfil:</label>
                        <input type="file" id="profile-picture" name="profile-picture" accept="image/*">

                        <button type="submit">Salvar</button>
                        <button class="close-box">Fechar</button>
                    </form> 
            </div>
            <div id="languages-box" class="additional-box" style="display: none;">
                <form>
                    <div>
                        <label for="language">Linguagem:</label>
                        <select id="language" name="language">
                            <option value="pt">Português</option>
                            <option value="en">English</option>
                            <option value="es">Español</option>
                            <!-- Add more language options as needed -->
                        </select>
                    </div>
                    <div>
                        <label for="timezone">Fuso-Horário</label>
                        <select id="timezone" name="timezone">
                            <option value="utc">UTC</option>
                            <option value="gmt">GMT</option>
                            <!-- Add more timezone options as needed -->
                        </select>
                    </div>
                    <button type="submit">Salvar</button>
                    <button type="button" class="close-box">Fechar</button>
                </form>
            </div>
            <div id="notification-box" class="additional-box" style="display: none;">
                <form id="notification-form">
                    <label for="email-notifications">Receber notificações por e-mail:</label>
                    <input type="checkbox" id="email-notifications" name="email-notifications">
            
                    <label for="mobile-notifications">Receber notificações no celular:</label>
                    <input type="checkbox" id="mobile-notifications" name="mobile-notifications">
            
                    <label for="push-notifications">Ativar notificações push:</label>
                    <input type="checkbox" id="push-notifications" name="push-notifications">
            
                    <label for="frequency">Frequência de notificações:</label>
                    <select id="frequency" name="frequency">
                        <option value="immediately">Imediatamente</option>
                        <option value="daily">Diariamente</option>
                        <option value="weekly">Semanalmente</option>
                    </select>
            
                    <button type="submit">Salvar Configurações</button>
                    <button type="button" class="close-box">Fechar</button>
                </form>
            </div>
            <div id="integration-box" class="additional-box" style="display: none;">
                <!-- Content for "Languages" box -->
                <form>
                    <label for="apiKey">Chave da API:</label>
                    <input type="text" id="apiKey" name="apiKey" placeholder="Insira sua chave da API">
        
                    <label for="permissions">Permissões:</label>
                    <select id="permissions" name="permissions">
                        <option value="read">Leitura</option>
                        <option value="write">Escrita</option>
                        <option value="readWrite">Leitura e Escrita</option>
                    </select>
        
                    <button type="submit">Salvar Configurações</button>
                    <button type="button" class="close-box">Fechar</button>
                </form>
        
                <div id="permissions-management">
                    <h3>Gerenciamento de Permissões</h3>
        
                    <!-- Lista de permissões com opções de remoção -->
                    <ul>
                        <li>
                            <span>Leitura</span>
                            <button class="revoke-permission">Revogar</button>
                        </li>
                        <li>
                            <span>Escrita</span>
                            <button class="revoke-permission">Revogar</button>
                        </li>
                    </ul>
                </div>
        
            </div>

            <div id="security-box" class="additional-box" style="display: none;">
                <form id="security-form">
                    <label for="current-password">Senha Atual:</label>
                    <input type="password" id="current-password" name="current-password" required>
            
                    <label for="new-password">Nova Senha:</label>
                    <input type="password" id="new-password" name="new-password" required>
            
                    <label for="confirm-password">Confirmar Nova Senha:</label>
                    <input type="password" id="confirm-password" name="confirm-password" required>
            
                    <label for="two-factor-auth">Autenticação de Dois Fatores:</label>
                    <select id="two-factor-auth" name="two-factor-auth">
                        <option value="enabled">Habilitada</option>
                        <option value="disabled">Desabilitada</option>
                    </select>
                    <button type="submit">Salvar Configurações</button>
                </form>
                <div id="account-activity">
                    <h3>Atividade da Conta</h3>
                    <p>Último login: 2024-01-12 10:30 AM</p>
                    <button id="logout-btn">Encerrar Sessão</button>
                </div>
            </div>
            
            <div id="acessi-box" class="additional-box" style="display: none;">
                <!-- Content for "Languages" box -->
                <form id="accessibility-form">
                    <label for="font-size">Tamanho da Fonte:</label>
                    <select id="font-size" name="font-size">
                        <option value="small">Pequeno</option>
                        <option value="medium">Médio</option>
                        <option value="large">Grande</option>
                    </select>
            
                    <label for="contrast">Contraste:</label>
                    <select id="contrast" name="contrast">
                        <option value="normal">Normal</option>
                        <option value="high">Alto</option>
                    </select>
            
                    <label for="text-spacing">Espaçamento de Texto:</label>
                    <select id="text-spacing" name="text-spacing">
                        <option value="normal">Normal</option>
                        <option value="wide">Largo</option>
                    </select>
            
                    <button type="submit">Salvar</button>
                    <button type="button" class="close-box">Fechar</button>
                </form>
            </div>
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

            <div class="reminders">
                <div class="header">
                    <h2>Configurações</h2>
                    <span class="material-icons-sharp toggle-btn" onclick="toggleSettings()">
                        tune
                    </span>
                </div>
            
                <div class="settings-content" style="display: none;">
                    <div class="notification">
                        <div class="icon">
                            <span  id="manageProfile"  class="material-icons-sharp">
                                edit
                            </span>
                        </div>
                        <div class="content">
                            <div class="info">
                                <h3>Gerenciar Perfil</h3>
                                <small class="text_muted">
                                    Editar
                                </small>
                            </div>
                            <span id="manageProfile" class="material-icons-sharp">
                                add
                            </span>
                        </div>
                    </div>
            
                    <div class="notification deactive">
                        <div class="icon" id="langua">
                            <span id="languages" class="material-icons-sharp">
                                language
                            </span>
                        </div>
                        <div class="content">
                            <div class="info">
                                <h3>Idiomas e Região</h3>
                                <small class="text_muted">
                                    Editar
                                </small>
                            </div>
                            <span id="languages" class="material-icons-sharp">
                                add
                            </span>
                        </div>
                    </div>
            
                    <div class="notification deactive">
                        <div class="icon" id="vol">
                            <span id="notification" class="material-icons-sharp">
                                volume_up
                            </span>
                        </div>
                        <div class="content">
                            <div class="info">
                                <h3>Notificações</h3>
                                <small class="text_muted">
                                    Editar
                                </small>
                            </div>
                            <span id="notification" class="material-icons-sharp">
                                add
                            </span>
                        </div>
                    </div>

                    <div class="notification">
                        <div class="icon" id="int">
                            <span id="integration" class="material-icons-sharp">
                                integration_instructions
                            </span>
                        </div>
                        <div class="content">
                            <div class="info">
                                <h3>Integrações de Terceiros</h3>
                                <small class="text_muted">
                                    Editar
                                </small>
                            </div>
                            <span id="integration" class="material-icons-sharp">
                                add
                            </span>
                        </div>
                    </div>
            
                    <div class="notification">
                        <div class="icon" id="seg">
                            <span id="security" class="material-icons-sharp">
                                security
                            </span>
                        </div>
                        <div class="content">
                            <div class="info">
                                <h3>Segurança e Privacidade</h3>
                                <small class="text_muted">
                                    Editar
                                </small>
                            </div>
                            <span id="security" class="material-icons-sharp">
                                add
                            </span>
                        </div>
                    </div>
                    <div class="notification deactive">
                        <div class="icon" id="langua">
                            <span id="acessi" class="material-icons-sharp">
                                settings_accessibility
                            </span>
                        </div>
                        <div class="content">
                            <div class="info">
                                <h3>Acessibilidade</h3>
                                <small class="text_muted">
                                    Editar
                                </small>
                            </div>
                            <span id="acessi" class="material-icons-sharp">
                                add
                            </span>
                        </div>
                    </div>
                    <!-- Adicione quantos botões de configurações extras desejar -->
                </div>
            </div>
    </div>
    <script src="scripts/links.js"></script>
    <script src="scripts/index.js"></script>
    <script>
        function toggleSettings() {
            var settingsContent = document.querySelector('.settings-content');
            settingsContent.style.display = (settingsContent.style.display === 'none' || settingsContent.style.display === '') ? 'block' : 'none';
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const integrationForm = document.querySelector('#integration-box form');
            const permissionsManagement = document.querySelector('#permissions-management ul');
    
            integrationForm.addEventListener('submit', function (event) {
                event.preventDefault();
    
                const apiKey = document.querySelector('#apiKey').value;
                const selectedPermission = document.querySelector('#permissions').value;
    
                // Salve suas configurações (simulação)
                console.log('Configurações salvas:');
                console.log('Chave da API:', apiKey);
                console.log('Permissão:', selectedPermission);
    
                // Adicione a permissão à lista de gerenciamento
                addPermissionToList(selectedPermission);
            });
    
            function addPermissionToList(permission) {
                const listItem = document.createElement('li');
                listItem.innerHTML = `
                    <span>${permission}</span>
                    <button class="revoke-permission">Revogar</button>
                `;
    
                permissionsManagement.appendChild(listItem);
    
                // Adicione um ouvinte de evento para o botão de revogação
                const revokeButton = listItem.querySelector('.revoke-permission');
                revokeButton.addEventListener('click', function () {
                    // Remova a permissão da lista (simulação)
                    console.log('Permissão revogada:', permission);
                    listItem.remove();
                });
            }
        });
    </script>
    
</body>

</html>