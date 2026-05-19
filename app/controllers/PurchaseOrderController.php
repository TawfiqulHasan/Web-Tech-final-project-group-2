<?php
class PurchaseOrderController {
    public function index() {
        require_role(["admin", "manager", "purchasing"]);

        view("purchase_orders/index", [
            "orders" => PurchaseOrder::all(),
            "suppliers" => Supplier::all()
        ]);
    }

    public function store() {
        require_role(["admin", "manager", "purchasing"]);

        $supplier_id = $_POST["supplier_id"] ?? "";
        $status = $_POST["status"] ?? "draft";
        $total_estimated_value = $_POST["total_estimated_value"] ?? 0;

        if ($supplier_id === "") {
            set_flash("error", "Supplier is required.");
            redirect("index.php?route=purchase_orders");
        }

        if (!is_numeric($total_estimated_value)) {
            set_flash("error", "Total estimated value must be a number.");
            redirect("index.php?route=purchase_orders");
        }

        $user = current_user();

        $id = PurchaseOrder::create([
            "supplier_id" => $supplier_id,
            "raised_by" => $user["id"],
            "status" => $status,
            "expected_delivery_date" => $_POST["expected_delivery_date"] ?? null,
            "total_estimated_value" => $total_estimated_value,
            "notes" => trim($_POST["notes"] ?? "")
        ]);

        log_activity("create", "purchase_orders", $id, "Created purchase order #" . $id);
        set_flash("success", "Purchase order added successfully.");
        redirect("index.php?route=purchase_orders");
    }
}
?>
