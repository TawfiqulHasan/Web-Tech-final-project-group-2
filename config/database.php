<?php
<<<<<<< HEAD
$host = "127.0.0.1";   
$user = "root";        
$pass = "";            
$dbname = "stock_management"; 

$conn = new mysqli($host, $user, $pass, $dbname,3309);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
=======

$conn = mysqli_connect("localhost", "root", "", "inventory_db");

if (!$conn) {
    die("Database connection failed");
}



?>
>>>>>>> main
