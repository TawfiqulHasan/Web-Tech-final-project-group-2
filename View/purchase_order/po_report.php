<?php
session_start();

require_once "../../Model/PurchaseOrder.php";

$from_date = $_GET['from_date'] ?? '';
$to_date = $_GET['to_date'] ?? '';

$result = null;

if (!empty($from_date) && !empty($to_date)) {
    $result = getPOReportByDateRange($from_date, $to_date);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>purchase order report</title>
</head>
<body>
    <h2>Purchase Order Report</h2>

<form method="GET">

From Date:
<input type="date" name="from_date" required>
<br><br>
To Date:
<input type="date" name="to_date" required>
<br><br>
<button type="submit">Generate Report</button>

<button><a href="po_report.php">Reset</a></button>

</form>

<br>

<?php if ($result) { ?>

<table border="1">

<tr>
    <th>PO ID</th>
    <th>Supplier ID</th>
    <th>Status</th>
    <th>Total Value</th>
    <th>Date</th>
</tr>

<?php while ($row = $result->fetch_assoc()) { ?>

<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['supplier_id'] ?></td>
    <td><?= $row['status'] ?></td>
    <td><?= $row['total_estimated_value'] ?></td>
    <td><?= $row['created_at'] ?></td>
</tr>

<?php } ?>

</table>

<?php } ?>

</body>
</html>