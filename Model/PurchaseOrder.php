<?php
require_once __DIR__ . "/../config/database.php";


function createPO($supplier_id, $raised_by, $status, $delivery_date, $total, $notes)
{
    global $conn;

    $sql = "INSERT INTO purchase_orders 
            (supplier_id, raised_by, status, expected_delivery_date, total_estimated_value, notes)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissds", $supplier_id, $raised_by, $status, $delivery_date, $total, $notes);

    return $stmt->execute();
}


function addPOItem($po_id, $product_id, $qty, $price)
{
    global $conn;

    $sql = "INSERT INTO purchase_order_items 
            (po_id, product_id, ordered_qty, unit_price, received_qty)
            VALUES (?, ?, ?, ?, 0)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiid", $po_id, $product_id, $qty, $price);

    return $stmt->execute();
}

function getAllSuppliers()
{
    global $conn;
    return $conn->query("SELECT * FROM suppliers");
}


function getAllProducts()
{
    global $conn;
    return $conn->query("SELECT * FROM products");
}


function getPOById($id)
{
    global $conn;
    return $conn->query("SELECT * FROM purchase_orders WHERE id = $id");
}

function getPOItems($po_id)
{
    global $conn;

    $sql = "SELECT product_id, ordered_qty, 
                   IFNULL(received_qty, 0) AS received_qty
            FROM purchase_order_items 
            WHERE po_id = $po_id";

    return $conn->query($sql);
}

function updatePO($id, $supplier_id, $delivery_date, $notes, $status)
{
    global $conn;

    $sql = "UPDATE purchase_orders 
            SET supplier_id=?, 
                expected_delivery_date=?, 
                notes=?, 
                status=?
            WHERE id=? AND status='draft'";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssi", $supplier_id, $delivery_date, $notes, $status, $id);

    return $stmt->execute();
}


function updatePOItem($po_id, $product_id, $qty, $price)
{
    global $conn;

    $sql = "UPDATE purchase_order_items 
            SET ordered_qty=?, unit_price=?
            WHERE po_id=? AND product_id=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("idii", $qty, $price, $po_id, $product_id);

    return $stmt->execute();
}


function deletePO($id)
{
    global $conn;

    $sql = "DELETE FROM purchase_orders 
            WHERE id=? AND status='draft'";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    return $stmt->execute();
}
function getAllPOs()
{
    global $conn;

    $sql = "SELECT * FROM purchase_orders ORDER BY created_at DESC";
    return $conn->query($sql);
}

function filterPOs($status, $supplier_id, $from_date, $to_date)
{
    global $conn;

    $sql = "SELECT * FROM purchase_orders WHERE 1=1";

    if (!empty($status)) {
        $sql .= " AND status = '$status'";
    }

    if (!empty($supplier_id)) {
        $sql .= " AND supplier_id = '$supplier_id'";
    }

    if (!empty($from_date) && !empty($to_date)) {
        $sql .= " AND expected_delivery_date 
                  BETWEEN '$from_date' AND '$to_date'";
    }

    $sql .= " ORDER BY created_at DESC";

    return $conn->query($sql);
}

function getApprovedPOs()
{
    global $conn;

    $sql = "SELECT * FROM purchase_orders
            WHERE status = 'approved'
            ORDER BY expected_delivery_date ASC";

    return $conn->query($sql);
}

function markPOReceived($po_id)
{
    global $conn;

    $sql = "UPDATE purchase_orders
            SET status='received'
            WHERE id=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $po_id);

    return $stmt->execute();
}

function updateReceivedQty($po_id, $product_id, $received_qty)
{
    global $conn;

    $sql = "UPDATE purchase_order_items
            SET received_qty = received_qty + ?
            WHERE po_id=? AND product_id=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $received_qty, $po_id, $product_id);

    return $stmt->execute();
}

function updateReceivedQtyAjax($po_id, $product_id, $qty)
{
    global $conn;

    $sql = "UPDATE purchase_order_items
            SET received_qty = received_qty + ?
            WHERE po_id=? AND product_id=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $qty, $po_id, $product_id);

    return $stmt->execute();
}


function cancelPO($id, $reason)
{
    global $conn;

    // append reason into notes instead of new column
    $sql = "UPDATE purchase_orders
            SET status='cancelled',
                notes = CONCAT(IFNULL(notes,''), ' | CANCELLED: ', ?)
            WHERE id=? AND status!='received'";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $reason, $id);

    return $stmt->execute();
}

function getSpendPerSupplierPerMonth()
{
    global $conn;

    $sql = "SELECT 
                supplier_id,
                DATE_FORMAT(created_at, '%Y-%m') AS month,
                SUM(total_estimated_value) AS total_spend
            FROM purchase_orders
            GROUP BY supplier_id, month
            ORDER BY month DESC";

    return $conn->query($sql);
}

function getAvgLeadTimePerSupplier()
{
    global $conn;

    $sql = "SELECT 
                supplier_id,
                AVG(DATEDIFF(CURDATE(), created_at)) AS avg_lead_time
            FROM purchase_orders
            WHERE status = 'received'
            GROUP BY supplier_id";

    return $conn->query($sql);
}

function getMostFrequentProducts()
{
    global $conn;

    $sql = "SELECT 
                product_id,
                SUM(ordered_qty) AS total_ordered
            FROM purchase_order_items
            GROUP BY product_id
            ORDER BY total_ordered DESC";

    return $conn->query($sql);
}

function getPOReportByDateRange($from_date, $to_date)
{
    global $conn;

    $sql = "SELECT 
                id,
                supplier_id,
                status,
                total_estimated_value,
                created_at
            FROM purchase_orders
            WHERE created_at BETWEEN '$from_date' AND '$to_date'
            ORDER BY created_at DESC";

    return $conn->query($sql);
}

?>