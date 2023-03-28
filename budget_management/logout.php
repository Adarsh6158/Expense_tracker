<?php
include './Includes/Functions/functions.php';

session_destroy();
unset($_SESSION);
header("Location: index.php");
?>