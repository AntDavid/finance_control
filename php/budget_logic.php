<?php
include_once 'conn.php'; 

function getBudgetSummary() {
    $conn = (new Conn())->getConnection();
    $sql = "SELECT month, SUM(income) as income, SUM(expense) as expense FROM budget GROUP BY month ORDER BY month DESC LIMIT 1"; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    
    $conn->close();
    return null;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $income = $_POST['income'];
    $expense = $_POST['expense'];
    $month = $_POST['month'];

    $conn = (new Conn())->getConnection();
    $stmt = $conn->prepare("INSERT INTO budget (income, expense, month) VALUES (?, ?, ?)");
    $stmt->bind_param("dds", $income, $expense, $month);
    
    if ($stmt->execute()) {
        echo "Orçamento adicionado com sucesso.";
    } else {
        echo "Erro ao adicionar orçamento: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    
    header("Location: ../pages/budget_management.php"); 
    exit;
}
?>
