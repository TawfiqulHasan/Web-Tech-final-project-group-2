<?php
class ProductController {
    public function index() {
        require_login();

        view("products/index", [
            "products" => Product::all(),
            "categories" => Category::all()
        ]);
    }

    public function store() {
        require_role(["admin", "manager", "purchasing"]);

        $name = trim($_POST["name"] ?? "");
        $sku = trim($_POST["sku"] ?? "");
        $category_id = $_POST["category_id"] ?? "";
        $unit = $_POST["unit"] ?? "";
        $reorder_level = $_POST["reorder_level"] ?? "";
        $current_stock = $_POST["current_stock"] ?? "";

        if ($name === "" || $sku === "" || $category_id === "" || $unit === "") {
            set_flash("error", "Product name, SKU, category and unit are required.");
            redirect("index.php?route=products");
        }

        if (!is_numeric($reorder_level) || !is_numeric($current_stock)) {
            set_flash("error", "Reorder level and current stock must be numbers.");
            redirect("index.php?route=products");
        }

        $id = Product::create([
            "category_id" => $category_id,
            "name" => $name,
            "sku" => $sku,
            "description" => trim($_POST["description"] ?? ""),
            "unit" => $unit,
            "reorder_level" => $reorder_level,
            "current_stock" => $current_stock
        ]);

        log_activity("create", "products", $id, "Created product: " . $name);
        set_flash("success", "Product added successfully.");
        redirect("index.php?route=products");
    }
}
?>
