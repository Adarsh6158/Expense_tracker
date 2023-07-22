<?php
include './Includes/Functions/functions.php';
include './Includes/Functions/auth.php';

// Ensure that the form is submitted using POST method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: add_edit_income.php");
    die;
}

if (isset($_POST['update']) && $_POST['update']) {
    $update = 1;
    $income_id = $_POST['income_id'];
} else {
    $update = 0;
}

$income = $_POST['income'];
$income['user_id'] = $_SESSION['user']['id'];

if (empty($income['name']) || empty($income['amount'])) {
    $_SESSION['ERROR'] = "All fields are required";
    if ($update) {
        header("Location: add_edit_income.php?income_id=$income_id");
    } else {
        header("Location: add_edit_income.php");
    }
    die;
}

if ($update) {
    // Prepare the update query using prepared statement
    $stmt = $db->prepare("UPDATE income SET name = ?, amount = ? WHERE id = ?");
    $stmt->bind_param("sdi", $income['name'], $income['amount'], $income_id);

    // Execute the update query
    if ($stmt->execute()) {
        // Update successful
    } else {
        // Update failed
        $_SESSION['ERROR'] = "Error updating income: " . $stmt->error;
        $stmt->close();
        header("Location: add_edit_income.php?income_id=$income_id");
        die;
    }

    $stmt->close();
} else {
    // Insert new income record
    $income['date'] = get_datetime();

    // Prepare the insert query using prepared statement
    $stmt = $db->prepare("INSERT INTO income (name, amount, user_id, date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdss", $income['name'], $income['amount'], $income['user_id'], $income['date']);

    // Execute the insert query
    if ($stmt->execute()) {
        // Insert successful
    } else {
        // Insert failed
        $_SESSION['ERROR'] = "Error inserting income: " . $stmt->error;
        $stmt->close();
        header("Location: add_edit_income.php");
        die;
    }

    $stmt->close();
}

$_SESSION['SUCCESS'] = "Saved successfully";
header("Location: income.php");
die;
?>
