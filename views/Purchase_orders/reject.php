<!DOCTYPE html>
<html>
<head>
    <title>Purchase Order</title>

    <style>

            body {
    margin: 0;
    font-family: Arial;
    background: #eaf2ff;;
}
        

        
        .header {
            background: #4f46e5;
            color: white;
            padding: 15px 20px;
            font-size: 18px;
            font-weight: bold;
        }

        
        .container {
            padding: 30px;
            display: flex;
            justify-content: center;
        }

        
        .box {
            background: white;
            width: 450px;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        textarea {
            width: 100%;
            height: 120px;
            padding: 10px;
            margin-top: 10px;
            border-radius: 6px;
            border: 1px solid #ddd;
        }

        button {
            background: #ef4444;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background: #dc2626;
        }

        
        .footer {
            margin-top: 20px;
            text-align: center;
        }

        .back-btn {
            display: inline-block;
            padding: 10px 16px;
            background: #4f46e5;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s;
        }

        .back-btn:hover {
            background: #3730a3;
        }
    </style>

</head>

<body>


<div class="header">
    Purchase Order System
</div>


<div class="container">

    <div class="box">

        <h2>Reject Purchase Order</h2>

        <form method="POST">

            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">

            <label>Reason</label>

            <textarea name="reason" required></textarea>

            <br>

            <button type="submit">
                Reject PO
            </button>

        </form>

        
        <div class="footer">
            <a href="POController.php?action=list" class="back-btn">
                ← Back to Dashboard
            </a>
        </div>

    </div>

</div>

</body>
</html>