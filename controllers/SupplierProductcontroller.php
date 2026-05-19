<?php

session_start();

require "../config/database.php";
require "../models/SupplierProduct.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/login.php");
    exit();
}

$link = new SupplierProduct($conn);

$action = $_GET['action'] ?? 'list';

if ($action == "list") {

    $links = $link->getAll();

    include "../views/supplier_products/index.php";
}

if ($action == "add") {

    $suppliers = mysqli_query($conn, "SELECT * FROM suppliers");
    $products = mysqli_query($conn, "SELECT * FROM products");

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $preferred =
            isset($_POST['is_preferred_supplier']) ? 1 : 0;

        $link->create(
            $_POST['supplier_id'],
            $_POST['product_id'],
            $_POST['unit_price'],
            $_POST['lead_time_days'],
            $preferred
        );

        header("Location: SupplierProductController.php?action=list");
        exit();
    }

    include "../views/supplier_products/add.php";
}


if ($action == "delete") {

    $link->delete($_GET['id']);

    header("Location: SupplierProductController.php?action=list");
}
?>