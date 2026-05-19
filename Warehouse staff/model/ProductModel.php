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

    // search product by name or SKU with category and location
    public function searchProduct($keyword) {

        global $conn;

        $sql = "SELECT 
                    products.id,
                    products.name,
                    products.sku,
                    categories.name AS category_name,
                    products.current_stock,
                    products.reorder_level,
                    warehouse_zones.zone_code,
                    product_locations.bin_code

                FROM products

                LEFT JOIN categories
                ON products.category_id = categories.id

                LEFT JOIN product_locations
                ON products.id = product_locations.product_id

                LEFT JOIN warehouse_zones
                ON product_locations.zone_id = warehouse_zones.id

                WHERE products.name LIKE '%$keyword%'
                OR products.sku LIKE '%$keyword%'";

        $result = $conn->query($sql);

        return $result;
    }
}

?>