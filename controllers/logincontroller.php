<?php
session_start();
require __DIR__ . "/../config/database.php";

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND is_active=1");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("User not found");
}

$user = $result->fetch_assoc();

if (!password_verify($password, $user['password_hash'])) {
    die("Password incorrect");
}

echo "LOGIN SUCCESS"; 

$role = strtolower(trim($user['role']));

if ($role == 'manager') {
    header("Location: ../views/dashboard.php");
    exit();
}