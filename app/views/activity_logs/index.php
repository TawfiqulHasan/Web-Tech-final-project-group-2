<h2>Activity Logs</h2>

<div class="card">
    <h3>Activity Log List</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Action</th>
            <th>Entity</th>
            <th>Entity ID</th>
            <th>Description</th>
            <th>Created</th>
        </tr>

        <?php if (empty($logs)): ?>
            <tr>
                <td colspan="7">No logs found.</td>
            </tr>
        <?php endif; ?>

        <?php foreach ($logs as $log): ?>
            <tr>
                <td><?= e($log["id"]) ?></td>
                <td><?= e($log["user_name"]) ?></td>
                <td><?= e($log["action_type"]) ?></td>
                <td><?= e($log["entity"]) ?></td>
                <td><?= e($log["entity_id"]) ?></td>
                <td><?= e($log["description"]) ?></td>
                <td><?= e($log["created_at"]) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
