<?php
include './Includes/Functions/functions.php';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget management system</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="main">
        <div class="form">
            <form action="process_register.php" method="post">
                    <h2>Sign up Here</h2>
                    <input type="text" name="user[username]" placeholder="Username" data-form-field="username" class="form-control display-7" value="" id="email-formbuilder-1o">
                    <input type="password" name="user[password]" placeholder="Password" data-form-field="password" class="form-control display-7" value="" id="password-formbuilder-1o">
                    <input type="password" name="user[confirm_password]" placeholder="Confirm Password" data-form-field="password" class="form-control display-7" value="" id="password1-formbuilder-1o">
                    <input type="text" name="birthday"  onfocus="(this.type='date')" placeholder="Date of birth">
                    <label class="container">Male
                        <input type="radio" name="gender" value="MALE"checked>
                        <span class="check"></span>
                      </label>
                      <label class="container">Female
                        <input type="radio" name="gender" value="FEMALE">
                        <span class="check"></span>
                      </label>
                    <button class="btnn" type="submit" name ="save1"><em>Sign up</em></button>
            </form>
        </div>
    <div>
</body>
</html>