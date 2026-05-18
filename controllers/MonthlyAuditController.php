<?php

session_start();
require "../config/database.php";

$month = $_GET['month'] ?? date('m');
$year = $_GET['year'] ?? date('Y');

$sql = "
SELECT 
    p.id,
    p.name,

    SUM(CASE WHEN st.type = 'in' THEN st.quantity ELSE 0 END) AS total_in,

    SUM(CASE WHEN st.type = 'out' THEN st.quantity ELSE 0 END) AS total_out,

    (
        SUM(CASE WHEN st.type = 'in' THEN st.quantity ELSE 0 END)
        -
        SUM(CASE WHEN st.type = 'out' THEN st.quantity ELSE 0 END)
    ) AS net_movement,

    (
        p.current_stock
    ) AS closing_stock

FROM products p
LEFT JOIN stock_transactions st 
    ON p.id = st.product_id
    AND MONTH(st.transaction_date) = $month
    AND YEAR(st.transaction_date) = $year

GROUP BY p.id
ORDER BY net_movement DESC
";

$result = mysqli_query($conn, $sql);

include "../views/monthly_audit/index.php";
?>