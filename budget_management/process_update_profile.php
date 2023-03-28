<?php
include './Includes/Functions/functions.php';
include './Includes/Functions/auth.php';
$user_id = $_SESSION['user']['id'];


$user = $params['user'];

$username = $user['username'];

$check_username = $db->query("SELECT * FROM users WHERE username LIKE '$username'")->fetch(PDO::FETCH_ASSOC);
if(!empty($check)){
    $_SESSION['ERROR'] =  "Username already in use";
    header("Location: profile.php");
    die;
}




$password = $user['password'];
$confirm_password = $user['confirm_password'];

if(!empty($password) || !empty($confirm_password)){
    if($password !== $confirm_password){
	$_SESSION['ERROR'] =  "Passwords do not match";
	header("Location: profile.php");
	die;
    }


    unset($user['confirm_password']);

    $user['password'] = md5($password);

}else{
    unset($user['password']);
    unset($user['confirm_password']);
}


$db->update("users", $user, array("id"=>$user_id));


$_SESSION['SUCCESS'] = "Your profile has been updated successfully.";

header("Location: profile.php");
die;