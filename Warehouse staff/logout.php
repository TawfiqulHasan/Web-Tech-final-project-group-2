<?php
session_start();

/* Remove login */
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="container">

<h2>You are logged out</h2>

<p>
SESSION destroyed.<br>
Login removed successfully.
</p>

<a href="view/warehouse/login.php">
    <button>Login Again</button>
</a>

</div>

</body>
</html>