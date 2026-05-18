<?php
class AuthController {
    public function index() {
        if (current_user()) {
            redirect("index.php?route=dashboard");
        }

        auth_view("auth/login", ["error" => ""]);
    }

    public function login() {
        $email = trim($_POST["email"] ?? "");
        $password = trim($_POST["password"] ?? "");

        if ($email === "" || $password === "") {
            auth_view("auth/login", ["error" => "Email and password are required."]);
            return;
        }

        $user = User::findByEmail($email);

        if (!$user) {
            auth_view("auth/login", ["error" => "Invalid email or password."]);
            return;
        }

        $saved_password = $user["password_hash"];
        $password_ok = password_verify($password, $saved_password) || hash_equals($saved_password, $password);

        if (!$password_ok) {
            auth_view("auth/login", ["error" => "Invalid email or password."]);
            return;
        }

        $_SESSION["user_id"] = $user["id"];
        log_activity("login", "users", $user["id"], "User logged in");

        redirect("index.php?route=dashboard");
    }

    public function logout() {
        log_activity("logout", "users", $_SESSION["user_id"] ?? 0, "User logged out");
        session_destroy();
        redirect("index.php?route=login");
    }
}
?>
