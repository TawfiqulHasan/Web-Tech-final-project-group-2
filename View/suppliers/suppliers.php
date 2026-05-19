<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'purchasing') {
    header("Location: ../auth/login.php");
    exit();
}


require_once "../../Controller/SupplierController.php";

$search = $_GET['search'] ?? "";
$result = getSuppliers($search);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppliers</title>

<style>

body{
    font-family: Arial;
    background-color: #caf0f8;
}

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
}

th, td{
    padding: 10px;
    text-align: center;
}

input{
    padding: 8px;
}

button{
    padding: 8px;
}

a{
    text-decoration: none;
}

</style>

</head>
<body>

<div>

<h2>All Suppliers</h2>

<br><br>

<a href="../product/products.php">
View Suppliers By Product
</a>
<br><br>
<form method="GET" action="">

<input type="text" 
       name="search" 
       placeholder="Search supplier or product">

<button type="submit">Search</button>

</form>

<br>

<table border="1">

<tr>
    <th>ID</th>
    <th>Company Name</th>
    <th>Contact Person</th>
    <th>Phone</th>
    <th>City</th>
    <th>Details</th>
</tr>

<?php

if ($result->num_rows == 0) {

    echo "<tr><td colspan='6'>No suppliers found.</td></tr>";

} else {

    while($row = $result->fetch_assoc()) {

        echo "<tr>

                <td>{$row['id']}</td>

                <td>{$row['company_name']}</td>

                <td>{$row['contact_person']}</td>

                <td>{$row['phone']}</td>

                <td>{$row['city']}</td>

                <td>
                    <a href='supplier_details.php?id={$row['id']}'>
                    View
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