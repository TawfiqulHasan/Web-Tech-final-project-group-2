<?php

session_start();
require "../config/database.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/login.php");
    exit();
}


$product = $_GET['product'] ?? '';
$warehouse = $_GET['warehouse'] ?? '';
$type = $_GET['type'] ?? '';
$from = $_GET['from'] ?? '';
$to = $_GET['to'] ?? '';

$sql = "
SELECT 
    st.*,
    p.name AS product_name,
    w.name AS warehouse_name
FROM stock_transactions st
JOIN products p ON p.id = st.product_id
JOIN warehouses w ON w.id = st.warehouse_id
WHERE 1=1
";

if ($product != '') {
    $sql .= " AND st.product_id = $product";
}

if ($warehouse != '') {
    $sql .= " AND st.warehouse_id = $warehouse";
}

if ($type != '') {
    $sql .= " AND st.type = '$type'";
}

if ($from != '' && $to != '') {
    $sql .= " AND st.transaction_date BETWEEN '$from' AND '$to'";
}

$sql .= " ORDER BY st.transaction_date DESC";

$result = mysqli_query($conn, $sql);

include "../views/stock_report/index.php";
?>