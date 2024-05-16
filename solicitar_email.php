<?php
session_start();

// Função para salvar o token no banco de dados junto com o e-mail do usuário
function salvarTokenNoBanco($email, $token) {
    // Configurações do banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "users";

    // Conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica erros na conexão
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

 // Consulta preparada para inserir o e-mail e o token no banco de dados
 $stmt = $conn->prepare("INSERT INTO reset_tokens (user_id, token, expiration_date) VALUES (?, ?, ?)");
 $stmt->bind_param("iss", $user_id, $token, $expiration_date);

 // Executa a consulta
 if ($stmt->execute()) {
     // Token salvo no banco de dados com sucesso
     return true;
 } else {
     // Erro ao salvar o token no banco de dados
     return false;
 }
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o campo de e-mail foi preenchido
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        // Aqui você deve processar o e-mail fornecido pelo usuário
        $email = $_POST['email'];

        // Verifica se o e-mail fornecido é válido (você pode adicionar mais validações aqui)
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Gere um token único para o usuário (pode ser um UUID, por exemplo)
            $token = uniqid();

           // Salve o token no banco de dados junto com o e-mail do usuário para referência futura
           if (salvarTokenNoBanco($email, $token)) {
            // Envie o e-mail com o link de redefinição de senha
            $to = $email;
            $subject = "Redefinição de senha";
            $message = "Para redefinir sua senha, clique neste link: https://prsegti.com/redefinir_senha.php?token=$token";
            $headers = "From: bruno.maia@prseg.com.br";

            if (mail($to, $subject, $message, $headers)) {
                // E-mail enviado com sucesso
                $_SESSION['reset_email_sent'] = true;
                header("Location: sucesso.php"); // Redireciona para uma página de sucesso
                exit;
            } else {
                // Erro ao enviar o e-mail
                $_SESSION['reset_email_error'] = "Erro ao enviar o e-mail. Por favor, tente novamente.";
            }
        } else {
            // Erro ao salvar o token no banco de dados
            $_SESSION['reset_email_error'] = "Erro ao salvar o token no banco de dados. Por favor, tente novamente.";
        }
    } else {
        // E-mail inválido
        $_SESSION['reset_email_error'] = "Por favor, insira um endereço de e-mail válido.";
    }
} else {
    // Campo de e-mail vazio
    $_SESSION['reset_email_error'] = "Por favor, insira seu endereço de e-mail.";
}

// Redireciona de volta para a página de "Esqueceu sua senha?" com mensagens de erro, se houver
header("Location: esqueceu_senha.php");
exit;
} else {
// Se o formulário não foi submetido via POST, redirecione para a página de "Esqueceu sua senha?"
header("Location: esqueceu_senha.php");
exit;
}
?>
