<h2>Purchase Orders</h2>

<div class="card">
    <h3>Add Purchase Order</h3>

    <form method="post" action="index.php?route=purchase_orders&action=store" class="needs-validation">
        <div class="form-grid">
            <div>
                <label>Supplier</label>
                <select name="supplier_id" required>
                    <option value="">Select supplier</option>
                    <?php foreach ($suppliers as $supplier): ?>
                        <option value="<?= e($supplier["id"]) ?>"><?= e($supplier["company_name"]) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label>Status</label>
                <select name="status" required>
                    <option value="draft">draft</option>
                    <option value="submitted">submitted</option>
                    <option value="approved">approved</option>
                    <option value="received">received</option>
                    <option value="cancelled">cancelled</option>
                </select>
            </div>

            <div>
                <label>Expected Delivery Date</label>
                <input type="date" name="expected_delivery_date">
            </div>

            <div>
                <label>Total Estimated Value</label>
                <input type="number" step="0.01" name="total_estimated_value" value="0">
            </div>
        </div>

        <label>Notes</label>
        <textarea name="notes"></textarea>

        <button type="submit">Save Purchase Order</button>
    </form>
</div>

<div class="card">
    <h3>Purchase Order List</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>Supplier</th>
            <th>Raised By</th>
            <th>Status</th>
            <th>Expected Delivery</th>
            <th>Total Value</th>
            <th>Created</th>
        </tr>

        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= e($order["id"]) ?></td>
                <td><?= e($order["company_name"]) ?></td>
                <td><?= e($order["raised_by_name"]) ?></td>
                <td><?= e($order["status"]) ?></td>
                <td><?= e($order["expected_delivery_date"]) ?></td>
                <td><?= e($order["total_estimated_value"]) ?></td>
                <td><?= e($order["created_at"]) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
