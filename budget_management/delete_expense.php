<?php
include './Includes/Functions/functions.php';

$expense_id = $params['expense_id'];

$db->delete("expenses", array("id"=>$expense_id));

$_SESSION['SUCCESS'] = "Deleted successfully";
header("Location: manage_expenses.php");
die;