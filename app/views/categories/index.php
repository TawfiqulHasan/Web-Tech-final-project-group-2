<h2>Categories</h2>

<?php if (has_role(["admin", "manager", "purchasing"])): ?>
<div class="card">
    <h3>Add Category</h3>

    <form method="post" action="index.php?route=categories&action=store" class="needs-validation">
        <label>Category Name</label>
        <input type="text" name="name" required>

        <label>Description</label>
        <textarea name="description"></textarea>

        <button type="submit">Save Category</button>
    </form>
</div>
<?php endif; ?>

<div class="card">
    <h3>Category List</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Parent ID</th>
        </tr>

        <?php foreach ($categories as $category): ?>
            <tr>
                <td><?= e($category["id"]) ?></td>
                <td><?= e($category["name"]) ?></td>
                <td><?= e($category["description"]) ?></td>
                <td><?= e($category["parent_id"]) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
