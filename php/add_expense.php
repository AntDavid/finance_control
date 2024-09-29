<?php
include_once 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $expense = $_POST['expense'];
    $description = $_POST['description'];

    $conn = (new Conn())->getConnection();
    $stmt = $conn->prepare("INSERT INTO expenses (amount, description) VALUES (?, ?)");
    $stmt->bind_param("ds", $expense, $description);

    if ($stmt->execute()) {
        echo "Despesa adicionada com sucesso.";
    } else {
        echo "Erro ao adicionar despesa: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: ../pages/budget_management.php"); 
}
?>
