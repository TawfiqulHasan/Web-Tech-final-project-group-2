<?php

include_once(__DIR__ . "/../config/db.php");

class TransactionModel {

    // stock in
    public function stockIn($product_id, $quantity, $user_id){

        global $conn;

        $sql =
        "UPDATE products
         SET current_stock = current_stock + '$quantity'
         WHERE id='$product_id'";

        $conn->query($sql);

        $transactionSql =
        "INSERT INTO stock_transactions
        (product_id, user_id, type, quantity, transaction_date)
        VALUES
        ('$product_id', '$user_id', 'in', '$quantity', NOW())";

        return $conn->query($transactionSql);
    }

    // stock out
    public function stockOut($product_id, $quantity, $user_id){

        global $conn;

        $checkSql =
        "SELECT current_stock FROM products WHERE id='$product_id'";

        $result = $conn->query($checkSql);
        $row = $result->fetch_assoc();

        if($row["current_stock"] < $quantity){
            return "not_enough_stock";
        }

        $sql =
        "UPDATE products
         SET current_stock = current_stock - '$quantity'
         WHERE id='$product_id'";

        $conn->query($sql);

        $transactionSql =
        "INSERT INTO stock_transactions
        (product_id, user_id, type, quantity, transaction_date)
        VALUES
        ('$product_id', '$user_id', 'out', '$quantity', NOW())";

        return $conn->query($transactionSql);
    }

    // stock adjustment
    public function stockAdjustment($product_id, $adjust_quantity, $reason, $user_id){

        global $conn;

        $checkSql =
        "SELECT current_stock FROM products WHERE id='$product_id'";

        $result = $conn->query($checkSql);
        $row = $result->fetch_assoc();

        $finalStock = $row["current_stock"] + $adjust_quantity;

        // prevent final stock from becoming negative
        if($finalStock < 0){
            return "negative_stock";
        }

        $sql =
        "UPDATE products
         SET current_stock = '$finalStock'
         WHERE id='$product_id'";

        $conn->query($sql);

        $transactionSql =
        "INSERT INTO stock_transactions
        (product_id, user_id, type, quantity, reason, transaction_date)
        VALUES
        ('$product_id', '$user_id', 'adjustment', '$adjust_quantity', '$reason', NOW())";

        return $conn->query($transactionSql);
    }
}

?>