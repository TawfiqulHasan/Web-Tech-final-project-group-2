<?php
class StockTransaction {
    public static function all() {
        global $pdo;

        $stmt = $pdo->query("
            SELECT stock_transactions.*, products.name AS product_name,
                   warehouses.name AS warehouse_name, users.name AS user_name
            FROM stock_transactions
            LEFT JOIN products ON stock_transactions.product_id = products.id
            LEFT JOIN warehouses ON stock_transactions.warehouse_id = warehouses.id
            LEFT JOIN users ON stock_transactions.user_id = users.id
            ORDER BY stock_transactions.id DESC
        ");

        return $stmt->fetchAll();
    }

    public static function create($data) {
        global $pdo;

        $stmt = $pdo->prepare("
            INSERT INTO stock_transactions
            (product_id, warehouse_id, user_id, type, quantity, unit_price, reason, reference_note, transaction_date)
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $data["product_id"],
            $data["warehouse_id"],
            $data["user_id"],
            $data["type"],
            $data["quantity"],
            $data["unit_price"],
            $data["reason"],
            $data["reference_note"],
            $data["transaction_date"]
        ]);

        return $pdo->lastInsertId();
    }
}
?>
