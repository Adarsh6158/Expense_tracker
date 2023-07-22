<?php
include './Includes/Functions/functions.php';

$budget_id = $_GET['budget_id']; // or $_POST['budget_id'] if using POST method

// Perform proper validation and sanitization of $budget_id here

$query = "DELETE FROM budget WHERE id = '$budget_id'";
$db->query($query);

$_SESSION['SUCCESS'] = "Deleted successfully";
header("Location: budget.php");
die;
