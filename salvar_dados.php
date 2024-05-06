<?php
// Configurações do banco de dados
$servername = "localhost"; // Endereço do servidor MySQL
$username = "root"; // Nome de usuário do MySQL
$password = ""; // Senha do MySQL
$dbname = "test"; // Nome do banco de dados

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
    echo "Dados inseridos/atualizados com sucesso";
} else {
    echo "Erro ao inserir/atualizar dados: " . $conn->error;
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
$stmt->close();
$conn->close();
?>