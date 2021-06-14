<?php
include_once "includes/admin_header.php";
include_once "../config.php";
?>

<div class="container">
  <div class="alert alert-info mt-3">
    <h4>All comments</h4>
  </div>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>News title</th>
        <th>User name</th>
        <th>Comments</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

      <?php
          $result = mysqli_query($conn, "SELECT comments.comment_id, comments.user_id, comments.user_name,
          comments.comment, news.title FROM comments LEFT JOIN news ON comments.news_id = news.news_id");
          while($data = mysqli_fetch_assoc($result)){
      ?>

      <tr>

        <td><?php echo $data['title']; ?></td>
        <td><?php echo $data['user_name']; ?></td>
        <td><?php echo $data['comment']; ?></td>
        <td> <a onclick="return confirm('Are you sure to delete the comment!')" href='delete_comment.php?commentId=<?php echo $data['comment_id']; ?>'> <button type="button" class="btn btn-danger">Delete comment</button> </a> </td>
      </tr>

        <?php  } ?>

    </tbody>
  </table>

</div>

<?php
    include_once "includes/admin_footer.php";
 ?>
