<?php
  include "../config.php";
  session_start();

  if(isset($_POST['postcomment'])){
    $comment = $_POST['comment'];
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
    $news_id = $_POST['news_id'];

    if($comment != ""){
      $sql = "INSERT INTO comments (news_id, user_id, user_name, comment) VALUES ('$news_id', '$user_id', '$user_name', '$comment') ";
      $result = mysqli_query($conn, $sql);
      if($result){
        header("Location: single_view.php?id=" . $news_id);
      }
    }
  }

 ?>
