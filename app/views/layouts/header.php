<?php
$user = current_user();
$flash = get_flash();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Warehouse Admin Panel</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="topbar">
    <div><strong>Warehouse Admin Panel</strong></div>

    <div>
        <?= e($user["name"] ?? "Guest") ?>
        <?php if ($user): ?>
            (<?= e($user["role"]) ?>)
            | <a href="index.php?route=logout">Logout</a>
        <?php endif; ?>
    </div>
</div>

<div class="layout">
    <div class="sidebar">
        <a href="index.php?route=dashboard">Dashboard</a>
        <a href="index.php?route=products">Products</a>
        <a href="index.php?route=categories">Categories</a>
        <a href="index.php?route=warehouses">Warehouses</a>
        <a href="index.php?route=stock_transactions">Stock Transactions</a>
        <a href="index.php?route=reports">Reports</a>

        <?php if (has_role(["admin", "manager", "purchasing"])): ?>
            <a href="index.php?route=suppliers">Suppliers</a>
            <a href="index.php?route=purchase_orders">Purchase Orders</a>
        <?php endif; ?>

        <?php if (has_role(["admin", "manager"])): ?>
            <a href="index.php?route=users">Users</a>
            <a href="index.php?route=activity_logs">Activity Logs</a>
        <?php endif; ?>
    </div>

    <main class="content">
        <?php if ($flash): ?>
            <div class="alert <?= e($flash["type"]) ?>">
                <?= e($flash["message"]) ?>
            </div>
        <?php endif; ?>
