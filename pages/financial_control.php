<?php
include_once '../php/check_session.php';
include_once '../php/financial_control_logic.php'; 

$user_id = $_SESSION['user_id'];

$params = [
    'user_id' => $user_id,
    'category' => isset($_GET['category']) ? $_GET['category'] : '',
    'start-date' => isset($_GET['start-date']) ? $_GET['start-date'] : '',
    'end-date' => isset($_GET['end-date']) ? $_GET['end-date'] : '',
    'order-by' => isset($_GET['order-by']) ? $_GET['order-by'] : 'date',
    'order-direction' => isset($_GET['order-direction']) ? $_GET['order-direction'] : 'ASC'
];

$data = getFinancialData($params);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle Financeiro</title>
    <link rel="stylesheet" href="../styles/contr_ol_finance.css">
</head>
<body>
    <div id="top-menu" class="top-menu">
        <button id="toggle-menu">☰ Menu</button>
        <div id="menu-options" class="menu-options">
            <a href="insert_expense.php">Inserir Despesa</a>
            <a href="financial_goals.php">Metas Futuras</a>
            <a href="budget_management.php">Orçamento Mensal</a>
            <a href="../php/logout.php">Logout</a>
        </div>
    </div>

    <div class="main-content">
        <h2>Resumo Financeiro</h2>
        <form id="filter-form" method="GET" action="">
            <label for="category">Categoria:</label>
            <input type="text" id="category" name="category" value="<?php echo htmlspecialchars(isset($_GET['category']) ? $_GET['category'] : ''); ?>">

            <label for="start-date">Data Início:</label>
            <input type="date" id="start-date" name="start-date" value="<?php echo htmlspecialchars(isset($_GET['start-date']) ? $_GET['start-date'] : ''); ?>">

            <label for="end-date">Data Fim:</label>
            <input type="date" id="end-date" name="end-date" value="<?php echo htmlspecialchars(isset($_GET['end-date']) ? $_GET['end-date'] : ''); ?>">

            <label for="order-by">Ordenar por:</label>
            <select id="order-by" name="order-by">
                <option value="name" <?php if (isset($_GET['order-by']) && $_GET['order-by'] == 'name') echo 'selected'; ?>>Nome</option>
                <option value="category" <?php if (isset($_GET['order-by']) && $_GET['order-by'] == 'category') echo 'selected'; ?>>Categoria</option>
                <option value="amount" <?php if (isset($_GET['order-by']) && $_GET['order-by'] == 'amount') echo 'selected'; ?>>Valor</option>
            </select>

            <label for="order-direction">Direção:</label>
            <select id="order-direction" name="order-direction">
                <option value="ASC" <?php if (isset($_GET['order-direction']) && $_GET['order-direction'] == 'ASC') echo 'selected'; ?>>Crescente</option>
                <option value="DESC" <?php if (isset($_GET['order-direction']) && $_GET['order-direction'] == 'DESC') echo 'selected'; ?>>Decrescente</option>
            </select>

            <button class= "filter" type="submit">Filtrar</button>
        </form>

        <div id="financial-data">
            <?php echo $data; ?>
        </div>
    </div>

    <script src="../js/financial_control.js"></script>
</body>
</html>
