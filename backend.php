<?php
// Conexão com o banco de dados (substitua os valores conforme necessário)
$servername = "localhost";
$username = "u171097075_brunomaia";
$password = "M3uV10l@0123";
$dbname = "u171097075_registro_ponto";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Define o fuso horário
date_default_timezone_set('America/Sao_Paulo');

// Verifica se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se a chave "action" está definida
    if (isset($_POST["action"])) {
        // Verifica se a requisição é para registrar ponto de presença
        if ($_POST["action"] == "registerAttendance") {
            // Obtém os dados do POST
            $employeeName = $_POST["employeeName"];
            $delayReason = $_POST["delayReason"];
            $timestamp = date("Y-m-d H:i:s");

            // Insere os dados no banco de dados
            $sql = "INSERT INTO registerForm (employee_name, delay_reason, timestamp) VALUES ('$employeeName', '$delayReason', '$timestamp')";
            
            if ($conn->query($sql) === TRUE) {
                echo "Registro de ponto de presença inserido com sucesso.";
            } else {
                echo "Erro ao inserir registro: " . $conn->error;
            }
        }
        // Verifica se a requisição é para registrar ponto de almoço
        elseif ($_POST["action"] == "registerLunchBreak") {
            // Obtém os dados do POST
            $employeeName = $_POST["employeeName"];
            $timestamp = date("Y-m-d H:i:s");

            // Insere os dados no banco de dados
            $sql = "INSERT INTO lunchBreak (employee_name, timestamp) VALUES ('$employeeName', '$timestamp')";
            
            if ($conn->query($sql) === TRUE) {
                echo "Registro de ponto de almoço inserido com sucesso.";
            } else {
                echo "Erro ao inserir registro: " . $conn->error;
            }
        }
        // Verifica se a requisição é para solicitar saída antecipada
        elseif ($_POST["action"] == "requestEarlyOut") {
            // Obtém os dados do POST
            $employeeName = $_POST["employeeName"];
            $earlyOutReason = $_POST["earlyOutReason"];
            $timestamp = date("Y-m-d H:i:s");

            // Insere os dados no banco de dados
            $sql = "INSERT INTO earlyOut (employee_name, early_out_reason, timestamp) VALUES ('$employeeName', '$earlyOutReason', '$timestamp')";
            
            if ($conn->query($sql) === TRUE) {
                echo "Solicitação de saída antecipada inserida com sucesso.";
            } else {
                echo "Erro ao inserir solicitação: " . $conn->error;
            }
        }
    } else {
        // Se a chave "action" não estiver definida, exibir uma mensagem de erro
        echo "Erro: Nenhuma ação especificada.";
    }
}

// Verifica se a requisição é para obter os registros de ponto de presença
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["action"]) && $_GET["action"] == "getAttendanceRecords") {
    // Array para armazenar os registros de ponto de presença
    $attendanceRecords = array();

    // Consulta SQL para obter os registros de ponto de presença do banco de dados
    $sql = "SELECT employee_name, timestamp, delay_reason FROM registerForm";
    $result = $conn->query($sql);

    // Verifica se há resultados da consulta
    if ($result->num_rows > 0) {
        // Itera sobre os resultados e adiciona cada registro ao array
        while ($row = $result->fetch_assoc()) {
            $attendanceRecords[] = $row;
        }
    }

    // Retorna os registros em formato JSON
    echo json_encode($attendanceRecords);
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
