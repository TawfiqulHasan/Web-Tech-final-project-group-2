<!DOCTYPE html>
<html>
<head>
    <title>Purchase Order Approval Dashboard</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            padding: 20px;
        }

        h2 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: #4f46e5;
            color: white;
        }

        .btn {
            padding: 6px 10px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-size: 13px;
        }

        .view { background: #3b82f6; }
        .approve { background: #22c55e; }
        .reject { background: #ef4444; }

        .back {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #4f46e5;
            font-weight: bold;
        }
    </style>
</head>

<body>

<h2>Purchase Order Approval Queue</h2>

<table>

<tr>
    <th>ID</th>
    <th>Supplier</th>
    <th>Total Value</th>
    <th>Date</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($orders)) { ?>

<tr>

    <td><?= $row['id'] ?></td>
    <td><?= $row['company_name'] ?></td>
    <td><?= $row['total_estimated_value'] ?></td>
    <td><?= $row['created_at'] ?></td>
    <td><?= $row['status'] ?></td>

    <td>

        <a class="btn view"
           href="POController.php?action=view&id=<?= $row['id'] ?>">
            View
        </a>

        <?php if($row['status'] == 'submitted') { ?>

            <a class="btn approve"
               href="POController.php?action=approve&id=<?= $row['id'] ?>">
                Approve
            </a>

            <a class="btn reject"
               href="POController.php?action=reject&id=<?= $row['id'] ?>">
                Reject
            </a>

        <?php } else { ?>

            <span style="color:green;font-weight:bold;">
                <?= ucfirst($row['status']) ?>
            </span>

        <?php } ?>

    </td>

</tr>

<?php } ?>

</table>

<br>

<a class="back" href="../index.php">
    ← Back to Dashboard
</a>

</body>
</html>