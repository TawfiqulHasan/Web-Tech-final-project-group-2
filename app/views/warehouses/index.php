<h2>Warehouses</h2>

<?php if (has_role(["admin", "manager"])): ?>
<div class="card">
    <h3>Add Warehouse</h3>

    <form method="post" action="index.php?route=warehouses&action=store" class="needs-validation">
        <label>Warehouse Name</label>
        <input type="text" name="name" required>

        <label>Address</label>
        <textarea name="address"></textarea>

        <label>City</label>
        <input type="text" name="city">

        <button type="submit">Save Warehouse</button>
    </form>
</div>
<?php endif; ?>

<div class="card">
    <h3>Warehouse List</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>City</th>
            <th>Active</th>
        </tr>

        <?php foreach ($warehouses as $warehouse): ?>
            <tr>
                <td><?= e($warehouse["id"]) ?></td>
                <td><?= e($warehouse["name"]) ?></td>
                <td><?= e($warehouse["address"]) ?></td>
                <td><?= e($warehouse["city"]) ?></td>
                <td><?= e($warehouse["is_active"]) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
