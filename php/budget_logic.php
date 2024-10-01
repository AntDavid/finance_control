<?php
include_once 'conn.php'; 
include_once 'check_session.php'; 

$user_id = $_SESSION['user_id']; 

function getBudgetSummary($user_id) {  
    $conn = (new Conn())->getConnection();
    
    $sql = "SELECT month, SUM(income) as income, SUM(expense) as expense 
            FROM budget 
            WHERE user_id = ? 
            GROUP BY month 
            ORDER BY month DESC 
            LIMIT 1";  
            
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $income = $_POST['income'];   
    $expense = $_POST['expense']; 
    $month = $_POST['month'];    

    if (!empty($income) && !empty($expense) && !empty($month)) {
        $conn = (new Conn())->getConnection();
        
        $stmt = $conn->prepare("INSERT INTO budget (user_id, income, expense, month) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("idds", $user_id, $income, $expense, $month);
        
        if ($stmt->execute()) {
            echo "Orçamento adicionado com sucesso.";
        } else {
            echo "Erro ao adicionar orçamento: " . $stmt->error;
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
