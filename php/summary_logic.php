<?php
include_once 'conn.php';

function getCurrentSalary($user_id) {
    $conn = (new Conn())->getConnection();
    $sql = "SELECT amount FROM salary WHERE user_id = ? ORDER BY created_at DESC LIMIT 1"; 
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);  
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc()['amount'];
    }

    return 0;
}

function getTotalExpenses($user_id) {
    $conn = (new Conn())->getConnection();
    $sql = "SELECT SUM(amount) AS total_expenses FROM expenses WHERE user_id = ?"; 
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);  
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc()['total_expenses'];
    }

    return 0;
}

function getBudgetSummary($user_id) {
    $conn = (new Conn())->getConnection();
    $sql = "SELECT month, SUM(income) as income, SUM(expense) as expense FROM budget WHERE user_id = ? GROUP BY month ORDER BY month DESC LIMIT 1"; 
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);  
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }

    $stmt->close();
    $conn->close();
    return null;
}
?>
