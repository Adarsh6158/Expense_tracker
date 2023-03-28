<?php
include './Includes/Functions/functions.php';
include './Includes/Functions/auth.php';


if($params['update']){
    $update = 1;
    $income_id = $params['income_id'];
}else{
    $update = 0;
}

$income = $params['income'];
$income['user_id'] = $_SESSION['user']['id'];

if(empty($income['name']) || empty($income['amount']) ){
    $_SESSION['ERROR'] = "All fields are required";
    if($update){
	header("Location: add_edit_income.php?income_id=$income_id");
    }else{
	header("Location: add_edit_income.php");
    }
    
    die;
}

if($update){
    $db->update("income", $income, array("id"=>$income_id));
}else{
    $income['date'] = get_datetime();
    
    $db->insert("income", $income);
}


$_SESSION['SUCCESS'] = "Saved successfully";
header("Location: income.php");
die;