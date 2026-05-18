<?php
function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}

function redirect($url) {
    header("Location: " . $url);
    exit;
}

function set_flash($type, $message) {
    $_SESSION["flash"] = [
        "type" => $type,
        "message" => $message
    ];
}

function get_flash() {
    if (!empty($_SESSION["flash"])) {
        $flash = $_SESSION["flash"];
        unset($_SESSION["flash"]);
        return $flash;
    }

    return null;
}

function current_user() {
    global $pdo;

    if (empty($_SESSION["user_id"])) {
        return null;
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ? AND is_active = 1");
    $stmt->execute([$_SESSION["user_id"]]);

    $user = $stmt->fetch();
    return $user ?: null;
}

function require_login() {
    if (!current_user()) {
        redirect("index.php?route=login");
    }
}

function has_role($roles) {
    $user = current_user();

    if (!$user) {
        return false;
    }

    if (!is_array($roles)) {
        $roles = [$roles];
    }

    return in_array($user["role"], $roles);
}

function require_role($roles) {
    require_login();

    if (!has_role($roles)) {
        die("Access denied. You do not have permission to open this page.");
    }
}

function view($view_file, $data = []) {
    extract($data);

    require __DIR__ . "/../views/layouts/header.php";
    require __DIR__ . "/../views/" . $view_file . ".php";
    require __DIR__ . "/../views/layouts/footer.php";
}

function auth_view($view_file, $data = []) {
    extract($data);
    require __DIR__ . "/../views/" . $view_file . ".php";
}

function log_activity($action_type, $entity, $entity_id, $description) {
    global $pdo;

    $user = current_user();
    $user_id = $user ? $user["id"] : null;

    $stmt = $pdo->prepare("
        INSERT INTO activity_logs(user_id, action_type, entity, entity_id, description)
        VALUES(?, ?, ?, ?, ?)
    ");

    $stmt->execute([$user_id, $action_type, $entity, $entity_id, $description]);
}
?>
