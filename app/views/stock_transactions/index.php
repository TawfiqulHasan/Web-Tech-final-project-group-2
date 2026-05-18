<h2>Stock Transactions</h2>

<div class="card">
    <h3>Add Stock Transaction</h3>

    <form method="post" action="index.php?route=stock_transactions&action=store" class="needs-validation">
        <div class="form-grid">
            <div>
                <label>Product</label>
                <select name="product_id" required>
                    <option value="">Select product</option>
                    <?php foreach ($products as $product): ?>
                        <option value="<?= e($product["id"]) ?>">
                            <?= e($product["name"]) ?> - Stock: <?= e($product["current_stock"]) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label>Warehouse</label>
                <select name="warehouse_id" required>
                    <option value="">Select warehouse</option>
                    <?php foreach ($warehouses as $warehouse): ?>
                        <option value="<?= e($warehouse["id"]) ?>"><?= e($warehouse["name"]) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label>Type</label>
                <select name="type" required>
                    <option value="">Select type</option>
                    <option value="in">in</option>
                    <option value="out">out</option>
                    <option value="adjustment">adjustment</option>
                    <option value="transfer">transfer</option>
                </select>
            </div>

            <div>
                <label>Quantity</label>
                <input type="number" name="quantity" required>
            </div>

            <div>
                <label>Unit Price</label>
                <input type="number" step="0.01" name="unit_price">
            </div>

            <div>
                <label>Transaction Date</label>
                <input type="date" name="transaction_date" value="<?= date('Y-m-d') ?>">
            </div>
        </div>

        <label>Reason</label>
        <textarea name="reason"></textarea>

        <label>Reference Note</label>
        <input type="text" name="reference_note">

        <button type="submit">Save Transaction</button>
    </form>
</div>

<div class="card">
    <h3>Transaction List</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Warehouse</th>
            <th>User</th>
            <th>Type</th>
            <th>Quantity</th>
            <th>Date</th>
            <th>Reason</th>
        </tr>

        <?php foreach ($transactions as $transaction): ?>
            <tr>
                <td><?= e($transaction["id"]) ?></td>
                <td><?= e($transaction["product_name"]) ?></td>
                <td><?= e($transaction["warehouse_name"]) ?></td>
                <td><?= e($transaction["user_name"]) ?></td>
                <td><?= e($transaction["type"]) ?></td>
                <td><?= e($transaction["quantity"]) ?></td>
                <td><?= e($transaction["transaction_date"]) ?></td>
                <td><?= e($transaction["reason"]) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
