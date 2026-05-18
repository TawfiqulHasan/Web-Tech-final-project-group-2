<h2>Dashboard</h2>

<div class="grid">
    <div class="stat-card">
        <h3>Total Users</h3>
        <p><?= e($total_users) ?></p>
    </div>

    <div class="stat-card">
        <h3>Total Products</h3>
        <p><?= e($total_products) ?></p>
    </div>

    <div class="stat-card">
        <h3>Total Warehouses</h3>
        <p><?= e($total_warehouses) ?></p>
    </div>

    <div class="stat-card">
        <h3>Total Suppliers</h3>
        <p><?= e($total_suppliers) ?></p>
    </div>
</div>

<div class="card">
    <h3>Low Stock Alert</h3>
    <p id="ajaxLowStockBox">Loading low stock data...</p>
</div>

<div class="card">
    <h3>Low Stock Products</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>SKU</th>
            <th>Reorder Level</th>
            <th>Current Stock</th>
        </tr>

        <?php if (empty($low_stock_products)): ?>
            <tr>
                <td colspan="5">No low stock product found.</td>
            </tr>
        <?php endif; ?>

        <?php foreach ($low_stock_products as $product): ?>
            <tr>
                <td><?= e($product["id"]) ?></td>
                <td><?= e($product["name"]) ?></td>
                <td><?= e($product["sku"]) ?></td>
                <td><?= e($product["reorder_level"]) ?></td>
                <td><?= e($product["current_stock"]) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
