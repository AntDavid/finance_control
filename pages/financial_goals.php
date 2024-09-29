<?php
include_once '../php/financial_goals_logic.php'; 
include_once '../php/check_session.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$financialGoals = new FinancialGoals();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['goal_name'])) {
    $goalName = $_POST['goal_name'];
    $targetAmount = $_POST['target_amount'];
    $dueDate = $_POST['due_date'];
    $financialGoals->insertGoal($goalName, $targetAmount, $dueDate);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['goal_id']) && isset($_POST['add_amount'])) {
    $goalId = $_POST['goal_id'];
    $addAmount = $_POST['add_amount'];
    $financialGoals->addMoneyToGoal($goalId, $addAmount);
}

$goals = $financialGoals->getGoals();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metas Financeiras</title>
    <link rel="stylesheet" href="../styles/financial_goals.css">
</head>
<body>
    <header>
        <h1>Metas Financeiras</h1>
        <nav>
            <ul>
                <li><a href="financial_control.php">Voltar</a></li>
                <li><a href="../php/logout.php">Sair</a></li>
            </ul>
        </nav>
    </header>
    <div class="main-content">
        <h2>Inserir Nova Meta Financeira</h2>
        <form method="POST" action="">
            <label for="goal_name">Título:</label>
            <input type="text" id="goal_name" name="goal_name" required>

            <label for="target_amount">Valor Alvo:</label>
            <input type="number" step="0.01" id="target_amount" name="target_amount" required>

            <label for="due_date">Data Limite:</label>
            <input type="date" id="due_date" name="due_date" required>

            <button type="submit">Inserir Meta</button>
        </form>

        <h2>Metas Financeiras</h2>
        <table>
            <tr>
                <th>Meta</th>
                <th>Valor Alvo</th>
                <th>Valor Acumulado</th>
                <th>Falta</th>
                <th>Data Limite</th>
                <th>Ações</th>
            </tr>
            <?php if (!empty($goals)): ?>
                <?php foreach ($goals as $goal): ?>
                <tr>
                    <td><?php echo htmlspecialchars($goal['goal_name']); ?></td>
                    <td>R$ <?php echo number_format($goal['target_amount'], 2, ',', '.'); ?></td>
                    <td>R$ <?php echo number_format($goal['current_amount'], 2, ',', '.'); ?></td>
                    <td>R$ <?php echo number_format($goal['target_amount'] - $goal['current_amount'], 2, ',', '.'); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($goal['due_date'])); ?></td>
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="goal_id" value="<?php echo $goal['id']; ?>">
                            <label for="add_amount">Adicionar dinheiro:</label>
                            <input type="number" step="0.01" name="add_amount" required>
                            <button type="submit">Adicionar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Nenhuma meta financeira cadastrada.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>
