<?php
require_once __DIR__ . "/../config/database.php";

function getSuppliers($search = "")
{
    global $conn;

    $sql = "SELECT DISTINCT suppliers.*
            FROM suppliers
            LEFT JOIN supplier_products 
            ON suppliers.id = supplier_products.supplier_id
            LEFT JOIN products
            ON supplier_products.product_id = products.id";

    if (!empty($search)) {
        $sql .= " WHERE suppliers.company_name LIKE ?
                  OR products.name LIKE ?";

        $stmt = $conn->prepare($sql);

        $searchParam = "%" . $search . "%";
        $stmt->bind_param("ss", $searchParam, $searchParam);

        $stmt->execute();
        return $stmt->get_result();
    }

    return $conn->query($sql);
}

function fetchSuppliersByProduct($product_id)
{
    require_once __DIR__ . "/../Model/ProductModel.php";
    return getProductSuppliers($product_id);
}

?>