<?php

include_once(__DIR__ . "/../config/db.php");

class TransactionModel {

    // stock in
    public function stockIn($product_id, $quantity, $user_id){

        global $conn;

        // update product stock
        $sql =
        "UPDATE products
         SET current_stock =
         current_stock + '$quantity'
         WHERE id='$product_id'";

        $conn->query($sql);

        // save transaction
        $transactionSql =
        "INSERT INTO stock_transactions
        (product_id, user_id, type, quantity, transaction_date)

        VALUES
        ('$product_id',
         '$user_id',
         'in',
         '$quantity',
         NOW())";

        return $conn->query($transactionSql);
    }
}

?>