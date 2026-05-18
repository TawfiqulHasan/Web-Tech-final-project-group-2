<h2>Reports</h2>

<div class="card">
    <h3>Low Stock Report</h3>
    <p>This report shows products where current stock is less than or equal to reorder level.</p>

    <button type="button" id="loadLowStockBtn">Load Low Stock: </button>

    <div id="ajaxReportBox" class="ajax-box"></div>

    <br>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>SKU</th>
            <th>Reorder Level</th>
            <th>Current Stock</th>
        </tr>

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
