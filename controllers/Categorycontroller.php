<?php
session_start();
require "../config/database.php";
require "../models/Category.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/login.php");
    exit();
}

$category = new Category($conn);
$action = $_GET['action'] ?? 'list';


if ($action == "list") {
    $categories = $category->getAll();
    include "../views/categories/index.php";
}


if ($action == "add") {

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $name = trim($_POST['name']);
        $desc = trim($_POST['description']);
        $parent = $_POST['parent_id'] ?? null;

        if ($name == "") {
            die("Category name required");
        }

        $category->create($name, $desc, $parent);

        header("Location: CategoryController.php?action=list");
    }

    include "../views/categories/add.php";
}


if ($action == "edit") {

    $id = $_GET['id'];
    $data = $category->getById($id);

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $name = trim($_POST['name']);
        $desc = trim($_POST['description']);
        $parent = $_POST['parent_id'] ?? null;

        $category->update($id, $name, $desc, $parent);

        header("Location: CategoryController.php?action=list");
    } 

    include "../views/categories/edit.php";
}


if ($action == "delete") {

    $id = $_GET['id'];

    $result = $category->delete($id);

    if (!$result) {
        echo "Cannot delete category: products are linked!";
        exit();
    }

    header("Location: CategoryController.php?action=list");
}