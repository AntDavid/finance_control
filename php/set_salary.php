<?php
include_once 'conn.php';
$user_id = $_SESSION['user_id']; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $salary = $_POST['salary'];

    $conn = (new Conn())->getConnection();
    $stmt = $conn->prepare("INSERT INTO salary (user_id, amount) VALUES (?)");
    $stmt->bind_param("d", $user_id, $salary);

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
