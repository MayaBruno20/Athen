<?php
// Conexão com o banco de dados (substitua pelos seus dados de conexão)
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "seu_banco_de_dados";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Verifica se o token está presente na URL
if(isset($_GET['token'])) {
    $token = $_GET['token'];
    
    // Consulta preparada para buscar o token no banco de dados
    $stmt = $conn->prepare("SELECT user_id, expiration_date FROM reset_tokens WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o token existe no banco de dados
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        $expiration_date = strtotime($row['expiration_date']);
        $current_time = time();

        // Verifica se o token ainda não expirou
        if ($current_time < $expiration_date) {
            // Token válido, exibe o formulário de redefinição de senha
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
</head>
<body>
    <h2>Redefinir Senha</h2>
    <!-- Formulário para redefinir a senha -->
    <form action="processar_redefinicao_senha.php" method="post">
        <input type="hidden" name="token" value="<?php echo $token; ?>">
        <label for="nova_senha">Nova Senha:</label>
        <input type="password" id="nova_senha" name="nova_senha" required>
        <label for="confirmar_senha">Confirmar Nova Senha:</label>
        <input type="password" id="confirmar_senha" name="confirmar_senha" required>
        <button type="submit">Redefinir Senha</button>
    </form>
</body>
</html>
<?php
        } else {
            // Token expirado
            echo "Token expirado.";
        }
    } else {
        // Token não encontrado no banco de dados
        echo "Token inválido.";
    }
} else {
    // Token não presente na URL
    echo "Token não encontrado.";
}
?>
