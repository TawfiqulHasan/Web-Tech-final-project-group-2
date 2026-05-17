<?php
include("includes/auth-check.php");
unset($_SESSION["success"]);
unset($_SESSION["error"]);

include("../../model/ProductModel.php");

$product = new ProductModel();

$result = $product->getAllProducts();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Stock Out</title>

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
    <a href="stock-out.php" class="active">Stock Out</a>
    <a href="stock-adjustment.php">Stock Adjustment</a>
    <a href="receive-po.php">Receive PO</a>
    <a href="transaction-history.php">Transactions</a>
    <a href="discrepancy-create.php" >Report Discrepancy</a>
    <a href="../../logout.php">Logout</a>

</div>

<div class="main-content">

    <div class="topbar">
        <div>
            <h2>Stock Out</h2>
            <p>Remove stock with reason and date</p>
        </div>
        <div class="topbar-right">
            <a href="my-discrepancy-reports.php" class="topbar-link">
                📝 My Reports
            </a>
            <a href="profile.php" class="topbar-link">
                👤 My Profile
            </a>
            <span class="topbar-date">
                <?php echo date("d M Y"); ?>
            </span>
        </div>
    </div>

    <div class="form-center">

        <div class="form-box">

            <form method="post" action="../../controller/StockController.php" onsubmit="return validateStockOut()">

                <input type="hidden" name="stock_out" value="1">

                <label>Product</label>

                <select name="product_id">

                    <option value="">Select Product</option>

                    <?php
                    while($row = $result->fetch_assoc()){
                    ?>

                        <option value="<?php echo $row["id"]; ?>">

                            <?php echo $row["name"]; ?>
                            - Available:
                            <?php echo $row["current_stock"]; ?>

                        </option>

                    <?php
                    }
                    ?>

                </select>

                <label>Quantity</label>

                <input type="number"
                       name="quantity"
                       placeholder="Enter quantity"
                       min="1">

                <label>Reason</label>

                <select name="reason">

                    <option value="">Select Reason</option>

                    <option value="sale">Sale</option>

                    <option value="usage">Usage</option>

                    <option value="damage">Damage</option>

                    <option value="dispatch">Dispatch</option>

                </select>

                <label>Transaction Date</label>

                <input type="date"
                       name="transaction_date"
                       value="<?php echo date('Y-m-d'); ?>">

                <input type="submit"
                       value="Remove Stock">

            </form>

            <?php
            if (!empty($_SESSION["success"])) {

                echo "<p class='success'>"
                . $_SESSION["success"] .
                "</p>";

                unset($_SESSION["success"]);
            }

            if (!empty($_SESSION["error"])) {

                echo "<p class='error'>"
                . $_SESSION["error"] .
                "</p>";

                unset($_SESSION["error"]);
            }
            ?>

        </div>

    </div>

</div>

</body>
</html>