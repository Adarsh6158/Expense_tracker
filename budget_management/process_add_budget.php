<?php
include './Includes/Functions/functions.php';
include './Includes/Functions/auth.php';


if($params['update']){
    $update = 1;
    $income_id = $params['budget_id'];
}else{
    $update = 0;
}

$income = $params['budget'];
$income['user_id'] = $_SESSION['user']['id'];

if(empty($income['goal_id']) || empty($income['amount_id']) ){
    $_SESSION['ERROR'] = "All fields are required";
    if($update){
	header("Location: add_edit_budget.php?budget_id=$income_id");
    }else{
	header("Location: add_edit_budget.php");
    }
    
    die;
}

if($update){
    $db->update("budget", $income, array("id"=>$income_id));
}else{
    $income['date'] = get_datetime();
    
    $db->insert("budget", $income);
}


$_SESSION['SUCCESS'] = "Saved successfully";
header("Location: budget.php");
die;