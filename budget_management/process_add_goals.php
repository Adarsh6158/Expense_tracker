<?php
include './Includes/Functions/functions.php';
include './Includes/Functions/auth.php';


if($params['update']){
    $update = 1;
    $goal_id = $params['goal_id'];
}else{
    $update = 0;
}

$goal = $params['goals'];
$goal['user_id'] = $_SESSION['user']['id'];

if(empty($goal['goal'])){
    $_SESSION['ERROR'] = "All fields are required";
    if($update){
	header("Location: add_edit_goals.php?goal_id=$goal_id");
    }else{
	header("Location: add_edit_goals.php");
    }
    
    die;
}

if($update){
    $db->update("goals", $goal, array("id"=>$goal_id));
}else{
    $goal['date'] = get_datetime();
    
    $db->insert("goals", $goal);
}


$_SESSION['SUCCESS'] = "Saved successfully";
header("Location: goals.php");
die;