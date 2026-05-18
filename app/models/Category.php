<?php
class Category {
    public static function all() {
        global $pdo;

        $stmt = $pdo->query("SELECT * FROM categories ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public static function create($data) {
        global $pdo;

        $stmt = $pdo->prepare("INSERT INTO categories(name, description) VALUES(?, ?)");
        $stmt->execute([$data["name"], $data["description"]]);

        return $pdo->lastInsertId();
    }
}
?>
