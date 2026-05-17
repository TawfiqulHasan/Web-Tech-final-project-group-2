<?php
include("includes/auth-check.php");
include("../../model/PurchaseOrderModel.php");

$po = new PurchaseOrderModel();

$result = $po->getPendingItems();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Receive Purchase Order</title>

    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/stock-list.css">
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
    <a href="receive-po.php" class="active">Receive PO</a>
    <a href="transaction-history.php">Transactions</a>
    <a href="discrepancy-create.php">Report Discrepancy</a>
    <a href="../../logout.php">Logout</a>

</div>

<div class="main-content">

    <div class="topbar">
        <div>
            <h2>Receive Purchase Order</h2>
            <p>Confirm received quantities for arriving purchase order items</p>
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

    <div class="table-box">

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

        <table class="stock-table">

            <tr>
                <th>PO ID</th>
                <th>Product</th>
                <th>SKU</th>
                <th>Ordered Qty</th>
                <th>Already Received</th>
                <th>Unit Price</th>
                <th>Expected Date</th>
                <th>Receive Qty</th>
                <th>Action</th>
            </tr>

            <?php
            while($row = $result->fetch_assoc()){
            ?>

            <tr>
                <td><?php echo $row["po_id"]; ?></td>
                <td><?php echo $row["product_name"]; ?></td>
                <td><?php echo $row["sku"]; ?></td>
                <td><?php echo $row["ordered_qty"]; ?></td>
                <td><?php echo $row["received_qty"]; ?></td>
                <td><?php echo $row["unit_price"]; ?></td>
                <td><?php echo $row["expected_delivery_date"]; ?></td>

                <td colspan="2">
                    <form method="post"
                          action="../../controller/PurchaseOrderController.php"
                          class="inline-form">

                        <input type="hidden"
                               name="item_id"
                               value="<?php echo $row["item_id"]; ?>">

                        <input type="number"
                               name="received_qty"
                               min="1"
                               placeholder="Qty">

                        <button type="submit">
                            Receive
                        </button>

                    </form>
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