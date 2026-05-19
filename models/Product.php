<?php

class Product {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAll() {

        $sql = "SELECT products.*, categories.name AS category_name
                FROM products
                LEFT JOIN categories 
                ON products.category_id = categories.id";

        return mysqli_query($this->conn, $sql);
    }
public function getById($id) {

        $sql = "SELECT * FROM products WHERE id=$id";

        $result = mysqli_query($this->conn, $sql);

        return mysqli_fetch_assoc($result);
    }

    public function create($category_id, $name, $sku, $description, $unit, $reorder_level) {

        $sql = "INSERT INTO products
                (category_id, name, sku, description, unit, reorder_level)
                VALUES
                ('$category_id', '$name', '$sku', '$description', '$unit', '$reorder_level')";

        return mysqli_query($this->conn, $sql);
    }

    public function update($id, $category_id, $name, $sku, $description, $unit, $reorder_level) {

        $sql = "UPDATE products SET
                category_id='$category_id',
                name='$name',
                sku='$sku',
                description='$description',
                unit='$unit',
                reorder_level='$reorder_level'
                WHERE id=$id";

        return mysqli_query($this->conn, $sql);
    }

 public function delete($id) {

    $sql = "DELETE FROM products WHERE id=$id";

return mysqli_query($this->conn, $sql);
}

}
?>