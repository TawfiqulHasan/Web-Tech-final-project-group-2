<!DOCTYPE html>
<html>
<head>
    <title>Inventory</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background: #4f46e5;
            color: white;
        }

        .low {
            background: #fee2e2;
        }

        .back-btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 15px;
            background: #4f46e5;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
    </style>
</head>

<body>

<h2>Inventory Levels Across Warehouses</h2>

<table>

<tr>
    <th>Product</th>
    <th>Warehouse</th>
    <th>Stock Qty</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr class="<?= ($row['stock_qty'] < 5) ? 'low' : '' ?>">

    <td><?= $row['product_name'] ?></td>
    <td><?= $row['warehouse_name'] ?></td>
    <td><?= $row['stock_qty'] ?></td>

</tr>

<?php } ?>

</table>

<br>

<a href="../controllers/DashboardController.php" class="back-btn">
    ← Back to Dashboard
</a>

</body>
</html>