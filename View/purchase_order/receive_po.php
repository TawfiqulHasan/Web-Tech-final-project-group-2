<?php
session_start();
require_once "../../Model/PurchaseOrder.php";
 
$po_id = $_GET['id'] ?? null;
 
if (!$po_id) {
    die("Purchase Order ID is missing");
}

$items = getPOItems($po_id);
$rows = $items->fetch_all(MYSQLI_ASSOC);

?>
 
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>recieve</title>
</head>
<body>
    <h2>Receive Purchase Order</h2>
 
 
<h2>Receive Purchase Order #<?= $po_id ?></h2>
 
<form method="post" action="../../Controller/PurchaseOrderController.php">
 
<input type="hidden" name="po_id" value="<?= $po_id ?>">
 
<table border="1">
 
<tr>
    <th>Product ID</th>
    <th>Ordered Qty</th>
    <th>Received Qty</th>
</tr>
 
<?php for ($i = 0; $i < count($rows); $i++) { 
    $row = $rows[$i];
?>
 
<tr>
    <td>
        <?= $row['product_id'] ?>
        <input type="hidden" name="product_id[]" value="<?= $row['product_id'] ?>">
    </td>
 
    <td><?= $row['ordered_qty'] ?></td>
 
    <td>
        <input type="number" name="received_qty[]" value="<?= $row['received_qty'] ?>">
    </td>
</tr>
 
<?php } ?>
 
</table>
 
<br>
 
<button type="submit" name="receive_po">Mark as Received</button>
 
</form>
 
<h3>Item Tracking</h3>

<table border="1">

<tr>
    <th>Product</th>
    <th>Ordered</th>
    <th>Received</th>
    <th>Remaining</th>
</tr>

<?php for ($i = 0; $i < count($rows); $i++) { 
    $row = $rows[$i];
    $remaining = $row['ordered_qty'] - $row['received_qty'];
?>

<tr>
    <td><?= $row['product_id'] ?></td>
    <td><?= $row['ordered_qty'] ?></td>
    <td><?= $row['received_qty'] ?></td>
    <td><?= $remaining ?></td>
</tr>

<?php } ?>

</table>
 
 

 
</body>
</html>