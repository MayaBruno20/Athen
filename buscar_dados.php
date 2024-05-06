<?php
// Configurações do banco de dados
$servername = "localhost"; // Endereço do servidor MySQL
$username = "root"; // Nome de usuário do MySQL
$password = ""; // Senha do MySQL
$dbname = "test"; // Nome do banco de dados

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
} 

// Preparar a consulta SQL para buscar o valor do banco de dados
$sql = "SELECT value FROM custos ORDER BY id DESC LIMIT 1"; // Supondo que o valor esteja na tabela 'custos' e tem o ID 1

// Executar a consulta SQL
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Retornar o valor como resposta
    $row = $result->fetch_assoc();
    echo $row["value"];
} else {
    echo "0"; // Se não houver resultados, retornar 0 como valor padrão
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
