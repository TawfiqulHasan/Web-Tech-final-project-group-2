<?php
require_once __DIR__ . "/../app/bootstrap.php";

header("Content-Type: application/json");

require_login();

$action = $_GET["action"] ?? "";

if ($action === "low_stock_count") {
    echo json_encode([
        "success" => true,
        "low_stock_count" => Product::lowStockCount()
    ]);
    exit;
}

if ($action === "low_stock_products") {
    echo json_encode([
        "success" => true,
        "products" => Product::lowStock()
    ]);
    exit;
}

echo json_encode([
    "success" => false,
    "message" => "Invalid API action."
]);
?>
