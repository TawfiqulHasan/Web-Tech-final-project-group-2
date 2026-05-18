<?php

session_start();
require "../config/database.php";
require "../models/Supplier.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/login.php");
    exit();
}

$supplier = new Supplier($conn);
$action = $_GET['action'] ?? 'list';

// LIST
if ($action == "list") {
    $suppliers = $supplier->getAll();
    include "../views/suppliers/index.php";
}

// ADD
if ($action == "add") {

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $supplier->create(
            $_POST['company_name'],
            $_POST['contact_person'],
            $_POST['phone'],
            $_POST['email'],
            $_POST['address'],
            $_POST['city'],
            $_POST['payment_terms']
        );

        header("Location: SupplierController.php?action=list");
        exit();
    }

    include "../views/suppliers/add.php";
}


if ($action == "edit") {

    $id = $_GET['id'];
    $data = $supplier->getById($id);

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $supplier->update(
            $id,
            $_POST['company_name'],
            $_POST['contact_person'],
            $_POST['phone'],
            $_POST['email'],
            $_POST['address'],
            $_POST['city'],
            $_POST['payment_terms']
        );

        header("Location: SupplierController.php?action=list");
        exit();
    }

    include "../views/suppliers/edit.php";
}


if ($action == "deactivate") {

    $supplier->deactivate($_GET['id']);

    header("Location: SupplierController.php?action=list");
    exit();
}

?>
