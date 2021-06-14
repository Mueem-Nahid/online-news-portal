<?php

    session_start();
    session_destroy();
    if (isset($_COOKIE['user_email']) and isset($_COOKIE['user_pass'])) {
    $email = $_COOKIE['user_email'];
    $pass = $_COOKIE['user_pass'];
    setcookie('user_email', $email, time()-2);
    setcookie('user_pass', $pass, time()-2);
    }
    header("location: ../index.php");

 ?>
