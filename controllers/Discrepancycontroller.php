<?php

session_start();
require "../config/database.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/login.php");
    exit();
}

$action = $_GET['action'] ?? 'list';


if ($action == "list") {

    $sql = "
    SELECT d.*, 
           p.name AS product_name,
           w.name AS warehouse_name
    FROM stock_discrepancy_reports d
    JOIN products p ON p.id = d.product_id
    JOIN warehouses w ON w.id = d.warehouse_id
    ORDER BY d.created_at DESC
    ";

    $reports = mysqli_query($conn, $sql);

    include "../views/discrepancy/index.php";
}


if ($action == "view") {

    $id = $_GET['id'];

    $sql = "
    SELECT d.*, 
           p.name AS product_name,
           w.name AS warehouse_name
    FROM stock_discrepancy_reports d
    JOIN products p ON p.id = d.product_id
    JOIN warehouses w ON w.id = d.warehouse_id
    WHERE d.id = $id
    ";

    $report = mysqli_fetch_assoc(mysqli_query($conn, $sql));

    include "../views/discrepancy/view.php";
}


if ($action == "resolve") {

    $id = $_POST['id'];
    $note = $_POST['resolution_note'];
    $user = $_SESSION['user_id'];

    $sql = "
    UPDATE stock_discrepancy_reports
    SET status='resolved',
        resolved_by=$user,
        description = CONCAT(description, ' | RESOLUTION: ', '$note')
    WHERE id=$id
    ";

    mysqli_query($conn, $sql);

    header("Location: DiscrepancyController.php?action=list");
}


if ($action == "escalate") {

    $id = $_GET['id'];

    mysqli_query($conn, "
        UPDATE stock_discrepancy_reports
        SET status='under_review'
        WHERE id=$id
    ");

    header("Location: DiscrepancyController.php?action=list");
}
?>