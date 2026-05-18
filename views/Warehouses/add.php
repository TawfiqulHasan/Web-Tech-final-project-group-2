<h2>Add Warehouse</h2>

<form method="POST">

    <label>Name</label><br>
    <input type="text" name="name" required>

    <br><br>

    <label>Address</label><br>
    <textarea name="address"></textarea>

    <br><br>

    <label>City</label><br>
    <input type="text" name="city">

    <br><br>

    <label>Responsible Staff</label><br>

    <select name="manager_id">

        <?php while($u = mysqli_fetch_assoc($users)) { ?>

            <option value="<?= $u['id'] ?>">
                <?= $u['name'] ?>
            </option>

        <?php } ?>

    </select>

    <br><br>

    <button type="submit">
        Save Warehouse
    </button>

</form>

<br>

<a href="../controllers/WarehouseController.php?action=list">
    Back
</a>