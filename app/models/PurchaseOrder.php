<?php
class PurchaseOrder {
    public static function all() {
        global $pdo;

        $stmt = $pdo->query("
            SELECT purchase_orders.*, suppliers.company_name, users.name AS raised_by_name
            FROM purchase_orders
            LEFT JOIN suppliers ON purchase_orders.supplier_id = suppliers.id
            LEFT JOIN users ON purchase_orders.raised_by = users.id
            ORDER BY purchase_orders.id DESC
        ");

        return $stmt->fetchAll();
    }

    public static function create($data) {
        global $pdo;

        $stmt = $pdo->prepare("
            INSERT INTO purchase_orders
            (supplier_id, raised_by, status, expected_delivery_date, total_estimated_value, notes)
            VALUES(?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $data["supplier_id"],
            $data["raised_by"],
            $data["status"],
            $data["expected_delivery_date"],
            $data["total_estimated_value"],
            $data["notes"]
        ]);

        return $pdo->lastInsertId();
    }
}
?>
