<?php
session_start();
require_once "../../Model/PurchaseOrder.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    die("Invalid Purchase Order ID");
}

$result = getPOById($id);
$po = $result->fetch_assoc();

$itemsResult = getPOItems($id);
$items = $itemsResult->fetch_assoc();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Edit Purchase Order</h2>

<form method="post" action="../../Controller/PurchaseOrderController.php">

<input type="hidden" name="po_id" value="<?php echo $po['id'] ?>">

Supplier ID:
<input type="text" name="supplier_id" value="<?php echo $po['supplier_id'] ?>">

<br><br>

Delivery Date:
<input type="date" name="delivery_date" value="<?php echo $po['expected_delivery_date'] ?>">

<br><br>

Notes:
<textarea name="notes"><?php echo $po['notes'] ?></textarea>

<br><br>

Product ID:
<input type="text" name="product_id" value="<?php echo $items['product_id'] ?? '' ?>">

<br><br>

Quantity:
<input type="number" name="qty" value="<?php echo $items['ordered_qty'] ?? '' ?>">

<br><br>

Unit Price:
<input type="number" name="price" value="<?php echo $items['unit_price'] ?? '' ?>">

Status:
<select name="status">

    <option value="draft" <?php echo ($po['status'] == 'draft') ? 'selected' : '' ?>>Draft</option>

    <option value="submitted" <?php echo ($po['status'] == 'submitted') ? 'selected' : '' ?>>Submitted</option>

</select>

<br><br>

<button type="submit" name="update_po">Update PO</button>

</form>
</body>
</html>