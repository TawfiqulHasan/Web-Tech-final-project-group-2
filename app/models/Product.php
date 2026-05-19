<?php
class Product {
    public static function all() {
        global $pdo;

        $stmt = $pdo->query("
            SELECT products.*, categories.name AS category_name
            FROM products
            LEFT JOIN categories ON products.category_id = categories.id
            ORDER BY products.id DESC
        ");

        return $stmt->fetchAll();
    }

    public static function countAll() {
        global $pdo;

        return $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
    }

    public static function lowStock() {
        global $pdo;

        $stmt = $pdo->query("
            SELECT * FROM products
            WHERE current_stock <= reorder_level
            ORDER BY current_stock ASC
        ");

        return $stmt->fetchAll();
    }

    public static function lowStockCount() {
        global $pdo;

        return $pdo->query("
            SELECT COUNT(*) FROM products
            WHERE current_stock <= reorder_level
        ")->fetchColumn();
    }

    public static function create($data) {
        global $pdo;

        $stmt = $pdo->prepare("
            INSERT INTO products(category_id, name, sku, description, unit, reorder_level, current_stock)
            VALUES(?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $data["category_id"],
            $data["name"],
            $data["sku"],
            $data["description"],
            $data["unit"],
            $data["reorder_level"],
            $data["current_stock"]
        ]);

        return $pdo->lastInsertId();
    }

    public static function updateStock($product_id, $type, $quantity) {
        global $pdo;

        if ($type === "in") {
            $stmt = $pdo->prepare("UPDATE products SET current_stock = current_stock + ? WHERE id = ?");
            $stmt->execute([$quantity, $product_id]);
        }

        if ($type === "out") {
            $stmt = $pdo->prepare("UPDATE products SET current_stock = current_stock - ? WHERE id = ?");
            $stmt->execute([$quantity, $product_id]);
        }

        if ($type === "adjustment") {
            $stmt = $pdo->prepare("UPDATE products SET current_stock = ? WHERE id = ?");
            $stmt->execute([$quantity, $product_id]);
        }
    }
}
?>
