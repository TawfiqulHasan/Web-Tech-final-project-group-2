<?php
session_start();

include_once("../model/TransactionModel.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $product_id = $_POST["product_id"];
    $quantity = $_POST["quantity"];

    // validation
    if (empty($product_id) || empty($quantity)) {

        $_SESSION["error"] = "All fields are required";

        header("Location: ../view/warehouse/stock-in.php");
        exit();
    }

    $transaction = new TransactionModel();

    $result = $transaction->stockIn($product_id, $quantity, $_SESSION["user_id"]);

    if ($result) {

        $_SESSION["success"] = "Stock added successfully";

    } else {

        $_SESSION["error"] = "Stock update failed";
    }

    header("Location: ../view/warehouse/stock-in.php");
    exit();
}
?>