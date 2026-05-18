<?php
class Warehouse {
    public static function all() {
        global $pdo;

        $stmt = $pdo->query("SELECT * FROM warehouses ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public static function countAll() {
        global $pdo;

        return $pdo->query("SELECT COUNT(*) FROM warehouses")->fetchColumn();
    }

    public static function create($data) {
        global $pdo;

        $stmt = $pdo->prepare("INSERT INTO warehouses(name, address, city) VALUES(?, ?, ?)");
        $stmt->execute([$data["name"], $data["address"], $data["city"]]);

        return $pdo->lastInsertId();
    }
}
?>
