<?php
class WarehouseController {
    public function index() {
        require_login();

        view("warehouses/index", ["warehouses" => Warehouse::all()]);
    }

    public function store() {
        require_role(["admin", "manager"]);

        $name = trim($_POST["name"] ?? "");

        if ($name === "") {
            set_flash("error", "Warehouse name is required.");
            redirect("index.php?route=warehouses");
        }

        $id = Warehouse::create([
            "name" => $name,
            "address" => trim($_POST["address"] ?? ""),
            "city" => trim($_POST["city"] ?? "")
        ]);

        log_activity("create", "warehouses", $id, "Created warehouse: " . $name);
        set_flash("success", "Warehouse added successfully.");
        redirect("index.php?route=warehouses");
    }
}
?>
