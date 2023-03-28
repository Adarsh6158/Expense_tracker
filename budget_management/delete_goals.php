<?php
include './Includes/Functions/functions.php';

$goal_id = $params['goal_id'];

$db->delete("goals", array("id"=>$goal_id));

// $db->delete("budget", array("id_g"=>$goal_id));


$_SESSION['SUCCESS'] = "Deleted successfully";
header("Location: goals.php");
die;