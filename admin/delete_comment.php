<?php
    include_once "../config.php";
    $comment_id = $_GET["commentId"];
    $result = mysqli_query($conn, "DELETE FROM comments WHERE comment_id = '$comment_id'");
    if($result){
      echo "<script> alert('Comment deleted.');
            window.location = 'all_comments.php'
            </script>";
    }else{
      echo "<script> alert('Comment not deleted');
            window.location = 'all_comments.php'
            </script>";
    }
 ?>
