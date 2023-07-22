<?php
include './Includes/Functions/functions.php';
include './Includes/Functions/auth.php';

// Ensure that the form is submitted using POST method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: add_edit_budget.php");
    die;
}

if (isset($_POST['update'])) {
    $update = 1;
    $budget_id = $_POST['budget_id'];
} else {
    $update = 0;
    $budget = array(); // Initialize an empty array for a new budget
}

$budget = $_POST['budget'];
$budget['user_id'] = $_SESSION['user']['id'];

// Check if any required field is empty
if (empty($budget['goal_id']) || empty($budget['amount'])) {
    $_SESSION['ERROR'] = "All fields are required";
    if ($update) {
        header("Location: add_edit_budget.php?budget_id=$budget_id");
    } else {
        header("Location: add_edit_budget.php");
    }
    die;
}

if ($update) {
    // Construct the SET clause for the update query
    $set_clause = '';
    foreach ($budget as $field => $value) {
        $field = mysqli_real_escape_string($db, $field);
        $value = mysqli_real_escape_string($db, $value);
        $set_clause .= "$field = '$value', ";
    }
    $set_clause = rtrim($set_clause, ', ');

    // Construct the update query
    $sql = "UPDATE budget SET $set_clause WHERE id = $budget_id";

    // Perform the query and handle errors
    if (mysqli_query($db, $sql)) {
        // Update successful
    } else {
        // Update failed
        $_SESSION['ERROR'] = "Error updating budget: " . mysqli_error($db);
        echo "SQL Error: " . mysqli_error($db); // Display the SQL error for debugging purposes
        header("Location: add_edit_budget.php?budget_id=$budget_id");
        die;
    }
} else {
    // Insert new budget
    $budget['date'] = get_datetime();

    // Construct the INSERT query based on the $budget array
    $fields = implode(',', array_keys($budget));
    $values = "'" . implode("','", array_values($budget)) . "'";
    $sql = "INSERT INTO budget ($fields) VALUES ($values)";

    // Perform the query and handle errors
    if (mysqli_query($db, $sql)) {
        // Insert successful
    } else {
        // Insert failed
        $_SESSION['ERROR'] = "Error inserting budget: " . mysqli_error($db);
        echo "SQL Error: " . mysqli_error($db); // Display the SQL error for debugging purposes
        header("Location: add_edit_budget.php");
        die;
    }
}

$_SESSION['SUCCESS'] = "Saved successfully";
header("Location: budget.php");
die;
?>
