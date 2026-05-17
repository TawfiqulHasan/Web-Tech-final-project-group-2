<?php
include("includes/auth-check.php");
include("../../config/db.php");

$user_id = $_SESSION["user_id"];

$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>

    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/form.css">
    
</head>
<body>

<div class="sidebar">

    <h2>Warehouse Staff</h2>

    <a href="dashboard.php">Dashboard</a>
    <a href="stock-list.php">Stock List</a>
    <a href="product-search.php">Product Search</a>
    <a href="stock-in.php">Stock In</a>
    <a href="stock-out.php">Stock Out</a>
    <a href="stock-adjustment.php">Stock Adjustment</a>
    <a href="receive-po.php">Receive PO</a>
    <a href="transaction-history.php">Transactions</a>
    <a href="discrepancy-create.php">Report Discrepancy</a>
    <a href="../../logout.php">Logout</a>

</div>


<div class="main-content">

    <div class="topbar">
        <div>
            <h2>My Profile</h2>
            <p>View and update your account information</p>
        </div>
            <div class="topbar-right">
        <a href="my-discrepancy-reports.php" class="topbar-link">
            📝 My Report
        </a>

        <a href="profile.php" class="topbar-link">
            👤 My Profile
        </a>

        <span class="topbar-date">
            <?php echo date("d M Y"); ?>
        </span>
    </div>
    </div>

    <div class="form-center">

        <div class="form-box">

            <p><b>Name:</b> <?php echo $user["name"]; ?></p>
            <p><b>Email:</b> <?php echo $user["email"]; ?></p>
            <p><b>Role:</b> <?php echo $user["role"]; ?></p>

            <form method="post" action="../../controller/ProfileController.php" onsubmit="return validateProfile();">

                <label>Phone</label>

                <input type="text"
                       name="phone"
                       value="<?php echo $user["phone"]; ?>"
                       placeholder="Enter phone number">

                <label>New Password</label>

                <input type="password"
                       name="password"
                       placeholder="Enter new password">

                <input type="submit" value="Update Profile">

            </form>

            <?php
            if(isset($_SESSION["success"])){
                echo "<p class='success'>" . $_SESSION["success"] . "</p>";
                unset($_SESSION["success"]);
            }

            if(isset($_SESSION["error"])){
                echo "<p class='error'>" . $_SESSION["error"] . "</p>";
                unset($_SESSION["error"]);
            }
            ?>

        </div>

    </div>

</div>
<script src="../../assets/js/validation.js"></script>

</body>
</html>