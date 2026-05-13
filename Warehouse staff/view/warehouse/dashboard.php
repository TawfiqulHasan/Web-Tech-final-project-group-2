<?php
include("includes/auth-check.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>

<div class="container">

<h2>Warehouse Dashboard</h2>

<p>
Welcome:
<b><?php echo $_SESSION["name"]; ?></b>
</p>

<p>
You are logged in as:
<b><?php echo $_SESSION["role"]; ?></b>
</p>

<a href="../../logout.php">
    <button>Logout</button>
</a>

</div>

</body>
</html>