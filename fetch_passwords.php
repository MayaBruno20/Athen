<?php
// Ativar exibição de erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
// Consulta para selecionar todas as senhas
$query = "SELECT site, username, password FROM senhas";
$result = mysqli_query($conn, $query);

$passwords = [];

// Verificar se a consulta foi bem-sucedida
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $passwords[] = $row;
    }
} else {
    echo "Erro ao executar consulta: " . mysqli_error($conn);
    exit;
}

// Retornar os dados em formato JSON
header('Content-Type: application/json');
echo json_encode($passwords);
?>
