<h2>Supplier Product Pricing</h2>

<a href="../controllers/SupplierProductController.php?action=add">
    + Add Supplier Product
</a>

<br><br>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Supplier</th>
    <th>Product</th>
    <th>Unit Price</th>
    <th>Lead Time</th>
    <th>Preferred</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($links)) { ?>

<tr>

    <td><?= $row['id'] ?></td>
    <td><?= $row['company_name'] ?></td>
    <td><?= $row['product_name'] ?></td>
    <td><?= $row['unit_price'] ?></td>
    <td><?= $row['lead_time_days'] ?> days</td>

    <td>
        <?= $row['is_preferred_supplier'] ? 'Yes' : 'No' ?>
    </td>

    <td>

        <a href="../controllers/SupplierProductController.php?action=delete&id=<?= $row['id'] ?>">
            Delete
        </a>

    </td>

</tr>

<?php } ?>

</table>

<br><br>

<a href="../controllers/Dashboardcontroller.php">
    <button type="button">Back to Dashboard</button>
</a>