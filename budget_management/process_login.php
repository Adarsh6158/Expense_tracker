<?php
include './Includes/Functions/functions.php';
//require __DIR__ . '/twilio-php-main/src/Twilio/autoload.php';
//use Twilio\Rest\Client;
//
//
//$t_account_sid = "ACd0b1687dbafae84084b9d8c145496d54";
//$t_auth_token = "98ed255cc07d9e0484eb017f269ab4af";

$user = $params['user'];

if(empty($user['username']) || empty($user['password'])){
    $_SESSION['ERROR'] = "Please enter all fields";
    header("Location: login.php");
    die;
}
// if(empty(username) || empty(password)){
//     $_SESSION['ERROR'] = "Please enter all fields";
//     header("Location: login.php");
//     die;
// }

// $username =username;
// $password = password;
$username = $user['username'];
$password = $user['password'];

$check = $db->query("SELECT * FROM users WHERE username LIKE '$username' AND password LIKE '$password'")->fetch();



if(empty($check)){
    $_SESSION['ERROR'] =  "Invalid Username or Password";
    header("Location: login.php");
    die;
}else{
    
    
    
    $_SESSION['user'] = $check;
    $user_id = $check['id'];

    header("Location: index.php");
    die;
    
}
    // $conn=mysqli_connect("localhost","root","","expense_tracker");
    // check connection
    // if(!$conn)
    // {
    //     echo("connection failed");
    // }
    // else{
    //     echo "connection ok";
    // }
    // if(isset($_POST['save']))
    // {
    //     $username=$_POST['email'];
    //     $password=$_POST['pass'];
    //     $query="SELECT * FROM users where username='$username' and password='$password'";
    //     $iquery=mysqli_query($conn,$query);
    //     $res=mysqli_fetch_array($iquery);
    //     if($res)
    //     {
           
    //         header("Location:index.php");
    //     }
    //     else{
    //         echo("Invalid Username or Password");
    //         header("Location:login.php");
    //     }
    // }
?>

