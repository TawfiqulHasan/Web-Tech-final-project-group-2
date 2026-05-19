<?php

include_once(__DIR__ . "/../config/db.php");

class PurchaseOrderModel {

    public function getPendingItems(){

        global $conn;

        $sql =
        "SELECT 
            purchase_order_items.id AS item_id,
            purchase_order_items.po_id,
            purchase_order_items.product_id,
            purchase_order_items.ordered_qty,
            purchase_order_items.received_qty,
            purchase_order_items.unit_price,
            purchase_orders.expected_delivery_date,
            purchase_orders.status,
            products.name AS product_name,
            products.sku
         FROM purchase_order_items
         LEFT JOIN purchase_orders
         ON purchase_order_items.po_id = purchase_orders.id
         LEFT JOIN products
         ON purchase_order_items.product_id = products.id
         WHERE purchase_orders.status IN ('approved', 'submitted')
         ORDER BY purchase_orders.expected_delivery_date ASC";

        return $conn->query($sql);
    }

    public function receiveItem($item_id, $received_qty, $user_id){

        global $conn;

        $itemSql =
        "SELECT * FROM purchase_order_items WHERE id='$item_id'";

        $itemResult = $conn->query($itemSql);
        $item = $itemResult->fetch_assoc();

        $product_id = $item["product_id"];
        $unit_price = $item["unit_price"];

        $updateItemSql =
        "UPDATE purchase_order_items
         SET received_qty = received_qty + '$received_qty'
         WHERE id='$item_id'";

        $conn->query($updateItemSql);

        $updateProductSql =
        "UPDATE products
         SET current_stock = current_stock + '$received_qty'
         WHERE id='$product_id'";

        $conn->query($updateProductSql);

        $transactionSql =
        "INSERT INTO stock_transactions
        (product_id, user_id, type, quantity, unit_price, po_id, transaction_date)
        VALUES
        ('$product_id', '$user_id', 'in', '$received_qty', '$unit_price', '{$item["po_id"]}', NOW())";

        return $conn->query($transactionSql);
    }
}

?>