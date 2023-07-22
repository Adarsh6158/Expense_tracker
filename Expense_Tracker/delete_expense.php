<?php
include './Includes/Functions/functions.php';

$expense_id = $_GET['expense_id']; // or $_POST['expense_id'] if using POST method

// Perform proper validation and sanitization of $expense_id here

$query = "DELETE FROM expenses WHERE id = '$expense_id'";
$db->query($query);

$_SESSION['SUCCESS'] = "Deleted successfully";
header("Location: manage_expenses.php");
die;
