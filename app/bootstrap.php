<?php
session_start();

require_once __DIR__ . "/config/database.php";
require_once __DIR__ . "/core/functions.php";

$database = new Database();
$pdo = $database->connect();

require_once __DIR__ . "/models/User.php";
require_once __DIR__ . "/models/Product.php";
require_once __DIR__ . "/models/Category.php";
require_once __DIR__ . "/models/Warehouse.php";
require_once __DIR__ . "/models/Supplier.php";
require_once __DIR__ . "/models/PurchaseOrder.php";
require_once __DIR__ . "/models/StockTransaction.php";
require_once __DIR__ . "/models/ActivityLog.php";

require_once __DIR__ . "/controllers/AuthController.php";
require_once __DIR__ . "/controllers/DashboardController.php";
require_once __DIR__ . "/controllers/ProductController.php";
require_once __DIR__ . "/controllers/CategoryController.php";
require_once __DIR__ . "/controllers/WarehouseController.php";
require_once __DIR__ . "/controllers/SupplierController.php";
require_once __DIR__ . "/controllers/PurchaseOrderController.php";
require_once __DIR__ . "/controllers/StockTransactionController.php";
require_once __DIR__ . "/controllers/UserController.php";
require_once __DIR__ . "/controllers/ReportController.php";
require_once __DIR__ . "/controllers/ActivityLogController.php";

require_once __DIR__ . "/core/Router.php";
?>
