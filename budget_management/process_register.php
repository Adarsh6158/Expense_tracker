<?php
include './Includes/Functions/functions.php';

$user = $params['user'];

if(empty($user['password']) || empty($user['confirm_password'] || empty($user['username']))){
    $_SESSION['ERROR'] = "All fields are required";
    header("Location: register.php");
    die;
}


$username = $user['username'];

$check_username = $db->query("SELECT * FROM users WHERE username LIKE '$username'")->fetch(PDO::FETCH_ASSOC);
if(!empty($check)){
    $_SESSION['ERROR'] =  "Username already in use";
    header("Location: register.php");
    die;
}


$password = $user['password'];
$confirm_password = $user['confirm_password'];

if($password !== $confirm_password){
    $_SESSION['ERROR'] =  "Passwords do not match";
    header("Location: register.php");
    die;
}


unset($user['confirm_password']);

$user['datetime_registered'] = date('Y-m-d H:i:s');
$user['role'] = "user";

$user['password'] = $password;

$db->insert("users", $user);
$user_id = $db->lastInsertId();

$user = get_info("users", $user_id);

$_SESSION['user'] = $user;

$_SESSION['SUCCESS'] = "Your account has been created successfully";

header("Location: index.php");
die;