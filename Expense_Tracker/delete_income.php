<?php
include './Includes/Functions/functions.php';

$income_id = $_GET['income_id']; // or $_POST['income_id'] if using POST method

// Perform proper validation and sanitization of $income_id here

// Delete the income record from the 'income' table
$query_income = "DELETE FROM income WHERE id = '$income_id'";
$db->query($query_income);

// Delete the associated expenses for the income from the 'expenses' table
$query_expenses = "DELETE FROM expenses WHERE category_id = '$income_id'";
$db->query($query_expenses);

$_SESSION['SUCCESS'] = "Deleted successfully";
header("Location: income.php");
die;
