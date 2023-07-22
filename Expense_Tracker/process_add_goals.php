<?php
include './Includes/Functions/Functions.php';
include './Includes/Functions/auth.php';

// Ensure that the form is submitted using POST method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: add_edit_goals.php");
    die;
}

if(isset($_POST['update'])){
    $update = 1;
    $goal_id = $_POST['goal_id'];
}else{
    $update = 0;
}

$goal = $_POST['goals'];
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
if ($update) {
    // Construct the SET clause for the update query
    $set_clause = '';
    foreach ($goal as $field => $value) {
        $field = mysqli_real_escape_string($db, $field);
        $value = mysqli_real_escape_string($db, $value);
        $set_clause .= "$field = '$value', ";
    }
    $set_clause = rtrim($set_clause, ', ');

    // Construct the update query
    $sql = "UPDATE goals SET $set_clause WHERE id = $goal_id";

    // Perform the query
    if (mysqli_query($db, $sql)) {
        // Update successful
    } else {
        // Update failed
        $_SESSION['ERROR'] = "Error updating goal: " . mysqli_error($db);
        header("Location: add_edit_goals.php?goal_id=$goal_id");
        die;
    }
} else {
    // Insert new goal
    $goal['date'] = get_datetime();
    
    // Construct the INSERT query based on the $goal array
    $fields = implode(',', array_keys($goal));
    $values = "'" . implode("','", array_values($goal)) . "'";
    $sql = "INSERT INTO goals ($fields) VALUES ($values)";

    // Perform the query
    if (mysqli_query($db, $sql)) {
        // Insert successful
    } else {
        // Insert failed
        $_SESSION['ERROR'] = "Error inserting goal: " . mysqli_error($conn);
        header("Location: add_edit_goals.php");
        die;
    }
}

$_SESSION['SUCCESS'] = "Saved successfully";
header("Location: goals.php");
die;
?>
