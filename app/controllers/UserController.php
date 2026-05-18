<?php
class UserController {
    public function index() {
        require_role(["admin", "manager"]);

        view("users/index", ["users" => User::all()]);
    }

    public function store() {
        require_role(["admin", "manager"]);

        $name = trim($_POST["name"] ?? "");
        $email = trim($_POST["email"] ?? "");
        $password = trim($_POST["password"] ?? "");
        $role = $_POST["role"] ?? "";

        if ($name === "" || $email === "" || $password === "" || $role === "") {
            set_flash("error", "Name, email, password and role are required.");
            redirect("index.php?route=users");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            set_flash("error", "Email address is invalid.");
            redirect("index.php?route=users");
        }

        $id = User::create([
            "name" => $name,
            "email" => $email,
            "password" => $password,
            "phone" => trim($_POST["phone"] ?? ""),
            "role" => $role
        ]);

        log_activity("create", "users", $id, "Created user: " . $name);
        set_flash("success", "User added successfully.");
        redirect("index.php?route=users");
    }
}
?>
