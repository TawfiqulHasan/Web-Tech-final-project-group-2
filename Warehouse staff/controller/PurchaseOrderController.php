<?php
session_start();

include_once("../model/PurchaseOrderModel.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $item_id = trim($_POST["item_id"]);
    $received_qty = trim($_POST["received_qty"]);

    if (empty($item_id) || empty($received_qty)) {

        $_SESSION["error"] = "Item and received quantity are required";

        header("Location: ../view/warehouse/receive-po.php");
        exit();
    }

    if (!is_numeric($received_qty)) {

        $_SESSION["error"] = "Received quantity must be a number";

        header("Location: ../view/warehouse/receive-po.php");
        exit();
    }

    if ($received_qty <= 0) {

        $_SESSION["error"] = "Received quantity must be greater than 0";

        header("Location: ../view/warehouse/receive-po.php");
        exit();
    }

    $po = new PurchaseOrderModel();

    $result = $po->receiveItem(
        $item_id,
        $received_qty,
        $_SESSION["user_id"]
    );

    if ($result) {

        $_SESSION["success"] = "Purchase order item received successfully";

    } else {

        $_SESSION["error"] = "Receive failed";
    }

    header("Location: ../view/warehouse/receive-po.php");
    exit();
}
?>