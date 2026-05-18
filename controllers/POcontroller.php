<?php

session_start();

require "../config/database.php";
require "../models/PurchaseOrder.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/login.php");
    exit();
}

$po = new PurchaseOrder($conn);

$action = $_GET['action'] ?? 'list';

if ($action == "list") {

    $orders = $po->getPending();

    include "../views/purchase_orders/index.php";
}


if ($action == "view") {

    $id = $_GET['id'];

    $items = $po->getItems($id);

    include "../views/purchase_orders/view.php";
}


if ($action == "approve") {

    $po->approve($_GET['id'], $_SESSION['user_id']);

    header("Location: POController.php?action=list");
}


if ($action == "reject") {

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $po->reject(
            $_POST['id'],
            $_POST['reason'],
            $_SESSION['user_id']
        );

        header("Location: POController.php?action=list");
        exit();
    }

    include "../views/purchase_orders/reject.php";
}
?>