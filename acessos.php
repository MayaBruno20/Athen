<?php
// Verifica se os dados foram enviados via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco de dados (substitua os valores conforme necessário)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "prseg";

    // Cria a conexão
    $conn = new mysqli($servername, $username, $password, $database);

    // Verifica se a conexão foi estabelecida com sucesso
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Obtém os dados enviados via POST
    $platform = $_POST["platform"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Prepara a instrução SQL para inserir ou atualizar os dados
    $sql = "INSERT INTO dados_plataforma (platform, email, senha) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE email = VALUES(email), senha = VALUES(senha)";
    
    // Prepara a declaração
    $stmt = $conn->prepare($sql);

    // Liga os parâmetros à declaração
    $stmt->bind_param("sss", $platform, $email, $senha);

    // Executa a declaração
    if ($stmt->execute()) {
        echo "Dados salvos com sucesso.";
    } else {
        echo "Erro ao salvar os dados: " . $conn->error;
    }

    // Fecha a declaração e a conexão
    $stmt->close();
    $conn->close();
} else {
    // Se os dados não foram enviados via POST, retorna uma mensagem de erro
    echo "Erro: Método inválido.";
}
?>
