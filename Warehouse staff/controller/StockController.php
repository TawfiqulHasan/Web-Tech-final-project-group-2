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

            $_SESSION["success"] = "";
            $_SESSION["error"] = "Product, quantity and reason are required";

            header("Location: ../view/warehouse/stock-adjustment.php");
            exit();
        }

        $transaction = new TransactionModel();

        $result = $transaction->stockAdjustment(
            $product_id,
            $quantity,
            $reason,
            $_SESSION["user_id"]
        );

        if ($result == "negative_stock") {

            $_SESSION["success"] = "";
            $_SESSION["error"] = "Final stock cannot become negative";

        } else if ($result) {

            $_SESSION["error"] = "";
            $_SESSION["success"] = "Stock adjusted successfully";

        } else {

            $_SESSION["success"] = "";
            $_SESSION["error"] = "Stock adjustment failed";
        }

        header("Location: ../view/warehouse/stock-adjustment.php");
        exit();
    }

    // STOCK OUT
    else if (isset($_POST["stock_out"])) {

        if (empty($product_id) || empty($quantity)) {

            $_SESSION["success"] = "";
            $_SESSION["error"] = "All fields are required";

            header("Location: ../view/warehouse/stock-out.php");
            exit();
        }

        $transaction = new TransactionModel();

        $result = $transaction->stockOut($product_id, $quantity, $_SESSION["user_id"]);

        if ($result == "not_enough_stock") {

            $_SESSION["success"] = "";
            $_SESSION["error"] = "Not enough stock available";

        } else if ($result) {

            $_SESSION["error"] = "";
            $_SESSION["success"] = "Stock removed successfully";

        } else {

            $_SESSION["success"] = "";
            $_SESSION["error"] = "Stock out failed";
        }

        header("Location: ../view/warehouse/stock-out.php");
        exit();
    }

    // STOCK IN
    else {

        if (empty($product_id) || empty($quantity)) {

            $_SESSION["success"] = "";
            $_SESSION["error"] = "All fields are required";

            header("Location: ../view/warehouse/stock-in.php");
            exit();
        }

        $transaction = new TransactionModel();

        $result = $transaction->stockIn($product_id, $quantity, $_SESSION["user_id"]);

        if ($result) {

            $_SESSION["error"] = "";
            $_SESSION["success"] = "Stock added successfully";

        } else {

            $_SESSION["success"] = "";
            $_SESSION["error"] = "Stock update failed";
        }

        header("Location: ../view/warehouse/stock-in.php");
        exit();
    }
}
?>