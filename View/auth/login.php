<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
<style>

 body{
            font-family: Arial;
            background-color: #8ecae6;
           
        }

         form{
            background-color: white;
            width: 300px;
            height: 300px;
            padding: 20px;
            margin: auto;
            margin-top: 100px;
            border: 1px solid black;
        }

        #submit{
             width: 200px;
             height: 30px;
             padding-right: 10px;
             margin-left: 50px;
        }


</style>

 
</head>
<body>
    <?php
if (isset($_GET['error'])) {
    echo "<p style='color:red;text-align:center;'>Invalid email or password</p>";
}

if (isset($_GET['role_error'])) {
    echo "<p style='color:red;text-align:center;'>Access denied: Not Purchasing Officer</p>";
}
?>
    <form action="/WebTech_Spring/PurchasingOfficer/Controller/loginController.php" method="post">
        <h2 style="margin-left: 50px;">Login to explore</h2>
<table>
    <tr>
        <td> <label>Email: </label> </td>
        <td> <input type="email" id="email" name="email" required placeholder="Enter your email"></td>
    </tr>

    <br>
    <tr>
       <td></td><td></td>
    </tr>
    <br>

    <tr>
        <td> <label>Password : </label> </td>
        <td> <input type="password" id="password" name="password" required placeholder="Enter your password"></td>
    </tr>
    
    <br>
    
</table>
    <br><br><br>
    <input id="submit" type="submit" value="Login" name="login">    




</form>
</body>
</html>