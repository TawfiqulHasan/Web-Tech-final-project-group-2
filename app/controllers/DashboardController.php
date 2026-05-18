<?php
class DashboardController {
    public function index() {
        require_login();

        view("dashboard/index", [
            "total_users" => User::countAll(),
            "total_products" => Product::countAll(),
            "total_warehouses" => Warehouse::countAll(),
            "total_suppliers" => Supplier::countAll(),
            "low_stock_products" => Product::lowStock()
        ]);
    }
}
?>
