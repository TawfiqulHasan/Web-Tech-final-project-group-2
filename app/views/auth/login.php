<!DOCTYPE html>
<html>
<head>
    <title>Login - Warehouse Admin Panel</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="login-body">

<div class="login-box">
    <h2>Warehouse Login</h2>

    <?php if (!empty($error)): ?>
        <div class="alert error"><?= e($error) ?></div>
    <?php endif; ?>

<form method="post" action="index.php?route=login" class="needs-validation" autocomplete="off">
        <label>Email</label>
        <input type="email" name="email" required placeholder="Enter email">

        <label>Password</label>
        <input type="password" name="password" required placeholder="Enter password">

        <button type="submit">Login</button>
    </form>

   
</div>

<script src="assets/app.js"></script>
</body>
</html>
