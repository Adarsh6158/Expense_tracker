<?php
include './Includes/Functions/functions.php';
include './Includes/Functions/auth.php';

// Ensure that the form is submitted using POST method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: add_edit_category.php");
    die;
}

if (isset($_POST['update']) && $_POST['update']) {
    $update = 1;
    $category_id = $_POST['category_id'];
} else {
    $update = 0;
}

$category = $_POST['category'];

if (empty($category['name'])) {
    $_SESSION['ERROR'] = "All fields are required";
    if ($update) {
        header("Location: add_edit_category.php?category_id=$category_id");
    } else {
        header("Location: add_edit_category.php");
    }
    die;
}

if ($update) {
    // Prepare the update query using prepared statement
    $stmt = $db->prepare("UPDATE categories SET name = ? WHERE id = ?");
    $stmt->bind_param("si", $category['name'], $category_id);

    // Execute the update query
    if ($stmt->execute()) {
        // Update successful
    } else {
        // Update failed
        $_SESSION['ERROR'] = "Error updating category: " . $stmt->error;
        $stmt->close();
        header("Location: add_edit_category.php?category_id=$category_id");
        die;
    }

    $stmt->close();
} else {
    // Insert new category
    $category['datetime_added'] = get_datetime();

    // Prepare the insert query using prepared statement
    $stmt = $db->prepare("INSERT INTO categories (name, datetime_added) VALUES (?, ?)");
    $stmt->bind_param("ss", $category['name'], $category['datetime_added']);

    // Execute the insert query
    if ($stmt->execute()) {
        // Insert successful
    } else {
        // Insert failed
        $_SESSION['ERROR'] = "Error inserting category: " . $stmt->error;
        $stmt->close();
        header("Location: add_edit_category.php");
        die;
    }

    $stmt->close();
}

$_SESSION['SUCCESS'] = "Saved successfully";
header("Location: manage_categories.php");
die;
?>
