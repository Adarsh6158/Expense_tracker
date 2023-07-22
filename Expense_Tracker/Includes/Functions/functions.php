<?php
session_start();
$dbname = "Expense_Tracker";
$host = "localhost";
$port = 3306;
$user = "root";
$password = "";

// Create a database connection
$db = mysqli_connect($host, $user, $password, $dbname, $port);

// Check the connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
$params = $_POST;
function ss() {
    return isset($_SESSION['user']);
}

function get_info($table, $id){
    global $db;

    if ($table == "wp_users") {
        $column = "ID";
    } elseif ($table == "sports") {
        $column = "sport_name";
    } else {
        $column = "id";
    }

    // Construct the SQL query based on the table and ID
    $sql = "SELECT * FROM $table WHERE $column = '$id'";

    $result = mysqli_query($db, $sql);

    // Check for query execution errors
    if (!$result) {
        die("Query failed: " . mysqli_error($db));
    }

    $row = mysqli_fetch_assoc($result);

    return $row; // Return the fetched row (associative array) from the query
}
function get_datetime(){
    return date('Y-m-d H:i:s');
}
?>
