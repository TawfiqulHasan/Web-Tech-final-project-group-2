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
    <a href="../../logout.php">Logout</a>
</div>

<div class="main-content">

    <div class="topbar">
        <div>
            <h2>Product Search</h2>
            <p>Search product by name or SKU</p>
        </div>
    </div>

    <div class="table-box">

        <input type="text"
               id="search"
               placeholder="Search product or SKU"
               onkeyup="searchProduct()">

        <table class="stock-table">
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>SKU</th>
                <th>Current Stock</th>
                <th>Reorder Level</th>
            </tr>

            <tbody id="searchResult">
            </tbody>
        </table>

    </div>

</div>

<script src="../../assets/js/product-search.js"></script>

</body>
</html>