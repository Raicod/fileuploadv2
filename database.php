<?php

session_start();

$conn=mysqli_connect("localhost", "root", "", "fileupload");
if (!$conn){
    die("Connection failed: " . mysqli_connect_error()); 
}

?>