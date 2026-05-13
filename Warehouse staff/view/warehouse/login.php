<?php
session_start();

/* If already logged in */
if (isset($_SESSION["user_id"])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Warehouse Staff Login</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>

<div class="container">

<h2>Warehouse Staff Login</h2>

<form method="post" action="../../controller/AuthController.php">

    Email:
    <input type="email"
           name="email"
           value="<?php echo $_COOKIE['remember_email'] ?? ''; ?>">
    <br><br>

    Password:
    <input type="password" name="password">
    <br><br>

    <label>
        <input type="checkbox" name="remember">
        Remember Me
    </label>
    <br><br>

    <input type="submit" value="Login">

</form>

<?php
if (isset($_SESSION["error"])) {
    echo "<p class='error'>" . $_SESSION["error"] . "</p>";
    unset($_SESSION["error"]);
}
?>

</div>

</body>
</html>