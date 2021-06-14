<?php

    $host_name="localhost";
    $username="root";
    $password="";
    $dbname="news_portal";

    $conn = mysqli_connect($host_name, $username, $password, $dbname);
    if(!$conn){
       die("Error: ". mysqli_connect_error());
       exit();
    }

 ?>
