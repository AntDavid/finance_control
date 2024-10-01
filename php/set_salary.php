<?php
include_once 'conn.php'; 

session_start();

if (!isset($_SESSION['user_id'])) {
    die('Erro: Usuário não logado.');
}

$user_id = $_SESSION['user_id'];  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $salary = $_POST['salary'];  

    if (empty($salary)) {
        die('Erro: Salário não foi informado.');
    }

    $conn = (new Conn())->getConnection();
    
    $stmt = $conn->prepare("INSERT INTO salary (user_id, amount) VALUES (?, ?)");
    
    if ($stmt === false) {
        die('Erro ao preparar a query: ' . $conn->error);
    }
    
    $stmt->bind_param("id", $user_id, $salary); 
    
    if ($stmt->execute()) {
        echo "Salário definido com sucesso.";
    } else {
        echo "Erro ao definir salário: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: ../pages/budget_management.php");
    exit;
}
?>
