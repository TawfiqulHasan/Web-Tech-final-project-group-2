<h2>Add Supplier Product Pricing</h2>

<form method="POST">

    <label>Supplier</label><br>

    <select name="supplier_id" required>

        <option value="">Select Supplier</option>

        <?php while($s = mysqli_fetch_assoc($suppliers)) { ?>

            <option value="<?= $s['id'] ?>">
                <?= $s['company_name'] ?>
            </option>

        <?php } ?>

    </select>

    <br><br>

    <label>Product</label><br>

    <select name="product_id" required>

        <option value="">Select Product</option>

        <?php while($p = mysqli_fetch_assoc($products)) { ?>

            <option value="<?= $p['id'] ?>">
                <?= $p['name'] ?>
            </option>

        <?php } ?>

    </select>

    <br><br>

    <label>Unit Price</label><br>
    <input type="number" step="0.01" name="unit_price" required>

    <br><br>

    <label>Lead Time (days)</label><br>
    <input type="number" name="lead_time_days" required>

    <br><br>

    <label>
        <input type="checkbox" name="is_preferred_supplier">
        Preferred Supplier
    </label>

    <br><br>

    <button type="submit">
        Save
    </button>

</form>

<br>

<a href="../controllers/SupplierProductController.php?action=list">
    Back
</a>