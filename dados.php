<?php
// Recupera os dados enviados pela requisição AJAX
$elementId = $_POST['elementId'];
$valor = $_POST['valor'];

// Conexão com o banco de dados
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "seu_banco_de_dados";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Prepara e executa a consulta SQL para atualizar o valor no banco de dados
$sql = "UPDATE tabela SET valor = '$valor' WHERE id = 1"; // Supondo que você tenha uma tabela chamada 'tabela' com uma coluna 'valor' que você deseja atualizar
if ($conn->query($sql) === TRUE) {
    echo "Dados atualizados com sucesso!";
} else {
    echo "Erro ao atualizar dados: " . $conn->error;
}

$conn->close();
?>
