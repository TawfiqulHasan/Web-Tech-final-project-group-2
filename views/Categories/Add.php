<h2>Add Category</h2>

<form method="POST">
    <input type="text" name="name" placeholder="Category Name"><br><br>
    <textarea name="description" placeholder="Description"></textarea><br><br>

    <input type="number" name="parent_id" placeholder="Parent Category ID (optional)"><br><br>

    <button type="submit">Save</button>
</form>

<a href="http://localhost/InventoryManagement/controllers/Categorycontroller.php?action=list" class="back">
    ← Back to Categories
</a>