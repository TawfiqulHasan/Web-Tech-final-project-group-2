<!DOCTYPE html>
<html>
<head>
    <title>Add Supplier</title>

    <style>

        body{
            font-family: Arial;
            background:#f4f6f9;
            padding:30px;
        }

        .box{
            width:500px;
            background:white;
            padding:25px;
            border-radius:10px;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
            margin:auto;
        }

        h2{
            margin-bottom:20px;
            color:#333;
        }

        input{
            width:100%;
            padding:10px;
            margin-bottom:12px;
            border:1px solid #ddd;
            border-radius:6px;
        }

        .btn{
            width:100%;
            background:#4f46e5;
            color:white;
            border:none;
            padding:12px;
            border-radius:6px;
            font-size:15px;
            cursor:pointer;
            font-weight:bold;
        }

        .btn:hover{
            background:#3730a3;
        }

        .back{
            display:block;
            margin-top:15px;
            text-align:center;
            text-decoration:none;
            color:#4f46e5;
        }

    </style>

</head>
<body>

<div class="box">

    <h2>Add Supplier</h2>

    <form method="POST">

        <input type="text" name="company_name" placeholder="Company Name" required>

        <input type="text" name="contact_person" placeholder="Contact Person">

        <input type="text" name="phone" placeholder="Phone">

        <input type="email" name="email" placeholder="Email">

        <input type="text" name="address" placeholder="Address">

        <input type="text" name="city" placeholder="City">

        <input type="text" name="payment_terms" placeholder="Payment Terms">

        <button type="submit" class="btn">+ Add Supplier</button>

    </form>

    <a href="http://localhost/InventoryManagement/controllers/SupplierController.php?action=list" class="back">
    ← Back to Suppliers
</a>

</div>

</body>
</html>