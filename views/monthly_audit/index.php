<!DOCTYPE html>
<html>
<head>
    <title>Monthly Inventory Audit</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            padding: 20px;
        }

        h2 {
            margin-bottom: 20px;
        }

        .filter {
            margin-bottom: 20px;
        }

        select {
            padding: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        th {
            background: #6366f1;
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

        .positive {
            color: green;
            font-weight: bold;
        }

        .negative {
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

<h2>Monthly Inventory Audit Summary</h2>

<!-- FILTER -->
<div class="filter">
    <form method="GET">
        <select name="month">
            <?php for($i=1;$i<=12;$i++) { ?>
                <option value="<?= $i ?>" <?= $i==$month?'selected':'' ?>>
                    <?= $i ?>
                </option>
            <?php } ?>
        </select>

        <select name="year">
            <?php for($y=2024;$y<=2030;$y++) { ?>
                <option value="<?= $y ?>" <?= $y==$year?'selected':'' ?>>
                    <?= $y ?>
                </option>
            <?php } ?>
        </select>

        <button type="submit">Filter</button>
    </form>
</div>

<!-- TABLE -->
<table>

<tr>
    <th>Product</th>
    <th>Total In</th>
    <th>Total Out</th>
    <th>Net Movement</th>
    <th>Closing Stock</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>
    <td><?= $row['name'] ?></td>
    <td><?= $row['total_in'] ?></td>
    <td><?= $row['total_out'] ?></td>

    <td class="<?= $row['net_movement'] >= 0 ? 'positive' : 'negative' ?>">
        <?= $row['net_movement'] ?>
    </td>

    <td><?= $row['closing_stock'] ?></td>
</tr>

<?php } ?>

</table>

<a href="../controllers/DashboardController.php" class="back">
    ← Back to Dashboard
</a>

</body>
</html>