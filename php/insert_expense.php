<?php
include 'conn.php';

session_start();


$user_id = $_SESSION['user_id']; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $type = $_POST['type']; 

    $conn = new Conn();
    $mysqli = $conn->getConnection();

    $stmt = $mysqli->prepare("INSERT INTO transactions (user_id, date, description, amount, category, type) VALUES (?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Erro na preparação da consulta: " . $mysqli->error);
    }

    $stmt->bind_param("issdss", $user_id, $date, $description, $amount, $category, $type);

    if ($stmt->execute()) {
        echo "<script>
                alert('Despesa inserida com sucesso!');
                window.location.href='../pages/insert_expense.php';
              </script>";
    } else {
        echo "<script>
                alert('Erro ao inserir despesa: " . $stmt->error . "');
                window.location.href='../pages/insert_expense.php';
              </script>";
    }

    $stmt->close();

    $mysqli->close();
}
?>