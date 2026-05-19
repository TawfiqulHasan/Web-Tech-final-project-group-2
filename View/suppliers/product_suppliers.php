<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'purchasing') {
    header("Location: ../auth/login.php");
    exit();
}

require_once "../../Controller/ProductController.php";

$product_id = $_GET['id'] ?? null;

if (!$product_id) {
    die("Product ID is missing");
}

$rows = showProductSuppliers($product_id);

$minPrice = PHP_FLOAT_MAX;

for ($i = 0; $i < count($rows); $i++) {

    if ($rows[$i]['unit_price'] < $minPrice) {
        $minPrice = $rows[$i]['unit_price'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
<tr>
    <th>Product</th>
    <th>Supplier</th>
    <th>Unit Price</th>
    <th>Lead Time</th>
    <th>Preferred</th>
</tr>

<?php

$minPrice = PHP_FLOAT_MAX;

for ($i = 0; $i < count($rows); $i++) {
    if ($rows[$i]['unit_price'] < $minPrice) {
        $minPrice = $rows[$i]['unit_price'];
    }
}

for ($i = 0; $i < count($rows); $i++) {

    $tag = "Normal";

    if ($rows[$i]['unit_price'] == $minPrice) {
        $tag = "Cheapest";
    }

    echo "<tr>
            <td>{$rows[$i]['product_name']}</td>
            <td>{$rows[$i]['company_name']}</td>
            <td>{$rows[$i]['unit_price']}</td>
            <td>{$rows[$i]['lead_time_days']}</td>
            <td>{$tag}</td>
          </tr>";
}

?>
</table>
</body>
</html>