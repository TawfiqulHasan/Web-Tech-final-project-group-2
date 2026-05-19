<?php
session_start();

if (isset($_GET['action']) && $_GET['action'] === 'logout') {

    $_SESSION = [];
    session_unset();
    session_destroy();

    header("Location: ../views/login.php");
    exit();
}