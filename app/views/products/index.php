<h2>Products</h2>

<?php if (has_role(["admin", "manager", "purchasing"])): ?>
<div class="card">
    <h3>Add Product</h3>

    <form method="post" action="index.php?route=products&action=store" class="needs-validation">
        <div class="form-grid">
            <div>
                <label>Category</label>
                <select name="category_id" required>
                    <option value="">Select category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= e($category["id"]) ?>"><?= e($category["name"]) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label>Product Name</label>
                <input type="text" name="name" required>
            </div>

            <div>
                <label>SKU</label>
                <input type="text" name="sku" required>
            </div>

            <div>
                <label>Unit</label>
                <select name="unit" required>
                    <option value="">Select unit</option>
                    <option value="pcs">pcs</option>
                    <option value="kg">kg</option>
                    <option value="litres">litres</option>
                    <option value="boxes">boxes</option>
                </select>
            </div>

            <div>
                <label>Reorder Level</label>
                <input type="number" name="reorder_level" required>
            </div>

            <div>
                <label>Current Stock</label>
                <input type="number" name="current_stock" required>
            </div>
        </div>

        <label>Description</label>
        <textarea name="description"></textarea>

        <button type="submit">Save Product</button>
    </form>
</div>
<?php endif; ?>

<div class="card">
    <h3>Product List</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Name</th>
            <th>SKU</th>
            <th>Unit</th>
            <th>Reorder Level</th>
            <th>Current Stock</th>
        </tr>

        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= e($product["id"]) ?></td>
                <td><?= e($product["category_name"]) ?></td>
                <td><?= e($product["name"]) ?></td>
                <td><?= e($product["sku"]) ?></td>
                <td><?= e($product["unit"]) ?></td>
                <td><?= e($product["reorder_level"]) ?></td>
                <td><?= e($product["current_stock"]) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
