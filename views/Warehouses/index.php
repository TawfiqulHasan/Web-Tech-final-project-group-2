<!DOCTYPE html>
<html>
<head>
    <title>Warehouses</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        h2 {
            margin-bottom: 15px;
            color: #111827;
        }


        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .btn-add {
            background: #4f46e5;
            color: white;
            padding: 10px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
        }

    
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        th {
            background: #4f46e5;
            color: white;
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background: #f9fafb;
        }

        
        .btn {
            padding: 6px 10px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            background: orange;
            color: white;
        }

        .btn:hover {
            opacity: 0.8;
        }

    
        .back {
            display: inline-block;
            margin-top: 15px;
            background: gray;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="header">
    <h2> Warehouses</h2>

    <a class="btn-add"
       href="../controllers/WarehouseController.php?action=add">
       + Add Warehouse
    </a>
</div>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>City</th>
        <th>Manager</th>
        <th>Action</th>
    </tr>

    <?php while($row = mysqli_fetch_assoc($warehouses)) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['city'] ?></td>
        <td><?= $row['manager_name'] ?></td>

        <td>
            <a class="btn"
               href="../controllers/WarehouseController.php?action=edit&id=<?= $row['id'] ?>">
               Edit
            </a>
        </td>
    </tr>
    <?php } ?>
</table>

<a class="back" href="../index.php">⬅ Back to Dashboard</a>

</body>
</html>