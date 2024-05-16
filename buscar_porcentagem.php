<?php
// Configurações do banco de dados
$servername = "localhost"; // Endereço do servidor MySQL
$username = "root"; // Nome de usuário do MySQL
$password = ""; // Senha do MySQL
$dbname = "pr"; // Nome do banco de dados

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Preparar a consulta SQL para buscar o valor da porcentagem
$sql = "SELECT value FROM porcentagens ORDER BY id DESC LIMIT 1"; // Supondo que o valor esteja na tabela 'porcentagens' e tem o ID 1

// Executar a consulta SQL
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Retornar o valor como resposta
    $row = $result->fetch_assoc();
    $valorPorcentagem = $row["value"];
    echo $valorPorcentagem;
    // Adicionando um log para verificar se o valor está sendo retornado corretamente
    file_put_contents('php://stdout', "Valor da porcentagem retornado: " . $valorPorcentagem . "\n");
} else {
    echo "0"; // Se não houver resultados, retornar 0 como valor padrão
    // Adicionando um log para verificar se a consulta está retornando zero
    file_put_contents('php://stdout', "Nenhum resultado encontrado. Retornando 0.\n");
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
