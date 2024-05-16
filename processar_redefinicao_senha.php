<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = $_POST['email'];

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Conexão com o banco de dados
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "users";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Erro na conexão com o banco de dados: " . $conn->connect_error);
            }

            // Consulta preparada para obter o ID do usuário
            $stmt_get_user_id = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
            $stmt_get_user_id->bind_param("s", $email);
            $stmt_get_user_id->execute();
            $result_get_user_id = $stmt_get_user_id->get_result();
            $user = $result_get_user_id->fetch_assoc();
            $user_id = $user['id'];

            // Gera um token único para o usuário
            $token = bin2hex(random_bytes(32));

            // Insere o token no banco de dados
            $stmt_insert_token = $conn->prepare("INSERT INTO reset_tokens (user_id, token) VALUES (?, ?)");
            $stmt_insert_token->bind_param("is", $user_id, $token);
            if ($stmt_insert_token->execute()) {
                // Token inserido com sucesso, envie o e-mail
                $to = $email;
                $subject = "Redefinição de senha";
                $message = "Para redefinir sua senha, clique neste link: https://prsegti.com/redefinir_senha.php?user_id=$user_id&token=$token";
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
                // Erro ao inserir o token no banco de dados
                $_SESSION['reset_email_error'] = "Erro ao enviar o e-mail. Por favor, tente novamente.";
            }
        } else {
            // E-mail inválido
            $_SESSION['reset_email_error'] = "Por favor, insira um endereço de e-mail válido.";
        }
    } else {
        // Campo de e-mail vazio
        $_SESSION['reset_email_error'] = "Por favor, insira seu endereço de e-mail.";
    }

    header("Location: esqueceu_senha.php");
    exit;
} else {
    header("Location: esqueceu_senha.php");
    exit;
}
?>
