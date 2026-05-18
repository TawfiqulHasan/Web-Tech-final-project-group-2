<h2>PO Items</h2>

<table border="1" cellpadding="10">

<tr>
    <th>Product</th>
    <th>Quantity</th>
    <th>Unit Price</th>
</tr>

<?php while($row = mysqli_fetch_assoc($items)) { ?>

<tr>

    <td><?= $row['name'] ?></td>
    <td><?= $row['ordered_qty'] ?></td>
    <td><?= $row['unit_price'] ?></td>

</tr>

<?php } ?>

</table>

<br>

<a href="../controllers/POController.php?action=list">
    Back
</a>