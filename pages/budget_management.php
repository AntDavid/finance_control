<?php
include '../php/check_session.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once '../php/summary_logic.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];  

$current_salary = getCurrentSalary($user_id);
$total_expenses = getTotalExpenses($user_id);
$budget_summary = getBudgetSummary($user_id);


?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orçamento Mensal</title>
    <link rel="stylesheet" href="../styles/budget_management.css">
</head>
<body>
    <header>
        <h1>Orçamento Mensal</h1>
        <nav>
            <ul>
                <li><a href="financial_control.php">Voltar</a></li>
                <li><a href="../php/logout.php">Sair</a></li>
            </ul>
        </nav>
    </header>
    <div class="main-content">
        <h2>Definir Salário</h2>
        <form method="POST" action="../php/set_salary.php">
            <label for="salary">Salário Mensal:</label>
            <input type="number" step="0.01" id="salary" name="salary" required>
            <button type="submit">Salvar Salário</button>
        </form>

        <h2>Registrar Despesas</h2>
        <form method="POST" action="../php/add_expense.php">
            <label for="expense">Despesa:</label>
            <input type="number" step="0.01" id="expense" name="expense" required>

            <label for="description">Descrição:</label>
            <input type="text" id="description" name="description" required>

            <button type="submit">Adicionar Despesa</button>
        </form>

        <h2>Resumo Financeiro</h2>
        <div class="financial-summary">
            <?php
            $salary = getCurrentSalary($user_id);
            $expenses = getTotalExpenses($user_id);

            echo "<p><strong>Salário Mensal:</strong> R$ " . number_format($salary, 2, ',', '.') . "</p>";
            echo "<p><strong>Total de Despesas:</strong> R$ " . number_format($expenses, 2, ',', '.') . "</p>";
            echo "<p><strong>Saldo:</strong> R$ " . number_format($salary - $expenses, 2, ',', '.') . "</p>";
            ?>
        </div>
    </div>
</body>
</html>
