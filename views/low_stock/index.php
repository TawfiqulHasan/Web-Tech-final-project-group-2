<!DOCTYPE html>
<html>
<head>
    <title>Low Stock Report</title>

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
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        th {
            background: #ef4444;
            color: white;
            padding: 10px;
        }

        td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background: #f9fafb;
        }

        .danger {
            color: red;
            font-weight: bold;
        }

        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background: #4f46e5;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }
    </style>
</head>

<body>

<h2>Low Stock Report</h2>

<table>

<tr>
    <th>ID</th>
    <th>Product</th>
    <th>Current Stock</th>
    <th>Reorder Level</th>
    <th>Status</th>
    <th>Recommended Order Qty</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td class="danger"><?= $row['current_stock'] ?></td>
    <td><?= $row['reorder_level'] ?></td>
    <td>LOW STOCK</td>
    <td><b><?= $row['recommended_qty'] ?></b></td>
</tr>

<?php } ?>

</table>

<a class="back-btn" href="../controllers/DashboardController.php">
    ← Back to Dashboard
</a>

</body>
</html>