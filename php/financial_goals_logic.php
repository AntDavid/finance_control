<?php
include_once '../php/Conn.php';

class FinancialGoals {
    private $conn;

    public function __construct() {
        $this->conn = (new Conn())->getConnection();
    }

    public function insertGoal($goalName, $targetAmount, $dueDate, $userId) { 
        $currentAmount = 0; 
        $stmt = $this->conn->prepare("INSERT INTO financial_goals (goal_name, target_amount, current_amount, due_date, user_id) VALUES (?, ?, ?, ?, ?)"); 
        $stmt->bind_param("sdssi", $goalName, $targetAmount, $currentAmount, $dueDate, $userId); 
        
        if ($stmt->execute()) {
            return true; 
        } else {
            echo "Erro ao inserir meta financeira: " . $stmt->error; 
            return false;
        }
    }

    public function getGoals($userId) { 
        $stmt = $this->conn->prepare("SELECT * FROM financial_goals WHERE user_id = ?"); 
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result(); 
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addMoneyToGoal($goalId, $addAmount) {
        $stmt = $this->conn->prepare("UPDATE financial_goals SET current_amount = current_amount + ? WHERE id = ?");
        $stmt->bind_param("di", $addAmount, $goalId);
        return $stmt->execute();
    }

    public function close() {
        $this->conn->close();
    }
}
?>
