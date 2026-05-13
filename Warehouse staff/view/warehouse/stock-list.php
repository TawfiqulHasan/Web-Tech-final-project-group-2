<?php
include("includes/auth-check.php");

include("../../model/ProductModel.php");

$product = new ProductModel();

$result = $product->getAllProducts();
?>

<!DOCTYPE html>
<html>
<head>

    <title>Stock List</title>

    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/stock-list.css">

</head>
<body>

<div class="sidebar">

    <h2>Warehouse Staff</h2>

    <a href="dashboard.php">Dashboard</a>

    <a href="stock-list.php" class="active">Stock List</a>

    <a href="product-search.php">Product Search</a>

    <a href="stock-in.php">Stock In</a>

    <a href="stock-out.php">Stock Out</a>

    <a href="../../logout.php">Logout</a>

</div>

<div class="main-content">

    <div class="topbar">

        <div>
            <h2>Stock List</h2>
            <p>All warehouse products</p>
        </div>

    </div>

    <div class="table-box">

        <table class="stock-table">

            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>SKU</th>
                <th>Current Stock</th>
                <th>Reorder Level</th>
                <th>Status</th>
            </tr>

            <?php
            while($row = $result->fetch_assoc()){

                $status = "";
                $statusClass = "";

                if($row["current_stock"] == 0){

                    $status = "Out Of Stock";
                    $statusClass = "status-out";

                }
                else if($row["current_stock"] <= $row["reorder_level"]){

                    $status = "Low Stock";
                    $statusClass = "status-low";

                }
                else{

                    $status = "In Stock";
                    $statusClass = "status-ok";

                }
            ?>

            <tr>

                <td><?php echo $row["id"]; ?></td>

                <td><?php echo $row["name"]; ?></td>

                <td><?php echo $row["sku"]; ?></td>

                <td><?php echo $row["current_stock"]; ?></td>

                <td><?php echo $row["reorder_level"]; ?></td>

                <td>
                    <span class="status <?php echo $statusClass; ?>">
                        <?php echo $status; ?>
                    </span>
                </td>

            </tr>

            <?php
            }
            ?>

        </table>

    </div>

</div>

</body>
</html>