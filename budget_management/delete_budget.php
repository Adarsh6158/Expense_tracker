<?php
include './Includes/Functions/functions.php';

$budget_id = $params['budget_id'];

$db->delete("budget", array("id"=>$budget_id));

$_SESSION['SUCCESS'] = "Deleted successfully";
header("Location: budget.php");
die;