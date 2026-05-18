<?php
session_start();

require_once "../../Model/PurchaseOrder.php";

$spend = getSpendPerSupplierPerMonth();
$lead = getAvgLeadTimePerSupplier();
$products = getMostFrequentProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Procurement Analytics Dashboard</h2>



<h3>Spend Per Supplier Per Month</h3>
<table border="1">
<tr>
    <th>Supplier ID</th>
    <th>Month</th>
    <th>Total Spend</th>
</tr>

<?php while ($row = $spend->fetch_assoc()) { ?>
<tr>
    <td><?= $row['supplier_id'] ?></td>
    <td><?= $row['month'] ?></td>
    <td><?= $row['total_spend'] ?></td>
</tr>
<?php } ?>
</table>



<h3>Average Lead Time</h3>
<table border="1">
<tr>
    <th>Supplier ID</th>
    <th>Avg Lead Time (Days)</th>
</tr>

<?php while ($row = $lead->fetch_assoc()) { ?>
<tr>
    <td><?= $row['supplier_id'] ?></td>
    <td><?= round($row['avg_lead_time'], 2) ?></td>
</tr>
<?php } ?>
</table>



<h3>Most Frequently Ordered Products</h3>
<table border="1">
<tr>
    <th>Product ID</th>
    <th>Total Ordered</th>
</tr>

<?php while ($row = $products->fetch_assoc()) { ?>
<tr>
    <td><?= $row['product_id'] ?></td>
    <td><?= $row['total_ordered'] ?></td>
</tr>
<?php } ?>
</table>
</body>
</html>