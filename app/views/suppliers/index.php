<h2>Suppliers</h2>

<div class="card">
    <h3>Add Supplier</h3>

    <form method="post" action="index.php?route=suppliers&action=store" class="needs-validation">
        <div class="form-grid">
            <div>
                <label>Company Name</label>
                <input type="text" name="company_name" required>
            </div>

            <div>
                <label>Contact Person</label>
                <input type="text" name="contact_person">
            </div>

            <div>
                <label>Phone</label>
                <input type="text" name="phone">
            </div>

            <div>
                <label>Email</label>
                <input type="email" name="email">
            </div>

            <div>
                <label>City</label>
                <input type="text" name="city">
            </div>
        </div>

        <label>Address</label>
        <textarea name="address"></textarea>

        <label>Payment Terms</label>
        <textarea name="payment_terms"></textarea>

        <button type="submit">Save Supplier</button>
    </form>
</div>

<div class="card">
    <h3>Supplier List</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>Company</th>
            <th>Contact Person</th>
            <th>Phone</th>
            <th>Email</th>
            <th>City</th>
        </tr>

        <?php foreach ($suppliers as $supplier): ?>
            <tr>
                <td><?= e($supplier["id"]) ?></td>
                <td><?= e($supplier["company_name"]) ?></td>
                <td><?= e($supplier["contact_person"]) ?></td>
                <td><?= e($supplier["phone"]) ?></td>
                <td><?= e($supplier["email"]) ?></td>
                <td><?= e($supplier["city"]) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
