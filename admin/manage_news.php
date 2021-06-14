<?php
include_once "includes/admin_header.php";
include_once "../config.php";
?>

<div class="container">
  <div class="alert alert-info mt-3">
    <h4>Manage News</h4>
  </div>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Image</th>
        <th>News title</th>
        <th>Category</th>
        <th>Date</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>

      <?php
          $result = mysqli_query($conn, "SELECT news.news_id, news.title, news.news_date, news.image, category.category_name FROM news
                    LEFT JOIN category ON news.category = category.category_id ORDER BY news.news_id DESC");
          while($data = mysqli_fetch_assoc($result)){
      ?>

      <tr>
        <td><img class="img-responsive" height="50px" src="upload/<?php echo $data['image']; ?>"></td>
        <td><?php echo $data['title']; ?></td>
        <td><?php echo $data['category_name']; ?></td>
        <td><?php echo $data['news_date']; ?></td>
        <td> <a href='update_news.php?newsid=<?php echo $data['news_id']; ?>'> <button type="button" class="btn btn-info">Edit</button> </a> </td>
        <td> <a onclick="return confirm('Are you sure to delete the news!')" href='delete_news.php?newsid=<?php echo $data['news_id']; ?>'> <button type="button" class="btn btn-warning">Delete</button> </a> </td>
      </tr>

        <?php  } ?>

    </tbody>
  </table>

</div>
<?php
    include_once "includes/admin_footer.php";
 ?>
