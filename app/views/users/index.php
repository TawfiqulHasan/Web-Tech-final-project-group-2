<h2>Users</h2>

<div class="card">
    <h3>Add User</h3>

    <form method="post" action="index.php?route=users&action=store" class="needs-validation">
        <div class="form-grid">
            <div>
                <label>Name</label>
                <input type="text" name="name" required>
            </div>

            <div>
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div>
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div>
                <label>Phone</label>
                <input type="text" name="phone">
            </div>

            <div>
                <label>Role</label>
                <select name="role" required>
                    <option value="">Select role</option>
                    <option value="staff">staff</option>
                    <option value="purchasing">purchasing</option>
                    <option value="manager">manager</option>
                    <option value="admin">admin</option>
                </select>
            </div>
        </div>

        <button type="submit">Save User</button>
    </form>
</div>

<div class="card">
    <h3>User List</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Active</th>
            <th>Created</th>
        </tr>

        <?php foreach ($users as $item): ?>
            <tr>
                <td><?= e($item["id"]) ?></td>
                <td><?= e($item["name"]) ?></td>
                <td><?= e($item["email"]) ?></td>
                <td><?= e($item["phone"]) ?></td>
                <td><?= e($item["role"]) ?></td>
                <td><?= e($item["is_active"]) ?></td>
                <td><?= e($item["created_at"]) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
