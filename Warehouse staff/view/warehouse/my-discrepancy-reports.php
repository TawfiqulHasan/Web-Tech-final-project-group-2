<?php
include("includes/auth-check.php");
include("../../config/db.php");

$user_id = $_SESSION["user_id"];

$sql = "SELECT stock_discrepancy_reports.*, products.name AS product_name
        FROM stock_discrepancy_reports
        LEFT JOIN products ON stock_discrepancy_reports.product_id = products.id
        WHERE stock_discrepancy_reports.reported_by = '$user_id'
        ORDER BY stock_discrepancy_reports.id DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Discrepancy Reports</title>

    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/stock-list.css">
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
    <a href="transaction-history.php">Transactions</a>
    <a href="discrepancy-create.php">Report Discrepancy</a>
    <a href="my-discrepancy-reports.php" class="active">My Reports</a>
    <a href="../../logout.php">Logout</a>

</div>

<div class="main-content">

    <div class="topbar">
        <div>
            <h2>My Discrepancy Reports</h2>
            <p>View your submitted stock discrepancy reports</p>
        </div>
    </div>

    <div class="table-box">

        <table class="stock-table">

            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Expected Qty</th>
                <th>Actual Qty</th>
                <th>Description</th>
                <th>Status</th>
                <th>Reported At</th>
            </tr>

            <?php
            while($row = $result->fetch_assoc()){

                $statusClass = "";

                if($row["status"] == "open"){
                    $statusClass = "status-low";
                }
                else if($row["status"] == "under_review"){
                    $statusClass = "status-ok";
                }
                else{
                    $statusClass = "status-out";
                }
            ?>

            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["product_name"]; ?></td>
                <td><?php echo $row["expected_qty"]; ?></td>
                <td><?php echo $row["actual_qty"]; ?></td>
                <td><?php echo $row["description"]; ?></td>

                <td>
                    <span class="status <?php echo $statusClass; ?>">
                        <?php echo ucfirst(str_replace("_", " ", $row["status"])); ?>
                    </span>
                </td>

                <td><?php echo $row["created_at"]; ?></td>
            </tr>

            <?php
            }
            ?>

        </table>

    </div>

</div>

</body>
</html>