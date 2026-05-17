<?php
include("includes/auth-check.php");

include("../../model/ProductModel.php");

$product = new ProductModel();

$result = $product->getAllProducts();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Stock Adjustment</title>

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
    <a href="stock-in.php">Stock In</a>
    <a href="stock-out.php">Stock Out</a>
    <a href="stock-adjustment.php" class="active">Stock Adjustment</a>
    <a href="transaction-history.php">Transactions</a>
    <a href="../../logout.php">Logout</a>

</div>

<div class="main-content">

    <div class="topbar">
        <div>
            <h2>Stock Adjustment</h2>
            <p>Adjust product stock with reason</p>
        </div>
    </div>

    <div class="form-center">

        <div class="form-box">

            <form method="post" action="../../controller/StockController.php">

                <input type="hidden" name="stock_adjustment" value="1">

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

                <label>Adjustment Quantity</label>

                <input type="number"
                       name="quantity"
                       placeholder="Use positive or negative number">

                <label>Reason</label>

                <textarea name="reason"
                          placeholder="Enter adjustment reason"
                          rows="4"></textarea>

                <input type="submit" value="Adjust Stock">

            </form>

            <?php
            if(!empty($_SESSION["success"])){
                echo "<p class='success'>" . $_SESSION["success"] . "</p>";
                $_SESSION["success"] = "";
            }

            if(!empty($_SESSION["error"])){
                echo "<p class='error'>" . $_SESSION["error"] . "</p>";
                $_SESSION["error"] = "";
            }
            ?>

        </div>

    </div>

</div>

</body>
</html>