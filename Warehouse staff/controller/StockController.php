<?php
session_start();

include_once("../model/TransactionModel.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $product_id = trim($_POST["product_id"]);
    $quantity = trim($_POST["quantity"]);

    // STOCK OUT
    if (isset($_POST["stock_out"])) {

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