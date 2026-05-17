<?php
session_start();

include_once("../model/DiscrepancyModel.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $product_id = trim($_POST["product_id"]);
    $expected_qty = trim($_POST["expected_qty"]);
    $actual_qty = trim($_POST["actual_qty"]);
    $description = trim($_POST["description"]);

    if (empty($product_id) || empty($expected_qty) || empty($actual_qty) || empty($description)) {

        $_SESSION["error"] = "All fields are required";

        header("Location: ../view/warehouse/discrepancy-create.php");
        exit();
    }

    $report = new DiscrepancyModel();

    $result = $report->addReport(
        $product_id,
        $expected_qty,
        $actual_qty,
        $description,
        $_SESSION["user_id"]
    );

    if ($result) {
        $_SESSION["success"] = "Discrepancy report submitted successfully";
    } else {
        $_SESSION["error"] = "Report submission failed";
    }

    header("Location: ../view/warehouse/discrepancy-create.php");
    exit();
}
?>