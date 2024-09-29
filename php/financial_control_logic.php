<?php
include 'conn.php';

function getFinancialData($params) {
    $valid_order_by_columns = ['date', 'description', 'amount', 'category'];
    
    $conn = new Conn();
    $mysqli = $conn->getConnection();

    $query = "SELECT * FROM transactions WHERE user_id = ?";
    $query_params = [$params['user_id']];
    $types = 'i';

    if ($params['category']) {
        $query .= " AND category LIKE ?";
        $query_params[] = '%' . $params['category'] . '%';
        $types .= 's';
    }

    if ($params['start-date']) {
        $query .= " AND date >= ?";
        $query_params[] = $params['start-date'];
        $types .= 's';
    }

    if ($params['end-date']) {
        $query .= " AND date <= ?";
        $query_params[] = $params['end-date'];
        $types .= 's';
    }

    $order_by = in_array($params['order-by'], $valid_order_by_columns) ? $params['order-by'] : 'date';
    $order_direction = $params['order-direction'] === 'DESC' ? 'DESC' : 'ASC';

    $query .= " ORDER BY $order_by $order_direction";

    $stmt = $mysqli->prepare($query);

    if (!$stmt) {
        die("Erro na preparação da consulta: " . $mysqli->error);
    }

    $stmt->bind_param($types, ...$query_params);
    $stmt->execute();
    $result = $stmt->get_result();

    $financial_data = '<table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Categoria</th>
            </tr>
        </thead>
        <tbody>';

    while ($row = $result->fetch_assoc()) {
        $financial_data .= '<tr>
            <td>' . htmlspecialchars($row['date']) . '</td>
            <td>' . htmlspecialchars($row['description']) . '</td>
            <td>' . htmlspecialchars($row['amount']) . '</td>
            <td>' . htmlspecialchars($row['category']) . '</td>
        </tr>';
    }

    $financial_data .= '</tbody></table>';

    $stmt->close();
    $mysqli->close();

    return $financial_data;
}
