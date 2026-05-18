<?php

class Warehouse {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAll() {

        $sql = "
        SELECT w.*,
               u.name AS manager_name
        FROM warehouses w
        LEFT JOIN users u
        ON w.manager_id = u.id
        ";

        return mysqli_query($this->conn, $sql);
    }

    
    public function create($name, $address, $city, $manager_id) {

        $sql = "
        INSERT INTO warehouses
        (name, address, city, manager_id)
        VALUES
        ('$name','$address','$city','$manager_id')
        ";

        return mysqli_query($this->conn, $sql);
    }

    
    public function getById($id) {

        $sql = "
        SELECT *
        FROM warehouses
        WHERE id=$id
        ";

        $result = mysqli_query($this->conn, $sql);

        return mysqli_fetch_assoc($result);
    }

    
    public function update($id, $name, $address, $city, $manager_id) {

        $sql = "
        UPDATE warehouses
        SET
        name='$name',
        address='$address',
        city='$city',
        manager_id='$manager_id'
        WHERE id=$id
        ";

        return mysqli_query($this->conn, $sql);
    }
}
?>