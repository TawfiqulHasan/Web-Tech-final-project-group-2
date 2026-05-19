<?php
require_once __DIR__ . "/../config/database.php";

function getAllPOs()
{
    global $conn;

    $sql = "SELECT po.id, po.supplier_id, po.status,
                   po.expected_delivery_date,
                   po.total_estimated_value,
                   po.created_at,
                   GROUP_CONCAT(p.name SEPARATOR ', ') AS product_names
            FROM purchase_orders po
            LEFT JOIN purchase_order_items poi ON po.id = poi.po_id
            LEFT JOIN products p ON poi.product_id = p.id
            GROUP BY po.id
            ORDER BY po.created_at DESC";

    return $conn->query($sql);
}

function getLowStockProducts()
{
    global $conn;

    return $conn->query("
        SELECT * FROM products
        WHERE current_stock <= reorder_level
    ");
}

function getWeeklyDeliveries()
{
    global $conn;

    $sql = "SELECT po.id, po.supplier_id, po.status,
                   po.expected_delivery_date,
                   GROUP_CONCAT(p.name SEPARATOR ', ') AS product_names
            FROM purchase_orders po
            LEFT JOIN purchase_order_items poi ON po.id = poi.po_id
            LEFT JOIN products p ON poi.product_id = p.id
            WHERE po.expected_delivery_date
            BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
            GROUP BY po.id";

    return $conn->query($sql);
}

function getTotalSpend()
{
    global $conn;

    return $conn->query("
        SELECT SUM(total_estimated_value) AS total_spend
        FROM purchase_orders
        WHERE status IN ('submitted','approved')
    ")->fetch_assoc();
}
?>