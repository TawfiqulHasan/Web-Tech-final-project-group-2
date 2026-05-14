<?php
include("includes/auth-check.php");
include("../../config/db.php");

/* Total products */
$totalProductsQuery = "SELECT COUNT(*) AS total FROM products";
$totalProductsResult = $conn->query($totalProductsQuery);
$totalProducts = $totalProductsResult->fetch_assoc()['total'];

/* Low stock */
$lowStockQuery = "SELECT COUNT(*) AS low_stock 
                  FROM products 
                  WHERE current_stock <= reorder_level 
                  AND current_stock > 0";
$lowStockResult = $conn->query($lowStockQuery);
$lowStock = $lowStockResult->fetch_assoc()['low_stock'];
/* Recent activity */
$activityQuery =
"SELECT stock_transactions.*, products.name AS product_name
 FROM stock_transactions
 LEFT JOIN products ON stock_transactions.product_id = products.id
 ORDER BY stock_transactions.id DESC
 LIMIT 5";
/* Total transactions */
$totalTransactionQuery =
"SELECT COUNT(*) AS total_transaction FROM stock_transactions";

$totalTransactionResult =
$conn->query($totalTransactionQuery);

$totalTransaction =
$totalTransactionResult->fetch_assoc()['total_transaction'];

$activityResult = $conn->query($activityQuery);
/* Out of stock */
$outStockQuery = "SELECT COUNT(*) AS out_stock 
                  FROM products 
                  WHERE current_stock = 0";
$outStockResult = $conn->query($outStockQuery);
$outStock = $outStockResult->fetch_assoc()['out_stock'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Warehouse Dashboard</title>

    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
</head>
<body>

<div class="sidebar">

    <h2>Warehouse Staff</h2>

    <a href="dashboard.php" class="active">Dashboard</a>
    <a href="stock-list.php">Stock List</a>
    <a href="product-search.php">Product Search</a>
    <a href="stock-in.php">Stock In</a>
    <a href="stock-out.php">Stock Out</a>
    <a href="transaction-history.php">Transactions</a>
    <a href="../../logout.php">Logout</a>

</div>

<div class="main-content">

    <div class="topbar">

        <div>
            <h2>Warehouse Dashboard</h2>
            <p>Welcome back, <b><?php echo htmlspecialchars($_SESSION["name"]); ?></b></p>
        </div>

        <div class="topbar-right">
            🔔 Notifications | <?php echo date("d M Y"); ?>
        </div>

    </div>

    <div class="dashboard-cards">

        <div class="card card-transaction">
            <h3>📦 Total Products</h3>
            <p><?php echo $totalProducts; ?></p>
        </div>

        <div class="card card-low">
            <h3>⚠️ Low Stock</h3>
            <p><?php echo $lowStock; ?></p>
        </div>

        <div class="card card-out">
            <h3>❌ Out of Stock</h3>
            <p><?php echo $outStock; ?></p>
        </div>
        <div class="card card-good">
            <h3>📊 Total Transactions</h3>
            <p><?php echo $totalTransaction; ?></p>
        </div>

    </div>

    <div class="quick-actions">

        <h3>Quick Actions</h3>

        <div class="action-grid">

            <a href="stock-list.php" class="action-btn stock-view">
                <div class="action-icon">📦</div>
                <b>View Stock</b>
                <span>Check all products</span>
            </a>

            <a href="product-search.php" class="action-btn search-product">
                <div class="action-icon">🔍</div>
                <b>Search Product</b>
                <span>Find product quickly</span>
            </a>

            <a href="stock-in.php" class="action-btn stock-in">
                <div class="action-icon">➕</div>
                <b>Stock In</b>
                <span>Add new stock</span>
            </a>

            <a href="stock-out.php" class="action-btn stock-out">
                <div class="action-icon">➖</div>
                <b>Stock Out</b>
                <span>Remove stock item</span>
            </a>

            <a href="transaction-history.php" class="action-btn transaction-btn">
                <div class="action-icon">📑</div>
                <b>Transactions</b>
                <span>View stock history</span>
            </a>

        </div>

    </div>

    <div class="activity-box">

        <h3>Recent Activity</h3>

        <?php
        if($activityResult->num_rows > 0){

            while($activity = $activityResult->fetch_assoc()){
        ?>

                <p>
                    <b><?php echo ucfirst($activity["type"]); ?></b>
                    -
                    <?php echo $activity["product_name"]; ?>
                    |
                    Quantity:
                    <?php echo $activity["quantity"]; ?>
                    |
                    Date:
                    <?php echo $activity["transaction_date"]; ?>
                </p>

        <?php
            }

        } else {
            echo "<p>No recent activity yet.</p>";
        }
        ?>

    </div>

</div>

</body>
</html>