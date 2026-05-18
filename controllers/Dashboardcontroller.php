<?php
session_start();
require "../config/database.php";


if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/login.php");
    exit();
}


$productQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM products");
if (!$productQuery) die("Products query failed: " . mysqli_error($conn));
$totalProducts = mysqli_fetch_assoc($productQuery)['total'] ?? 0;


$supplierQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM suppliers");
if (!$supplierQuery) die("Suppliers query failed: " . mysqli_error($conn));
$totalSuppliers = mysqli_fetch_assoc($supplierQuery)['total'] ?? 0;


$sql = "SELECT SUM(p.current_stock * sp.unit_price) AS stock_value
        FROM products p
        LEFT JOIN supplier_products sp ON p.id = sp.product_id
        AND sp.is_preferred_supplier = 1";
$stockQuery = mysqli_query($conn, $sql);
if (!$stockQuery) die("Stock value query failed: " . mysqli_error($conn));
$stockValue = mysqli_fetch_assoc($stockQuery)['stock_value'] ?? 0;


$disQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM stock_discrepancy_reports WHERE status = 'open'");
if (!$disQuery) die("Discrepancy query failed: " . mysqli_error($conn));
$openDiscrepancy = mysqli_fetch_assoc($disQuery)['total'] ?? 0;


$overdueQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM purchase_orders WHERE status = 'submitted' AND expected_delivery_date < CURDATE()");
if (!$overdueQuery) die("Overdue PO query failed: " . mysqli_error($conn));
$overduePO = mysqli_fetch_assoc($overdueQuery)['total'] ?? 0;


$txnSQL = "SELECT st.*, p.name AS product_name, w.name AS warehouse_name
           FROM stock_transactions st
           JOIN products p ON st.product_id = p.id
           JOIN warehouses w ON st.warehouse_id = w.id
           ORDER BY st.created_at DESC
           LIMIT 5";
$txnQuery = mysqli_query($conn, $txnSQL);
if (!$txnQuery) die("Transactions query failed: " . mysqli_error($conn));

include "../views/dashboard.php";
?> 