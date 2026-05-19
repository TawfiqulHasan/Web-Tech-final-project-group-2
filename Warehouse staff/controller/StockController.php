<?php
session_start();

include_once("../model/TransactionModel.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $product_id = trim($_POST["product_id"]);
    $quantity = trim($_POST["quantity"]);

    // STOCK ADJUSTMENT
    if (isset($_POST["stock_adjustment"])) {

        $reason = trim($_POST["reason"]);

        if (empty($product_id) || empty($quantity) || empty($reason)) {
            $_SESSION["error"] = "Product, quantity and reason are required";
            header("Location: ../view/warehouse/stock-adjustment.php");
            exit();
        }

        if (!is_numeric($quantity)) {
            $_SESSION["error"] = "Quantity must be a number";
            header("Location: ../view/warehouse/stock-adjustment.php");
            exit();
        }

        if (!preg_match("/^-?[0-9]+$/", $quantity)) {
            $_SESSION["error"] = "Quantity must be a valid whole number";
            header("Location: ../view/warehouse/stock-adjustment.php");
            exit();
        }

        $reason = htmlspecialchars($reason);

        $transaction = new TransactionModel();

        $result = $transaction->stockAdjustment(
            $product_id,
            $quantity,
            $reason,
            $_SESSION["user_id"]
        );

        if ($result == "negative_stock") {
            $_SESSION["error"] = "Final stock cannot become negative";
        } else if ($result) {
            $_SESSION["success"] = "Stock adjusted successfully";
        } else {
            $_SESSION["error"] = "Stock adjustment failed";
        }

        header("Location: ../view/warehouse/stock-adjustment.php");
        exit();
    }

    // STOCK OUT
    else if (isset($_POST["stock_out"])) {

        $reason = trim($_POST["reason"]);
        $transaction_date = trim($_POST["transaction_date"]);

        if (empty($product_id) || empty($quantity) || empty($reason) || empty($transaction_date)) {
            $_SESSION["error"] = "Product, quantity, reason and date are required";
            header("Location: ../view/warehouse/stock-out.php");
            exit();
        }

        if (!is_numeric($quantity)) {
            $_SESSION["error"] = "Quantity must be a number";
            header("Location: ../view/warehouse/stock-out.php");
            exit();
        }

        if ($quantity <= 0) {
            $_SESSION["error"] = "Quantity must be greater than 0";
            header("Location: ../view/warehouse/stock-out.php");
            exit();
        }

        $reason = htmlspecialchars($reason);

        $transaction = new TransactionModel();

        $result = $transaction->stockOut(
            $product_id,
            $quantity,
            $reason,
            $transaction_date,
            $_SESSION["user_id"]
        );

        if ($result == "not_enough_stock") {
            $_SESSION["error"] = "Not enough stock available";
        } else if ($result) {
            $_SESSION["success"] = "Stock removed successfully";
        } else {
            $_SESSION["error"] = "Stock out failed";
        }

        header("Location: ../view/warehouse/stock-out.php");
        exit();
    }

    // STOCK IN
    else {

        $unit_price = trim($_POST["unit_price"]);
        $po_id = trim($_POST["po_id"]);
        $transaction_date = trim($_POST["transaction_date"]);

        if (empty($product_id) || empty($quantity) || empty($unit_price) || empty($transaction_date)) {
            $_SESSION["error"] = "Product, quantity, unit price and date are required";
            header("Location: ../view/warehouse/stock-in.php");
            exit();
        }

        if (!is_numeric($quantity) || !is_numeric($unit_price)) {
            $_SESSION["error"] = "Quantity and unit price must be numbers";
            header("Location: ../view/warehouse/stock-in.php");
            exit();
        }

        if ($quantity <= 0 || $unit_price < 0) {
            $_SESSION["error"] = "Quantity must be greater than 0 and unit price cannot be negative";
            header("Location: ../view/warehouse/stock-in.php");
            exit();
        }

        $transaction = new TransactionModel();

        $result = $transaction->stockIn(
            $product_id,
            $quantity,
            $unit_price,
            $po_id,
            $transaction_date,
            $_SESSION["user_id"]
        );

        if ($result) {
            $_SESSION["success"] = "Stock added successfully";
        } else {
            $_SESSION["error"] = "Stock update failed";
        }

        header("Location: ../view/warehouse/stock-in.php");
        exit();
    }
}
?>