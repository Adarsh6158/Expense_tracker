<?php
include './Includes/Functions/functions.php';
include './Includes/Functions/auth.php';

// Ensure that the form is submitted using POST method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: add_edit_expense.php");
    die;
}

if (isset($_POST['update']) && $_POST['update']) {
    $update = 1;
    $expense_id = $_POST['expense_id'];
} else {
    $update = 0;
}

$expense = $_POST['expense'];
$expense['user_id'] = $_SESSION['user']['id'];

if (empty($expense['amount_pid']) || empty($expense['description']) || empty($expense['category_id'])) {
    $_SESSION['ERROR'] = "All fields are required";
    if ($update) {
        header("Location: add_edit_expense.php?expense_id=$expense_id");
    } else {
        header("Location: add_edit_expense.php");
    }
    die;
}

if ($update) {
    // Prepare the update query using prepared statement
    $stmt = $db->prepare("UPDATE expenses SET amount_pid = ?, description = ?, category_id = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("dssii", $expense['amount_pid'], $expense['description'], $expense['category_id'], $expense_id, $_SESSION['user']['id']);

    // Execute the update query
    if ($stmt->execute()) {
        // Update successful
    } else {
        // Update failed
        $_SESSION['ERROR'] = "Error updating expense: " . $stmt->error;
        $stmt->close();
        header("Location: add_edit_expense.php?expense_id=$expense_id");
        die;
    }

    $stmt->close();
} else {
    // Insert new expense
    $expense['datetime_added'] = get_datetime();

    // Prepare the insert query using prepared statement
    $stmt = $db->prepare("INSERT INTO expenses (amount_pid, description, category_id, user_id, datetime_added) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("dssis", $expense['amount_pid'], $expense['description'], $expense['category_id'], $_SESSION['user']['id'], $expense['datetime_added']);

    // Execute the insert query
    if ($stmt->execute()) {
        // Insert successful
    } else {
        // Insert failed
        $_SESSION['ERROR'] = "Error inserting expense: " . $stmt->error;
        $stmt->close();
        header("Location: add_edit_expense.php");
        die;
    }

    $stmt->close();
}

$_SESSION['SUCCESS'] = "Saved successfully";
header("Location: manage_expenses.php");
die;
?>
