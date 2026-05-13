<?php

include_once("../model/ProductModel.php");

$product = new ProductModel();

// get all products
$result = $product->getAllProducts();

?>
