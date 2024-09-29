<?php
include '../php/check_session.php'; 
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir Despesa</title>
    <link rel="stylesheet" href="../styles/insert_expense.css">
    <script src="../js/insert_expense.js" defer></script>
</head>
<body>
    <header>
        <h1>Inserir Despesa</h1>
        <nav>
            <ul>
                <li><a href="financial_control.php">Voltar</a></li>
                <li><a href="../php/logout.php">Sair</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <form id="expense-form" action="../php/insert_expense.php" method="POST">
            <label for="date">Data:</label>
            <input type="date" id="date" name="date" required>

            <label for="description">Descrição:</label>
            <input type="text" id="description" name="description" required>

            <label for="amount">Valor:</label>
            <input type="number" id="amount" name="amount" step="0.01" required>

            <label for="category">Categoria:</label>
            <input type="text" id="category" name="category" required>

            <input type="hidden" name="type" value="expense">

            <button type="submit">Inserir Despesa</button>
        </form>
    </main>
</body>
</html>
