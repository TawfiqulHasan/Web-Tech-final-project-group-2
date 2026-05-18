<?php

session_start();
require "../config/database.php";

$sql = "
SELECT 
    p.id,
    p.name,
    p.reorder_level,
    p.current_stock,

    (p.reorder_level - p.current_stock + 10) AS recommended_qty

FROM products p
WHERE p.current_stock < p.reorder_level
ORDER BY (p.reorder_level - p.current_stock) DESC
";

$result = mysqli_query($conn, $sql);

include "../views/low_stock/index.php";
?>