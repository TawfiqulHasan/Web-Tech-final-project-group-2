<?php
require_once "../config/database.php";
session_start();

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && $password == $user['password_hash']) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        // ROLE CHECK
        if ($user['role'] == 'purchasing') {
            header("Location: ../View/dashboard/dashboard.php");
        } else {
    header("Location: ../View/auth/login.php?role_error=1");//or suppose header("Location: ../View/auth/login.php?role_error=1");
    exit();
}

      

    } else {
    header("Location: ../View/auth/login.php?error=1");
    exit();
}
}
?>