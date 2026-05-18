<?php

session_start();
require "../config/database.php";

$sql = "
SELECT 
    s.id,
    s.company_name,

    COUNT(po.id) AS total_orders,

    AVG(DATEDIFF(po.expected_delivery_date, po.created_at)) AS avg_delivery_time,

    SUM(po.total_estimated_value) AS total_spend

FROM suppliers s
LEFT JOIN purchase_orders po ON po.supplier_id = s.id
GROUP BY s.id
ORDER BY total_spend DESC
";

$result = mysqli_query($conn, $sql);

include "../views/supplier_report/index.php";
?>