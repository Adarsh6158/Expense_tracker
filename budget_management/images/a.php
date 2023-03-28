<?php
$servername="localhost";
$email="email";
$password="password";

// create connection
$conn=mysqli_connect($servername,$email,$password);

// check connection
if(!$conn)
   {
    die("connection failed:".mysqli_connect_error());
   }
   echo ("connected successfully");
?>
