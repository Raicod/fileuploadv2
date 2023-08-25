<?php
    require_once("database.php");

    if(!$_SESSION['role']){
        header("Location: Login.php");
    }
?>