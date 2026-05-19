<?php

require "../config/database.php";

header('Content-Type: application/json');

$sql = "
SELECT 
    st.id,
    st.product_id,
    st.warehouse_id,
    st.type,
    st.quantity,
    st.transaction_date,

    p.name AS product_name,
    w.name AS warehouse_name

FROM stock_transactions st
LEFT JOIN products p ON p.id = st.product_id
LEFT JOIN warehouses w ON w.id = st.warehouse_id
WHERE 1=1
";

if (!empty($_GET['product'])) {
    $product = (int)$_GET['product'];
    $sql .= " AND st.product_id = $product";
}

if (!empty($_GET['warehouse'])) {
    $warehouse = (int)$_GET['warehouse'];
    $sql .= " AND st.warehouse_id = $warehouse";
}

if (!empty($_GET['type'])) {
    $type = $_GET['type'];
    $sql .= " AND st.type = '$type'";
}

if (!empty($_GET['from']) && !empty($_GET['to'])) {
    $from = $_GET['from'];
    $to = $_GET['to'];
    $sql .= " AND st.transaction_date BETWEEN '$from' AND '$to'";
}

$sql .= " ORDER BY st.transaction_date DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo json_encode(["error" => mysqli_error($conn)]);
    exit;
}

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
?>