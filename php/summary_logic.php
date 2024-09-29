<?php
include_once 'conn.php';

function getCurrentSalary() {
    $conn = (new Conn())->getConnection();
    $sql = "SELECT amount FROM salary ORDER BY created_at DESC LIMIT 1"; // Obtém o último salário registrado
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc()['amount'];
    }

    return 0; // Retorna 0 se não houver salário definido
}

function getTotalExpenses() {
    $conn = (new Conn())->getConnection();
    $sql = "SELECT SUM(amount) AS total_expenses FROM expenses";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc()['total_expenses'];
    }

    return 0; // Retorna 0 se não houver despesas registradas
}
?>
