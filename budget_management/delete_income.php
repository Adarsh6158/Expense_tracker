<?php
include './Includes/Functions/functions.php';

$income_id = $params['income_id'];

$db->delete("income", array("id"=>$income_id));

$db->delete("expenses", array("category_id"=>$category_id));


$_SESSION['SUCCESS'] = "Deleted successfully";
header("Location: income.php");
die;