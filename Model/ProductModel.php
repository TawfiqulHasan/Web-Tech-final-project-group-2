<?php
require_once __DIR__ . "/../config/database.php";


function getProducts($filter = "")
{
    global $conn;

    $sql = "SELECT *,
            (reorder_level - current_stock) AS urgency
            FROM products
            $filter
            ORDER BY urgency DESC";

    return $conn->query($sql);
}

/*
function getProductSuppliers($product_id)
{
    global $conn;

    $sql = "SELECT 
                products.name AS product_name,
                suppliers.company_name,
                supplier_products.unit_price,
                supplier_products.lead_time_days,
                supplier_products.is_preferred_supplier
            FROM supplier_products
            JOIN products ON supplier_products.product_id = products.id
            JOIN suppliers ON supplier_products.supplier_id = suppliers.id
            WHERE products.id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();

    return $stmt->get_result();
}*/


function getProductSuppliers($product_id)
{
    global $conn;

    $sql = "SELECT 
                p.name,
                s.company_name,
                sp.unit_price,
                sp.lead_time_days,
                sp.is_preferred_supplier
            FROM supplier_products sp
            INNER JOIN products p ON sp.product_id = p.id
            INNER JOIN suppliers s ON sp.supplier_id = s.id
            WHERE sp.product_id = ?";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $product_id);
    $stmt->execute();

    $stmt->bind_result(
        $product_name,
        $company_name,
        $unit_price,
        $lead_time_days,
        $is_preferred_supplier
    );

    $rows = [];

    while ($stmt->fetch()) {
        $rows[] = [
            "product_name" => $product_name,
            "company_name" => $company_name,
            "unit_price" => $unit_price,
            "lead_time_days" => $lead_time_days,
            "is_preferred_supplier" => $is_preferred_supplier
        ];
    }

    return $rows;
}

?>