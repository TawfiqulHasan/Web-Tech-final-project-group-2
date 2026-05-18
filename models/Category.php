<?php

class Category {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }


    public function getAll() {
        return mysqli_query($this->conn, "
            SELECT c1.*, c2.name AS parent_name
            FROM categories c1
            LEFT JOIN categories c2 ON c1.parent_id = c2.id
        ");
    }

    
    public function getById($id) {
        return mysqli_fetch_assoc(
            mysqli_query($this->conn, "SELECT * FROM categories WHERE id=$id")
        );
    }

    
    public function create($name, $description, $parent_id) {
        return mysqli_query($this->conn, "
            INSERT INTO categories(name, description, parent_id)
            VALUES('$name', '$description', " . ($parent_id ?: "NULL") . ")
        ");
    }

    
    public function update($id, $name, $description, $parent_id) {
        return mysqli_query($this->conn, "
            UPDATE categories 
            SET name='$name', description='$description', parent_id=" . ($parent_id ?: "NULL") . "
            WHERE id=$id
        ");
    }

    
    public function delete($id) {

        $check = mysqli_query($this->conn, "
            SELECT COUNT(*) AS total 
            FROM products 
            WHERE category_id=$id
        ");

        $count = mysqli_fetch_assoc($check)['total'];

        if ($count > 0) {
            return false; // blocked
        }

        return mysqli_query($this->conn, "DELETE FROM categories WHERE id=$id");
    }
}