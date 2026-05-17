<?php
session_start();

include_once("../config/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_SESSION["user_id"];
    $phone = trim($_POST["phone"]);
    $password = trim($_POST["password"]);

    if (empty($phone) && empty($password)) {

        $_SESSION["error"] = "Phone or password is required";

        header("Location: ../view/warehouse/profile.php");
        exit();
    }

    if (!empty($phone)) {

        if (!preg_match("/^[0-9]{11}$/", $phone)) {

            $_SESSION["error"] = "Phone number must be exactly 11 digits";

            header("Location: ../view/warehouse/profile.php");
            exit();
        }

        $phone = htmlspecialchars($phone);

        $sql = "UPDATE users SET phone='$phone' WHERE id='$user_id'";
        $conn->query($sql);
    }

    if (!empty($password)) {

        if (strlen($password) < 4) {

            $_SESSION["error"] = "Password must be at least 4 characters";

            header("Location: ../view/warehouse/profile.php");
            exit();
        }

        $password = htmlspecialchars($password);

        $sql = "UPDATE users SET password_hash='$password' WHERE id='$user_id'";
        $conn->query($sql);
    }

    $_SESSION["success"] = "Profile updated successfully";

    header("Location: ../view/warehouse/profile.php");
    exit();
}
?>