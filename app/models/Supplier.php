<?php
class Supplier {
    public static function all() {
        global $pdo;

        $stmt = $pdo->query("SELECT * FROM suppliers ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public static function countAll() {
        global $pdo;

        return $pdo->query("SELECT COUNT(*) FROM suppliers")->fetchColumn();
    }

    public static function create($data) {
        global $pdo;

        $stmt = $pdo->prepare("
            INSERT INTO suppliers(company_name, contact_person, phone, email, address, city, payment_terms)
            VALUES(?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $data["company_name"],
            $data["contact_person"],
            $data["phone"],
            $data["email"],
            $data["address"],
            $data["city"],
            $data["payment_terms"]
        ]);

        return $pdo->lastInsertId();
    }
}
?>
