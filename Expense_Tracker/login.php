<?php
include './Includes/Functions/functions.php';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget management system</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main">
        <div class="form">
            <form action="process_login.php" method="post">
                    <h2>Login Here</h2>
                    <input type="text" name="user[username]" placeholder="Username" data-form-field="username" class="form-control display-7" value="" id="email-formbuilder-1j">
                    <input type="password" name="user[password]" placeholder="Password" data-form-field="password" class="form-control display-7" value="" id="password-formbuilder-1j">
                    <button class="btnn" type="submit" name ="save"><em>Login</em></button>

                    <p class="link">Don't have an account<br> 
                    <a href="register.php">Sign up</a> here</p>
            </form>
        </div>
    <div>
</body>
</html>