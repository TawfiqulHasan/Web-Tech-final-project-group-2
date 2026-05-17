<?php
include("includes/auth-check.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Search</title>

    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/stock-list.css">
</head>
<body>

<div class="sidebar">

    <h2>Warehouse Staff</h2>

    <a href="dashboard.php">Dashboard</a>
    <a href="stock-list.php">Stock List</a>
    <a href="product-search.php" class="active">Product Search</a>
    <a href="stock-in.php">Stock In</a>
    <a href="stock-out.php">Stock Out</a>
    <a href="stock-adjustment.php">Stock Adjustment</a>
    <a href="receive-po.php">Receive PO</a>
    <a href="transaction-history.php">Transactions</a>
    <a href="discrepancy-create.php">Report Discrepancy</a>
    <a href="../../logout.php">Logout</a>

</div>

<div class="main-content">

    <div class="topbar">

        <div>
            <h2>Product Search</h2>
            <p>
                Search products by name or SKU
                and view warehouse location
            </p>
        </div>
            <div class="topbar-right">
        <a href="my-discrepancy-reports.php" class="topbar-link">
            📝 My Report
        </a>

        <a href="profile.php" class="topbar-link">
            👤 My Profile
        </a>

        <span class="topbar-date">
            <?php echo date("d M Y"); ?>
        </span>
    </div>

    </div>

    <div class="table-box">

        <div class="table-header">

            <h3>Search Product</h3>

            <input type="text"
                   class="search-box"
                   id="search"
                   placeholder="Search product or SKU"
                   onkeyup="searchProduct()">

        </div>

        <table class="stock-table">

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>SKU</th>
                    <th>Category</th>
                    <th>Current Stock</th>
                    <th>Reorder Level</th>
                    <th>Zone</th>
                    <th>Bin</th>
                </tr>

            </thead>

            <tbody id="searchResult">

            </tbody>

        </table>

    </div>

</div>

<script src="../../assets/js/product-search.js?v=2"></script>

</body>
</html>