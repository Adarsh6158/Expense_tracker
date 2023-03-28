<?php
include './Includes/Functions/functions.php';

$category_id = $params['category_id'];

$db->delete("categories", array("id"=>$category_id));

$db->delete("expenses", array("category_id"=>$category_id));


$_SESSION['SUCCESS'] = "Deleted successfully";
header("Location: manage_categories.php");
die;