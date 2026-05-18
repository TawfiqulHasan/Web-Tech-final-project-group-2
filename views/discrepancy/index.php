<!DOCTYPE html>
<html>
<head>
    <title>Stock Discrepancy</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #111827;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        th {
            background: #4f46e5;
            color: white;
            padding: 12px;
            text-align: center;
        }

        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background: #f9fafb;
        }

        /* Status styles */
        .status-open {
            background: #fef3c7;
            color: #92400e;
            padding: 5px 10px;
            border-radius: 6px;
            font-weight: bold;
        }

        .status-review {
            background: #dbeafe;
            color: #1e3a8a;
            padding: 5px 10px;
            border-radius: 6px;
            font-weight: bold;
        }

        .status-resolved {
            background: #dcfce7;
            color: #166534;
            padding: 5px 10px;
            border-radius: 6px;
            font-weight: bold;
        }

        .status-escalated {
            background: #fee2e2;
            color: #991b1b;
            padding: 5px 10px;
            border-radius: 6px;
            font-weight: bold;
        }

        /* Action links */
        a {
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 13px;
        }

        a:hover {
            opacity: 0.8;
        }

        .view {
            background: #4f46e5;
            color: white;
        }

        .escalate {
            background: #ef4444;
            color: white;
        }

        /* Back button */
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background: #4f46e5;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }

        .back-btn:hover {
            background: #3730a3;
        }
    </style>
</head>

<body>

<h2>Stock Discrepancy Reports</h2>

<table>

<tr>
    <th>ID</th>
    <th>Product</th>
    <th>Warehouse</th>
    <th>Expected</th>
    <th>Actual</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($reports)) { ?>

<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['product_name'] ?></td>
    <td><?= $row['warehouse_name'] ?></td>
    <td><?= $row['expected_qty'] ?></td>
    <td><?= $row['actual_qty'] ?></td>

    <td>
        <?php if($row['status'] == 'open') { ?>
            <span class="status-open">Open</span>

        <?php } elseif($row['status'] == 'under_review') { ?>
            <span class="status-review">Under Review</span>

        <?php } elseif($row['status'] == 'resolved') { ?>
            <span class="status-resolved">Resolved</span>

        <?php } else { ?>
            <span class="status-escalated">Escalated</span>
        <?php } ?>
    </td>

    <td>
        <a class="view" href="../controllers/DiscrepancyController.php?action=view&id=<?= $row['id'] ?>">
            View
        </a>

        <a class="escalate" href="../controllers/DiscrepancyController.php?action=escalate&id=<?= $row['id'] ?>">
            Escalate
        </a>
    </td>
</tr>

<?php } ?>

</table>

<a class="back-btn" href="../controllers/DashboardController.php">
    ← Back to Dashboard
</a>

</body>
</html>