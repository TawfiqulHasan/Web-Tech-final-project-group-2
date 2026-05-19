<?php
class Router {
    public function dispatch() {
        $route = $_GET["route"] ?? "dashboard";
        $action = $_GET["action"] ?? "index";

        $routes = [
            "login" => "AuthController",
            "logout" => "AuthController",
            "dashboard" => "DashboardController",
            "products" => "ProductController",
            "categories" => "CategoryController",
            "warehouses" => "WarehouseController",
            "suppliers" => "SupplierController",
            "purchase_orders" => "PurchaseOrderController",
            "stock_transactions" => "StockTransactionController",
            "users" => "UserController",
            "reports" => "ReportController",
            "activity_logs" => "ActivityLogController"
        ];

        if (!isset($routes[$route])) {
            die("Page not found.");
        }

        $controllerName = $routes[$route];
        $controller = new $controllerName();

        if ($route === "login" && $_SERVER["REQUEST_METHOD"] === "POST") {
            $action = "login";
        }

        if ($route === "logout") {
            $action = "logout";
        }

        if (!method_exists($controller, $action)) {
            die("Action not found.");
        }

        $controller->$action();
    }
}
?>
