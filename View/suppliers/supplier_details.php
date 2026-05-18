<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'purchasing') {
    header("Location: ../auth/login.php");
    exit();
}

require_once "../../config/database.php";

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Supplier ID is missing");
}

$sql = "SELECT suppliers.company_name,
               products.name,
               supplier_products.unit_price,
               supplier_products.lead_time_days

        FROM supplier_products

        JOIN suppliers
        ON supplier_products.supplier_id = suppliers.id

        JOIN products
        ON supplier_products.product_id = products.id

        WHERE suppliers.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Details</title>

<style>

body{
    font-family: Arial;
    background-color: #caf0f8;
}

div{
    width: 900px;
    margin: auto;
    background-color: white;
    padding: 20px;
    margin-top: 50px;
    border: 1px solid #0077b6;
}

table{
    width: 100%;
}

th, td{
    padding: 10px;
    text-align: center;
}

</style>

</head>
<body>

<div>

<h2>Supplier Product List</h2>

<table border="1">

<tr>
    <th>Supplier</th>
    <th>Product</th>
    <th>Unit Price</th>
    <th>Lead Time (Days)</th>
</tr>

<?php

if ($result->num_rows == 0) {

    echo "<tr><td colspan='4'>No data found.</td></tr>";

} else {

    while($row = $result->fetch_assoc()) {

        echo "<tr>

                <td>{$row['company_name']}</td>

                <td>{$row['name']}</td>

                <td>{$row['unit_price']}</td>

                <td>{$row['lead_time_days']}</td>

              </tr>";
    }
}

?>

</table>

</div>

</body>
</html>