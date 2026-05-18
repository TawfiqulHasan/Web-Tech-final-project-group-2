<?php
session_start();
require_once "../../Controller/PurchaseOrderController.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$suppliers = fetchSuppliers();
$products = fetchProducts();
?>

<!DOCTYPE html>
<html>
<head>
<title>Create PO</title>
</head>
<body>

<h2>Create Purchase Order</h2>

<form method="post" action="../../Controller/PurchaseOrderController.php">

<!-- Supplier -->
<select name="supplier_id" required>
    <option value="">Select Supplier</option>
    <?php while($s = $suppliers->fetch_assoc()) { ?>
        <option value="<?php echo $s['id'] ?>">
            <?php echo $s['company_name'] ?>
        </option>
    <?php } ?>
</select>

<br><br>


<select name="product_id" required>
    <option value="">Select Product</option>
    <?php while($p = $products->fetch_assoc()) { ?>
        <option value="<?php echo $p['id'] ?>">
            <?php echo $p['name'] ?>
        </option>
    <?php } ?>
</select>

<br><br>

Quantity:
<input type="number" name="qty" required>

<br><br>

Unit Price:
<input type="number" name="price" required>

<br><br>

Expected Delivery:
<input type="date" name="delivery_date" required>

<br><br>

Notes:
<textarea name="notes"></textarea>

<br><br>

<button type="submit" name="status" value="draft">Save Draft</button>
<button type="submit" name="status" value="submitted">Submit</button>

</form>

</body>
</html>