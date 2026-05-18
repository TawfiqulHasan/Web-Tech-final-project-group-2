
<?php
require_once "../config/database.php";
session_start();


if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'purchasing') {
    header("Location: ../View/auth/login.php");
    exit();
}


$sql = "SELECT status, COUNT(*) as total FROM purchase_orders GROUP BY status";
$result = $conn->query($sql);


include "../View/dashboard/dashboard.php";
?>