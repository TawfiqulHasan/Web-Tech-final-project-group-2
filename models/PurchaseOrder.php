<?php

class PurchaseOrder {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getPending() {

        $sql = "
        SELECT po.*,
               s.company_name
        FROM purchase_orders po
        LEFT JOIN suppliers s
        ON po.supplier_id = s.id
        WHERE po.status = 'submitted'
        ORDER BY po.created_at DESC
        ";

        return mysqli_query($this->conn, $sql);
    }

    public function getItems($id) {

    $sql = "
    SELECT 
        poi.*,
        p.name
    FROM purchase_order_items poi
    JOIN products p
    ON poi.product_id = p.id
    WHERE poi.po_id = $id
    ";

    return mysqli_query($this->conn, $sql);
}
    
    public function approve($id, $user_id) {

        return mysqli_query($this->conn,
            "UPDATE purchase_orders
             SET status='approved',
                 approved_by=$user_id
             WHERE id=$id"
        );
    }


    public function reject($id, $reason, $user_id) {

        return mysqli_query($this->conn,
            "UPDATE purchase_orders
             SET status='rejected',
                 rejection_reason='$reason',
                 approved_by=$user_id
             WHERE id=$id"
        );
    }
}
?>