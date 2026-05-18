<?php
$host = "127.0.0.1";   // database server
$user = "root";        // database username
$pass = "";            // database password
$dbname = "stock_management"; // database name

$conn = new mysqli($host, $user, $pass, $dbname,3309);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
