<?php

include_once("../model/ProductModel.php");

$product = new ProductModel();

/* AJAX Search */
if (isset($_GET["search"])) {

    header("Content-Type: application/json");

    $keyword = $_GET["search"];

    $result = $product->searchProduct($keyword);

    $products = [];

    while ($row = $result->fetch_assoc()) {

        $products[] = $row;
    }

    echo json_encode($products);
}

?>