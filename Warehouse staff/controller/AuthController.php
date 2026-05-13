<?php
session_start();

include_once("../model/UserModel.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // validation
    if (empty($email) || empty($password)) {

        $_SESSION["error"] = "All fields are required";

        header("Location: ../view/warehouse/login.php");
        exit();
    }

    // email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $_SESSION["error"] = "Invalid email format";

        header("Location: ../view/warehouse/login.php");
        exit();
    }

    $user = new UserModel();

    $result = $user->login($email, $password);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        $_SESSION["user_id"] = $row["id"];
        $_SESSION["name"] = $row["name"];
        $_SESSION["role"] = $row["role"];

        // COOKIE = remember email
        if (isset($_POST["remember"])) {

            setcookie(
                "remember_email",
                $email,
                time() + (86400 * 30),
                "/"
            );
        }

        header("Location: ../view/warehouse/dashboard.php");
        exit();

    } else {

        $_SESSION["error"] = "Email or Password incorrect";

        header("Location: ../view/warehouse/login.php");
        exit();
    }
}
?>