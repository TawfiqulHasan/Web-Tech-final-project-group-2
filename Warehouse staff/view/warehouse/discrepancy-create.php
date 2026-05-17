<?php
include("includes/auth-check.php");

include("../../model/ProductModel.php");

$product = new ProductModel();

$result = $product->getAllProducts();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Report Discrepancy</title>

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
    <a href="stock-adjustment.php">Stock Adjustment</a>
    <a href="receive-po.php">Receive PO</a>
    <a href="transaction-history.php">Transactions</a>
    <a href="discrepancy-create.php" class="active">Report Discrepancy</a>
    <a href="../../logout.php">Logout</a>

</div>

<div class="main-content">

    <div class="topbar">
        <div>
            <h2>Report Discrepancy</h2>
            <p>Submit stock count mismatch, damage, theft, or counting issue</p>
        </div>
        <div class="topbar-right">
        <a href="my-discrepancy-reports.php" class="topbar-link">
            📝 My Report
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

            <form method="post" action="../../controller/DiscrepancyController.php" onsubmit="return validateDiscrepancy()">

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

                <label>Expected Quantity</label>

                <input type="number"
                       name="expected_qty"
                       placeholder="Enter expected quantity"
                       min="0">

                <label>Actual Quantity</label>

                <input type="number"
                       name="actual_qty"
                       placeholder="Enter actual quantity"
                       min="0">

                <label>Description</label>

                <textarea name="description"
                          rows="4"
                          placeholder="Example: damage, theft, counting error"></textarea>

                <input type="submit" value="Submit Report">

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