<?php
include_once 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $salary = $_POST['salary'];

    $conn = (new Conn())->getConnection();
    $stmt = $conn->prepare("INSERT INTO salary (amount) VALUES (?)");
    $stmt->bind_param("d", $salary);

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
