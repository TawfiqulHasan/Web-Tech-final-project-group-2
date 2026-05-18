<?php

session_start();
require "../config/database.php";

$sql = "
SELECT 
    p.name AS product_name,
    w.name AS warehouse_name,
    st.warehouse_id,
    st.product_id,

    SUM(
        CASE 
            WHEN st.type = 'in' THEN st.quantity
            WHEN st.type = 'out' THEN -st.quantity
            WHEN st.type = 'adjustment' THEN st.quantity
            ELSE 0
        END
    ) AS stock_qty

FROM stock_transactions st
JOIN products p ON p.id = st.product_id
JOIN warehouses w ON w.id = st.warehouse_id

GROUP BY 
    st.product_id,
    st.warehouse_id,
    p.name,
    w.name

ORDER BY p.id, w.id
";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("SQL Error: " . mysqli_error($conn));
}

include "../views/inventory/index.php";
?>