<?php
session_start();

require_once __DIR__ . "/../../Model/PurchaseOrder.php";
//$result = getAllPOs(); // we will create this function

require_once "../../Controller/PurchaseOrderController.php";

$status = $_GET['status'] ?? '';
$supplier_id = $_GET['supplier_id'] ?? '';
$from_date = $_GET['from_date'] ?? '';
$to_date = $_GET['to_date'] ?? '';

if (!empty($status) || !empty($supplier_id) || !empty($from_date)) {

    $result = fetchFilteredPOs(
        $status,
        $supplier_id,
        $from_date,
        $to_date
    );

} else {

    $result = getAllPOs();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Purchase Orders</title>
</head>
<body>

<h2>All Purchase Orders</h2>

<a href="analytics.php">Analytics Dashboard</a>
<br><br>

<form method="GET">

Status:
<select name="status">

    <option value="">All</option>

    <option value="draft">Draft</option>

    <option value="submitted">Submitted</option>

    <option value="approved">Approved</option>

    <option value="received">Received</option>

    <option value="cancelled">Cancelled</option>

</select>

<br><br>

Supplier ID:
<input type="text" name="supplier_id">

<br><br>

From:
<input type="date" name="from_date">

To:
<input type="date" name="to_date">

<br><br>

<button type="submit">Filter</button>

<a href="all_po.php">Reset</a>

</form>

<br><br>
<table border="1">

<tr>
    <th>ID</th>
    <th>Supplier</th>
    <th>Status</th>
    <th>Total</th>
    <th>Actions</th>
</tr>

<?php while ($row = $result->fetch_assoc()) { ?>

<tr>
    <td><?php echo $row['id'] ?></td>
    <td><?php echo $row['supplier_id'] ?></td>
    <td><?php echo $row['status'] ?></td>
    <td><?php echo $row['total_estimated_value'] ?></td>

    <td>

    <a href="edit_po.php?id=<?php echo $row['id'] ?>">Edit</a>

    <a href="receive_po.php?id=<?php echo $row['id'] ?>">Receive</a>

    <?php if ($row['status'] == 'draft' || $row['status'] == 'submitted' || $row['status'] == 'approved') { ?>

        <form method="post" action="../../Controller/PurchaseOrderController.php" style="display:inline;">

            <input type="hidden" name="po_id" value="<?php echo $row['id'] ?>">

            <input type="text" name="reason" placeholder="Cancel reason" required>

            <button type="submit" name="cancel_po"
                onclick="return confirm('Cancel this PO?')">
                Cancel
            </button>

        </form>

    <?php } ?>

    <?php if ($row['status'] == 'draft') { ?>

        <a href="../../Controller/PurchaseOrderController.php?delete=<?php echo $row['id'] ?>"
           onclick="return confirm('Delete this draft?')">
           Delete
        </a>

    <?php } ?>

</td>
</tr>


<?php } ?>

</table>

</body>
</html>