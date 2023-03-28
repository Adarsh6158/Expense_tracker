<?php
if(!ss()){
    header("Location: login.php");
    die;
}
//
//check_phone_confirmation($_SESSION['user']['id']);
//
//if((!isset($page) || $page !== "my_account") && $_SESSION['user']['role'] !== "admin"){
//    check_password_change($_SESSION['user']['id']);
//}
//
//if(!get_attribute("users", su_("id"), "enabled_2fa") && (!isset($page) || ($page !== "manage_2fa" && $page !== "my_account"))){
//    $_SESSION['ERROR'] = "Please set up 2-Factor Authentication using Google Authenticator";
//    header("Location: manage_2fa.php");
//    die;
//}
//
//if(isset($_SESSION['tip_jar_user_id']) && (!isset($page) || $page !== "tipjar")){
//    $tipping_to_user = get_info("users", $_SESSION['tip_jar_user_id']);
//    header("Location: tipjar.php?un=".$tipping_to_user['username']);
//}
