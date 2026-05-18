<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>

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

        button{
            background:#4f46e5;
            color:white;
            border:none;
            padding:10px 15px;
            cursor:pointer;
        }

    </style>

</head>
<body>

<div class="form-box">

    <h2>Edit Product</h2>

    <form method="POST">

        <label>Category</label>

        <select name="category_id" required>

            <?php while($cat = mysqli_fetch_assoc($categories)) { ?>

                <option value="<?= $cat['id'] ?>"
                    <?= ($cat['id'] == $data['category_id']) ? 'selected' : '' ?>>

                    <?= $cat['name'] ?>

                </option>

            <?php } ?>

        </select>


        <label>Product Name</label>

        <input type="text"
               name="name"
               value="<?= $data['name'] ?>"
               required>


        <label>SKU</label>

        <input type="text"
               name="sku"
               value="<?= $data['sku'] ?>"
               required>


        <label>Description</label>

        <textarea name="description"><?= $data['description'] ?></textarea>


        <label>Unit</label>

        <select name="unit">

            <option value="pcs"
                <?= ($data['unit']=="pcs") ? 'selected' : '' ?>>
                pcs
            </option>

            <option value="kg"
                <?= ($data['unit']=="kg") ? 'selected' : '' ?>>
                kg
            </option>

            <option value="litres"
                <?= ($data['unit']=="litres") ? 'selected' : '' ?>>
                litres
            </option>

            <option value="boxes"
                <?= ($data['unit']=="boxes") ? 'selected' : '' ?>>
                boxes
            </option>

        </select>


        <label>Reorder Level</label>

        <input type="number"
               name="reorder_level"
               value="<?= $data['reorder_level'] ?>"
               required>


        <button type="submit">Update Product</button>

    </form>

    <br>

    <a href="../../controllers/ProductController.php?action=list">
        Back
    </a>

</div>

</body>
</html>