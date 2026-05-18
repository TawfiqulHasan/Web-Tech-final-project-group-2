<?php 
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'purchasing') {
    header("Location: ../auth/login.php");
    exit();
}

require_once "../../Controller/ProductController.php";

$filter = "";

if (isset($_GET['filter'])) {

    if ($_GET['filter'] == 'low') {
        $filter = "WHERE current_stock <= reorder_level AND current_stock > 0";
    } elseif ($_GET['filter'] == 'out') {
        $filter = "WHERE current_stock = 0";
    }
}

$result = fetchProducts($filter);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>

<style>



div{
    width: 1000px;
    margin: auto;
    background-color: white;
    padding: 20px;
    margin-top: 50px;
    border: 1px solid #0077b6;
}

table{
    width: 100%;
    border-width: 1.5px;
}

th, td{
    padding: 10px;
    text-align: center;
}

a{
    text-decoration: none;
    padding: 10px;
}

</style>

</head>
<body>
    <div>

<h2>Product Restocking Queue</h2>

<a href="products.php">All Products</a>
<a href="products.php?filter=low">Low Stock</a>
<a href="products.php?filter=out">Out of Stock</a>

<br><br>

<table border="1">

<tr>
    <th>ID</th>
    <th>Product Name</th>
    <th>Current Stock</th>
    <th>Reorder Level</th>
    <th>Urgency</th>
    <th>Action</th>
</tr>

<?php
if ($result->num_rows == 0) {
    echo "<tr><td colspan='5'>No products found.</td></tr>";
} else {
    while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['name']}</td>
        <td>{$row['current_stock']}</td>
        <td>{$row['reorder_level']}</td>
        <td>{$row['urgency']}</td>
        <td>
            <a href='../suppliers/product_suppliers.php?id={$row['id']}'>
                View Suppliers
            </a>
        </td>
      </tr>";
}
}
?>
</table>

</div>
</body>
</html>