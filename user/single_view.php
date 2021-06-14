<?php
  include_once "include/user_header.php";
  include_once "../config.php";
 ?>

<div class="container bg-light">

  <?php

      $news_id = $_GET['id'];
      $result = mysqli_query($conn, "SELECT news.news_id, news.title, news.description, news.image, news.category, news.news_date, category.category_name FROM news
                LEFT JOIN category ON news.category = category.category_id WHERE news.news_id = {$news_id}")
                or die("query failed.");
      while($data = mysqli_fetch_assoc($result)){
  ?>

  <div class=" mx-auto mt-3">
    <div class="alert alert-info text-center">
      <h3><b><?php echo $data['title']; ?></b></h3>
      <span> <u><?php echo $data['category_name']; ?></u>  </span>
      <span> <u><?php echo ", Uploaded on: ".$data['news_date']; ?></u>  </span>
    </div>
    <div class=" text-center ">
      <span class="border border-info">
        <img  class="img-fluid" src="../admin/upload/<?php echo $data['image']; ?>">
      </span>
    </div>
    <div class="mt-3 text-justify">
      <p><?php echo $data['description']; ?></p>
    </div>
  </div>

  <?php } ?>

</div>
<br>
<div class="container bg-light ">
  <div class="mx-auto mt-3 alert alert-secondary text-center">
    <h5>Add comment</h5>
    <form class="" action="comment.php" method="post">
      <input type="hidden" name="news_id" value="<?php echo $news_id; ?>">
      <div class="form-group">
          <textarea class="form-control" rows="2" name="comment"></textarea>
      </div>
        <input type="submit" name="postcomment" value="Comment" class="btn btn-primary">
    </form>
  </div>
</div>
<div class="container bg-light">
  <div class="mx-auto mt-3 alert alert-secondary text-center">
    <h5>All comments</h5>
    </div>
    <div class="text-center">
    <?php
        $comments_query = "SELECT * FROM comments WHERE news_id = '$news_id' ORDER BY comment_id DESC";
        $comment_result = mysqli_query($conn, $comments_query) or die("error");
        if(mysqli_num_rows($comment_result) > 0 ){
          while($com = mysqli_fetch_assoc($comment_result)){
            $username = $com['user_name'];
            $usercomment = $com['comment'];
            $user_id = $com['user_id'];
            //$commentID = $com['comment_id'];
            ?>
            <p> <?php echo "<b>$username</b>: " . $usercomment;?> <?php

                if($_SESSION['user_id'] == $user_id ){
                  ?> <a href="delete_comment.php?commentId=<?php echo $com['comment_id']; ?>"> Delete</a>
                  <?php
                }

             ?></p>

            <?php
            }
          }
        else{
          echo "<p class='alert alert-warning' role='alert'>
                  No comments.
                </p>";
        }
     ?>
     </div>
</div>

<?php
  include_once "include/user_footer.php";
 ?>
