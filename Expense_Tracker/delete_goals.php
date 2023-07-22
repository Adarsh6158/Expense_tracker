<?php
include './Includes/Functions/functions.php';

$goal_id = $_GET['goal_id']; // or $_POST['goal_id'] if using POST method

// Perform proper validation and sanitization of $goal_id here

$query = "DELETE FROM goals WHERE id = '$goal_id'";
$db->query($query);

$_SESSION['SUCCESS'] = "Deleted successfully";
header("Location: goals.php");
die;
