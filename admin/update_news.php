<?php
    include_once "includes/admin_header.php";
    include_once "../config.php"
?>

  <div class="container">
    <?php
        //------for news table----------
        $news_id = $_GET['newsid'];
        $result = mysqli_query($conn, "SELECT news.news_id, news.title, news.description, news.image, news.category, category.category_name FROM news
                  LEFT JOIN category ON news.category = category.category_id WHERE news.news_id = {$news_id}")
                  or die("query failed.");
        while($data = mysqli_fetch_assoc($result)){
    ?>
   <form  action="save_updated_news.php" method="post" enctype="multipart/form-data">
        <div class="alert alert-primary mt-3">
          <h3>Update news</h3>
        </div>
        <!-- to update, it needs to take the id  -->
        <div class="form-group">
          <input type="hidden" name="news_id" class="form-control" value="<?php echo $data['news_id']; ?>">
        </div>
        <!--  -->
        <div class="form-group">
         <label for="newstitle">News title:</label>
         <input type="text" name="newstitle" class="form-control" value="<?php echo $data['title']; ?>">
        </div>
        <div class="form-group">
          <label for="newsdescription">Description</label>
          <textarea name="newsdescription" class="form-control" rows="8" cols="80" ><?php echo $data['description']; ?></textarea>
        </div>
        <div class="form-group">
          <label for="category">Category</label>
          <select class="form-control" name="select_category" required>
            <option disabled>Select category</option>
            <?php
                //-----------for category table------------
                $query = "SELECT * FROM category";
                $result2 = mysqli_query($conn, $query) or die("query failed.");
                if(mysqli_num_rows($result2) > 0){
                  while ($row = mysqli_fetch_assoc($result2)) {
                    if($data['category'] == $row['category_id']){
                      $selected_category = "selected";
                    }else{
                      $selected_category = "";
                    }
                    echo "<option  {$selected_category} value='{$row['category_id']}'>{$row['category_name']}</option>";
                  }
                }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="image">Choose new image</label>
          <!-- for new picture -->
          <input type="file" name="new-image" accept="image/*"><br>
          <img class="img-responsive" src="upload/<?php echo $data['image']; ?>" height="150px">
          <!-- if new image is not selected -->
          <input type="hidden" name="old-image" value="<?php echo $data['image']; ?>">
        </div>

        <div class="form-group">
          <input type="submit" name="btnUpdateNews"  class="btn btn-success" value="Update">
          <a href="manage_news.php"><button type="button" class="btn btn-info">Cancel</button></a>

        </div>

    </form>

  <?php  } ?>

 </div>

 <?php
      include_once "includes/admin_footer.php";
  ?>
