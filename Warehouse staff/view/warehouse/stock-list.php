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
    <a href="stock-adjustment.php">Stock Adjustment</a>
    <a href="receive-po.php">Receive PO</a>
    <a href="transaction-history.php">Transactions</a>
    <a href="discrepancy-create.php" >Report Discrepancy</a>
    <a href="../../logout.php">Logout</a>

</div>

<div class="main-content">

    <div class="topbar">
        <div>
            <h2>Stock List</h2>
            <p>All warehouse products</p>
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

        <div class="table-header">

            <h3>Product Stock Overview</h3>

            <div class="filter-box">

                <input type="text"
                       class="search-box"
                       id="stockSearch"
                       placeholder="Search product..."
                       onkeyup="filterTable()">

                <select id="statusFilter"
                        onchange="filterTable()">

                    <option value="">All Status</option>
                    <option value="In Stock">In Stock</option>
                    <option value="Low Stock">Low Stock</option>
                    <option value="Out Of Stock">Out Of Stock</option>

                </select>

            </div>

        </div>

        <p id="resultCount"></p>

        <table class="stock-table" id="stockTable">

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
                $rowClass = "";

                if($row["current_stock"] == 0){

                    $status = "Out Of Stock";
                    $statusClass = "status-out";
                    $rowClass = "out-row";

                }
                else if($row["current_stock"] <= $row["reorder_level"]){

                    $status = "Low Stock";
                    $statusClass = "status-low";
                    $rowClass = "low-row";

                }
                else{

                    $status = "In Stock";
                    $statusClass = "status-ok";
                    $rowClass = "";

                }
            ?>

            <tr class="<?php echo $rowClass; ?>">

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

<script>
function filterTable(){

    let input = document.getElementById("stockSearch").value.toLowerCase();

    let status = document.getElementById("statusFilter").value.toLowerCase();

    let table = document.getElementById("stockTable");

    let rows = table.getElementsByTagName("tr");

    let visibleCount = 0;

    for(let i = 1; i < rows.length; i++){

        let text = rows[i].innerText.toLowerCase();

        let rowStatus = rows[i].cells[5].innerText.toLowerCase();

        let searchMatch = text.indexOf(input) > -1;

        let statusMatch = status == "" || rowStatus.indexOf(status) > -1;

        if(searchMatch && statusMatch){

            rows[i].style.display = "";

            visibleCount++;

        } else {

            rows[i].style.display = "none";
        }
    }

    document.getElementById("resultCount").innerHTML =
    "Showing " + visibleCount + " products";
}

filterTable();
</script>

</body>
</html>