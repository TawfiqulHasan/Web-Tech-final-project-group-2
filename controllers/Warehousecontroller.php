<?php

session_start();

require "../config/database.php";
require "../models/Warehouse.php";

if (!isset($_SESSION['user_id'])) {

    header("Location: ../views/login.php");
    exit();
}

$warehouse = new Warehouse($conn);

$action = $_GET['action'] ?? 'list';

if ($action == "list") {

    $warehouses = $warehouse->getAll();

    include "../views/warehouses/index.php";
}

if ($action == "add") {

    $users = mysqli_query($conn,
        "SELECT * FROM users"
    );

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $warehouse->create(
            $_POST['name'],
            $_POST['address'],
            $_POST['city'],
            $_POST['manager_id']
        );

        header("Location: WarehouseController.php?action=list");
        exit();
    }

    include "../views/warehouses/add.php";
}

if ($action == "edit") {

    $id = $_GET['id'];

    $data = $warehouse->getById($id);

    $users = mysqli_query($conn,
        "SELECT * FROM users"
    );

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $warehouse->update(
            $id,
            $_POST['name'],
            $_POST['address'],
            $_POST['city'],
            $_POST['manager_id']
        );

        header("Location: WarehouseController.php?action=list");
        exit();
    }

    include "../views/warehouses/edit.php";
}
?>