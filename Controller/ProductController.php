<?php
require_once __DIR__ . "/../Model/ProductModel.php";

function fetchProducts($filter = "")
{
    return getProducts($filter);
}

function showProductSuppliers($product_id)
{
    return getProductSuppliers($product_id);
}
?>