<?php

    session_start();
    session_destroy();
    if (isset($_COOKIE['admin_email']) and isset($_COOKIE['admin_pass'])) {
    $email = $_COOKIE['admin_email'];
    $pass_cookie = $_COOKIE['admin_pass'];
    setcookie('admin_email', $email, time()-2);
    setcookie('admin_pass', $pass_cookie, time()-2);
    }
    header("location: index.php");

 ?>
