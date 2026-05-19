<?php
class CategoryController {
    public function index() {
        require_login();

        view("categories/index", ["categories" => Category::all()]);
    }

    public function store() {
        require_role(["admin", "manager", "purchasing"]);

        $name = trim($_POST["name"] ?? "");

        if ($name === "") {
            set_flash("error", "Category name is required.");
            redirect("index.php?route=categories");
        }

        $id = Category::create([
            "name" => $name,
            "description" => trim($_POST["description"] ?? "")
        ]);

        log_activity("create", "categories", $id, "Created category: " . $name);
        set_flash("success", "Category added successfully.");
        redirect("index.php?route=categories");
    }
}
?>
