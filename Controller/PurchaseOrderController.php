<?php
require_once __DIR__ . "/../Model/PurchaseOrder.php";

function fetchSuppliers()
{
    return getAllSuppliers();
}

function fetchProducts()
{
    return getAllProducts();
}


if (isset($_POST['status'])) {

    session_start();

    $supplier_id = $_POST['supplier_id'];
    $product_id = $_POST['product_id'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $delivery_date = $_POST['delivery_date'];
    $notes = $_POST['notes'];
    $status = $_POST['status'];
    $raised_by = $_SESSION['user_id'];

    $total = $qty * $price;

    
    createPO($supplier_id, $raised_by, $status, $delivery_date, $total, $notes);

    global $conn;
    $po_id = $conn->insert_id;

   
    addPOItem($po_id, $product_id, $qty, $price);

    header("Location: ../View/purchase_order/all_po.php");
    exit();
}

if (isset($_POST['update_po'])) {

    $po_id = $_POST['po_id'];
    $supplier_id = $_POST['supplier_id'];
    $product_id = $_POST['product_id'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $delivery_date = $_POST['delivery_date'];
    $notes = $_POST['notes'];

    $status = $_POST['status'];

updatePO($po_id, $supplier_id, $delivery_date, $notes, $status);
    updatePOItem($po_id, $product_id, $qty, $price);

    header("Location: ../View/purchase_order/all_po.php");
    exit();
}


if (isset($_GET['delete'])) {

    $id = $_GET['delete'];

    deletePO($id);

    header("Location: ../View/purchase_order/all_po.php");
    exit();
}

function fetchFilteredPOs($status, $supplier_id, $from_date, $to_date)
{
    return filterPOs($status, $supplier_id, $from_date, $to_date);
}

function fetchApprovedPOs()
{
    return getApprovedPOs();
}




if (isset($_POST['receive_po'])) {

    $po_id = $_POST['po_id'];

    $product_ids = $_POST['product_id'];
    $received_qtys = $_POST['received_qty'];

    for ($i = 0; $i < count($product_ids); $i++) {

        updateReceivedQty(
            $po_id,
            $product_ids[$i],
            $received_qtys[$i]
        );
    }

    markPOReceived($po_id);

    header("Location: ../View/purchase_order/all_po.php");
    exit();
}

if (isset($_POST['cancel_po'])) {

    $po_id = $_POST['po_id'];
    $reason = $_POST['reason'];

    if (empty($reason)) {
        die("Cancellation reason is required");
    }

    cancelPO($po_id, $reason);

    header("Location: ../View/purchase_order/all_po.php");
    exit();
}

function fetchSpendReport()
{
    return getSpendPerSupplierPerMonth();
}

function fetchLeadReport()
{
    return getAvgLeadTimePerSupplier();
}

function fetchProductReport()
{
    return getMostFrequentProducts();
}

function fetchPOReport($from_date, $to_date)
{
    return getPOReportByDateRange($from_date, $to_date);
}

?>