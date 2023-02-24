<?php
    session_start();

    // unset($_SESSION['success_login']);
    // unset($_SESSION['role']);
    // unset($_SESSION['Admin']);
    // unset($_SESSION['manager']);
    // unset($_SESSION['student']);
    
    session_unset();
    session_destroy();
    header("location:login.php");
