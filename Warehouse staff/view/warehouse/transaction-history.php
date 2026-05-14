<?php
include("includes/auth-check.php");
include("../../config/db.php");

$sql = "SELECT stock_transactions.*, products.name AS product_name, users.name AS user_name
        FROM stock_transactions
        LEFT JOIN products ON stock_transactions.product_id = products.id
        LEFT JOIN users ON stock_transactions.user_id = users.id
        ORDER BY stock_transactions.id DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transaction History</title>

    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/stock-list.css">
</head>
<body>

<div class="sidebar">

    <h2>Warehouse Staff</h2>

    <a href="dashboard.php">Dashboard</a>
    <a href="stock-list.php">Stock List</a>
    <a href="product-search.php">Product Search</a>
    <a href="stock-in.php">Stock In</a>
    <a href="stock-out.php">Stock Out</a>
    <a href="transaction-history.php" class="active">Transactions</a>
    <a href="../../logout.php">Logout</a>

</div>

<div class="main-content">

    <div class="topbar">
        <div>
            <h2>Transaction History</h2>
            <p>All stock in and stock out records</p>
        </div>
    </div>

    <div class="table-box">

        <table class="stock-table">

            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>User</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>Date</th>
            </tr>

            <?php
            while($row = $result->fetch_assoc()){
            ?>

            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["product_name"]; ?></td>
                <td><?php echo $row["user_name"]; ?></td>
                <td><?php echo $row["type"]; ?></td>
                <td><?php echo $row["quantity"]; ?></td>
                <td><?php echo $row["transaction_date"]; ?></td>
            </tr>

            <?php
            }
            ?>

        </table>

    </div>

</div>

</body>
</html>