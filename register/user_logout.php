<?php
session_start();

unset($_SESSION['user']); 
     
    // We redirect them to the login page 
    header("Location: ../index.php?route=main"); 
    die("Redirecting to: ../index.php?route=main");
?>