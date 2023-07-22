<?php
include './Includes/Functions/functions.php';
include './Includes/Functions/auth.php';
$user_id = $_SESSION['user']['id'];

$user = $params['user'];
$username = $user['username'];

// Check if the new username is already in use
$check_username_query = "SELECT * FROM users WHERE username = '$username' AND id != $user_id";
$check_username_result = mysqli_query($db, $check_username_query);
$check_username = mysqli_fetch_assoc($check_username_result);

if (!empty($check_username)) {
    $_SESSION['ERROR'] =  "Username already in use";
    header("Location: profile.php");
    die;
}

$password = $user['password'];
$confirm_password = $user['confirm_password'];

if (!empty($password) || !empty($confirm_password)) {
    if ($password !== $confirm_password) {
        $_SESSION['ERROR'] =  "Passwords do not match";
        header("Location: profile.php");
        die;
    }

    unset($user['confirm_password']);

    // Uncomment the next line if you want to encrypt the password before storing it.
    // $user['password'] = md5($password);
} else {
    unset($user['password']);
    unset($user['confirm_password']);
}

// Prepare the SET clause for the update query
$set_clause = '';
foreach ($user as $field => $value) {
    $field = mysqli_real_escape_string($db, $field);
    $value = mysqli_real_escape_string($db, $value);
    $set_clause .= "$field = '$value', ";
}
$set_clause = rtrim($set_clause, ', ');

// Construct the update query
$sql = "UPDATE users SET $set_clause WHERE id = $user_id";

// Perform the query
if (mysqli_query($db, $sql)) {
    $_SESSION['SUCCESS'] = "Your profile has been updated successfully.";
} else {
    $_SESSION['ERROR'] = "Error updating profile: " . mysqli_error($db);
}

header("Location: profile.php");
die;
?>
