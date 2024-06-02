<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pr";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

date_default_timezone_set('America/Sao_Paulo');

function registerAttendance($conn, $employeeName, $delayReason, $userId) {
    $timestamp = date("Y-m-d H:i:s");
    $stmt = $conn->prepare("INSERT INTO registerForm (employee_name, delay_reason, timestamp, user_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $employeeName, $delayReason, $timestamp, $userId);
    return $stmt->execute();
}

function registerLunchBreak($conn, $employeeName, $userId) {
    $timestamp = date("Y-m-d H:i:s");
    $stmt = $conn->prepare("INSERT INTO lunchBreak (employee_name, timestamp, user_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $employeeName, $timestamp, $userId);
    return $stmt->execute();
}

function requestEarlyOut($conn, $employeeName, $earlyOutReason, $userId) {
    $timestamp = date("Y-m-d H:i:s");
    $stmt = $conn->prepare("INSERT INTO earlyOut (employee_name, early_out_reason, timestamp, user_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $employeeName, $earlyOutReason, $timestamp, $userId);
    return $stmt->execute();
}

function getAttendanceRecords($conn, $userId, $limit = 14) {
    $stmt = $conn->prepare("SELECT employee_name, timestamp, delay_reason FROM registerForm WHERE user_id = ? ORDER BY timestamp DESC LIMIT ?");
    $stmt->bind_param("ii", $userId, $limit);
    $stmt->execute();
    $result = $stmt->get_result();
    $attendanceRecords = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $attendanceRecords[] = $row;
        }
    }

    echo json_encode($attendanceRecords);
}

function getFullAttendanceRecords($conn, $userId) {
    $attendanceRecords = array();

    // Buscar registros de registerForm
    $stmt = $conn->prepare("SELECT 'attendance' AS type, employee_name, delay_reason AS reason, timestamp FROM registerForm WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $attendanceRecords[] = $row;
    }

    // Buscar registros de lunchBreak
    $stmt = $conn->prepare("SELECT 'lunch' AS type, employee_name, NULL AS reason, timestamp FROM lunchBreak WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $attendanceRecords[] = $row;
    }

    // Buscar registros de earlyOut
    $stmt = $conn->prepare("SELECT 'earlyOut' AS type, employee_name, early_out_reason AS reason, timestamp FROM earlyOut WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $attendanceRecords[] = $row;
    }

    // Ordenar os registros pelo timestamp
    usort($attendanceRecords, function($a, $b) {
        return strtotime($b['timestamp']) - strtotime($a['timestamp']);
    });

    echo json_encode($attendanceRecords);
}

function getEmployeeList($conn) {
    $sql = "SELECT name FROM employees";
    $result = $conn->query($sql);
    $employeeList = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $employeeList[] = $row['name'];
        }
    }

    echo json_encode($employeeList);
}

function getLoggedInEmployeeName($conn, $userId) {
    $stmt = $conn->prepare("SELECT username FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        return $row['username'];
    } else {
        return null;
    }
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"] ?? '';
    $employeeName = htmlspecialchars($_POST["employeeName"] ?? '');
    $delayReason = htmlspecialchars($_POST["delayReason"] ?? '');
    $earlyOutReason = htmlspecialchars($_POST["earlyOutReason"] ?? '');
    $userId = $_SESSION['user_id'];

    switch ($action) {
        case 'registerAttendance':
            if (registerAttendance($conn, $employeeName, $delayReason, $userId)) {
                echo "Registro de ponto de presença inserido com sucesso.";
            } else {
                echo "Erro ao inserir registro: " . $conn->error;
            }
            break;
        case 'registerLunchBreak':
            if (registerLunchBreak($conn, $employeeName, $userId)) {
                echo "Registro de ponto de almoço inserido com sucesso.";
            } else {
                echo "Erro ao inserir registro: " . $conn->error;
            }
            break;
        case 'requestEarlyOut':
            if (requestEarlyOut($conn, $employeeName, $earlyOutReason, $userId)) {
                echo "Solicitação de saída antecipada inserida com sucesso.";
            } else {
                echo "Erro ao inserir solicitação: " . $conn->error;
            }
            break;
        default:
            echo "Erro: Nenhuma ação especificada.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if ($_GET["action"] == "getAttendanceRecords") {
        $userId = $_SESSION['user_id'];
        getAttendanceRecords($conn, $userId);
    } elseif ($_GET["action"] == "getFullAttendanceRecords") {
        $userId = $_SESSION['user_id'];
        getFullAttendanceRecords($conn, $userId); // Retorna todos os registros
    } elseif ($_GET["action"] == "getEmployeeList") {
        getEmployeeList($conn);
    } elseif ($_GET["action"] == "getLoggedInEmployeeName") {
        $userId = $_SESSION['user_id'];
        $employeeName = getLoggedInEmployeeName($conn, $userId);
        echo json_encode(["employeeName" => $employeeName]);
    }
}

$conn->close();
?>
