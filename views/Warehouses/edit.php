<!DOCTYPE html>
<html>
<head>
    <title>Edit Warehouse</title>

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

        input, textarea, select{
            width:100%;
            padding:10px;
            margin-top:8px;
            margin-bottom:15px;
        }

        .btn{
            background:#4f46e5;
            color:white;
            border:none;
            padding:12px;
            border-radius:8px;
            cursor:pointer;
            width:100%;
            font-size:16px;
        }

        .btn:hover{
            background:#3730a3;
        }

        a{
            text-decoration:none;
        }

    </style>

</head>
<body>

<div class="form-box">

    <h2>Edit Warehouse</h2>

    <form method="POST">

        <label>Warehouse Name</label>

        <input type="text"
               name="name"
               value="<?= $data['name'] ?>"
               required>


        <label>Address</label>

        <textarea name="address"><?= $data['address'] ?></textarea>


        <label>City</label>

        <input type="text"
               name="city"
               value="<?= $data['city'] ?>">


        <label>Responsible Staff</label>

        <select name="manager_id">

            <?php while($u = mysqli_fetch_assoc($users)) { ?>

                <option value="<?= $u['id'] ?>"

                    <?php
                    if($u['id'] == $data['manager_id']) {
                        echo "selected";
                    }
                    ?>

                >

                    <?= $u['name'] ?>

                </option>

            <?php } ?>

        </select>


        <button type="submit" class="btn">
            Update Warehouse
        </button>

    </form>

    <br>

    <a href="../controllers/WarehouseController.php?action=list">
        ← Back
    </a>

</div>

</body>
</html>