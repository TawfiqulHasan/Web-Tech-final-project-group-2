<?php
class StockTransactionController {
    public function index() {
        require_login();

        view("stock_transactions/index", [
            "transactions" => StockTransaction::all(),
            "products" => Product::all(),
            "warehouses" => Warehouse::all()
        ]);
    }

    public function store() {
        require_login();

        $product_id = $_POST["product_id"] ?? "";
        $warehouse_id = $_POST["warehouse_id"] ?? "";
        $type = $_POST["type"] ?? "";
        $quantity = $_POST["quantity"] ?? "";

        if ($product_id === "" || $warehouse_id === "" || $type === "" || $quantity === "") {
            set_flash("error", "Product, warehouse, type and quantity are required.");
            redirect("index.php?route=stock_transactions");
        }

        if (!is_numeric($quantity) || $quantity < 0) {
            set_flash("error", "Quantity must be a positive number.");
            redirect("index.php?route=stock_transactions");
        }

        $user = current_user();

        $id = StockTransaction::create([
            "product_id" => $product_id,
            "warehouse_id" => $warehouse_id,
            "user_id" => $user["id"],
            "type" => $type,
            "quantity" => $quantity,
            "unit_price" => $_POST["unit_price"] ?: null,
            "reason" => trim($_POST["reason"] ?? ""),
            "reference_note" => trim($_POST["reference_note"] ?? ""),
            "transaction_date" => $_POST["transaction_date"] ?? date("Y-m-d")
        ]);

        Product::updateStock($product_id, $type, $quantity);
        log_activity("create", "stock_transactions", $id, "Created stock transaction: " . $type);

        set_flash("success", "Stock transaction saved successfully.");
        redirect("index.php?route=stock_transactions");
    }
}
?>
