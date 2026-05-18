<!DOCTYPE html>
<html>
<head>
    <title>Products</title>

    <style>

        body{
            font-family: Arial;
        }

        h2{
            display:inline-block;
        }

        .add-btn{
            display:inline-block;
            margin-left:20px;
            background:green;
            color:white;
            border:none;
            padding:10px 16px;
            border-radius:6px;
            font-size:14px;
            font-weight:bold;
            text-decoration:none;
            transition:0.3s;
        }

        .add-btn:hover{
            background:#3730a3;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        th{
            background:#4f46e5;
            color:white;
        }

        th, td{
            padding:10px;
            border:1px solid #ddd;
            text-align:left;
        }

    </style>

</head>
<body>

<h2>Products</h2>

<a href="ProductController.php?action=add" class="add-btn">
    + Add Product
</a>

<br><br>

<table>

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>SKU</th>
    <th>Category</th>
    <th>Unit</th>
    <th>Reorder Level</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($products)) { ?>

<tr>

    <td><?= $row['id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['sku'] ?></td>
    <td><?= $row['category_name'] ?></td>
    <td><?= $row['unit'] ?></td>
    <td><?= $row['reorder_level'] ?></td>

    <td>

        <a href="ProductController.php?action=edit&id=<?= $row['id'] ?>">
            Update
        </a>

        |

        <a href="ProductController.php?action=deactivate&id=<?= $row['id'] ?>">
            Deactivate
        </a>

    </td>

</tr>

<?php } ?>

</table>

<a href="../controllers/Dashboardcontroller.php">
    <button type="button">Back to Dashboard</button>


</body>
</html>