<?php
include("includes/auth-check.php");
include("../../config/db.php");

/* Filters */
$productFilter = $_GET["product"] ?? "";
$typeFilter = $_GET["type"] ?? "";
$fromDate = $_GET["from_date"] ?? "";
$toDate = $_GET["to_date"] ?? "";

/* Main query */
$sql = "SELECT stock_transactions.*, products.name AS product_name, users.name AS user_name
        FROM stock_transactions
        LEFT JOIN products ON stock_transactions.product_id = products.id
        LEFT JOIN users ON stock_transactions.user_id = users.id
        WHERE 1=1";

/* Product filter */
if($productFilter != ""){
    $sql .= " AND stock_transactions.product_id='$productFilter'";
}

/* Type filter */
if($typeFilter != ""){
    $sql .= " AND stock_transactions.type='$typeFilter'";
}

/* Date filter */
if($fromDate != ""){
    $sql .= " AND DATE(stock_transactions.transaction_date) >= '$fromDate'";
}

if($toDate != ""){
    $sql .= " AND DATE(stock_transactions.transaction_date) <= '$toDate'";
}

$sql .= " ORDER BY stock_transactions.id DESC";

$result = $conn->query($sql);

/* Product dropdown */
$productSql = "SELECT id, name FROM products";
$productResult = $conn->query($productSql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transaction History</title>

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
    <a href="receive-po.php">Receive PO</a>
    <a href="transaction-history.php" class="active">Transactions</a>
    <a href="discrepancy-create.php" >Report Discrepancy</a>
    <a href="../../logout.php">Logout</a>

</div>

<div class="main-content">

    <div class="topbar">
        <div>
            <h2>Transaction History</h2>
            <p>Filter stock in, stock out and adjustment records</p>
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

    <div class="table-box">

        <div class="table-header">

            <h3>Stock Transactions</h3>

            <input type="text"
                   class="search-box"
                   id="transactionSearch"
                   placeholder="Search transaction..."
                   onkeyup="filterTransaction()">

        </div>

<form method="get" class="filter-form">

    <div class="filter-group">

        <label>Product:</label>

        <select name="product">

            <option value="">All Products:</option>

            <?php
            while($product = $productResult->fetch_assoc()){
            ?>
                <option value="<?php echo $product["id"]; ?>"
                <?php if($productFilter == $product["id"]){ echo "selected"; } ?>>

                    <?php echo $product["name"]; ?>

                </option>
            <?php
            }
            ?>

        </select>

    </div>

    <div class="filter-group">

        <label>Transaction Type:</label>

        <select name="type">

            <option value="">All Types</option>

            <option value="in"
            <?php if($typeFilter == "in"){ echo "selected"; } ?>>
                Stock In
            </option>

            <option value="out"
            <?php if($typeFilter == "out"){ echo "selected"; } ?>>
                Stock Out
            </option>

            <option value="adjustment"
            <?php if($typeFilter == "adjustment"){ echo "selected"; } ?>>
                Adjustment
            </option>

        </select>

    </div>

    <div class="filter-group">

        <label>From Date:</label>

        <input type="date"
               name="from_date"
               value="<?php echo $fromDate; ?>">

    </div>

    <div class="filter-group">

        <label>To Date:</label>

        <input type="date"
               name="to_date"
               value="<?php echo $toDate; ?>">

    </div>

    <div class="filter-btns">

        <button type="submit">
            Filter
        </button>

        <a href="transaction-history.php">

            <button type="button">
                Reset
            </button>

        </a>

    </div>

</form>

        <table class="stock-table" id="transactionTable">

            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>User</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>Date</th>
            </tr>

            <?php
            while($row = $result->fetch_assoc()){

                $typeClass = "";

                if($row["type"] == "in"){
                    $typeClass = "status-ok";
                }
                else if($row["type"] == "out"){
                    $typeClass = "status-out";
                }
                else{
                    $typeClass = "status-low";
                }
            ?>

            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["product_name"]; ?></td>
                <td><?php echo $row["user_name"]; ?></td>

                <td>
                    <span class="status <?php echo $typeClass; ?>">
                        <?php echo ucfirst($row["type"]); ?>
                    </span>
                </td>

                <td><?php echo $row["quantity"]; ?></td>
                <td><?php echo $row["transaction_date"]; ?></td>
            </tr>

            <?php
            }
            ?>

        </table>

    </div>

</div>

<script>
function filterTransaction(){

    let input = document.getElementById("transactionSearch").value.toLowerCase();
    let table = document.getElementById("transactionTable");
    let rows = table.getElementsByTagName("tr");

    for(let i = 1; i < rows.length; i++){

        let text = rows[i].innerText.toLowerCase();

        if(text.indexOf(input) > -1){
            rows[i].style.display = "";
        }
        else{
            rows[i].style.display = "none";
        }
    }
}
</script>

</body>
</html>