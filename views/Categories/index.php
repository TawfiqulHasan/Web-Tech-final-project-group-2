<!DOCTYPE html>
<html>
<head>
    <title>Categories</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            padding: 20px;
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
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        th {
            background: #4f46e5;
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

        .edit {
            background: orange;
            color: white;
            padding: 5px 8px;
            border-radius: 5px;
            text-decoration: none;
        }

        .delete {
            background: red;
            color: white;
            padding: 5px 8px;
            border-radius: 5px;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="header">
    <h2>Categories</h2>

    <a class="btn-add" href="../controllers/CategoryController.php?action=add">
        + Add Category
    </a>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Parent ID</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        <?php if (mysqli_num_rows($categories) > 0) { ?>

            <?php while ($row = mysqli_fetch_assoc($categories)) { ?>

                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['description'] ?></td>
                    <td><?= $row['parent_id'] ?></td>
                    <td>
                        <a class="edit"
                           href="../controllers/CategoryController.php?action=edit&id=<?= $row['id'] ?>">
                           Edit
                        </a>

                        <a class="delete"
                           href="../controllers/CategoryController.php?action=delete&id=<?= $row['id'] ?>"
                           onclick="return confirm('Are you sure?')">
                           Delete
                        </a>
                    </td>
                </tr>

            <?php } ?>

        <?php } else { ?>

            <tr>
                <td colspan="5">No Categories Found</td>
            </tr>

        <?php } ?>

    </tbody>
</table> <br/>

<a href="../controllers/Dashboardcontroller.php">
    <button type="button" class="btn-add">Back to Dashboard</button>

</body>
</html>