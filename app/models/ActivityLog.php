<?php
class ActivityLog {
    public static function all() {
        global $pdo;

        $stmt = $pdo->query("
            SELECT activity_logs.*, users.name AS user_name
            FROM activity_logs
            LEFT JOIN users ON activity_logs.user_id = users.id
            ORDER BY activity_logs.id DESC
        ");

        return $stmt->fetchAll();
    }
}
?>
