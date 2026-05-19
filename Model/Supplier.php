<?php
require_once __DIR__ . "/../config/database.php";

function getSuppliersByProduct($product_id)
{
    global $conn;

    $sql = "SELECT 
                suppliers.company_name,
                supplier_products.unit_price,
                supplier_products.lead_time_days
            FROM supplier_products

            JOIN suppliers
            ON supplier_products.supplier_id = suppliers.id

            WHERE supplier_products.product_id = $product_id

            ORDER BY supplier_products.unit_price ASC";

    return $conn->query($sql);
}
?>