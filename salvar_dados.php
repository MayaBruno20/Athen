<?php
// Configurações do banco de dados
$servername = "localhost"; // Endereço do servidor MySQL
$username = "root"; // Nome de usuário do MySQL
$password = ""; // Senha do MySQL
$dbname = "prseg"; // Nome do banco de dados

// Parâmetros recebidos do AJAX
$data = json_decode(file_get_contents("php://input"));

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
} else {
    echo "Conexão bem sucedida"; // Mensagem de sucesso se a conexão for bem-sucedida
}

// Preparar a declaração SQL para inserir ou atualizar os dados
if ($data->id === "custo") {
    // Lidar com os dados do elemento <h2> (custo)
    $stmt = $conn->prepare("INSERT INTO custos (id, value) VALUES (?, ?) ON DUPLICATE KEY UPDATE value = VALUES(value)");
    $stmt->bind_param("ss", $data->id, $data->value);
} elseif ($data->id === "porcentagem") {
    // Lidar com os dados do elemento <h1> (porcentagem)
    $stmt = $conn->prepare("INSERT INTO porcentagens (value) VALUES (?) ON DUPLICATE KEY UPDATE value = VALUES(value)");
    $stmt->bind_param("s", $data->value);
}

// Executar a declaração SQL
if ($stmt->execute() === TRUE) {
    // Dados inseridos/atualizados com sucesso
} else {
    echo "Erro ao inserir/atualizar dados: " . $conn->error;
}

// Fechar a conexão com o banco de dados
$conn->close();

// Retornar os valores para a página
echo json_encode(array("custo" => $custo_value, "porcentagem" => $porcentagem_value));
?>