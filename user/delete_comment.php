<?php
    include_once "../config.php";
    $comment_id = $_GET["commentId"];
    $result2 = mysqli_query($conn, "SELECT * FROM comments WHERE comment_id = '$comment_id' ");
    $com = mysqli_fetch_assoc($result2);
    $id = $com['news_id'];



    $result = mysqli_query($conn, "DELETE FROM comments WHERE comment_id = '$comment_id'");
    if($result){
      header("Location: single_view.php?id=" .$id);
    }
 ?>
