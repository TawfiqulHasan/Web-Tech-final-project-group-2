<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>

    <style>

        body{
            font-family: Arial;
            background:#f4f6f9;
            padding:30px;
        }

        .form-box{
            width:500px;
            background:white;
            padding:25px;
            border-radius:10px;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
        }

        input, select, textarea{
            width:100%;
            padding:10px;
            margin-top:8px;
            margin-bottom:15px;
        }

        .add-btn{
    width:100%;
    background:#4f46e5;
    color:white;
    border:none;
    padding:12px;
    border-radius:8px;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s;
}

.add-btn:hover{
    background:#3730a3;
}

    </style>

</head>
<body>

<div class="form-box">

    <h2>Add Product</h2>

    <form method="POST">

        <label>Category</label>

        <select name="category_id" required>

            <option value="">Select Category</option>

            <?php while($cat = mysqli_fetch_assoc($categories)) { ?>

                <option value="<?= $cat['id'] ?>">
                    <?= $cat['name'] ?>
                </option>

            <?php } ?>

        </select>


        <label>Product Name</label>
        <input type="text" name="name" required>


        <label>SKU</label>
        <input type="text" name="sku" required>


        <label>Description</label>
        <textarea name="description"></textarea>


        <label>Unit</label>

        <select name="unit" required>
            <option value="pcs">pcs</option>
            <option value="kg">kg</option>
            <option value="litres">litres</option>
            <option value="boxes">boxes</option>
        </select>


        <label>Reorder Level</label>
        <input type="number" name="reorder_level" required>


        <button type="submit" class="add-btn">
            + Add Product
             </button>

    </form>

    <br>
<a href="http://localhost/InventoryManagement/controllers/Productcontroller.php?action=list" class="back">
    ← Back 
</a>

</div>

</body>
</html>