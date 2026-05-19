<!DOCTYPE html>
<html>
<head>
    <title>Supplier Performance Report</title>

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
            background: #10b981;
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

        .high {
            color: green;
            font-weight: bold;
        }

        .low {
            color: red;
            font-weight: bold;
        }

        .back {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 15px;
            background: #4f46e5;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
    </style>
</head>

<body>

<h2>Supplier Performance Report</h2>

<table>

<tr>
    <th>Supplier</th>
    <th>Total Orders</th>
    <th>Avg Delivery Time (Days)</th>
    <th>Total Spend</th>
    <th>Performance</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>
    <td><?= $row['company_name'] ?></td>
    <td><?= $row['total_orders'] ?></td>
    <td><?= round($row['avg_delivery_time'], 2) ?></td>
    <td><?= $row['total_spend'] ?></td>

    <td>
        <?php
        if ($row['avg_delivery_time'] <= 3) {
            echo "<span class='high'>Excellent</span>";
        } else {
            echo "<span class='low'>Needs Improvement</span>";
        }
        ?>
    </td>
</tr>

<?php } ?>

</table>

<a href="../controllers/DashboardController.php" class="back">
    ← Back to Dashboard
</a>

</body>
</html>