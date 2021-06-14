<?php
    include_once "../config.php";
    $user_id = $_GET["userid"];
    $result = mysqli_query($conn, "DELETE FROM user WHERE user_id = '$user_id'");
    $result2 = mysqli_query($conn, "DELETE FROM comments WHERE user_id = '$user_id'");
    if($result || $result2){
      echo "<script> alert('User removed');
            window.location = 'users.php'
            </script>";
    }else{
      echo "<script> alert('News not deleted');
            window.location = 'users.php'
            </script>";
    }
 ?>
