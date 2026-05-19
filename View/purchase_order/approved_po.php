<?php
session_start();

require_once "../../Controller/PurchaseOrderController.php";

$result = fetchApprovedPOs();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approved Purchase Orders</title>

<style>

body{
    font-family: Arial;
    background-color: #caf0f8;
}

div{
    width: 1000px;
    margin: auto;
    background: white;
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

<h2>Approved Purchase Orders</h2>

<table border="1">

<tr>
    <th>PO ID</th>
    <th>Supplier ID</th>
    <th>Status</th>
    <th>Expected Delivery</th>
    <th>Overdue</th>
</tr>

<?php

if ($result->num_rows == 0) {

    echo "<tr><td colspan='5'>No approved purchase orders found</td></tr>";

} else {

    while($row = $result->fetch_assoc()) {

        $overdue = "";

        if (
            $row['expected_delivery_date'] < date("Y-m-d")
            && $row['status'] == 'approved'
        ) {
            $overdue = "YES";
        } else {
            $overdue = "NO";
        }

        echo "<tr>

                <td>{$row['id']}</td>

                <td>{$row['supplier_id']}</td>

                <td>{$row['status']}</td>

                <td>{$row['expected_delivery_date']}</td>

                <td>$overdue</td>

              </tr>";
    }
}

?>

</table>

</div>

</body>
</html>