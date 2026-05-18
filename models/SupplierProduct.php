<?php

class SupplierProduct {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }


    public function getAll() {

        $sql = "
        SELECT sp.*,
               s.company_name,
               p.name AS product_name
        FROM supplier_products sp
        JOIN suppliers s ON sp.supplier_id = s.id
        JOIN products p ON sp.product_id = p.id
        ";

        return mysqli_query($this->conn, $sql);
    }

    
    public function create($supplier_id, $product_id, $price, $lead_time, $preferred) {

        if ($preferred == 1) {
            mysqli_query($this->conn,
                "UPDATE supplier_products
                 SET is_preferred_supplier = 0
                 WHERE product_id = $product_id"
            );
        }

        $sql = "
        INSERT INTO supplier_products
        (supplier_id, product_id, unit_price, lead_time_days, is_preferred_supplier)
        VALUES
        ('$supplier_id','$product_id','$price','$lead_time','$preferred')
        ";

        return mysqli_query($this->conn, $sql);
    }

    // DELETE
    public function delete($id) {
        return mysqli_query($this->conn,
            "DELETE FROM supplier_products WHERE id=$id"
        );
    }
}
?>