<?php
include './Includes/Functions/functions.php';
include './Includes/Functions/auth.php';

if($params['update']){
    $update = 1;
    $category_id = $params['category_id'];
}else{
    $update = 0;
}

$category = $params['category'];

if(empty($category['name'])){
    $_SESSION['ERROR'] = "All fields are required";
    if($update){
	header("Location: add_edit_category.php?category_id=$category_id");
    }else{
	header("Location: add_edit_category.php");
    }
    
    die;
}

if($update){
    $db->update("categories", $category, array("id"=>$category_id));
}else{
    $category['datetime_added'] = get_datetime();
    
    $db->insert("categories", $category);
}


$_SESSION['SUCCESS'] = "Saved successfully";
header("Location: manage_categories.php");
die;