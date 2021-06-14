<?php
    include_once "../config.php";
    $id = $_GET["cid"];
    $result = mysqli_query($conn, "DELETE FROM category WHERE category_id = '$id'");
    if($result){
      echo "<script> alert('Category deleted');
            window.location = 'manage_category.php'
            </script>";
    }else{
      echo "<script> alert('News not deleted');
            window.location = 'manage_category.php'
            </script>";
    }
 ?>
