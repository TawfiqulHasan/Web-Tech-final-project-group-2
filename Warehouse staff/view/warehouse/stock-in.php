<?php
include("includes/auth-check.php");

include("../../model/ProductModel.php");

$product = new ProductModel();

$result = $product->getAllProducts();
?>

<!DOCTYPE html>
<html>
<head>

    <title>Stock In</title>

    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/form.css">

</head>
<body>

<div class="sidebar">

    <h2>Warehouse Staff</h2>

    <a href="dashboard.php">Dashboard</a>
    <a href="stock-list.php">Stock List</a>
    <a href="product-search.php">Product Search</a>
    <a href="stock-in.php" class="active">Stock In</a>
    <a href="stock-out.php">Stock Out</a>
    <a href="../../logout.php">Logout</a>

</div>

<div class="main-content">

    <div class="topbar">
        <div>
            <h2>Stock In</h2>
            <p>Add product stock</p>
        </div>
    </div>

    <div class="form-center">

        <div class="form-box">

            <form method="post" action="../../controller/StockController.php">

                <label>Product</label>

                <select name="product_id">
                    <option value="">Select Product</option>

                    <?php
                    while($row = $result->fetch_assoc()){
                    ?>
                        <option value="<?php echo $row["id"]; ?>">
                            <?php echo $row["name"]; ?> 
                            - Available: <?php echo $row["current_stock"]; ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>

                <label>Quantity</label>

                <input type="number"
                       name="quantity"
                       placeholder="Enter quantity"
                       min="0">

                <input type="submit" value="Add Stock">

            </form>

            <?php
            if(isset($_SESSION["success"])){
                echo "<p class='success'>" . $_SESSION["success"] . "</p>";
                unset($_SESSION["success"]);
            }

            if(isset($_SESSION["error"])){
                echo "<p class='error'>" . $_SESSION["error"] . "</p>";
                unset($_SESSION["error"]);
            }
            ?>

        </div>

    </div>

</div>

</body>
</html>