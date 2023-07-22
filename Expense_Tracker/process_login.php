<?php
include './Includes/Functions/functions.php';

$user = $params['user'];

if(empty($user['username']) || empty($user['password'])){
    $_SESSION['ERROR'] = "Please enter all fields";
    header("Location: login.php");
    die;
}

$username = $user['username'];
$password = $user['password'];

// Establish the database connection
$conn = mysqli_connect("localhost", "root", "", "expense_tracker");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Construct the query
$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

// Execute the query
$result = mysqli_query($conn, $query);

// Fetch the result as an associative array
$check = mysqli_fetch_assoc($result);

// Close the database connection
mysqli_close($conn);

if(empty($check)){
    $_SESSION['ERROR'] =  "Invalid Username or Password";
    header("Location: login.php");
    die;
} else {
    $_SESSION['user'] = $check;
    $user_id = $check['id'];

    header("Location: index.php");
    die;
}
?>
