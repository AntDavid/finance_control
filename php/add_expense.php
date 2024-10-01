<?php
include_once 'conn.php';
include_once 'check_session.php'; 

$user_id = $_SESSION['user_id']; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $expense = $_POST['expense'];
    $description = $_POST['description'];

    if (!empty($expense) && !empty($description)) {
        $conn = (new Conn())->getConnection();
        
        $stmt = $conn->prepare("INSERT INTO expenses (user_id, amount, description) VALUES (?, ?, ?)");
        $stmt->bind_param("ids", $user_id, $expense, $description); 

        if ($stmt->execute()) {
            echo "Despesa adicionada com sucesso.";
        } else {
            echo "Erro ao adicionar despesa: " . $stmt->error; 
        }

        $stmt->close();
        $conn->close();

        header("Location: ../pages/budget_management.php"); 
        exit; 
    } else {
        echo "Por favor, preencha todos os campos."; 
    }
}
?>
