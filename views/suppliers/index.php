<!DOCTYPE html>
<html>
<head>
    <title>Suppliers</title>

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

        
        .topbar {
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

        .btn-back {
            background: gray;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
            float: right;
            margin-top: 15px;
        }

        /* TABLE */
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
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
        }

        .edit {
            background: orange;
            color: white;
        }

        .delete {
            background: red;
            color: white;
        }

        .edit:hover,
        .delete:hover {
            opacity: 0.8;
        }

        
        .header-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="header-box">
    <h2>🏭 Suppliers</h2>

    <a class="btn-add"
       href="../controllers/SupplierController.php?action=add">
       + Add Supplier
    </a>
</div>

<table>
    <tr>
        <th>ID</th>
        <th>Company</th>
        <th>Contact</th>
        <th>Phone</th>
        <th>Email</th>
        <th>City</th>
        <th>Action</th>
    </tr>

    <?php while($row = mysqli_fetch_assoc($suppliers)) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['company_name'] ?></td>
        <td><?= $row['contact_person'] ?></td>
        <td><?= $row['phone'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['city'] ?></td>

        <td>
            <a class="btn edit"
               href="../controllers/SupplierController.php?action=edit&id=<?= $row['id'] ?>">
               Edit
            </a>

            <a class="btn delete"
               href="../controllers/SupplierController.php?action=deactivate&id=<?= $row['id'] ?>"
               onclick="return confirm('Are you sure?')">
               Delete
            </a>
        </td>
    </tr>
    <?php } ?>
</table>

<a class="btn-back" href="../controllers/DashboardController.php">
    ⬅ Back to Dashboard
</a>

</body>
</html>