<?php

session_start();

require "../config/database.php";
require "../models/Product.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/login.php");
    exit();
}

$product = new Product($conn);

$action = $_GET['action'] ?? 'list';



if ($action == "list") {

    $products = $product->getAll();

    include "../views/products/index.php";
}



if ($action == "add") {

    $categories = mysqli_query($conn, "SELECT * FROM categories");

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $product->create(
            $_POST['category_id'],
            $_POST['name'],
            $_POST['sku'],
            $_POST['description'],
            $_POST['unit'],
            $_POST['reorder_level']
        );

        header("Location: ProductController.php?action=list");
        exit();
    }

    include "../views/products/add.php";
}



if ($action == "edit") {

    $id = $_GET['id'];

    $data = $product->getById($id);

    $categories = mysqli_query($conn, "SELECT * FROM categories");

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $product->update(
            $id,
            $_POST['category_id'],
            $_POST['name'],
            $_POST['sku'],
            $_POST['description'],
            $_POST['unit'],
            $_POST['reorder_level']
        );

        header("Location: ProductController.php?action=list");
        exit();
    }

    include "../views/products/edit.php";
}


if ($action == "deactivate") {

    $id = $_GET['id'];

    $product->deactivate($id);

    header("Location: ProductController.php?action=list");
    exit();
}
?>