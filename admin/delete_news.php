<?php
    include_once "../config.php";
    $id = $_GET["newsid"];
    //for delleting image from folder
    $query = "SELECT * FROM news WHERE news_id = {$id}";
    $result = mysqli_query($conn, $query) or die("Query failed");
    $row = mysqli_fetch_assoc($result);
    unlink("upload/" .$row['image']);
    // ------
    $result2 = mysqli_query($conn, "DELETE FROM news WHERE news_id = '$id'");
    $result3 = mysqli_query($conn, "DELETE FROM comments WHERE news_id = '$id'");
    if($result2 || $result3){
      echo "<script> alert('News deleted');
            window.location = 'manage_news.php'
            </script>";
    }else{
      echo "<script> alert('News not deleted');
            window.location = 'manage_news.php'
            </script>";
    }
 ?>
