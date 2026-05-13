<?php

include_once(__DIR__ . "/../config/db.php");

class ProductModel {

    // get all products
    public function getAllProducts() {

        global $conn;

        $sql = "SELECT * FROM products";

        $result = $conn->query($sql);

        return $result;
    }

    // search product
    public function searchProduct($keyword) {

        global $conn;

        $sql = "SELECT *
                FROM products
                WHERE name LIKE '%$keyword%'
                OR sku LIKE '%$keyword%'";

        $result = $conn->query($sql);

        return $result;
    }
}

?>