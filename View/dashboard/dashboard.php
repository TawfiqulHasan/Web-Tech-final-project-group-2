<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'purchasing') {
    header("Location: ../auth/login.php");
    exit();
}

require_once "../../config/database.php";

$sql = "SELECT * FROM purchase_orders";
$result = $conn->query($sql);

$lowStockSql = "SELECT * FROM products WHERE current_stock <= reorder_level";
$lowStockResult = $conn->query($lowStockSql);

$deliverySql = "SELECT * FROM purchase_orders
                WHERE expected_delivery_date
                BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)";
$deliveryResult = $conn->query($deliverySql);

$spendSql = "SELECT SUM(total_estimated_value) AS total_spend
             FROM purchase_orders
             WHERE status IN ('submitted', 'approved')";
$spendResult = $conn->query($spendSql);
$spendData = $spendResult->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>

<style>
table { border: 1px solid #1b4965; }
div {
    border: 1px solid #62b6cb;
    margin: auto;
    padding: 30px;
    width: 900px;
    min-height: 600px;
}
nav {
    background-color: #1b4965;
    height: 50px;
}
button a { text-decoration: none; color: black; }
</style>
</head>

<body>

<nav>
    <button><a href="../product/products.php">Product</a></button>
    <button><a href="dashboard.php">Dashboard</a></button>

    <!-- ✅ FIXED BUTTON (NO <a>) -->
    <button id="analyticsBtn" type="button">Analytical Dashboard</button>

    <button><a href="../purchase_order/approved_po.php">Approve Order</a></button>
    <button><a href="../purchase_order/create.php">Create Order</a></button>
    <button><a href="../purchase_order/po_report.php">Order Report</a></button>
    <button><a href="../suppliers/suppliers.php">Suppliers</a></button>
    <button><a href="../purchase_order/all_po.php">Order Info</a></button>
</nav>

<div id="contentArea">

<h2>Purchasing Dashboard</h2>

<h3>Open Purchase Orders</h3>
<table border="1" cellpadding="10">
<tr>
<th>PO ID</th><th>Supplier</th><th>Status</th><th>Delivery</th><th>Value</th><th>Date</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
<td><?= $row['id'] ?></td>
<td><?= $row['supplier_id'] ?></td>
<td><?= $row['status'] ?></td>
<td><?= $row['expected_delivery_date'] ?></td>
<td><?= $row['total_estimated_value'] ?></td>
<td><?= $row['created_at'] ?></td>
</tr>
<?php } ?>

</table>

<h3>Low Stock Products</h3>
<table border="1" cellpadding="10">
<?php while($p = $lowStockResult->fetch_assoc()) { ?>
<tr>
<td><?= $p['id'] ?></td>
<td><?= $p['name'] ?></td>
<td><?= $p['current_stock'] ?></td>
<td><?= $p['reorder_level'] ?></td>
</tr>
<?php } ?>
</table>

<h3>Deliveries This Week</h3>
<table border="1">
<?php while($d = $deliveryResult->fetch_assoc()) { ?>
<tr>
<td><?= $d['id'] ?></td>
<td><?= $d['supplier_id'] ?></td>
<td><?= $d['status'] ?></td>
<td><?= $d['expected_delivery_date'] ?></td>
</tr>
<?php } ?>
</table>

<h3>Total Spend</h3>
<p><?= $spendData['total_spend'] ?? 0 ?></p>

</div>

<script>
document.getElementById("analyticsBtn").addEventListener("click", function (e) {

    e.preventDefault();

    document.getElementById("contentArea").innerHTML = "Loading analytics...";

    fetch("../purchase_order/analytics.php")
        .then(res => res.text())
        .then(data => {
            document.getElementById("contentArea").innerHTML = data;
        })
        .catch(err => {
            document.getElementById("contentArea").innerHTML = "Error loading analytics";
            console.log(err);
        });

});
</script>

</body>
</html>