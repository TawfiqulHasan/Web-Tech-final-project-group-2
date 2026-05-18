<?php
session_start();
 
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'purchasing') {
    header("Location: ../auth/login.php");
    exit();
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
table{
    border: 1px solid #1b4965;
}
div{
    
    border: 1px solid #62b6cb;
    margin: auto;
    padding: 30px;
    width: 900px;
    height: 1500px;
}
nav{
    background-color: #1b4965;
    height: 50px;


}
a{
    text-decoration: none;
}
</style>
</head>
<body>
   
  <nav>
    
    
    <button> <a href="http://localhost:8080/WebTech_Spring/PurchasingOfficer/View/product/products.php"> Product </a></button>
    <button> <a href="http://localhost:8080/WebTech_Spring/PurchasingOfficer/View/dashboard/dashboard.php">Dashboard </a></button>
    <button> <a href="http://localhost:8080/WebTech_Spring/PurchasingOfficer/View/purchase_order/analytics.php">Analatical Dashboard </a></button>
    <button> <a href="http://localhost:8080/WebTech_Spring/PurchasingOfficer/View/purchase_order/approved_po.php"> Approve Order</a></button>
    <button> <a href="http://localhost:8080/WebTech_Spring/PurchasingOfficer/View/purchase_order/create.php">Create Order </a></button>
    <button> <a href="http://localhost:8080/WebTech_Spring/PurchasingOfficer/View/purchase_order/po_report.php"> Order Report </a></button>
    <button> <a href="http://localhost:8080/WebTech_Spring/PurchasingOfficer/View/suppliers/suppliers.php"> Suppliers</a></button>
    <button> <a href="http://localhost:8080/WebTech_Spring/PurchasingOfficer/View/purchase_order/all_po.php"> Order Info </a></button>


</nav> 
 
<div>
<h3>Open Purchase Orders</h3>
 
<?php
require_once "../../config/database.php";
 
$sql =  "SELECT * FROM purchase_orders";
$result = $conn->query($sql);
 
$lowStockSql = "SELECT * FROM products
                WHERE current_stock <= reorder_level";
 
$lowStockResult = $conn->query($lowStockSql);
 
$deliverySql = "SELECT * FROM purchase_orders
                WHERE expected_delivery_date
                BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)";
 
$deliveryResult = $conn->query($deliverySql);
 
$spendSql = "SELECT SUM(total_estimated_value) AS total_spend
             FROM purchase_orders
             WHERE status IN ('submitted', 'approved')";
 
$spendResult = $conn->query($spendSql);
 
$spendData = $spendResult->fetch_assoc();
 
?>
 
<h2>Purchasing Dashboard</h2>
 
<table border=1 cellpadding ="10">
     <tr>
        <th>PO ID</th>
        <th>Supplier ID</th>
        <th>Status</th>
        <th>Expected Delivery</th>
        <th>Total Value</th>
        <th>Created At</th>
    </tr>
 
    <?php if ($result->num_rows == 0) { ?>
 
    <tr>
        <td >No purchase orders found.</td>
    </tr>
 
<?php } else { ?>
 
    <?php while($row = $result->fetch_assoc()) { ?>
         <tr>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo$row['supplier_id'] ?></td>
            <td><?php echo$row['status'] ?></td>
            <td><?php echo$row['expected_delivery_date'] ?></td>
            <td><?php echo$row['total_estimated_value'] ?></td>
            <td><?php echo$row['created_at'] ?></td>
        </tr>
    <?php } ?>
 
<?php } ?>
</table>
<h3>Low Stock Products</h3>
 
<table border="1" cellpadding="10">
 
    <tr>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Current Stock</th>
        <th>Reorder Level</th>
    </tr>
 
<?php if ($lowStockResult->num_rows == 0) { ?>
 
    <tr>
        <td colspan="4">No low stock products found.</td>
    </tr>
 
<?php } else { ?>
 
    <?php while($product = $lowStockResult->fetch_assoc()) { ?>
 
        <tr>
            <td><?php echo $product['id'] ?></td>
            <td><?php echo $product['name'] ?></td>
            <td><?php echo$product['current_stock'] ?></td>
            <td><?php echo$product['reorder_level'] ?></td>
        </tr>
 
    <?php } ?>
 
<?php } ?>
 
</table>
 
<h3>Expected Deliveries This Week</h3>
 
<table border="1" cellpadding="10">
 
    <tr>
        <th>PO ID</th>
        <th>Supplier ID</th>
        <th>Status</th>
        <th>Expected Delivery</th>
    </tr>
 
<?php if ($deliveryResult->num_rows == 0) { ?>
 
    <tr>
        <td colspan="4">No deliveries this week.</td>
    </tr>
 
<?php } else { ?>
 
    <?php while($delivery = $deliveryResult->fetch_assoc()) { ?>
 
        <tr>
            <td><?php echo$delivery['id'] ?></td>
            <td><?php echo$delivery['supplier_id'] ?></td>
            <td><?php echo$delivery['status'] ?></td>
            <td><?php echo$delivery['expected_delivery_date'] ?></td>
        </tr>
 
    <?php } ?>
 
<?php } ?>
 
</table>
 
<h3>Total Committed Spend</h3>
 
<p>
    Total Spend:
    <?php echo $spendData['total_spend'] ? $spendData['total_spend'] : 0 ?>
</p>
 
</div>
 
</body>
</html>