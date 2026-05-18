<h2>Edit Category</h2>

<form method="POST">
    <input type="text" name="name" value="<?= $data['name'] ?>"><br><br>
    <textarea name="description"><?= $data['description'] ?></textarea><br><br>

    <input type="number" name="parent_id" value="<?= $data['parent_id'] ?>"><br><br>

    <button type="submit">Update</button>
</form>