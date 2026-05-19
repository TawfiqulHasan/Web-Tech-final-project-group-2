<?php
class User {
    public static function findByEmail($email) {
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND is_active = 1");
        $stmt->execute([$email]);

        return $stmt->fetch();
    }

    public static function all() {
        global $pdo;

        $stmt = $pdo->query("SELECT * FROM users ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public static function countAll() {
        global $pdo;

        return $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
    }

    public static function create($data) {
        global $pdo;

        $stmt = $pdo->prepare("
            INSERT INTO users(name, email, password_hash, phone, role)
            VALUES(?, ?, ?, ?, ?)
        ");

        $password_hash = password_hash($data["password"], PASSWORD_DEFAULT);

        $stmt->execute([
            $data["name"],
            $data["email"],
            $password_hash,
            $data["phone"],
            $data["role"]
        ]);

        return $pdo->lastInsertId();
    }
}
?>
