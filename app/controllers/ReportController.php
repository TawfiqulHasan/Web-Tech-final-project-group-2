<?php
class ReportController {
    public function index() {
        require_login();

        view("reports/index", [
            "low_stock_products" => Product::lowStock()
        ]);
    }
}
?>
