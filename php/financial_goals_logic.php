<?php
include_once '../php/Conn.php';

class FinancialGoals {
    private $conn;

    public function __construct() {
        $this->conn = (new Conn())->getConnection();
    }

    public function insertGoal($goalName, $targetAmount, $dueDate) {
        $stmt = $this->conn->prepare("INSERT INTO financial_goals (goal_name, target_amount, due_date) VALUES (?, ?, ?)");
        $stmt->bind_param("sds", $goalName, $targetAmount, $dueDate);
        return $stmt->execute();
    }

    public function getGoals() {
        $result = $this->conn->query("SELECT * FROM financial_goals");
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
