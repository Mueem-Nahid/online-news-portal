<?php

    include_once "../config.php";
    session_start();
    if(!empty($_POST["btnLogin"])){
      $email = $_POST["admin_email"];
      $pass_cookie = $_POST["admin_pass"];
      $pass = md5($_POST["admin_pass"]);
      $result = mysqli_query($conn, "SELECT * FROM admin_login WHERE eid = '$email' AND password = '$pass'");
      $row = mysqli_num_rows($result);
      if($row > 0){
        $data = mysqli_fetch_assoc($result);
        //set admin name into session
        if(isset($_POST['rememberme'])){
            setcookie('admin_email', $email, time()+3600);
            setcookie('admin_pass', $pass_cookie, time()+3600);
          }

        $_SESSION["session_admin_id"] = $data["id"];
        $_SESSION["session_admin_name"] = $data["name"];
        header("location: admin_dashboard.php");
      }else{
        echo"<script>
              alert('Invalid User');
              window.location='index.php';
             </script>";
      }
    }

 ?>
