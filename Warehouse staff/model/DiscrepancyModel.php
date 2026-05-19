<?php

include_once(__DIR__ . "/../config/db.php");

class DiscrepancyModel {

    public function addReport($product_id, $expected_qty, $actual_qty, $description, $user_id){

        global $conn;

        $sql =
        "INSERT INTO stock_discrepancy_reports
        (product_id, warehouse_id, reported_by, description, expected_qty, actual_qty, status)
        VALUES
        ('$product_id', 1, '$user_id', '$description', '$expected_qty', '$actual_qty', 'open')";

        return $conn->query($sql);
    }
}

?>