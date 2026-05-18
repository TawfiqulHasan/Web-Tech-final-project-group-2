<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4f46e5, #9333ea);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background: white;
            width: 350px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
        }

        .login-box h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .login-box input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
        }

        .login-box input:focus {
            border-color: #4f46e5;
        }

        .login-box button {
            width: 100%;
            padding: 10px;
            background: #4f46e5;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        .login-box button:hover {
            background: #3730a3;
        }

        .title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .subtitle {
            font-size: 13px;
            color: gray;
            margin-bottom: 20px;
        }
    </style>

</head>
<body>

<div class="login-box">

    <div class="title">Inventory System</div>
    <div class="subtitle">Please login to continue</div>

    <form action="../controllers/logincontroller.php" method="POST">

        <input type="email" name="email" placeholder="Email" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Login</button>

    </form>

</div>

</body>
</html>