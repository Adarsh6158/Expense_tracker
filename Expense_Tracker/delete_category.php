<?php
include './Includes/Functions/functions.php';

$category_id = $_GET['category_id']; // or $_POST['category_id'] if using POST method

// Perform proper validation and sanitization of $category_id here

// Delete the category from the 'categories' table
$query_categories = "DELETE FROM categories WHERE id = '$category_id'";
$db->query($query_categories);

// Delete the associated expenses from the 'expenses' table
$query_expenses = "DELETE FROM expenses WHERE category_id = '$category_id'";
$db->query($query_expenses);

$_SESSION['SUCCESS'] = "Deleted successfully";
header("Location: manage_categories.php");
die;
